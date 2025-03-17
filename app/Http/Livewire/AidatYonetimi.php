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
    public $selectedYear;
    public $years = [];

    public function mount()
    {
        // Varsayılan yıl: bu yıl
        $this->selectedYear = date('Y');
        // Örneğin, son 5 yıl ile gelecek 1 yıl (ihtiyacınıza göre ayarlayın)
        $this->years = range(date('Y') - 5, date('Y') + 1);

        // Daire verilerini çekiyoruz; eğer yoksa Ayarlar tablosundaki daire sayısına göre dummy daireler oluşturuyoruz
        $daireData = Daire::all();
        if ($daireData->isEmpty()) {
            $ayar = \App\Models\Ayarlar::first();
            $daireCount = $ayar ? $ayar->daire_sayisi : 10;
            $this->daireler = collect(range(1, $daireCount))->map(function($no) {
                return (object)['no' => $no];
            });
        } else {
            $this->daireler = $daireData;
        }
        $this->loadAidatRecords();
    }

    // Seçili yıl için veritabanından aidat kayıtlarını yükler
    public function loadAidatRecords()
    {
        foreach ($this->daireler as $daire) {
            foreach ($this->aylar as $ay) {
                $record = Aidat::where('daire_no', $daire->no)
                    ->where('ay', $ay)
                    ->where('yil', $this->selectedYear)
                    ->first();
                $this->aidatMiktarlari[$daire->no][$ay] = $record ? $record->miktar : "";
            }
        }
    }

    // "Öde" butonuna basıldığında çağrılır
    public function ode($daireNo, $ay)
    {
        $miktar = $this->aidatMiktarlari[$daireNo][$ay] ?? null;
        // Loglama
        logger("Attempting to update aidat for daire: $daireNo, ay: $ay, year: {$this->selectedYear}, miktar: " . $miktar);

        if ($miktar === "" || !is_numeric($miktar)) {
            session()->flash('error', 'Lütfen geçerli bir miktar giriniz.');
            return;
        }

        $status = $miktar > 0 ? 'odendi' : 'odenmedi';

        Aidat::updateOrCreate(
            [
                'daire_no' => $daireNo,
                'ay'       => $ay,
                'yil'      => $this->selectedYear,
            ],
            [
                'miktar'   => $miktar,
                'status'   => $status,
            ]
        );

        session()->flash('message', "Daire {$daireNo} - {$ay} aidatı güncellendi.");
        // Kayıt sonrası verileri yeniden yükle
        $this->loadAidatRecords();
    }

    // Belirtilen daire ve ay için, veritabanındaki kayda göre hücre rengini döner
    public function getCellColor($daireNo, $ay)
    {
        $aidat = Aidat::where([
            ['daire_no', $daireNo],
            ['ay', $ay],
            ['yil', $this->selectedYear],
        ])->first();

        if ($aidat) {
            if ($aidat->status === 'odendi') {
                return 'green';
            } elseif ($aidat->status === 'odenmedi') {
                return 'red';
            }
        }
        return 'yellow';
    }

    public function render()
    {
        return view('livewire.aidat-yonetimi', [
            'aylar' => $this->aylar,
            'daireler' => $this->daireler,
            'aidatMiktarlari' => $this->aidatMiktarlari,
            'selectedYear' => $this->selectedYear,
            'years' => $this->years,
        ]);
    }
}
