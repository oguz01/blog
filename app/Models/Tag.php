<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];
    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'id_tag', 'id_post');
    }
}
