<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi secara massal  
    protected $fillable = [
        'user_id',        // ID pengguna yang melakukan transaksi  
        'product_id',     // ID produk yang dibeli  
        'payment_method', // Metode pembayaran  
        'amount',         // Jumlah yang dibayarkan  
        'status',         // Status transaksi  
    ];

    // Relasi dengan model User  
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Product (jika diperlukan)  
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
