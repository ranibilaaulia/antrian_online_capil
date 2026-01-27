@extends('template_admin.layout')

@section('head')
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<style>
    .dashboard-card {
        border-radius: 12px;
        text-align: center;
        padding: 30px 20px;
        font-weight: bold;
        color: #fff;
        /* teks putih */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        transition: transform 0.2s ease-in-out;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .dashboard-card h5 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .dashboard-card h2 {
        font-size: 42px;
        font-weight: 800;
    }

    /* Warna khusus tiap kotak */
    .card-total {
        background: #28a745 !important;
    }

    /* hijau */
    .card-selesai {
        background: #007bff !important;
    }

    /* biru */
    .card-berjalan {
        background: #fd7e14 !important;
    }

    /* oranye */
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <!-- Total Antrian -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card card-total">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5>Total Antrian</h5>
                    <h2>{{ $totalAntrian ?? 30 }}</h2>
                </div>
            </div>
        </div>

        <!-- Antrian Selesai -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card card-selesai">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h5>Antrian Selesai</h5>
                    <h2>{{ $antrianSelesai }}</h2>
                </div>
            </div>
        </div>

        <!-- Antrian Berjalan -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card card-berjalan">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-clock fa-3x mb-3"></i>
                    <h5>Antrian Berjalan</h5>
                    <h2>{{ $antrianBerjalan}}</h2>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
