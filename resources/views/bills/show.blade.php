@extends('layouts.app')

@section('title', 'Detail Nota')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Detail Nota</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th>Barang</th>
                    <td>: {{ $bill->item->name }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>: {{ $bill->customer->name }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>: {{ $bill->amount }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>: Rp {{ number_format($bill->total, 2) }}</td>
                </tr>
                <tr>
                    <th>Periode</th>
                    <td>: {{ $bill->period->format('F Y') }}</td>
                </tr>
                <tr>
                    <th>Dibuat Tanggal</th>
                    <td>: {{ $bill->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>: {{ $bill->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('bills.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('bills.edit', $bill) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection