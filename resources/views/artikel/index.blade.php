@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Data Artikel</span>
                    <div>
                      <a href="{{ route('kategori.index') }}" class="btn btn-primary">Kategori</a>
                      <a href="{{ route('penulis.index') }}" class="btn btn-primary">Penulis</a>
                      <a href="{{ route('komentar.index') }}" class="btn btn-primary">Komentar</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <button class="btn btn-success" data-toggle="modal" data-target="#tambahArtikelModal">Tambah Artikel</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Isi</th>
                                <th>Gambar</th>
                                <th>Tentang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($artikel as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->judul }}</td>
                                <td>{{ $data->kategori->nama_kategori }}</td>
                                <td>{{ $data->penulis->nama }}</td>
                                <td>{{ $data->konten }}</td>
                                <td>
                                    @if($data->gambar)
                                    <img src="{{ asset('images/artikel/' . $data->gambar) }}" width="80" height="80" class="rounded">
                                    @else
                                    <span class="badge bg-secondary">Tidak Ada Gambar</span>
                                    @endif
                                </td>
                                <td>{{ $data->tentang }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#lihatArtikel{{ $data->id }}">Lihat</button>
                                    <div class="modal fade" id="lihatArtikel{{ $data->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Artikel</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('images/artikel/' . $data->gambar) }}" width="100" height="100" class="rounded-circle mb-3">
                                                    <h5>{{ $data->judul }}</h5>
                                                    <p>{{ $data->konten }}</p>
                                                    <small>Kategori: {{ $data->kategori->nama_kategori }} | Penulis: {{ $data->penulis->nama }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editArtikel{{ $data->id }}">Edit</button>
                                    <div class="modal fade" id="editArtikel{{ $data->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Artikel</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form action="{{ route('artikel.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Judul</label>
                                                            <input type="text" name="judul" class="form-control" value="{{ $data->judul }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Isi</label>
                                                            <textarea name="konten" class="form-control" required>{{ $data->konten }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gambar</label><br>
                                                            @if($data->gambar)
                                                                <img src="{{ asset('images/artikel/' . $data->gambar) }}" width="80" height="80" class="rounded mb-2">
                                                            @endif
                                                            <input type="file" name="gambar" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kategori</label>
                                                            <select name="id_kategori" class="form-control">
                                                                @foreach($kategori as $k)
                                                                <option value="{{ $k->id }}" {{ $data->id_kategori == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Penulis</label>
                                                            <select name="id_penulis" class="form-control">
                                                                @foreach($penulis as $p)
                                                                <option value="{{ $p->id }}" {{ $data->id_penulis == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tentang</label>
                                                            <textarea name="tentang" class="form-control">{{ $data->tentang }}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Perbarui Artikel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('artikel.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($artikel->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data artikel.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahArtikelModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Artikel Baru</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea name="konten" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <select name="id_penulis" class="form-control" required>
                            @foreach($penulis as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tentang</label>
                        <textarea name="tentang" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah Artikel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
