@extends('layouts.app')

@section('title', 'Buat Service Baru')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Buat Service Baru</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('services.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Barang</label>
                                <select name="item_id" class="form-control @error('item_id') is-invalid @enderror" required>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label>Pelanggan (Opsional)</label>
                                <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Tanggal Service</label>
                                <input type="date" name="service_date" class="form-control @error('service_date') is-invalid @enderror" value="{{ old('service_date') }}" required>
                                @error('service_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">Diproses</option>
                                    <option value="completed">Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection