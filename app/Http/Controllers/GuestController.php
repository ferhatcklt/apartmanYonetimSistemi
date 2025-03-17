<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gelir;
use App\Models\Gider;
use App\Models\Aidat;
use App\Models\DaireSahibi;
class GuestController extends Controller
{

    public function index(Request $request)
    {
        $toplamGelir = \App\Models\Gelir::whereYear('tarih', date('Y'))
                        ->whereMonth('tarih', date('m'))->sum('miktar');
        $toplamGider = \App\Models\Gider::whereYear('tarih', date('Y'))
                        ->whereMonth('tarih', date('m'))->sum('miktar');
        $ayar = \App\Models\Ayarlar::first();
        $beklenenGelir = $ayar->guncel_aidat * $ayar->daire_sayisi;
        $odemeyenDaireSayisi = \App\Models\Aidat::where('status', 'odenmedi')
                                ->whereYear('yil', date('Y'))->count();
        $sonGelirler = \App\Models\Gelir::orderBy('tarih', 'desc')->take(5)->get();
        $sonGiderler = \App\Models\Gider::orderBy('tarih', 'desc')->take(5)->get();

        // Yıl seçimi: request'den gelen 'year' varsa onu, yoksa varsayılan olarak mevcut yıl
        $selectedYear = $request->has('year') ? $request->year : date('Y');

        // Yıllar listesi (örneğin son 5 yıl)
        $years = range(date('Y') - 4, date('Y'));

        // Aidat grid oluşturma: Ayarlar'da belirlenen daire sayısına göre, seçilen yıl için
        $daireSayisi = $ayar->daire_sayisi;
        $months = ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'];
        $aidatGrid = [];
        for ($i = 1; $i <= $daireSayisi; $i++) {
            foreach ($months as $month) {
                $record = \App\Models\Aidat::where('daire_no', $i)
                            ->where('ay', $month)
                            ->where('yil', $selectedYear)
                            ->first();
                $aidatGrid[$i][$month] = $record ? $record->status : null;
            }
        }

        $projeler = \App\Models\Proje::all();

        return view('guest.index', compact(
        'toplamGelir',
        'toplamGider',
        'beklenenGelir',
        'odemeyenDaireSayisi',
        'sonGelirler',
        'sonGiderler',
        'aidatGrid',
        'projeler',
        'ayar',
        'years',
        'selectedYear'
        ));
    }

    public function gelirIndex()
    {
        // Tüm gelir kayıtlarını tarih sırasına göre (en yeni en üstte) listeleyelim
        $gelirler = Gelir::orderBy('tarih', 'desc')->get();
        return view('guest.gelir', compact('gelirler'));
    }

    public function giderIndex()
    {
        // Tüm gider kayıtlarını tarih sırasına göre (en yeni en üstte) listeleyelim
        $giderler = Gider::orderBy('tarih', 'desc')->get();
        return view('guest.gider', compact('giderler'));
    }
    public function borclular(Request $request)
{
    // Ayarlar tablosundan daire sayısı ve güncel aidat bilgilerini çekiyoruz.
    $ayar = \App\Models\Ayarlar::first();

    if (!$ayar) {
        return view('guest.borclular', ['borcluList' => [], 'year' => date('Y')]);
    }

    $daireSayisi = $ayar->daire_sayisi;
    $guncelAidat = $ayar->guncel_aidat;
    $year = $request->year ?? date('Y');
    $borcluList = [];

    // Her daire için ödenmeyen ay sayısı ve toplam ödenmemiş tutar hesaplanıyor
    for ($i = 1; $i <= $daireSayisi; $i++) {
        // Belirtilen yıl için, o dairede "odenmedi" durumundaki aidat kayıtlarını sayıyoruz.
        $unpaidCount = \App\Models\Aidat::where('daire_no', $i)
            ->where('status', 'odenmedi')
            ->count();

        // Toplam ödenmemiş tutar = ödenmemiş ay sayısı * güncel aidat
        $unpaidTotal = $unpaidCount * $guncelAidat;

        // Daire sahipleri tablosundan, ilgili daire numarasına göre isim çekiyoruz.
        $sahip = \App\Models\DaireSahibi::where('daire_no', $i)->first();
        $isim = $sahip ? $sahip->isim : '-';

        $borcluList[] = [
            'daire_no'    => $i,
            'isim'        => $isim,
            'unpaidCount' => $unpaidCount,
            'unpaidTotal' => $unpaidTotal,
        ];
    }

    return view('guest.borclular', compact('borcluList', 'year'));
}
    public function daireSahipleri()
    {
        $daireSahipleri = DaireSahibi::all();
        return view('guest.daire-sahipleri', compact('daireSahipleri'));
    }


}
