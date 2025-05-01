@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Data Penulis</span>
          <a href="{{ route('artikel.index') }}" class="btn btn-primary">Artikel</a>
        </div>
        <div class="card-body">
            <div class="mb-4">
            <button class="btn btn-success" data-toggle="modal" data-target="#tambahPenulisModal">Tambah Penulis</button>
            </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Foto Profil</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($penulis as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->email }}</td>
                <td>
                  @if($data->foto_profil)
                    <img src="{{ asset('images/profil/' . $data->foto_profil) }}" width="80" height="80" class="rounded">
                  @else
                    <span class="badge bg-secondary">Tidak Ada</span>
                  @endif
                </td>
                <td>
                
                  <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#lihatPenulis{{ $data->id }}">Lihat</button>
                  <div class="modal fade" id="lihatPenulis{{ $data->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Detail Penulis</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                          @if($data->foto_profil)
                            <img src="{{ asset('images/profil/' . $data->foto_profil) }}" width="100" height="100" class="rounded-circle mb-3">
                          @endif
                          <h5>{{ $data->nama }}</h5>
                          <p>{{ $data->email }}</p>
                        </div>
                      </div>
                    </div>
                  </div>

            
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPenulis{{ $data->id }}">Edit</button>
                  <div class="modal fade" id="editPenulis{{ $data->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Penulis</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('penulis.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf @method('PUT')
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
                            </div>
                            <div class="form-group">
                              <label>Foto Profil</label><br>
                              @if($data->foto_profil)
                                <img src="{{ asset('images/profil/' . $data->foto_profil) }}" width="80" height="80" class="rounded mb-2">
                              @endif
                              <input type="file" name="foto_profil" class="form-control">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <form action="{{ route('penulis.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus penulis ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
              @if($penulis->isEmpty())
              <tr>
                <td colspan="5" class="text-center">Belum ada data.</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tambahPenulisModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Penulis</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('penulis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Foto Profil</label>
            <input type="file" name="foto_profil" class="form-control">
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
