<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['name', 'slug'];

     ///Post Tablosuyla çoklu ilişkilendirme yaptık
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
