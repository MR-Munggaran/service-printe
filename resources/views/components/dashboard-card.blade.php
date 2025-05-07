{{-- resources/views/components/dashboard-card.blade.php --}}
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-{{ $color }} shadow h-100 py-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-lg font-weight-bold text-{{ $color }} text-uppercase mb-2">
            {{ $title }}
          </div>
          <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
        </div>
        <div class="col-auto">
          <i class="{{ $icon }} fa-3x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
