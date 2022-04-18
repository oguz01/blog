<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Post::select('picture', 'title','slug','created_at')->latest()->get();
        $kategori = Kategori::select('name', 'slug')->orderBy('name','asc')->get();
        return view('article.index',compact('article','kategori'));
    }
    public function article($slug)
    {
        $article = Post::select('id','picture', 'title','id_kategori','content','created_at')
        ->where('slug', $slug)->firstOrFail();
        $kategori = Kategori::select('name', 'slug')->orderBy('name','asc')->get();
        return view('article.article',compact('article','kategori'));

    }
    public function kategori($slug)
    {
        $kategori = Kategori::select('id')->where('slug',$slug)->firstOrFail();

        $article = Post::select('picture', 'title','slug','created_at')
        ->where('id_kategori', $kategori->id)->latest()->get();
        $kategori = Kategori::select('name', 'slug')->orderBy('name','asc')->get();
        return view('article.index',compact('article','kategori'));
    }
    public function tag($slug)
    {
        $article = Tag::select('id')->where('slug',$slug)->latest()->firstOrFail();
        $article = $article->post;
        $kategori = Kategori::select('name', 'slug')->orderBy('name','asc')->get();
        return view('article.index',compact('article','kategori'));

    }



}
