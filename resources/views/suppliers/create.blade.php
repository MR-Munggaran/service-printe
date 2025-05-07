@extends('layouts.app')

@section('title','Tambah Supplier')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5>Tambah Supplier</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf

        <div class="form-group">
          <label for="name">Nama Supplier</label>
          <input type="text" name="name" id="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name') }}" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="contact_person">Contact Person</label>
          <input type="text" name="contact_person" id="contact_person"
                 class="form-control @error('contact_person') is-invalid @enderror"
                 value="{{ old('contact_person') }}">
          @error('contact_person')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="phone">Telepon</label>
          <input type="text" name="phone" id="phone"
                 class="form-control @error('phone') is-invalid @enderror"
                 value="{{ old('phone') }}">
          @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}">
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="address">Alamat</label>
          <textarea name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    rows="3">{{ old('address') }}</textarea>
          @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-primary">Simpan Supplier</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
