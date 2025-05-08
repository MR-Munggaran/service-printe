@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard Staff</h1>
</div>
<div class="row">
  @component('components.dashboard-card',['title'=>'My Pending','count'=>$myPending,'icon'=>'fas fa-clock','color'=>'warning'])@endcomponent
  @component('components.dashboard-card',['title'=>'My In Progress','count'=>$myInProgress,'icon'=>'fas fa-spinner','color'=>'primary'])@endcomponent
  @component('components.dashboard-card',['title'=>'My Completed','count'=>$myCompleted,'icon'=>'fas fa-check-circle','color'=>'success'])@endcomponent
</div>
@endsection
