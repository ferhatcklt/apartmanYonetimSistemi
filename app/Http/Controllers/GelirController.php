<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gelir;

class GelirController extends Controller
{
    public function index()
    {
        $gelirler = Gelir::all();
        return view('admin.gelir', compact('gelirler'));
    }

    public function create()
    {
        $projeler = \App\Models\Proje::all(); // Tüm projeleri çekiyoruz
        return view('admin.create-gelir', compact('projeler'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'baslik' => 'required|string|max:255',
            'miktar' => 'required|numeric|min:0',
            'tarih'  => 'required|date',
        ]);

        Gelir::create($request->all());
        return redirect()->route('gelir.index')->with('message', 'Gelir kaydı eklendi.');
    }

    public function edit($id)
    {
        $gelir = Gelir::findOrFail($id);
        return view('admin.edit-gelir', compact('gelir'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'baslik' => 'required|string|max:255',
            'miktar' => 'required|numeric|min:0',
            'tarih'  => 'required|date',
        ]);

        $gelir = Gelir::findOrFail($id);
        $gelir->update($request->all());
        return redirect()->route('gelir.index')->with('message', 'Gelir kaydı güncellendi.');
    }

    public function destroy($id)
    {
        $gelir = Gelir::findOrFail($id);
        $gelir->delete();
        return redirect()->route('gelir.index')->with('message', 'Gelir kaydı silindi.');
    }
}
