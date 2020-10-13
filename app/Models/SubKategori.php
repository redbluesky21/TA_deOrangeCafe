<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class SubKategori extends Model
{
    use HasFactory;
    protected $table = "sub_kategori";
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
