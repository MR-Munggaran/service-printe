@extends('layouts.app')

@section('title', 'Data Nota')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Nota</h1>
        <a href="{{ route('bills.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Nota
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Nota</h6>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <form method="GET" action="{{ route('bills.index') }}" class="form-inline">
                    <div class="form-group mr-2">
                        <input type="text" name="item_name" class="form-control" 
                            placeholder="Cari nama barang" 
                            value="{{ request('item_name') }}">
                    </div>
                    <div class="form-group mr-2">
                        <input type="text" name="customer_name" class="form-control" 
                            placeholder="Cari nama pelanggan" 
                            value="{{ request('customer_name') }}">
                    </div>
                    <div class="form-group mr-2">
                        <input type="month" name="period" class="form-control" 
                            value="{{ request('period') }}">
                    </div>
                    <div class="form-group mr-2">
                        <input type="number" name="min_amount" class="form-control" 
                            placeholder="Min Jumlah" 
                            value="{{ request('min_amount') }}" min="0">
                    </div>
                    <div class="form-group mr-2">
                        <input type="number" name="max_amount" class="form-control" 
                            placeholder="Max Jumlah" 
                            value="{{ request('max_amount') }}" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Filter</button>
                    <a href="{{ route('bills.index') }}" class="btn btn-secondary mr-2">Reset</a>
                    <a
                        href="{{ route('bills.export', request()->only(['item_name','customer_name','period','min_amount','max_amount'])) }}"
                        class="btn btn-success"
                        >
                        Export ke Excel
                    </a>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Pelanggan</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        <tr>
                            <td>{{ $bill->item->name }}</td>
                            <td>{{ $bill->customer->name }}</td>
                            <td>{{ $bill->amount }}</td>
                            <td>Rp {{ number_format($bill->total, 2) }}</td>
                            <td>{{ $bill->period->format('Y-m') }}</td>
                            <td>
                            <div class="d-flex">
                                    <a href="{{ route('bills.show', $bill) }}" class="btn btn-info btn-circle btn-sm mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('bills.edit', $bill) }}" class="btn btn-warning btn-circle btn-sm mr-2">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('bills.destroy', $bill) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $bills->links() }}
            </div>
        </div>
    </div>
@endsection