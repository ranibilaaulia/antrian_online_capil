@extends('template_admin.layout')

@section('head')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Card Laporan -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 font-weight-bold">Laporan Antrean</h6>
            </div>
            <div class="card-body">

                <!-- Form Filter -->
                <form action="{{ route('laporan.index') }}" method="GET" class="form-inline mb-4">
                    <div class="form-group mr-3">
                        <label for="antrean" class="mr-2 font-weight-bold">Antrean</label>
                        <select name="antrean" id="antrean" class="form-control">
                            <option value="">-- Pilih Antrean --</option>
                            <option value="dukcapil" {{ request('antrean') == 'dukcapil' ? 'selected' : '' }}>Dukcapil
                            </option>
                            <option value="pencatatan_sipil" {{ request('antrean') == 'pencatatan_sipil' ? 'selected' : '' }}>
                                Pencatatan Sipil</option>
                        </select>
                    </div>

                    <div class="form-group mr-3">
                        <label for="bulan" class="mr-2 font-weight-bold">Pilih Bulan</label>
                        <input type="month" name="bulan" id="bulan" value="{{ request('bulan') }}" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-info font-weight-bold">Tampilkan Laporan</button>
                </form>
                <!-- End Form Filter -->

                <!-- Tabel Laporan -->
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Bulan/Tahun</th>
                            <th>Nomor Antrean</th>
                            <th>Nama Pendaftar</th>
                            <th>Jenis Pendaftaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->periode)->format('d-m-Y') }}</td>
                                <td>{{ $item->nomor }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_pendaftaran }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data laporan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
