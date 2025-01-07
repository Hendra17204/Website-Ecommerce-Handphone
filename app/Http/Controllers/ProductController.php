<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $products = Product::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%{$query}%");
        })->paginate(10); // Menggunakan pagination

        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create'); // Pastikan ini mengarah ke tampilan yang benar  
    }

    // Menyimpan produk baru  
    public function store(Request $request)
    {
        // Validasi input  
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => ['required', Rule::in(['iPhone', 'Samsung', 'Xiaomi'])], // Improved category validation  
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar  
        ]);

        // Menyimpan gambar jika ada  
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar di folder public/images  
        }

        // Membuat produk baru  
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image' => $imagePath, // Simpan path gambar  
        ]);

        // Redirect ke halaman produk dengan pesan sukses  
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Ambil produk berdasarkan ID  
        return view('products.edit', compact('product')); // Kembalikan tampilan edit dengan data produk  
    }

    public function update(Request $request, $id)
    {
        // Validasi input  
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Apple,Samsung,Xiaomi',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar  
        ]);

        // Ambil produk yang akan diperbarui  
        $product = Product::findOrFail($id);

        // Menyimpan gambar jika ada  
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada  
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar di folder public/images  
        } else {
            $imagePath = $product->image; // Jika tidak ada gambar baru, gunakan gambar lama  
        }

        // Perbarui produk  
        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image' => $imagePath, // Simpan path gambar  
        ]);

        // Redirect ke halaman produk dengan pesan sukses  
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
