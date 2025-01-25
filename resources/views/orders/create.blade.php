@extends('layouts.app')

@section('content')
<div class="container">
    <header class="header">
        <h1>Create Order</h1>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="order-form-container">
        <div class="form-section">
            <h2 class="form-title">Place Your Order</h2>
            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thesis_file">Upload Thesis (PDF or DOCX):</label>
                    <input type="file" name="thesis_file" id="thesis_file" accept=".pdf,.docx" required class="rounded-input" onchange="updatePageCountAndCost()">
                    @error('thesis_file')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="print_color">Color:</label>
                    <select name="print_color" id="print_color" required class="rounded-input" onchange="updateCost()">
                        <option value="bw">Black and White</option>
                        <option value="color">Color</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Page Count:</label>
                    <p id="page_count">0</p>
                </div>

                <div class="form-group">
                    <label>Base Cost (RM):</label>
                    <p id="base_cost">0.00</p>
                </div>
                
                <script>
                    function calculateBaseCost(pageCount, printType) {
                        const costPerPage = printType === 'color' ? 0.50 : 0.10;
                        return pageCount * costPerPage;
                    }

                    function updateCost() {
                        const pageCount = parseInt(document.getElementById('page_count').innerText) || 0;
                        const printType = document.getElementById('print_color').value;
                        const baseCost = calculateBaseCost(pageCount, printType);
                        document.getElementById('base_cost').innerText = baseCost.toFixed(2);
                    }

                    function updatePageCountAndCost() {
                        const fileInput = document.getElementById('thesis_file');
                        const file = fileInput.files[0];

                        if (file) {
                            const formData = new FormData();
                            formData.append('thesis_file', file);

                            fetch('{{ route('orders.page_count') }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('page_count').innerText = data.page_count;
                                const printType = document.getElementById('print_color').value;
                                const baseCost = calculateBaseCost(data.page_count, printType);
                                document.getElementById('base_cost').innerText = baseCost.toFixed(2);
                            })
                            .catch(error => console.error('Error:', error));
                        }
                    }
                </script>

                <div class="form-group">
                    <label for="paper_size">Paper Size:</label>
                    <select name="paper_size" id="paper_size" required class="rounded-input">
                        <option value="A4">A4</option>
                        <option value="Letter">Letter</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="binding_style">Binding Style:</label>
                    <select name="binding_style" id="binding_style" required class="rounded-input">
                        <option value="Hard Cover">Hard Cover</option>
                        <option value="Sewn">Sewn</option>
                        <option value="Spiral">Spiral</option>
                        <option value="Tape">Tape</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cover_colour">Cover Colour:</label>
                    <select name="cover_colour" id="cover_colour" required class="rounded-input">
                        <option value="Black">Black</option>
                        <option value="Dark Blue">Dark Blue</option>
                        <option value="Maroon">Maroon</option>
                        <option value="White">White</option>
                        <option value="Purple">Purple</option>
                        <option value="Green">Green</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1" required class="rounded-input">
                </div>

                <div class="form-group">
                    <label for="shipping_option">Shipping Option:</label>
                    <select name="shipping_option" id="shipping_option" required class="rounded-input">
                        <option value="pickup">Pick Up at Store</option>
                        <option value="delivery">Delivery</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select name="payment_method" id="payment_method" required class="rounded-input">
                        <option value="qr_code">QR Code</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit rounded-button">Place Order</button>
            </form>
        </div>
        <div class="image-section">
            <img src="/images/printing_service.jpg" alt="Printing Service" class="service-image">
        </div>
    </div>
</div>

<style>
    .order-form-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: auto;
    }
    .form-section {
        flex: 1;
        padding: 20px;
    }
    .image-section {
        flex: 1;
        padding: 20px;
    }
    .service-image {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }
    .form-title {
        text-align: center;
        color: #333;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .rounded-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    .btn-submit {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }
    .btn-submit:hover {
        background-color: #0056b3;
    }
    .alert {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>
@endsection