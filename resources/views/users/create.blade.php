@if (Auth::user()->role === 'admin')
    @extends('layouts.app')

    @section('content')
        <div class="container mt-5">
            <h2 class="text-center mb-4">Tambah Pengguna</h2>
            <form method="POST" action="{{ route('users.store') }}" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama Pengguna</label>
                    <input type="text" id="name" name="name" class="form-control" required
                        placeholder="Nama Pengguna" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email Pengguna</label>
                    <input type="email" id="email" name="email" class="form-control" required
                        placeholder="Email Pengguna" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Peran Pengguna</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required
                        placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        required placeholder="Konfirmasi Password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Tambah Pengguna</button>
                </div>
            </form>
        </div>
    @endsection
@endif
