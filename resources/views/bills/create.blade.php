@extends('layouts.app')

@section('title', 'Buat Nota Baru')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Buat Nota Baru</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bills.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="item_id">Barang</label>
                                <select name="item_id" id="item_id" class="form-control @error('item_id') is-invalid @enderror" required>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }} (Rp {{ number_format($item->selling_price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="customer_id">Pelanggan</label>
                                <select name="customer_id" id="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="amount">Jumlah</label>
                                <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" 
                                       value="{{ old('amount') }}" min="1" required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="total">Total</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" name="total" id="total" class="form-control @error('total') is-invalid @enderror" 
                                           value="{{ old('total') }}" min="0" step="0.01" required>
                                </div>
                                @error('total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="period">Periode</label>
                            <input type="month" name="period" id="period" class="form-control @error('period') is-invalid @enderror" 
                                   value="{{ old('period') }}" required>
                            @error('period')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">Simpan Nota</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection