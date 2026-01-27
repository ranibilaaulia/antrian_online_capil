@extends('template_admin.layout')

@section('head')
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<style>
    .custom-table th, .custom-table td {
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
    }
    .custom-table th {
        background: #d9534f; /* merah header */
        color: white;
    }
    .btn-konfirmasi {
        background-color: green;
        color: white;
        border: none;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
    }
    .icon-btn {
        font-size: 18px;
        margin-left: 6px;
        cursor: pointer;
        color: black;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">
            <h6 class="m-0 font-weight-bold">Daftar Dukcapil Hari Ini</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered custom-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>NOMOR ANTREAN</th>
                        <th>JAM</th>
                        <th>NAMA PENDAFTAR</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($antreans as $index => $antrean)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $antrean->nomor }}</td>
                        <td>{{ $antrean->jam ?? '08.00' }}</td>
                        <td>{{ strtoupper($antrean->pendaftar->nama) }}</td>
                        <td>{{ strtoupper($antrean->status) }}</td>
                        <td>
                            <form action="{{ route('dukcapil.konfirmasi', $antrean->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-konfirmasi">konfirmasi</button>
                            </form>
                            <a href="{{ route('dukcapil.show', $antrean->id) }}" class="icon-btn">
                                <i class="fas fa-eye"></i>
                            
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada antrean</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
