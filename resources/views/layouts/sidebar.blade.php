<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cash-register"></i>  <!-- Changed from fa-print to cash register -->
        </div>
        <div class="sidebar-brand-text mx-3">Epson POS</div>  <!-- Added POS for clarity -->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Customers -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('customers.index') }}">
            <i class="fas fa-fw fa-users"></i>  <!-- More appropriate than chart-area -->
            <span>Customers</span>
        </a>
    </li>

    <!-- Categories -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-fw fa-tags"></i>  <!-- Better for categories -->
            <span>Categories</span>
        </a>
    </li>

    <!-- Items -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="fas fa-fw fa-box-open"></i>  <!-- Represents physical items -->
            <span>Items</span>
        </a>
    </li>

    <!-- Services -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('services.index') }}">
            <i class="fas fa-fw fa-concierge-bell"></i>  <!-- Represents services -->
            <span>Services</span>
        </a>
    </li>

    <!-- Bills -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('bills.index') }}">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>  <!-- Perfect for bills -->
            <span>Bills</span>
        </a>
    </li>

    <!-- Divider
    <hr class="sidebar-divider d-none d-md-block">

    Reports Section
    <div class="sidebar-heading">
        Reports
    </div>
    
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Sales Reports</span>
        </a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>