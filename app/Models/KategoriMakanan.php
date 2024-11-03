<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMakanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $table = 'kategori_makanans';

    public function menu(){
        return $this->hasMany(Menu::class);
    }
}
