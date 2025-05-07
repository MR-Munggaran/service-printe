@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard Owner</h1>
</div>

<div class="row">
  @component('components.dashboard-card', [
    'title' => 'Kategori', 'count' => $categoriesCount, 'icon' => 'fas fa-tags', 'color' => 'warning'
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Barang',   'count' => $itemsCount,      'icon' => 'fas fa-boxes', 'color' => 'primary'
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Pelanggan','count' => $customersCount,  'icon' => 'fas fa-users', 'color' => 'info'
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Transaksi','count' => $totalTransactions,'icon' => 'fas fa-receipt', 'color' => 'success'
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Pendapatan','count' => 'Rp '.number_format($totalRevenue,0,',','.'),'icon' => 'fas fa-coins','color'=>'success'
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Service','count' => $totalServices, 'icon' => 'fas fa-tools','color'=>'secondary'
  ])@endcomponent
</div>
@endsection
