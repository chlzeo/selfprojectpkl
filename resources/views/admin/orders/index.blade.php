@extends('layouts.admin.master')

@section('ordersActive')
    text-primary
@endsection

@section('content')
    <h1 class="mb-4" style="font-size:x-large">Manajemen Pesanan</h1>
    <hr><br>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
                </div>
                <div class="card-body">
                    @if ($orders->isEmpty())
                        <p>Tidak ada pesanan ditemukan.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No. Order</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Status Pembayaran</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td><span
                                                    class="badge {{ $order->status == 'pending' ? 'bg-warning' : ($order->status == 'processing' ? 'bg-info' : ($order->status == 'completed' ? 'bg-success' : 'bg-danger')) }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            <td><span
                                                    class="badge {{ $order->payment_status == 'pending' ? 'bg-warning' : ($order->payment_status == 'paid' ? 'bg-success' : 'bg-danger') }}">{{ ucfirst($order->payment_status) }}</span>
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn btn-sm btn-info">Detail</a>
                                                {{-- Tombol hapus bisa ditambahkan di sini atau di halaman detail --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection