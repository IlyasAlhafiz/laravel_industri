<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    use HasFactory;

    protected $table = 'penulis';

    protected $fillable = [
        'id',
        'nama_penulis',
        'email',
        'foto_profil',
    ];
    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_penulis');
    }

    public function deleteImage()
    {
        if ($this->gambar && file_exists(public_path('images/profil/' . $this->gambar))) {
            return unlink(public_path('images/profil/' . $this->gambar));
        }
    }
}
