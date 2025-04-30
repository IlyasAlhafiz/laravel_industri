<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Artikel;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $komentar = Komentar::with(['artikel', 'user'])->get();
        return view('komentar.index', compact('komentar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artikel = Artikel::all();
        $user = User::all();
        return view('komentar.create', compact('artikel', 'user'));
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
            'id_artikel' => 'required',
            'id_user' => 'required',
            'isi_komentar' => 'required',
        ]);

        $komentar = new Komentar();
        $komentar->id_artikel = $request->id_artikel;
        $komentar->id_user = $request->id_user;
        $komentar->isi_komentar = $request->isi_komentar;
        $komentar->save();

        Alert::success('Berhasil!', 'Komentar berhasil ditambahkan.');
        return redirect()->route('komentar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $komentar = Komentar::with(['artikel', 'user'])->findOrFail($id);
        return view('komentar.show', compact('komentar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komentar = Komentar::findOrFail($id);
        $artikel = Artikel::all();
        $user = User::all();
        return view('komentar.edit', compact('komentar', 'artikel', 'user'));
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
            'isi_komentar' => 'required',
        ]);

        $komentar = Komentar::findOrFail($id);
        $komentar->isi_komentar = $request->isi_komentar;
        $komentar->save();

        Alert::success('Berhasil!', 'Komentar berhasil diperbarui.');
        return redirect()->route('komentar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        Alert::success('Berhasil!', 'Komentar berhasil dihapus.');
        return redirect()->route('komentar.index');
    }
}
