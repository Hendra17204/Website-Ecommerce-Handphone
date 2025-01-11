@if (Auth::user()->role === 'admin')
    @extends('layouts.app')

    @section('content')
        <div class="container mt-5">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-3"> <i class="fas fa-arrow-left"></i>
                Kembali</a>
            <h2 class="text-center mb-4">Edit Produk</h2>
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"
                class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input type="text" id="name" name="name" class="form-control" required
                        placeholder="Nama Produk" value="{{ old('name', $product->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="category" class="form-label">Kategori Produk</label>
                    <select id="category" name="category" class="form-select" required>
                        <option value="Apple" {{ old('category', $product->category) == 'Apple' ? 'selected' : '' }}>Apple
                        </option>
                        <option value="Samsung" {{ old('category', $product->category) == 'Samsung' ? 'selected' : '' }}>
                            Samsung</option>
                        <option value="Xiaomi" {{ old('category', $product->category) == 'Xiaomi' ? 'selected' : '' }}>
                            Xiaomi</option>
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
                            placeholder="Harga Produk" step="0.01" value="{{ old('price', $product->price) }}">
                    </div>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="quantity" class="form-label">Jumlah Produk</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required
                        placeholder="Jumlah Produk" value="{{ old('quantity', $product->quantity) }}">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Deskripsi Produk</label>
                    <textarea id="description" name="description" class="form-control" placeholder="Deskripsi Produk" rows="4">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($product->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Perbarui Produk</button>
                </div>
            </form>
        </div>
    @endsection
@endif
