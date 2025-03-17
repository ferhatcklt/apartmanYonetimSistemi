<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Duyuru;

class DuyuruController extends Controller
{
    public function index()
    {
        $duyurular = Duyuru::all();
        return view('admin.duyurular', compact('duyurular'));
    }

    public function create()
    {
        return view('admin.create-duyuru');
    }

    public function store(Request $request)
    {
        $request->validate([
            'baslik'   => 'required|string|max:255',
            'aciklama' => 'required',
        ]);

        Duyuru::create($request->all());
        return redirect()->route('duyuru.index')->with('message', 'Duyuru eklendi.');
    }

    public function edit($id)
    {
        $duyuru = Duyuru::findOrFail($id);
        return view('admin.edit-duyuru', compact('duyuru'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'baslik'   => 'required|string|max:255',
            'aciklama' => 'required',
        ]);

        $duyuru = Duyuru::findOrFail($id);
        $duyuru->update($request->all());
        return redirect()->route('duyuru.index')->with('message', 'Duyuru güncellendi.');
    }

    public function destroy($id)
    {
        $duyuru = Duyuru::findOrFail($id);
        $duyuru->delete();
        return redirect()->route('duyuru.index')->with('message', 'Duyuru silindi.');
    }
}
