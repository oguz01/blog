<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable = ['title','picture','content','slug','id_kategori'];

     ///id_kategori alanı ile Kategori tablosunu post tablosu ile ilişkilendirdik.
  public function kategori()
  {
      return $this->belongsTo(Kategori::class,'id_kategori');
  }


  public function tag()
  {
      return $this->belongsToMany(Tag::class, 'post_tag', 'id_post', 'id_tag');
  }

}
