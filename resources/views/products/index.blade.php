@if (Auth::user()->role === 'admin')
    @extends('layouts.app')

    @section('content')
        <div class="container my-5">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h1 class="text-center mb-4">Daftar Produk</h1>
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Produk</a>
                <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" placeholder="Cari produk..." class="form-control me-2"
                        style="width: auto;">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category }}</td>
                                <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="btn btn-warning btn-sm me-1">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada produk ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}
        </div>
    @endsection
@endif
