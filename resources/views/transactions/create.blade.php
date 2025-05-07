@extends('layouts.app')

@section('title','Buat Transaksi Baru')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5>Buat Transaksi Baru</h5>
    </div>
    <div class="card-body">
      <form id="tx-form" method="POST" action="{{ route('transactions.store') }}">
        @csrf

        <div class="form-group">
          <label for="invoice_no">Invoice No</label>
          <input type="text" name="invoice_no" id="invoice_no"
                 class="form-control @error('invoice_no') is-invalid @enderror"
                 value="{{ old('invoice_no') }}" required>
          @error('invoice_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="customer_id">Pelanggan (opsional)</label>
          <select name="customer_id" id="customer_id" class="form-control">
            <option value="">- Tetap Umum -</option>
            @foreach($customers as $c)
            <option value="{{ $c->id }}" {{ old('customer_id')==$c->id?'selected':'' }}>
              {{ $c->name }}
            </option>
            @endforeach
          </select>
        </div>

        <hr>

        <h6>Lines (Barang / Service)</h6>
        <table class="table table-sm" id="lines-table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Item / Service</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th><button type="button" id="add-line" class="btn btn-sm btn-success">+</button></th>
            </tr>
          </thead>
          <tbody>
            {{-- Jika ada old lines, loop di sini --}}
          </tbody>
        </table>

        <div class="row">
          <div class="col-md-4">
            <label for="discount">Diskon</label>
            <input type="number" name="discount" id="discount"
                   class="form-control" value="{{ old('discount',0) }}" min="0" step="0.01">
          </div>
          <div class="col-md-4">
            <label for="paid">Bayar</label>
            <input type="number" name="paid" id="paid"
                   class="form-control" value="{{ old('paid',0) }}" min="0" step="0.01" required>
          </div>
          <div class="col-md-4">
            <label for="payment_method">Metode Bayar</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
              <option value="cash">Cash</option>
              <option value="card">Card</option>
              <option value="transfer">Transfer</option>
              <option value="ewallet">eWallet</option>
            </select>
          </div>
        </div>

        <hr>

        <div class="text-right">
          <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const items = @json($items);
  const services = @json($services);

  function renderOption(type) {
    let arr = type==='item'? items : services;
    return arr.map(o => `<option value="${o.id}" data-price="${o.${type}==='item'?'selling_price':'service_fee'}">${o.name} - Rp ${o.${type}==='item'?o.selling_price:o.service_fee}</option>`).join('');
  }

  function addLine(old={type:'item',id:'',quantity:1,price:0}) {
    let row = document.createElement('tr');
    row.innerHTML = `
      <td>
        <select name="lines[][type]" class="form-control line-type">
          <option value="item" ${old.type==='item'?'selected':''}>Item</option>
          <option value="service" ${old.type==='service'?'selected':''}>Service</option>
        </select>
      </td>
      <td>
        <select name="lines[][id]" class="form-control line-id">
          ${renderOption(old.type)}
        </select>
      </td>
      <td><input type="number" name="lines[][quantity]" class="form-control line-qty" value="${old.quantity}" min="1"></td>
      <td><input type="number" name="lines[][price]" class="form-control line-price" value="${old.price}" step="0.01"></td>
      <td class="line-subtotal">0</td>
      <td><button type="button" class="btn btn-sm btn-danger remove-line">&times;</button></td>
    `;
    document.querySelector('#lines-table tbody').append(row);
    recalcRow(row);
  }

  function recalcRow(row) {
    const qty = +row.querySelector('.line-qty').value;
    const price = +row.querySelector('.line-price').value;
    row.querySelector('.line-subtotal').textContent = (qty*price).toFixed(2);
  }

  document.addEventListener('DOMContentLoaded',()=>{
    document.getElementById('add-line').onclick = ()=>addLine();
    document.querySelector('#lines-table').addEventListener('input', e=>{
      if(e.target.closest('tr')) recalcRow(e.target.closest('tr'));
    });
    document.querySelector('#lines-table').addEventListener('click', e=>{
      if(e.target.matches('.remove-line'))
        e.target.closest('tr').remove();
    });
    // inisialisasi satu baris
    addLine();
  });
</script>
@endpush
