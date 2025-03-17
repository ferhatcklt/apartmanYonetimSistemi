<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Gelir;
use App\Models\Gider;
use App\Models\Aidat;
use App\Models\Ayarlar;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $currentMonth = date('m');
        $year = date('Y');

        $toplamGelir = Gelir::whereYear('tarih', $year)->whereMonth('tarih', $currentMonth)->sum('miktar');
        $toplamGider = Gider::whereYear('tarih', $year)->whereMonth('tarih', $currentMonth)->sum('miktar');

        $ayar = Ayarlar::first();
        $beklenenGelir = $ayar->guncel_aidat * $ayar->daire_sayisi;
        $odemeyenDaireSayisi = Aidat::where('status', 'odenmedi')
                                     ->whereYear('created_at', $year)
                                     ->whereMonth('created_at', $currentMonth)
                                     ->count();
        $guncelKasa = $ayar->ilk_kasa + Aidat::where('status', 'odendi')->sum('miktar') + $toplamGelir - $toplamGider;

        return view('livewire.dashboard', compact('toplamGelir', 'toplamGider', 'beklenenGelir', 'odemeyenDaireSayisi', 'guncelKasa'));
    }
}
