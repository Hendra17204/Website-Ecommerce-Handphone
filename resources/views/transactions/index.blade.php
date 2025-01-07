@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2>Daftar Transaksi</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>Pengguna</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->product->name }}</td>
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->payment_method }}</td>
                            <td>Rp {{ number_format($transaction->amount, 2, ',', '.') }}</td>
                            <td>{{ $transaction->status }}</td>
                            <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada transaksi ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
