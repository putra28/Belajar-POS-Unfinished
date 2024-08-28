<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
    <a href="{{ URL('/dashboard') }}"
        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-5 d-none d-sm-inline">Point Of Sale</span>
    </a>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-1 align-items-center align-items-sm-start" id="menu">
        <li class="w-100">
            <a href="{{ URL('/dashboard') }}" class="nav-link px-0 align-middle" style="color: #ffffff">
                <i class="fa-solid fa-gauge"></i> <span class="ms-1 d-none d-sm-inline">
                    Dashboard</span></a>
        </li>
        <li class="w-100">
            <a href="{{ URL('/transaksi') }}" class="nav-link px-0 align-middle" style="color: #ffffff">
                <i class="fa-solid fa-cart-shopping"></i> <span class="ms-1 d-none d-sm-inline">
                    Transaksi</span></a>
        </li>
        <li class="w-100 dropend dropend">
            <a href="#" role="button" class="nav-link px-0 align-middle" style="color: #ffffff"
                id="dropdownManajemen" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-table"></i> <span class="ms-1 d-none d-sm-inline">
                    Manajemen</span></a>
            <ul class="dropdown-menu text-small shadow" style="background-color: rgba(0, 0, 0, 0.623); backdrop-filter: blur(10px); li:hover {color: black;}">
                <li><a class="dropdown-item link-light" href="{{ URL('/manage_produk') }}" style="color: black; :hover {color: white !important;}"
                    onmouseover="this.classList.add('link-dark')" onmouseout="this.classList.remove('link-dark')">
                    <i class="fa-solid fa-utensils"></i>
                        <span class="ms-1 d-none d-sm-inline">Manajemen Produk</span>
                    </a>
                </li>
                <li><a class="dropdown-item link-light" href="{{ URL('/manage_kategori') }}" style="color: black; :hover {color: white !important;}"
                    onmouseover="this.classList.add('link-dark')" onmouseout="this.classList.remove('link-dark')">
                    <i class="fa-solid fa-list-check"></i>
                        <span class="ms-1 d-none d-sm-inline">Manajemen Kategori</span>
                    </a>
                </li>
                <li><hr>
                </li>
                <li><a class="dropdown-item link-light" href="{{ URL('/manage_member') }}" style="color: black; :hover {color: white !important;}"
                    onmouseover="this.classList.add('link-dark')" onmouseout="this.classList.remove('link-dark')">
                    <i class="fa-regular fa-id-badge"></i>
                        <span class="ms-1 d-none d-sm-inline">Manajemen Member</span>
                    </a>
                </li>
                <li><a class="dropdown-item link-light" href="{{ URL('/manage_supplier') }}" style="color: black; :hover {color: white !important;}"
                    onmouseover="this.classList.add('link-dark')" onmouseout="this.classList.remove('link-dark')">
                    <i class="fa-solid fa-truck"></i>
                        <span class="ms-1 d-none d-sm-inline">Manajemen Supplier</span>
                    </a>
                </li>
                <li><hr>
                </li>
                <li><a class="dropdown-item link-light" href="{{ URL('/manage_users') }}" style="color: black; :hover {color: white !important;}"
                    onmouseover="this.classList.add('link-dark')" onmouseout="this.classList.remove('link-dark')">
                    <i class="fa-regular fa-id-card"></i>
                        <span class="ms-1 d-none d-sm-inline">Manajemen Pengguna</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="w-100 dropend dropend">
            <a href="#" role="button" class="nav-link px-0 align-middle" style="color: #ffffff"
                id="dropdownLaporan" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-regular fa-clipboard"></i> <span class="ms-1 d-none d-sm-inline">
                    Laporan</span></a>
            <ul class="dropdown-menu text-small shadow" style="background-color: rgba(0, 0, 0, 0.623); backdrop-filter: blur(10px); li:hover {color: black;}">
                <li><a class="dropdown-item link-light" href="{{ URL('/penjualan_detail') }}" style="color: black; :hover {color: white !important;}"
                    onmouseover="this.classList.add('link-dark')" onmouseout="this.classList.remove('link-dark')">
                    <i class="fa-solid fa-receipt"></i>
                        <span class="ms-1 d-none d-sm-inline">Detail Penjualan</span>
                    </a>
                </li>
                <li><a class="dropdown-item link-light" href="{{ URL('/penjualan_histori') }}" style="color: black; :hover {color: white !important;}"
                    onmouseover="this.classList.add('link-dark')" onmouseout="this.classList.remove('link-dark')">
                    <i class="fa-solid fa-cash-register"></i>
                        <span class="ms-1 d-none d-sm-inline">Histori Penjualan</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <hr>
    <div class="dropdown pb-4">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
            <span class="d-none d-sm-inline mx-1">{{ session('nama_user') }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updatePasswordModal"
                    style="cursor: pointer;">Update Password</a></li>
            <li><a class="dropdown-item" href="{{ URL('logout') }}">Sign out</a></li>
        </ul>
    </div>
</div>
