@if (Auth::user()->role === 'admin')
    @extends('layouts.app')

    @section('content')
        <div class="container mt-5">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-3"> <i class="fas fa-arrow-left"></i>
                Kembali</a>
            <h2 class="text-center mb-4">Edit Pengguna</h2>
            <form method="POST" action="{{ route('users.update', $user->id) }}" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Pengguna</label>
                    <input type="text" id="name" name="name" class="form-control" required
                        placeholder="Nama Pengguna" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email Pengguna</label>
                    <input type="email" id="email" name="email" class="form-control" required
                        placeholder="Email Pengguna" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Peran Pengguna</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Perbarui Pengguna</button>
                </div>
            </form>
        </div>
    @endsection
@endif
