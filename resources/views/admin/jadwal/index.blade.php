@extends('template_admin.layout')

@section('head')
<link href="css/sb-admin-2.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    {{-- Flash Messages --}}
    {{-- @if(session('success'))
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
    @endif --}}

    <div class="row">
        <!-- Kalender -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Kalender</h6>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <!-- Form Buat Jadwal -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h6 class="m-0 font-weight-bold">Buat Jadwal Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jam_buka">Jam Buka</label>
                                <input type="time" name="jam_buka" id="jam_buka" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jam_tutup">Jam Tutup</label>
                                <input type="time" name="jam_tutup" id="jam_tutup" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kuota">Kuota Maksimal</label>
                            <input type="number" name="kuota" id="kuota" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Simpan Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Jadwal -->
    <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">
            <h6 class="m-0 font-weight-bold">Daftar Jadwal</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        <th>Kuota</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>    
                <tbody>
                    @forelse($jadwals as $jadwal)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $jadwal->jam_buka }}</td>
                            <td>{{ $jadwal->jam_tutup }}</td>
                            <td>{{ $jadwal->kuota }}</td>
                            {{-- <td>
                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                </form>
                            </td> --}}
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Belum ada jadwal</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- FullCalendar --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  if(calendarEl){
      var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          selectable: true,
          dateClick: function(info) {
              // isi otomatis input tanggal (format yyyy-mm-dd sesuai input[type=date])
              document.getElementById('tanggal').value = info.dateStr;
          }
      });
      calendar.render();
  }
});
</script>
@endsection
