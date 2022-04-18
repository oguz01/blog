<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class KategoriContoller extends Controller
{
    public function index()
    {
        $kategori = Kategori::select('id', 'name', 'slug')->latest()->simplePaginate(5);
        return view('admin.kategori.index', compact('kategori'));
    }
    public function create()
    {
        return view('admin.kategori.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);
        Kategori::create([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect()->route('kategori.index')->with('success', 'Kategori Başarıyla Kayıt Edildi!');
    }

    public function show(Kategori $kategori)
    {
        //
    }
    public function edit($id)
    {
        // 2 çeşit kullanım Mevcut
        //$kategori = Kategori::find($id) ?? abort(404,'Kategori Bulunamadı');
        $kategori = Kategori::select('id', 'name', 'slug')->whereId($id)->first();
        return view('admin.kategori.edit', compact('kategori'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);
        Kategori::whereId($id)->update([
            'name' => Str::title($request->name),
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect()->route('kategori.index')->with('success', 'Kategori Başarıyla Güncellendi!');
    }
    public function destroy($id)
    {
        $kategori = Kategori::find($id) ?? abort(404 ,'Kategori Bulunamadı');
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori Başarıyla Silindi!');
    }
}
