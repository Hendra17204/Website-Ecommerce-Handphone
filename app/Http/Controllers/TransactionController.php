<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $entries = $request->input('entries', 10); // Default to 10 if not set  

        $transactions = Transaction::with(['product', 'user']) // Pastikan untuk memuat relasi  
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })->paginate($entries);

        return view('transactions.index', compact('transactions'));
    }


    public function confirm(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return view('transactions.confirm', compact('product'));
    }

    public function purchase(Request $request, $id)
    {
        // Validasi input    
        $request->validate([
            'quantity' => 'required|integer|min:1', // Tambahkan validasi untuk jumlah  
            'payment_method' => 'required|string', // Pastikan payment_method tidak null    
        ]);

        // Temukan produk berdasarkan ID    
        $product = Product::findOrFail($id);

        // Cek apakah jumlah yang diminta tersedia  
        if ($request->quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Jumlah produk yang diminta melebihi stok yang tersedia.');
        }

        // Simulasi penyimpanan transaksi    
        Transaction::create([
            'user_id' => auth()->id(), // ID pengguna yang melakukan pembelian    
            'product_id' => $product->id,
            'payment_method' => $request->payment_method, // Ambil nilai dari request    
            'amount' => $product->price * $request->quantity, // Hitung total harga  
            'status' => 'pending', // Status bisa diatur sesuai kebutuhan    
        ]);

        // Kurangi jumlah produk yang tersedia  
        $product->quantity -= $request->quantity;
        $product->save();

        // Redirect ke halaman sukses atau halaman lain    
        return redirect()->route('dashboard')->with('success', 'Pembelian berhasil dilakukan.');
    }
}
