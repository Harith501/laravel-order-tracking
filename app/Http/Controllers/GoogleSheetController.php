<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Support\Facades\Log;

class GoogleSheetController extends Controller
{
    private function getClient()
    {
        $client = new Client();
        $client->setApplicationName('Laravel Google Sheets');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setAccessType('offline');

        return $client;
    }

    public function read()
    {
        try {
            $client = $this->getClient();
            $service = new Sheets($client);

            $spreadsheetId = env('GOOGLE_SHEET_ID');
            $range = 'try!A2:Z'; // Skip header row

            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();

            // Convert each row to an object
            $orders = collect($values)->map(function ($row) {
                return (object)[
                    'order_no' => $row[0] ?? '',
                    'customer_name' => $row[1] ?? '',
                    'installation_date' => $row[2] ?? '',
                    'exchange' => $row[3] ?? '',
                    'work_activity' => $row[4] ?? '',
                    'id_slot_order' => $row[5] ?? '',
                    'team_leader' => $row[6] ?? '',
                    'team_member_1' => $row[7] ?? '',
                    'team_member_2' => $row[8] ?? '',
                    'team_member_3' => $row[9] ?? '',
                    'order_status' => $row[10] ?? '',
                    'timestamp' => $row[11] ?? '',
                ];
            });

            return view('orders.index', ['orders' => $orders]);
        } catch (\Exception $e) {
            Log::error('Google Sheet Read Error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load data from Google Sheet.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_no' => 'required',
            'customer_name' => 'required',
            'installation_date' => 'required|date',
            'exchange' => 'required',
            'work_activity' => 'required',
            'id_slot_order' => 'required',
            'team_leader' => 'required',
            'team_member_1' => 'nullable',
            'team_member_2' => 'nullable',
            'team_member_3' => 'nullable',
            'order_status' => 'required',
        ]);

        try {
            $client = $this->getClient();
            $service = new Sheets($client);

            $spreadsheetId = env('GOOGLE_SHEET_ID');
            $range = 'try!A1';

            $values = [[
                $request->order_no,
                $request->customer_name,
                $request->installation_date,
                $request->exchange,
                $request->work_activity,
                $request->id_slot_order,
                $request->team_leader,
                $request->team_member_1,
                $request->team_member_2,
                $request->team_member_3,
                $request->order_status,
                now()->toDateTimeString()
            ]];

            $body = new \Google\Service\Sheets\ValueRange([
                'values' => $values
            ]);

            $params = ['valueInputOption' => 'RAW'];
            $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

            return redirect()->route('orders.index')->with('success', 'Order Successfully Saved!');
        } catch (\Exception $e) {
            Log::error('Google Sheet Write Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to save order.');
        }
    }
}
