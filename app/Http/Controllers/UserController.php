<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian dan jumlah entri per halaman  
        $search = $request->input('search');
        $entries = $request->input('entries', 10); // Default ke 10 jika tidak diset  

        // Ambil pengguna dengan paginasi dan pencarian  
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })->paginate($entries);

        return view('users.index', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }


    // Menyimpan pengguna baru  
    public function store(Request $request)
    {
        // Validasi input  
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:admin,user',
            'password' => 'required|string|min:8|confirmed', // Pastikan ada konfirmasi password  
        ]);

        // Membuat pengguna baru  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password), // Hash password  
        ]);

        // Redirect ke halaman pengguna dengan pesan sukses  
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil pengguna berdasarkan ID  
        return view('users.edit', compact('user')); // Kembalikan tampilan edit dengan data pengguna  
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
