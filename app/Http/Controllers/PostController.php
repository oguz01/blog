<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{

    public function index()
    {
        $post = Post::select('id', 'picture', 'title', 'id_kategori')->latest()->paginate(10);
        return view('admin.post.index', compact('post'));
    }

    public function create()
    {
        $tag = Tag::select('id', 'name')->get();
        $kategori = Kategori::select('id', 'name')->get();
        return view('admin.post.create', compact('kategori', 'tag'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|mimes:jpg,jpeg,png|max:2048',
            'title'   => 'required',
            'content' => 'required',
            'kategori' => 'required',
            'tag' => 'required',
        ]);
        $picture = time() . '-' . $request->picture->getClientOriginalName();
        $request->picture->move('upload/post', $picture);
        Post::create([
            'picture' => $picture,
            'title'   => $request->title,
            'content' => $request->content,
            'id_kategori' => $request->kategori,
            'slug'    => Str::slug($request->title, '-'),
        ])->tag()->attach($request->tag);

        return redirect('/post')->with('success', 'Yazı Başarıyla Kayıt Edildi!');
    }

    public function show($id)
    {
        //$post = Post::find($id) ?? abort(404,'Post Bulunamadı');
        $post = Post::select('id', 'picture', 'title', 'content', 'created_at')->whereId($id)->firstOrFail();
        return view('admin.post.show', compact('post'));
    }

    public function edit($id)
    {
        $tag = Tag::select('id', 'name')->get();
        $kategori = Kategori::select('id', 'name')->get();
        $post = Post::select('id', 'picture', 'title', 'content', 'id_kategori')->whereId($id)->firstOrFail();
        return view('admin.post.edit', compact('post', 'kategori', 'tag'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'picture' => 'mimes:jpg,jpeg,png|max:2048',
            'title'   => 'required',
            'content' => 'required',
            'kategori' => 'required',
            'tag' => 'required',
        ]);
        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'id_kategori' => $request->kategori,
            'slug'    => Str::slug($request->title, '-'),
        ];
        $post =  Post::select('picture', 'id')->whereId($id)->first();
        if ($request->picture) {
            File::delete('upload/post/' . $post->picture);
            $picture = time() . '-' . $request->picture->getClientOriginalName();
            $request->picture->move('upload/post', $picture);
            $data['picture'] = $picture;
        }
        $post->update($data);
        $post->tag()->sync($request->tag);
        Alert::success('success', 'Yazı Başarıyla Güncellendi!');
        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        //$post = Post::find($id) ?? abort(404, 'Yazı Bulunamadı');
        $post =  Post::select('picture', 'id')->whereId($id)->first();
        File::delete('upload/post/' . $post->picture);
        $post->delete();
        Alert::success('success', 'Yazı Başarıyla Silindi!');
        return redirect()->route('post.index');
    }

    public function kontrol($id)
    {
        alert()->question('Silmek İstediğine Emin misin?','Bu İşlem Geri Alamazsın Dikkat!')
        ->showConfirmButton('<a href="/post/'.$id.'/delete" class="text-white"><i class="fas fa-trash"></i> Sil</a>', '#e74a3b')
        ->toHtml()->showCancelButton('Kapat', '#3085d6')->reverseButtons();
        return redirect()->route('post.index');
    }


    public function delete($id)
    {
        //$post = Post::find($id) ?? abort(404, 'Yazı Bulunamadı');
        $post =  Post::select('picture', 'id')->whereId($id)->firstOrFail();
        File::delete('upload/post/' . $post->picture);
        $post->delete();
        Alert::success('success', 'Yazı Başarıyla Silindi!');
        return redirect()->route('post.index');
    }
}
