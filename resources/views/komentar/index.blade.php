@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Data Komentar</span>
          <a href="{{ route('artikel.index') }}" class="btn btn-primary">Artikel</a>
        </div>
        <div class="card-body">
            <div class="mb-4">
            <button class="btn btn-success" data-toggle="modal" data-target="#tambahKomentarModal">Tambah Komentar</button>
            </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Artikel</th>
                <th>Nama User</th>
                <th>Komentar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($komentar as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->artikel->judul ?? '-' }}</td>
                <td>{{ $data->user->name ?? '-' }}</td>
                <td>{{ $data->isi_komentar }}</td>
                <td>
                  
                  <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#lihatKomentar{{ $data->id }}">Lihat</button>
                  <div class="modal fade" id="lihatKomentar{{ $data->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Detail Komentar</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <p><strong>Artikel:</strong> {{ $data->artikel->judul}}</p>
                          <p><strong>User:</strong> {{ $data->user->name}}</p>
                          <p><strong>Komentar:</strong><br> {{ $data->isi_komentar }}</p>
                        </div>
                      </div>
                    </div>
                  </div>

                
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKomentar{{ $data->id }}">Edit</button>
                  <div class="modal fade" id="editKomentar{{ $data->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Komentar</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('komentar.update', $data->id) }}" method="POST">
                          @csrf @method('PUT')
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Komentar</label>
                              <textarea name="isi_komentar" class="form-control" required>{{ $data->isi_komentar }}</textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <form action="{{ route('komentar.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
              @if($komentar->isEmpty())
              <tr>
                <td colspan="5" class="text-center">Belum ada data komentar.</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tambahKomentarModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Komentar</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('komentar.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Artikel</label>
            <select name="id_artikel" class="form-control" required>
              <option value="">-- Pilih Artikel --</option>
              @foreach(App\Models\Artikel::all() as $artikel)
                <option value="{{ $artikel->id }}">{{ $artikel->judul }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>User</label>
            <select name="id_user" class="form-control" required>
              <option value="">-- Pilih User --</option>
              @foreach(App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Komentar</label>
            <textarea name="isi_komentar" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
