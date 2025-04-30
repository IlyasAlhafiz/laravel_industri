@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Penulis</div>
                <div class="card-body">
                
                    <div class="mb-3">
                        <a href="{{ route('artikel.create') }}" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Foto Profil</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $id = 1; @endphp
                            @foreach($penulis as $data)
                            <tr>
                                <th scope="row">{{ $id++ }}</th>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <img src="{{ asset('/images/profil/' . $data->foto_profil) }}" width="70" height="70" style="border-radius: 50%; object-fit: cover;">
                                </td>
                                <td>
                                    <a href="{{ route('penulis.edit', $data->id) }}" class="btn btn-success">Edit</a>
                                    <a href="{{ route('penulis.show', $data->id) }}" class="btn btn-warning">Show</a>
                                    <form action="{{ route('penulis.destroy', $data->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection