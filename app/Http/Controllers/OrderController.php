<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 🧠 Sync Google Sheet → Laravel Database
    private function syncFromGoogleSheet()
    {
        $client = new \Google\Client();
        $client->setApplicationName('Laravel Google Sheets');
        $client->setScopes([\Google\Service\Sheets::SPREADSHEETS_READONLY]);
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setAccessType('offline');

        $service = new \Google\Service\Sheets($client);
        $spreadsheetId = env('GOOGLE_SHEET_ID');
        $range = 'try!A2:K'; // Skip header row

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $rows = $response->getValues();

        if (!empty($rows)) {
            foreach ($rows as $row) {
                if (!isset($row[0])) continue;

                Order::updateOrCreate(
                    ['order_no' => $row[0]],
                    [
                        'customer_name'     => $row[1] ?? null,
                        'installation_date' => $row[2] ?? null,
                        'exchange'          => $row[3] ?? null,
                        'work_activity'     => $row[4] ?? null,
                        'id_slot_order'     => $row[5] ?? null,
                        'team_leader'       => $row[6] ?? null,
                        'team_member_1'     => $row[7] ?? null,
                        'team_member_2'     => $row[8] ?? null,
                        'team_member_3'     => $row[9] ?? null,
                        'order_status'      => $row[10] ?? null,
                    ]
                );
            }
        }
    }

    // 📋 Admin-only: View all orders
    public function index(Request $request)
    {
        $this->syncFromGoogleSheet(); // Sync before showing
        $this->syncDeletedOrders();

        $query = Order::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('order_no', 'like', "%{$searchTerm}%")
                    ->orWhere('customer_name', 'like', "%{$searchTerm}%")
                    ->orWhere('id_slot_order', 'like', "%{$searchTerm}%");
            });
        }

        $orders = $query->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // 📝 Public: Show order form
    public function create()
    {
        return view('orders.create');
    }

    // ✅ Public: Store new order + sync to Google Sheets
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_no'         => 'required',
            'customer_name'    => 'required',
            'installation_date'=> 'required|date',
            'exchange'         => 'required',
            'work_activity'    => 'required',
            'id_slot_order'    => 'required',
            'team_leader'      => 'required',
            'team_member_1'    => 'nullable',
            'team_member_2'    => 'nullable',
            'team_member_3'    => 'nullable',
            'order_status'     => 'required',
        ]);

        $order = Order::create($validated);

        // Push to Google Sheet
        $client = new \Google\Client();
        $client->setApplicationName('Laravel Google Sheets');
        $client->setScopes([\Google\Service\Sheets::SPREADSHEETS]);
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setAccessType('offline');

        $service = new \Google\Service\Sheets($client);
        $spreadsheetId = env('GOOGLE_SHEET_ID');
        $range = 'try!A:K';

        $values = [[
            $order->order_no,
            $order->customer_name,
            $order->installation_date,
            $order->exchange,
            $order->work_activity,
            $order->id_slot_order,
            $order->team_leader,
            $order->team_member_1,
            $order->team_member_2,
            $order->team_member_3,
            $order->order_status
        ]];

        $body = new \Google\Service\Sheets\ValueRange(['values' => $values]);
        $params = ['valueInputOption' => 'RAW'];

        $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

        return redirect()->route('home')->with('success', 'Order submitted successfully!');
    }

    // ✏️ Admin-only: Edit
    public function edit($order_no)
    {
        if (!Auth::user()->IsAdmin) {
            abort(403, 'Unauthorized action.');
        }

        $order = Order::findOrFail($order_no);
        return view('orders.edit', compact('order'));
    }

    // 🔄 Admin-only: Update order
    // Replace the update() method with this:
