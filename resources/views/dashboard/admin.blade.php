@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
</div>
<div class="row">
  @component('components.dashboard-card',['title'=>'Pending Service','count'=>$pendingServices,'icon'=>'fas fa-clock','color'=>'warning'])@endcomponent
  @component('components.dashboard-card',['title'=>'In Progress','count'=>$inProgress,'icon'=>'fas fa-spinner','color'=>'primary'])@endcomponent
  @component('components.dashboard-card',['title'=>'Completed','count'=>$completed,'icon'=>'fas fa-check-circle','color'=>'success'])@endcomponent
  @component('components.dashboard-card',['title'=>'Stok Rendah','count'=>$lowStockItems,'icon'=>'fas fa-exclamation-triangle','color'=>'danger'])@endcomponent
</div>
@endsection
