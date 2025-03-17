<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Aidat;

class ManualAidatEkle extends Component
{
    public $daire_no;
    public $miktar;
    public $tarih;

    protected $rules = [
        'daire_no' => 'required|integer',
        'miktar'   => 'required|numeric|min:0',
        'tarih'    => 'required|date',
    ];

    public function submit()
    {
        $this->validate();

        // Tarihten İngilizce ay adını al
        $englishMonth = date('F', strtotime($this->tarih));

        // İngilizce ay adlarını Türkçe karşılıklarıyla eşle
        $monthMapping = [
            'January'   => 'Ocak',
            'February'  => 'Şubat',
            'March'     => 'Mart',
            'April'     => 'Nisan',
            'May'       => 'Mayıs',
            'June'      => 'Haziran',
            'July'      => 'Temmuz',
            'August'    => 'Ağustos',
            'September' => 'Eylül',
            'October'   => 'Ekim',
            'November'  => 'Kasım',
            'December'  => 'Aralık',
        ];

        $turkishMonth = isset($monthMapping[$englishMonth]) ? $monthMapping[$englishMonth] : $englishMonth;

        Aidat::create([
            'daire_no' => $this->daire_no,
            'ay'       => $turkishMonth,
            'yil'      => date('Y', strtotime($this->tarih)),
            'miktar'   => $this->miktar,
            'status'   => $this->miktar > 0 ? 'odendi' : 'odenmedi',
        ]);

        session()->flash('message', 'Manuel aidat kaydı başarıyla eklendi.');
        $this->reset();
    }


    public function render()
    {
        return view('livewire.manual-aidat-ekle');
    }
}
