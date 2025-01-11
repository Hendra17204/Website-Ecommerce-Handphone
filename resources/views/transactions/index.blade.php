@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">Daftar Transaksi</h2>

        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex align-items-center">
                <p class="mb-0 me-2">Tampilkan</p>
                <form action="{{ route('transactions.index') }}" method="GET" class="d-flex">
                    <select name="entries" class="form-select me-2" onchange="this.form.submit()">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <input type="hidden" name="search" value="{{ request('search') }}">
                </form>
                <p class="mb-0">Data</p>
            </div>

            <form action="{{ route('transactions.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" placeholder="Cari transaksi..." class="form-control me-2"
                    style="width: auto;">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

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

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Menampilkan {{ $transactions->count() }} dari {{ $transactions->total() }} entri
            </div>
            <div>
                <nav>
                    <ul class="pagination">
                        @if ($transactions->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $transactions->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $transactions->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($transactions->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $transactions->nextPageUrl() }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
