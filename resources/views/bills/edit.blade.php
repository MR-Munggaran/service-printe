@extends('layouts.app')

@section('title', 'Edit Nota')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Edit Nota</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bills.update', $bill) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Barang</label>
                                <select name="item_id" class="form-control @error('item_id') is-invalid @enderror" required>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" {{ $bill->item_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }} (Rp {{ number_format($item->selling_price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label>Pelanggan</label>
                                <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $bill->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Jumlah</label>
                                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $bill->amount) }}" min="1" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label>Total</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total', $bill->total) }}" min="0" step="0.01" required>
                                </div>
                                @error('total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Periode</label>
                            <input type="month" name="period" class="form-control @error('period') is-invalid @enderror" value="{{ old('period', $bill->period->format('Y-m')) }}" required>
                            @error('period')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Nota</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection