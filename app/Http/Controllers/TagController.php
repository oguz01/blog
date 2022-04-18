<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
      $tag = Tag::select('id', 'name','slug')->latest()->paginate(10);
      return view('admin.tag.index', compact('tag'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);
        Tag::create([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect()->route('tag.index')->with('success', 'Etiket Başarıyla Kayıt Edildi!');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $tag = Tag::select('id', 'name', 'slug')->whereId($id)->firstOrfail();
        return view('admin.tag.edit',compact('tag'));
    }
   public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);
        Tag::whereId($id)->update([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect()->route('tag.index')->with('success', 'Etiket Başarıyla Güncellendi!');
    }
    public function destroy($id)
    {
        Tag::whereId($id)->delete();
        return redirect()->route('tag.index')->with('success', 'Etiket Başarıyla Silindi!');
    }
}
