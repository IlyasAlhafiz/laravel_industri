<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Komentar;
use App\Models\Kategori;
use App\Models\Penulis;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::with('kategori','penulis')->get();
        $kategori = Kategori::all();
        $penulis = Penulis::all();
    
        return view('artikel.index', compact('artikel', 'kategori', 'penulis'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('artikel.create', compact('kategori', 'penulis'));
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
            'id_kategori' => 'required',
            'id_penulis' => 'required',
            'judul' => 'required|max:255',
            'konten' => 'required',
            'tentang' => 'required|max:255',
        ], [
            'id_penulis.required' => 'Penulis wajib dipilih!',
            'id_kategori.required' => 'Kategori wajib dipilih!',
            'judul.required' => 'Judul artikel wajib diisi!',
            'konten.required' => 'Konten artikel wajib diisi!',
            'tentang.required' => 'Tentang artikel wajib diisi!',
        ]);

        $artikel = new Artikel();
        $artikel->id_kategori = $request->id_kategori;
        $artikel->id_penulis = $request->id_penulis;
        $artikel->judul = $request->judul;
        $artikel->konten = $request->konten;
        if ($request->hasFile('gambar')) {
            $img = $request->file('gambar');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/artikel', $name);
            $artikel->gambar = $name;
        }
        $artikel->tentang = $request->tentang;
        $artikel->save();

        Alert::success('Berhasil!', 'Artikel berhasil ditambahkan.');
        return redirect()->route('artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel = Artikel::with('kategori', 'penulis', 'komentar.user')->findOrFail($id);
        return view('artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('artikel.edit', compact('artikel', 'kategori', 'penulis'));
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
            'id_penulis' => 'required',
            'id_kategori' => 'required',
            'judul' => 'required|max:255',
            'konten' => 'required',
            'tentang' => 'required|max:255',
        ], [
            'id_penulis.required' => 'Penulis wajib dipilih!',
            'id_kategori.required' => 'Kategori wajib dipilih!',
            'judul.required' => 'Judul artikel wajib diisi!',
            'konten.required' => 'Konten artikel wajib diisi!',
            'tentang.required' => 'Tentang artikel wajib diisi!',
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->id_penulis = $request->id_penulis;
        $artikel->id_kategori = $request->id_kategori;
        $artikel->judul = $request->judul;
        $artikel->konten = $request->konten;
        if ($request->hasFile('gambar')) {
            $artikel->deleteImage();
            $img = $request->file('gambar');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/artikel', $name);
            $artikel->gambar = $name;
        }
        $artikel->tentang = $request->tentang;
        $artikel->save();

        Alert::success('Berhasil!', 'Artikel berhasil diperbarui.');
        return redirect()->route('artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        Alert::success('Berhasil!', 'Artikel berhasil dihapus.');
        return redirect()->route('artikel.index');
    }

    public function storeKomentar(Request $request, $artikelId)
    {
        $request->validate([
            'isi_komentar' => 'required|max:255',
        ]);

        $komentar = new Komentar();
        $komentar->id_artikel = $artikelId;
        $komentar->id_user = Auth::id();
        $komentar->isi_komentar = $request->isi_komentar;
        $komentar->save();

        Alert::success('Berhasil!', 'Komentar berhasil ditambahkan.');
        return redirect()->route('artikel.index', $artikelId);
    }
}
