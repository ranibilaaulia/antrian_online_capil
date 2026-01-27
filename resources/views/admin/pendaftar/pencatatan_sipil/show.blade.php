@extends('template_admin.layout')

@section('head')
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    {{-- End Flash Messages --}}

    <!-- Card Detail Pendaftar -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Detail Pendaftar</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nama Lengkap</th>
                    <td>{{ $Pendaftar->nama }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $Pendaftar->nik }}</td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td>{{ $Pendaftar->no_hp }}</td>
                </tr>
                <tr>
                    <th>Alamat Lengkap</th>
                    <td>{{ $Pendaftar->alamat }}</td>
                </tr>
                <tr>
                    <th>Jenis Pendaftaran</th>
                    <td>{{ ucfirst(str_replace('_', ' ', $Pendaftar->jenis_pendaftaran)) }}</td>
                </tr>

                <tr>
                    <th>Tanggal Daftar</th>
                    <td>{{ $Pendaftar->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            </table>
            <div class="mt-3">
                <a href="{{ route('pencatatan_sipil.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
               
            </div>
        </div>
    </div>

</div>
@endsection
