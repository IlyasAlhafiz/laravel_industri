<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'id',
        'nama_kategori',
        'deskripsi_kategori',
        'gambar_kategori',
    ];

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_kategori');
    }

    public function deleteImage()
    {
        if ($this->gambar_kategori && file_exists(public_path('images/kategori/' . $this->gambar_kategori))) {
            return unlink(public_path('images/kategori/' . $this->gambar_kategori));
        }
    }
}
