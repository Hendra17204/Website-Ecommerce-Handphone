@if (Auth::user()->role === 'admin')
    @extends('layouts.app')

    @section('content')
        <div class="container mt-5">
            <h2 class="text-center mb-4">Tambah Produk Handphone</h2>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data"
                class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" id="name" name="name" class="form-control" required
                        placeholder="Masukkan Nama Produk" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="category" class="form-label">Kategori Produk</label>
                    <select id="category" name="category" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="iPhone" {{ old('category') == 'iPhone' ? 'selected' : '' }}>iPhone</option>
                        <option value="Samsung" {{ old('category') == 'Samsung' ? 'selected' : '' }}>Samsung</option>
                        <option value="Xiaomi" {{ old('category') == 'Xiaomi' ? 'selected' : '' }}>Xiaomi</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Harga Produk</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" id="price" name="price" class="form-control" required
                            placeholder="Masukkan Harga Produk" step="0.01" value="{{ old('price') }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="number" id="stock" name="quantity" class="form-control" required
                        placeholder="Masukkan Stok Produk" value="{{ old('quantity') }}"> <!-- Changed name to quantity -->
                    @error('quantity')
                        <!-- Changed error message to quantity -->
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Deskripsi Produk</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Masukkan Deskripsi Produk"
                        rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Tambah Produk</button>
                </div>
            </form>
        </div>
    @endsection
@endif
