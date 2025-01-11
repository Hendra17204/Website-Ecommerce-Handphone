@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 18px;
        }

        .container h3 {
            color: #333;
            margin-bottom: 30px;
            text-align: start;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.3em;
            margin: 0;
            color: #333;
        }

        .card-text {
            color: #666;
        }

        .price {
            font-size: 1.5em;
            color: #4CAF50;
            font-weight: bold;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.4rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .info-card {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .info-card div {
            flex: 1;
            margin: 0 10px;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
            color: #333;
        }

        .info-card h4 {
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .info-card h2 {
            font-size: 2em;
            margin: 0;
        }

        .info-card p {
            font-size: 0.9em;
        }

        .info-card div:hover {
            color: #fff;
            background-color: #4caf4fbb;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-4 {
            flex: 0 0 32%;
            max-width: 32%;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .info-card {
                flex-direction: column;
            }

            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    @if (Auth::user()->role === 'admin')
        <div class="container">
            <h3>Informasi</h3>
            <div class="info-card">
                <div class="total-products">
                    <h4>Jumlah Produk</h4>
                    <h2>{{ \App\Models\Product::count() }}</h2>
                    <p class="my-2">Total produk yang tersedia.</p>
                </div>
                <div class="total-sold">
                    <h4>Jumlah Produk Terjual</h4>
                    <h2>{{ \App\Models\Transaction::count() }}</h2>
                    <p class="my-2">Total produk yang telah terjual.</p>
                </div>
                <div class="total-users">
                    <h4>Jumlah Pengguna</h4>
                    <h2>{{ \App\Models\User::count() }}</h2>
                    <p class="my-2">Total pengguna terdaftar.</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <h3>Produk</h3>
        <div class="row">
            @forelse (\App\Models\Product::latest()->take(10)->get() as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <a class="text-decoration-none" href="{{ route('products.show', $product) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('path/to/default/image.jpg') }}"
                                alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->category }}</p>
                                <p class="price">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                @if (Auth::user()->role === 'user')
                                    <form action="{{ route('products.confirm', $product) }}" method="GET"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Beli</button>
                                    </form>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">Tidak ada produk terbaru.</div>
            @endforelse
        </div>
    </div>
@endsection
