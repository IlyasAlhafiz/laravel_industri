@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Data Kategori</span>
          <a href="{{ route('artikel.index') }}" class="btn btn-primary">Artikel</a>
        </div>
        <div class="card-body">
        <div class="mb-4">
            <button class="btn btn-success" data-toggle="modal" data-target="#tambahKategoriModal">Tambah Kategori</button>
        </div>
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($kategori as $data)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->nama_kategori }}</td>
                <td>{{ $data->deskripsi_kategori }}</td>
                <td>
                  @if($data->gambar_kategori)
                    <img src="{{ asset('images/kategori/' . $data->gambar_kategori) }}" width="80" height="80" class="rounded">
                  @else
                    <span class="badge bg-secondary">Tidak Ada</span>
                  @endif
                </td>
                <td>
                  <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#lihatKategori{{ $data->id }}">Lihat</button>
                  <div class="modal fade" id="lihatKategori{{ $data->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Detail Kategori</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                          @if($data->gambar_kategori)
                            <img src="{{ asset('images/kategori/' . $data->gambar_kategori) }}" width="100" height="100" class="rounded-circle mb-3">
                          @endif
                          <h5>{{ $data->nama_kategori }}</h5>
                          <p>{{ $data->deskripsi_kategori }}</p>
                        </div>
                      </div>
                    </div>
                  </div>

                
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKategori{{ $data->id }}">Edit</button>
                  <div class="modal fade" id="editKategori{{ $data->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Kategori</h5>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('kategori.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf @method('PUT')
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Nama Kategori</label>
                              <input type="text" name="nama_kategori" class="form-control" value="{{ $data->nama_kategori }}" required>
                            </div>
                            <div class="form-group">
                              <label>Deskripsi</label>
                              <textarea name="deskripsi_kategori" class="form-control">{{ $data->deskripsi_kategori }}</textarea>
                            </div>
                            <div class="form-group">
                              <label>Gambar</label><br>
                              @if($data->gambar_kategori)
                                <img src="{{ asset('images/kategori/' . $data->gambar_kategori) }}" width="80" height="80" class="rounded mb-2">
                              @endif
                              <input type="file" name="gambar_kategori" class="form-control">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
 
                  <form action="{{ route('kategori.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
              @if($kategori->isEmpty())
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

<div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi_kategori" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar_kategori" class="form-control">
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
