<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Warga</title>

    <!-- SB Admin 2 & Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc;
            font-size: 15px;
        }
        nav.navbar {
            padding: 0.75rem 1rem;
        }
        .navbar h5 {
            font-size: 1.1rem;
        }
        .card {
            border-radius: 1rem;
            border: none;
        }
        .card-header {
            background: #fff;
            border-bottom: none;
            text-align: center;
        }
        .card-header h6 {
            color: #4e73df;
            font-weight: 600;
        }
        label {
            font-weight: 500;
            color: #4e4e4e;
            font-size: 0.9rem;
        }
        .form-control {
            border-radius: 0.75rem;
            font-size: 0.9rem;
            padding: 0.6rem 0.75rem;
        }
        .btn-user {
            border-radius: 2rem;
            padding: 0.6rem;
            font-size: 0.95rem;
        }
        footer {
            padding: 1rem 0;
            text-align: center;
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 0.75rem;
            }
            .card {
                margin-bottom: 1rem;
            }
            .card-header h6 {
                font-size: 1rem;
            }
            .btn-user {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-3 shadow-sm">
            <h5 class="m-0 font-weight-bold text-primary">Form Pendaftaran Baru</h5>
        </nav>
        <!-- End Topbar -->

        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Isi Data Pendaftaran</h6>
                </div>
                <div class="card-body">

                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show small" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(!empty($errorMessage))
                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ $errorMessage }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    {{-- End Flash Messages --}}

                    <form action="{{ route('warga.store') }}" method="POST" class="user">
                        @csrf

                        <div class="mb-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Nama Lengkap" required>
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" id="nik"
                                value="{{ old('nik') }}"
                                class="form-control @error('nik') is-invalid @enderror"
                                placeholder="Nomor Induk Kependudukan" required>
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp">Nomor HP</label>
                            <input type="number" name="no_hp" id="no_hp"
                                value="{{ old('no_hp') }}"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                placeholder="08xxxxxxxxxx" required>
                            @error('no_hp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="Tuliskan alamat lengkap" rows="3"
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jadwals_id">Tanggal Jadwal</label>
                            <select name="jadwals_id" id="jadwals_id"
                                class="form-control @error('jadwals_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Tanggal Jadwal --</option>
                                @foreach ($jadwals as $j)
                                    <option value="{{ $j->id }}">
                                        {{ \Carbon\Carbon::parse($j->tanggal)->translatedFormat('d F Y') }}
                                        ({{ $j->jam_buka }} - {{ $j->jam_tutup }})
                                    </option>
                                @endforeach
                            </select>
                            @error('jadwals_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_pendaftaran">Jenis Pendaftaran</label>
                            <select name="jenis_pendaftaran" id="jenis_pendaftaran"
                                class="form-control @error('jenis_pendaftaran') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Pendaftaran --</option>
                                <option value="dukcapil" {{ old('jenis_pendaftaran') == 'dukcapil' ? 'selected' : '' }}>Dukcapil</option>
                                <option value="pencatatan_sipil" {{ old('jenis_pendaftaran') == 'pencatatan_sipil' ? 'selected' : '' }}>Pencatatan Sipil</option>
                            </select>
                            @error('jenis_pendaftaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-user w-100">
                            <i class="fas fa-save"></i> Simpan Pendaftaran
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <footer class="bg-white mt-auto">
        <div class="container my-auto">
            <div class="text-center my-auto">
                <small>© {{ date('Y') }} Sistem Pendaftaran</small>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
