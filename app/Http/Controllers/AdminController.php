<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayarlar;
use App\Models\Admin;
use App\Models\Gelir;
use App\Models\Gider;
use App\Models\Aidat;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Yönetici dashboard (özet bilgiler)
    public function dashboard()
    {
        // Veritabanındaki tüm Gelir ve Gider toplamlarını alıyoruz:
        $toplamGelir = \App\Models\Gelir::sum('miktar');
        $toplamGider = \App\Models\Gider::sum('miktar');

        $ayar = \App\Models\Ayarlar::first();
        // Beklenen gelir: güncel aidat * daire sayısı
        $beklenenGelir = $ayar->guncel_aidat * $ayar->daire_sayisi;
        // Ödenmemiş daire sayısı: veritabanındaki tüm aidat kayıtlarında odendi olmayanlar
        $odemeyenDaireSayisi = \App\Models\Aidat::where('status', 'odenmedi')->count();

        // Güncel kasa = ilk kasa + (aidat ödenmiş kayıtların toplamı) + tüm gelir - tüm gider
        $guncelKasa = $ayar->ilk_kasa
            + \App\Models\Aidat::where('status', 'odendi')->sum('miktar')
            + $toplamGelir - $toplamGider;

        return view('admin.dashboard', compact(
            'toplamGelir',
            'toplamGider',
            'beklenenGelir',
            'odemeyenDaireSayisi',
            'guncelKasa'
        ));
    }


    // Ayarlar sayfası ve güncelleme
    public function ayarlar()
    {
        $ayar = Ayarlar::first();
        return view('admin.ayarlar', compact('ayar'));
    }

    public function updateAyarlar(Request $request)
    {
        $request->validate([
            'daire_sayisi' => 'required|integer|min:1',
            'guncel_aidat' => 'required|numeric|min:0',
            'ilk_kasa'     => 'required|numeric|min:0',
        ]);

        $ayar = Ayarlar::first();
        $ayar->update($request->only('daire_sayisi', 'guncel_aidat', 'ilk_kasa'));
        return redirect()->back()->with('message', 'Ayarlar güncellendi.');
    }

    // Yönetici ekleme ve listeleme
    public function yoneticiler()
    {
        $admins = Admin::all();
        return view('admin.yoneticiler', compact('admins'));
    }

    public function createAdmin()
    {
        return view('admin.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('admin.yoneticiler')->with('message', 'Yönetici eklendi.');
    }

    // Proje işlemleri (listeleme, ekleme)
    public function projeIndex()
    {
        $projes = \App\Models\Proje::all();
        return view('admin.proje', compact('projes'));
    }

    public function createProje()
    {
        return view('admin.create-proje');
    }

    public function storeProje(Request $request)
    {
        $request->validate([
            'baslik'       => 'required|string|max:255',
            'detay'        => 'required',
            'toplam_tutar' => 'required|numeric|min:0',
        ]);

        $ayar = Ayarlar::first();
        $daireSayisi = $ayar->daire_sayisi;
        $daireBasiOdeme = $request->toplam_tutar / $daireSayisi;

        \App\Models\Proje::create([
            'baslik'           => $request->baslik,
            'detay'            => $request->detay,
            'toplam_tutar'     => $request->toplam_tutar,
            'daire_basi_odeme' => $daireBasiOdeme,
        ]);

        return redirect()->route('proje.index')->with('message', 'Proje eklendi.');
    }

    // Raporlama sayfası
    public function raporlama(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year  = $request->get('year', date('Y'));

        $gelir = Gelir::whereYear('tarih', $year)->whereMonth('tarih', $month)->sum('miktar');
        $gider = Gider::whereYear('tarih', $year)->whereMonth('tarih', $month)->sum('miktar');
        $beklenenGelir = Ayarlar::first()->guncel_aidat * Ayarlar::first()->daire_sayisi;
        $odemeyenDaire = Aidat::where('status', 'odenmedi')
                               ->whereYear('created_at', $year)
                               ->whereMonth('created_at', $month)
                               ->get();

        return view('admin.raporlama', compact('gelir', 'gider', 'beklenenGelir', 'odemeyenDaire'));
    }
}
