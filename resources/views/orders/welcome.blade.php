<!DOCTYPE html>
<html>
<head>
    <title>Add Order</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input, textarea { display: block; margin-bottom: 10px; width: 100%; padding: 8px; }
        .item { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>Add New Order</h2>

@if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('orders.store') }}">
    @csrf
    <label>Customer Name</label>
    <input type="text" name="customer_name" required>

    <label>Order Date</label>
    <input type="date" name="order_date" required>

    <label>Remarks</label>
    <textarea name="remarks"></textarea>

    <h4>Order Items</h4>
    <div id="items">
        <div class="item">
            <input type="text" name="product_name[]" placeholder="Product Name" required>
            <input type="number" name="quantity[]" placeholder="Quantity" required>
            <input type="number" step="0.01" name="unit_price[]" placeholder="Unit Price" required>
        </div>
    </div>

    <button type="button" onclick="addItem()">+ Add Item</button><br><br>
    <button type="submit">Save Order</button>
</form>

<script>
function addItem() {
    let div = document.createElement('div');
    div.classList.add('item');
    div.innerHTML = `
        <input type="text" name="product_name[]" placeholder="Product Name" required>
        <input type="number" name="quantity[]" placeholder="Quantity" required>
        <input type="number" step="0.01" name="unit_price[]" placeholder="Unit Price" required>
    `;
    document.getElementById('items').appendChild(div);
}
</script>

</body>
</html>
