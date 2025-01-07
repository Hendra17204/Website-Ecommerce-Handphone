@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('path/to/default/image.jpg') }}"
                    class="img-fluid rounded shadow-lg" alt="{{ $product->name }}" style="height: 400px; object-fit: cover;">
            </div>
            <div class="col-md-6">
                <h2 class="my-4">{{ $product->name }}</h2>
                <div class="mb-4">
                    <dl class="row">
                        <dt class="col-sm-4">Kategori</dt>
                        <dd class="col-sm-8">{{ $product->category }}</dd>

                        <dt class="col-sm-4">Harga</dt>
                        <dd class="col-sm-8">Rp {{ number_format($product->price, 2, ',', '.') }}</dd>

                        <dt class="col-sm-4">Stok</dt>
                        <dd class="col-sm-8">
                            <span class="badge {{ $product->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->quantity }} {{ $product->quantity > 0 ? 'Tersedia' : 'Habis' }}
                            </span>
                        </dd>
                    </dl>
                </div>
                <h4 class="my-4">Deskripsi</h4>
                <p class="text-muted">{{ $product->description }}</p>
                @if (Auth::user()->role === 'user')
                    <form action="{{ route('products.confirm', $product) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">Beli Produk</button>
                    </form>
                @else
                    <p type="submit" class="btn btn-secondary btn-lg">Beli Produk</p>
                @endif
            </div>
        </div>
    </div>
@endsection
