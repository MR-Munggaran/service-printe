@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-3">  <!-- Increased py-2 to py-3 -->
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-2">  <!-- Changed text-xs to text-lg and mb-1 to mb-2 -->
                            Jumlah Barang
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $itemsCount }}</div>  <!-- Changed h5 to h3 -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-3x text-gray-300"></i>  <!-- Increased fa-2x to fa-3x -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-3">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-success text-uppercase mb-2">
                            Stock Barang
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $items->sum('stock') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cubes fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-3">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-info text-uppercase mb-2">
                            Customers
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ $CustomersCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-3x text-gray-300"></i>  <!-- Changed fa-user to fa-users and increased size -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-3">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-warning text-uppercase mb-2">
                            Kategori Barang
                        </div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $categoriesCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-3x text-gray-300"></i>  <!-- Changed fa-table to fa-tags -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<!-- <div class="row">

    Area Chart
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            Card Header - Dropdown
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
            </div>
            Card Body
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
