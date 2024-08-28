@extends('app')
@section('styles')
    <style>
        .icon-container {
            width: 50px;
            /* Lebar dan tinggi div */
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: linear-gradient(to right, #2D3250, #424769);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.671);
            /* Membuat bentuk lingkaran */
        }

        .icon {
            color: #cecece;
            /* Warna ikon */
        }

        .card-text {
            font-size: 20px !important;
        }

        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
@endsection
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- content -->
    <title>{{ $title }}</title>
    <div class="container">
        <h3>{{ $title }}</h3>
        <hr />
        <div class="row mb-3">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body mb-3" style="max-width:530px">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="row mb-3">
                    <div class="col-xl-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pendapatan</h5>
                                        <span class="h2 font-weight-bold mb-0">Hari Ini</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-container ">
                                            <i class="icon fa fa-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> Rp.</span>
                                    <span class="text-success mr-2"></i>number_format</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                                        <span class="h2 font-weight-bold mb-0">Menu</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-container ">
                                            <i class="icon fa fa-utensils"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> $totalproduk</span>
                                    <span class="text-nowrap">Menu</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Tanggal</h5>
                                        <span class="h2 font-weight-bold mb-0">Bulan Ini</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-container ">
                                            <i class="icon fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-nowrap">{{ now()->format('d/m/Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Penjualan</h5>
                                        <span class="h2 font-weight-bold mb-0">Bulan ini</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon-container ">
                                            <i class="icon fa fa-arrow-up"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 120 </span>
                                    <span class="text-nowrap">Penjualan</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body mb-3">
                        <table class="table table-hovered table-striped" id="trxTable">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Kode Trx</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Kode Trx</th>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Kode Trx</th>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Kode Trx</th>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Kode Trx</th>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Kode Trx</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#trxTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [
                    [5, 10, 15, 20, 25],
                    [5, 10, 15, 20, 25]
                ]
            });
            const ctx = document.getElementById('myChart');

            let smooth = true;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Total Penjualan',
                        data: [120, 190, 300, 500, 200, 300, 158, 235, 127, 378, 234, 941],
                        borderWidth: 2,
                        tension: smooth ? 0.3 : 0,
                        fill: smooth,
                        cubicInterpolationMode: 'monotone',
                        backgroundColor: '#4247693a',
                        borderColor: '#4247693a',
                        pointBorderColor: '#4247693a',
                        pointBackgroundColor: '#4247693a',
                        pointHoverBackgroundColor: '#4247693a',
                        pointHoverBorderColor: '#4247693a'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });
        </script>
    </div>
@endsection
