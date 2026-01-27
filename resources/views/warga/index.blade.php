<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga</title>

    <!-- SB Admin 2 & Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fc;
        }
        .card {
            border-radius: 1rem;
        }
        .btn-lg {
            border-radius: 2rem;
        }
        @media (max-width: 768px) {
            h4 {
                font-size: 1.3rem;
            }
            .card-body {
                padding: 1.25rem;
            }
            .btn-lg {
                font-size: 1rem;
                padding: 0.75rem;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h4 class="text-primary fw-bold">
            <i class="fas fa-users"></i> Dashboard Warga
        </h4>
        <p class="text-muted mb-0">Selamat datang di sistem antrean warga</p>
    </div>

    {{-- Logika utama --}}
    @if(!$pendaftarId)
        {{-- BELUM REGISTRASI --}}
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fas fa-user-plus fa-3x text-success mb-3"></i>
                <h5 class="mb-3">Belum Terdaftar</h5>
                <p class="text-muted mb-4">
                    Silakan lakukan registrasi terlebih dahulu sebelum mengambil nomor antrean.
                </p>
                <a href="{{ route('register') }}" class="btn btn-success btn-lg w-100">
                    <i class="fas fa-pen"></i> Registrasi Warga
                </a>
            </div>
        </div>
    @else
        {{-- SUDAH REGISTRASI --}}
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fas fa-ticket-alt fa-3x text-primary mb-3"></i>
                <h5 class="mb-3">Ambil Nomor Antrean</h5>
                <p class="text-muted mb-4">
                    Tekan tombol di bawah untuk mencetak nomor antrean Anda.
                </p>
                <a href="{{ route('cetak.antrian') }}" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-print"></i> Ambil Nomor Antrian
                </a>

                <p class="text-muted small mt-3">
                    ID Pendaftar: {{ $pendaftarId }}
                </p>

                {{-- Optional tombol keluar --}}
                <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm mt-2 w-100">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
            </div>
        </div>
    @endif

    <div class="text-center mt-4">
        <small class="text-muted">© {{ date('Y') }} Sistem Antrean Warga</small>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
