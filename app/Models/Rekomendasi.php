<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function kategoriMakanan(){
        return $this->belongsTo(KategoriMakanan::class);
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class , 'id_tenant');
    }
}
