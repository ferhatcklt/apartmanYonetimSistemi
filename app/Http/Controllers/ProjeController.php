<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proje;
use App\Models\Ayarlar;

class ProjeController extends Controller
{
    // Projelerin listelendiği metot
    public function index()
    {
        $projes = Proje::all();
        return view('admin.proje', compact('projes'));
    }

    // Yeni proje ekleme formu
    public function create()
    {
        return view('admin.create-proje');
    }
    public function detay($id)
    {
        $proje = \App\Models\Proje::findOrFail($id);
        return view('proje.detay', compact('proje'));
    }
    public function show($id)
    {
        $proje = \App\Models\Proje::findOrFail($id);
        return view('proje.show', compact('proje'));
    }

    // Yeni proje kaydını oluşturma
    public function store(Request $request)
    {
        $request->validate([
            'baslik'       => 'required|string|max:255',
            'detay'        => 'required',
            'toplam_tutar' => 'required|numeric|min:0',
        ]);

        $ayar = Ayarlar::first();
        $daireSayisi = $ayar->daire_sayisi;
        $daireBasiOdeme = $request->toplam_tutar / $daireSayisi;

        Proje::create([
            'baslik'           => $request->baslik,
            'detay'            => $request->detay,
            'toplam_tutar'     => $request->toplam_tutar,
            'daire_basi_odeme' => $daireBasiOdeme,
        ]);

        return redirect()->route('proje.index')->with('message', 'Proje eklendi.');
    }

    // Proje düzenleme formunu gösterme
    public function edit($id)
    {
        $proje = Proje::findOrFail($id);
        return view('admin.edit-proje', compact('proje'));
    }

    // Proje kaydını güncelleme
    public function update(Request $request, $id)
    {
        $request->validate([
            'baslik'       => 'required|string|max:255',
            'detay'        => 'required',
            'toplam_tutar' => 'required|numeric|min:0',
        ]);

        $ayar = Ayarlar::first();
        $daireSayisi = $ayar->daire_sayisi;
        $daireBasiOdeme = $request->toplam_tutar / $daireSayisi;

        $proje = Proje::findOrFail($id);
        $proje->update([
            'baslik'           => $request->baslik,
            'detay'            => $request->detay,
            'toplam_tutar'     => $request->toplam_tutar,
            'daire_basi_odeme' => $daireBasiOdeme,
        ]);

        return redirect()->route('proje.index')->with('message', 'Proje güncellendi.');
    }

    // Proje kaydını silme
    public function destroy($id)
    {
        $proje = Proje::findOrFail($id);
        $proje->delete();

        return redirect()->route('proje.index')->with('message', 'Proje silindi.');
    }
}
