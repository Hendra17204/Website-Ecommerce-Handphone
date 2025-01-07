<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('product', 'user')->get(); // Ambil semua transaksi dengan relasi  
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
            'payment_method' => 'required|string', // Pastikan payment_method tidak null  
        ]);

        // Temukan produk berdasarkan ID  
        $product = Product::findOrFail($id);

        // Simulasi penyimpanan transaksi  
        Transaction::create([
            'user_id' => auth()->id(), // ID pengguna yang melakukan pembelian  
            'product_id' => $product->id,
            'payment_method' => $request->payment_method, // Ambil nilai dari request  
            'amount' => $product->price,
            'status' => 'pending', // Status bisa diatur sesuai kebutuhan  
        ]);

        // Redirect ke halaman sukses atau halaman lain  
        return redirect()->route('dashboard')->with('success', 'Pembelian berhasil dilakukan.');
    }
}
