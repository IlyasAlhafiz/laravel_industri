<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'nama_kategori' => 'required|max:100',
            'deskripsi_kategori' => 'nullable|max:500',
            'gambar_kategori' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_samping' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.max' => 'Nama maksimal 100 karakter.',
            'deskripsi_kategori.max' => 'Deskripsi maksimal 500 karakter.',
            'gambar_kategori.image' => 'File harus berupa gambar.',
            'gambar_kategori.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'gambar_kategori.max' => 'Ukuran gambar maksimal 2MB.',
            'gambar_samping.image' => 'File harus berupa gambar.',
            'gambar_samping.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'gambar_samping.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->deskripsi_kategori = $request->deskripsi_kategori;
        if ($request->hasFile('gambar_kategori')) {
            $img = $request->file('gambar_kategori');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/kategori', $name);
            $kategori->gambar_kategori = $name;
        }
        if ($request->hasFile('gambar_samping')) {
            $img = $request->file('gambar_samping');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/samping', $name);
            $kategori->gambar_samping = $name;
        }
        $kategori->save();

        Alert::success('Berhasil!', 'Kategori berhasil ditambahkan.');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
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
            'nama_kategori' => 'required|max:100',
            'deskripsi_kategori' => 'nullable|max:500',
            'gambar_kategori' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_samping' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.max' => 'Nama maksimal 100 karakter.',
            'deskripsi_kategori.max' => 'Deskripsi maksimal 500 karakter.',
            'gambar_kategori.image' => 'File harus berupa gambar.',
            'gambar_kategori.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'gambar_kategori.max' => 'Ukuran gambar maksimal 2MB.',
            'gambar_samping.image' => 'File harus berupa gambar.',
            'gambar_samping.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif.',
            'gambar_samping.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->deskripsi_kategori = $request->deskripsi_kategori;
        if ($request->hasFile('gambar_kategori')) {
            $kategori->deleteImage();
            $img = $request->file('gambar_kategori');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/kategori', $name);
            $kategori->gambar_kategori = $name;
        }
        if ($request->hasFile('gambar_samping')) {
            $kategori->deleteImage();
            $img = $request->file('gambar_samping');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/samping', $name);
            $kategori->gambar_samping = $name;
        }
        $kategori->save();

        Alert::success('Berhasil!', 'Kategori berhasil diperbarui.');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        Alert::success('Berhasil!', 'Kategori berhasil dihapus.');
        return redirect()->route('kategori.index');
    }
}
