@extends('layouts.app')

@section('content')
    <div class="container">

        @if (Auth::user()->role === 'admin')
            <h3 class="my-4 text-left">Informasi</h3>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 rounded-lg shadow-lg mb-3" style="background-color: #2E7D32;">
                        <div class="card-header text-center text-white"><strong>Jumlah Produk</strong></div>
                        <div class="card-body text-center">
                            <h5 class="card-title display-4 text-white">{{ \App\Models\Product::count() }}</h5>
                            <p class="card-text text-white">Total produk yang tersedia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 rounded-lg shadow-lg mb-3" style="background-color: #1976D2;">
                        <div class="card-header text-center text-white"><strong>Jumlah Produk Terjual</strong></div>
                        <div class="card-body text-center">
                            <h5 class="card-title display-4 text-white">{{ \App\Models\Transaction::count() }}</h5>
                            <p class="card-text text-white">Total produk yang telah terjual.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 rounded-lg shadow-lg mb-3" style="background-color: #FFA000;">
                        <div class="card-header text-center text-white"><strong>Jumlah Pengguna</strong></div>
                        <div class="card-body text-center">
                            <h5 class="card-title display-4 text-white">{{ \App\Models\User::count() }}</h5>
                            <p class="card-text text-white">Total pengguna terdaftar.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h3 class="my-4 text-left">Produk Terbaru</h3>
        <div class="row">
            @forelse (\App\Models\Product::latest()->take(3)->get() as $product)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 rounded-lg shadow-lg h-100">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('path/to/default/image.jpg') }}"
                            class="card-img-top img-fluid" alt="{{ $product->name }}"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text mb-1">{{ $product->category }}</p>
                            <p class="card-text text-success fw-bold mb-2">Rp
                                {{ number_format($product->price, 2, ',', '.') }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-outline-secondary btn-sm">Detail</a>
                                @if (Auth::user()->role === 'user')
                                    <form action="{{ route('products.confirm', $product) }}" method="GET"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Beli</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">Tidak ada produk terbaru.</div>
            @endforelse
        </div>
    </div>
@endsection
