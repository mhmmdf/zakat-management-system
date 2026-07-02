<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articles;

class ArticleController extends Controller
{
    public function index()
    {
        $items = Articles::all();

        return view('pages.backend.articles.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('pages.backend.articles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'thumbnail' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = $this->generateSlug($request->judul);

        if ($request->hasFile('thumbnail')) {
            $finalName = $this->uploadThumbnail($request);
            Articles::create([
                'slug' => $slug,
                'judul' => $request->judul,
                'thumbnail' => $finalName,
                'tanggal' => $request->tanggal,
                'author' => $request->author,
                'content' => $request->content,
            ]);
        } else {
            Articles::create([
                'slug' => $slug,
                'judul' => $request->judul,
                'thumbnail' => 'thumbnail-default.jpg',
                'tanggal' => $request->tanggal,
                'author' => $request->author,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('articles.index');
    }

    public function show($id)
    {
        $item = Articles::findOrFail($id);

        return view('pages.backend.articles.detail', [
            'item' => $item
        ]);
    }

    public function edit($id)
    {
        $item = Articles::findOrFail($id);

        return view('pages.backend.articles.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'thumbnail' => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $slug = $this->generateSlug($request->judul);

        if ($request->hasFile('thumbnail')) {
            $finalName = $this->uploadThumbnail($request);
            $item = Articles::findOrFail($id);
            $item->update([
                'slug' => $slug,
                'judul' => $request->judul,
                'thumbnail' => $finalName,
                'tanggal' => $request->tanggal,
                'author' => $request->author,
                'kategori' => $request->kategori,
                'content' => $request->content,
            ]);
        } else {
            $item = Articles::findOrFail($id);
            $item->update([
                'slug' => $slug,
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
                'author' => $request->author,
                'kategori' => $request->kategori,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('articles.index');
    }

    public function destroy($id)
    {
        $item = Articles::findOrFail($id);
        $item->delete();

        return redirect()->route('articles.index');
    }

    private function generateSlug($judul)
    {
        $slug = strtolower(str_replace(" ", "-", strip_tags($judul)));
        return strlen($slug) > 100 ? substr($slug, 0, 100) : $slug;
    }

    private function uploadThumbnail(Request $request)
    {
        $resource = $request->file('thumbnail');
        $name = $resource->getClientOriginalName();
        $finalName = date('His') . $name;
        $request->file('thumbnail')->storeAs('images/', $finalName, 'public');
        return $finalName;
    }
}
