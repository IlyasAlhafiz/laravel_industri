<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;
use RealRashid\SweetAlert\Facades\Alert;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penulis = Penulis::all();
        return view('penulis.index', compact('penulis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'foto_profil.image' => 'File harus berupa gambar!',
            'foto_profil.mimes' => 'Format gambar tidak valid!',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB!',
        ]);

        $penulis = new Penulis();
        $penulis->nama = $request->nama;
        $penulis->email = $request->email;
        if ($request->hasFile('foto_profil')) {
            $img = $request->file('foto_profil');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/profil', $name);
            $penulis->foto_profil = $name;
        }

        $penulis->save();

        Alert::success('Berhasil!', 'Penulis berhasil ditambahkan.');
        return redirect()->route('penulis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penulis = Penulis::findOrFail($id);
        return view('penulis.show', compact('penulis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penulis = Penulis::findOrFail($id);
        return view('penulis.edit', compact('penulis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'foto_profil.image' => 'File harus berupa gambar!',
            'foto_profil.mimes' => 'Format gambar tidak valid!',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB!',
        ]);

        $penulis = Penulis::findOrFail($id);
        $penulis->nama = $request->nama;
        $penulis->email = $request->email;
        if ($request->hasFile('foto_profil')) {
            $penulis->deleteImage();
            $img = $request->file('foto_profil');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/profil', $name);
            $penulis->foto_profil = $name;
        }

        $penulis->save();

        Alert::success('Berhasil!', 'Penulis berhasil diperbarui.');
        return redirect()->route('penulis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penulis = Penulis::findOrFail($id);
        $penulis->delete();

        Alert::success('Berhasil!', 'Penulis berhasil dihapus.');
        return redirect()->route('penulis.index');
    }
}
