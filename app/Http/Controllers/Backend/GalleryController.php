<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Galleries;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Galleries::all();

        return view('pages.backend.galleries.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('pages.backend.galleries.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $resource = $request->file('foto');
            $name = $resource->getClientOriginalName();
            $finalName = date('His') . $name;
            $request->file('foto')->storeAs('images/', $finalName, 'public');
            Galleries::create([
                'foto' => $finalName,
            ]);
        }

        return redirect()->route('galleries.index');
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id)
    {
        $item = Galleries::findOrFail($id);
        $item->delete();

        return redirect()->route('galleries.index');
    }
}
