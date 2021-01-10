<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{url('admin/dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>

            <a class="nav-link" href="{{route('obat.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-prescription-bottle-alt"></i></div>
                Data Obat
            </a>
            <a class="nav-link" href="{{route('persediaan.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-prescription-bottle"></i></div>
                Data Persediaan
            </a>

            <a class="nav-link" href="{{route('kmeans.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-prescription-bottle"></i></div>
                Proses Kmeans
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as: {{ Auth::user()->name }}</div>
        {{-- @section('login')

        @endsection --}}
    </div>
</nav>
