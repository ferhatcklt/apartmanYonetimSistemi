<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaireSahibi;

class DaireSahibiController extends Controller
{
    public function index()
    {
        $daireSahipleri = DaireSahibi::all();
        return view('admin.daire-sahipleri.index', compact('daireSahipleri'));
    }

    public function create()
    {
        return view('admin.daire-sahipleri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'daire_no' => 'required|integer',
            'isim' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefon' => 'nullable|string|max:50',
        ]);

        DaireSahibi::create($request->all());
        return redirect()->route('admin.daire-sahipleri.index')->with('message', 'Daire sahibi eklendi.');
    }

    public function edit($id)
    {
        $daireSahibi = DaireSahibi::findOrFail($id);
        return view('admin.daire-sahipleri.edit', compact('daireSahibi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'daire_no' => 'required|integer',
            'isim' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefon' => 'nullable|string|max:50',
        ]);

        $daireSahibi = DaireSahibi::findOrFail($id);
        $daireSahibi->update($request->all());
        return redirect()->route('admin.daire-sahipleri.index')->with('message', 'Daire sahibi güncellendi.');
    }

    public function destroy($id)
    {
        $daireSahibi = DaireSahibi::findOrFail($id);
        $daireSahibi->delete();
        return redirect()->route('admin.daire-sahipleri.index')->with('message', 'Daire sahibi silindi.');
    }
}
