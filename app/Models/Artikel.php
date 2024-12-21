<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'published_at' => 'datetime',
    ];


    public function kategori_artikel()
    {
        return $this->belongsTo(KategoriArtikel::class);
    }
}
