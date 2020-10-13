<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $guarded = [];
    public function getImagePathAttribute()
    {
        return Storage::url('public/menu/img/' . $this->gambar);
    }
}