public function update(Request $request, $order_no)
{
    if (!Auth::user()->IsAdmin) {
        abort(403, 'Unauthorized action.');
    }

    $order = Order::findOrFail($order_no);
    $order->update($request->all());

    // Sync update to Google Sheets
    $client = new \Google\Client();
    $client->setApplicationName('Laravel Google Sheets');
    $client->setScopes([\Google\Service\Sheets::SPREADSHEETS]);
    $client->setAuthConfig(storage_path('app/google/credentials.json'));
    $client->setAccessType('offline');

    $service = new \Google\Service\Sheets($client);
    $spreadsheetId = env('GOOGLE_SHEET_ID');
    $sheetRange = 'try!A2:K'; // Read data to find matching row

    $response = $service->spreadsheets_values->get($spreadsheetId, $sheetRange);
    $rows = $response->getValues();

    $targetRowIndex = null;
    foreach ($rows as $index => $row) {
        if (isset($row[0]) && $row[0] === $order->order_no) {
            $targetRowIndex = $index + 2; // +2 to account for 0-index and header row
            break;
        }
    }

    if ($targetRowIndex) {
        $updateRange = "try!A{$targetRowIndex}:K{$targetRowIndex}";
        $values = [[
            $order->order_no,
            $order->customer_name,
            $order->installation_date,
            $order->exchange,
            $order->work_activity,
            $order->id_slot_order,
            $order->team_leader,
            $order->team_member_1,
            $order->team_member_2,
            $order->team_member_3,
            $order->order_status
        ]];

        $body = new \Google\Service\Sheets\ValueRange(['values' => $values]);
        $params = ['valueInputOption' => 'RAW'];
        $service->spreadsheets_values->update($spreadsheetId, $updateRange, $body, $params);
    }

    return redirect()->route('orders.index')->with('success', 'Order updated and synced!');
}


    // 🗑️ Admin-only: Delete order
    public function destroy($order_no)
{
    if (!Auth::user()->IsAdmin) {
        abort(403, 'Unauthorized action.');
    }

    // Delete from MySQL database
    $order = Order::findOrFail($order_no);
    $order->delete();

    // Now delete from Google Sheets
    $client = new \Google\Client();
    $client->setApplicationName('Laravel Google Sheets');
    $client->setScopes([\Google\Service\Sheets::SPREADSHEETS]);
    $client->setAuthConfig(storage_path('app/google/credentials.json'));
    $client->setAccessType('offline');

    $service = new \Google\Service\Sheets($client);
    $spreadsheetId = env('GOOGLE_SHEET_ID');
    $sheetRange = 'try!A2:K'; // Assuming data starts from row 2

    // Get all rows to find the matching row to delete
    $response = $service->spreadsheets_values->get($spreadsheetId, $sheetRange);
    $rows = $response->getValues();

    $targetRowIndex = null;
    foreach ($rows as $index => $row) {
        if (isset($row[0]) && $row[0] === $order_no) {
            $targetRowIndex = $index + 2; // +2 for header + zero-based index
            break;
        }
    }

    if ($targetRowIndex) {
        // To delete a row in Google Sheets via API, you use the batchUpdate method
        $batchUpdateRequest = new \Google\Service\Sheets\BatchUpdateSpreadsheetRequest([
            'requests' => [
                'deleteDimension' => [
                    'range' => [
                        'sheetId' => $this->getSheetId($service, $spreadsheetId, 'try'), // You'll need this helper function below
                        'dimension' => 'ROWS',
                        'startIndex' => $targetRowIndex - 1, // zero-based index
                        'endIndex' => $targetRowIndex,
                    ]
                ]
            ]
        ]);

        $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
    }

    return redirect()->route('orders.index')->with('success', 'Order deleted from database and Google Sheets.');
}

/**
 * Helper function to get Sheet ID by sheet name.
 */
private function getSheetId($service, $spreadsheetId, $sheetName)
{
    $spreadsheet = $service->spreadsheets->get($spreadsheetId);
    foreach ($spreadsheet->getSheets() as $sheet) {
        if ($sheet->getProperties()->getTitle() === $sheetName) {
            return $sheet->getProperties()->getSheetId();
        }
    }
    return null;
}

public function syncDeletedOrders()
{
    $client = new \Google\Client();
    $client->setApplicationName('Laravel Google Sheets');
    $client->setScopes([\Google\Service\Sheets::SPREADSHEETS_READONLY]);
    $client->setAuthConfig(storage_path('app/google/credentials.json'));
    $client->setAccessType('offline');

    $service = new \Google\Service\Sheets($client);
    $spreadsheetId = env('GOOGLE_SHEET_ID');
    $range = 'try!A2:A'; // Only column A which stores order_no

    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $sheetOrderNos = collect($response->getValues())->flatten()->all();

    // Get all order_no from database
    $dbOrderNos = Order::pluck('order_no')->toArray();

    // Orders that exist in DB but NOT in the sheet anymore
    $toDelete = array_diff($dbOrderNos, $sheetOrderNos);

    if (!empty($toDelete)) {
        Order::whereIn('order_no', $toDelete)->delete();
    }
}


}
