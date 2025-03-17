<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Daire;
use App\Models\Aidat;
use Carbon\Carbon;

class AidatYonetimi extends Component
{
    public $daireler;
    public $aylar = ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'];
    public $aidatMiktarlari = [];

    public function mount()
    {
        $this->daireler = Daire::all();
    }

    public function ode($daireNo, $ay)
    {
        $miktar = $this->aidatMiktarlari[$daireNo][$ay] ?? null;
        if (!is_numeric($miktar)) {
            session()->flash('error', 'Lütfen geçerli bir miktar giriniz.');
            return;
        }
        $status = $miktar > 0 ? 'odendi' : 'odenmedi';

        Aidat::updateOrCreate(
            [
                'daire_no' => $daireNo,
                'ay'       => $ay,
                'yil'      => Carbon::now()->year,
            ],
            [
                'miktar'   => $miktar,
                'status'   => $status,
            ]
        );

        session()->flash('message', "Daire {$daireNo} - {$ay} aidatı güncellendi.");
    }

    public function getCellColor($daireNo, $ay)
    {
        $aidat = Aidat::where([
            ['daire_no', $daireNo],
            ['ay', $ay],
            ['yil', Carbon::now()->year],
        ])->first();

        if ($aidat) {
            if ($aidat->status === 'odendi') {
                return '#28a745'; // Yeşil
            } elseif ($aidat->status === 'odenmedi') {
                return '#dc3545'; // Kırmızı
            }
        }
        return '#ffc107'; // Sarı (veri yoksa)
    }

    public function render()
    {
        return view('livewire.aidat-yonetimi', [
            'aylar' => $this->aylar,
            'daireler' => $this->daireler,
            'aidatMiktarlari' => $this->aidatMiktarlari,
        ]);
    }
}
