@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-3"> <i class="fas fa-arrow-left"></i>
                    Kembali</a>
                <h2 class="text-center mb-4">Konfirmasi Pembelian</h2>
                <div class="text-center mb-4">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('path/to/default/image.jpg') }}"
                        class="img-fluid rounded" alt="{{ $product->name }}" style="max-width: 300px;">
                </div>
                <h3 class="mb-3">{{ $product->name }}</h3>
                <dl class="row mb-4">
                    <dt class="col-sm-4">Kategori</dt>
                    <dd class="col-sm-8">{{ $product->category }}</dd>
                    <dt class="col-sm-4">Harga Satuan</dt>
                    <dd class="col-sm-8">Rp {{ number_format($product->price, 2, ',', '.') }}</dd>
                    <dt class="col-sm-4">Stok Tersedia</dt>
                    <dd class="col-sm-8">{{ $product->quantity }}</dd>
                </dl>

                <form action="{{ route('products.purchase', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="{{ $product->quantity }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total Harga</label>
                        <input type="text" id="total" name="total" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="credit_card">Kartu Kredit</option>
                            <option value="bank_transfer">Transfer Bank</option>
                            <option value="cash_on_delivery">Bayar di Tempat</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100">Konfirmasi Pembelian</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');
        const totalInput = document.getElementById('total');
        const unitPrice = {{ $product->price }}; // Get unit price from Blade    

        quantityInput.addEventListener('input', () => {
            const quantity = parseInt(quantityInput.value, 10) || 1; // Handle empty input    
            const totalPrice = quantity * unitPrice;
            totalInput.value = totalPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).replace('IDR', ''); // Menghapus 'IDR' yang ditambahkan oleh toLocaleString  
        });

        // Initial calculation    
        quantityInput.dispatchEvent(new Event('input'));
    </script>
@endsection
