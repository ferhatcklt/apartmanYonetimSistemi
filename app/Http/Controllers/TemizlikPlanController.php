<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TemizlikPlanController extends Controller
{
    public function index(Request $request)
    {
        // Sabit plan başlangıç tarihi: İlk temizlik 16 Mart 2023
        $planStart = Carbon::create(2025, 3, 16);
        // Plan 1 yıl süreli (örneğin 16 Mart 2023'ten 15 Mart 2024'e kadar)
        $planEnd = $planStart->copy()->addYear()->subDay();

        // Seçilen ay ve yıl (admin seçimi)
        $current = Carbon::now();
        if ($current->between($planStart, $planEnd)) {
            $defaultYear = $current->year;
            $defaultMonth = $current->month;
        } else {
            $defaultYear = $planStart->year;
            $defaultMonth = $planStart->month;
        }

        $selectedYear = $request->year ? intval($request->year) : $defaultYear;
        $selectedMonth = $request->month ? intval($request->month) : $defaultMonth;

        // Hesaplama: plan başlangıcından itibaren 7 günde bir temizlik tarihi oluşturuluyor
        $cleaningDates = [];
        $date = $planStart->copy();
        $index = 1;
        while ($date->lte($planEnd)) {
            $cleaningDates[] = [
                'date' => $date->copy(),
                'index' => $index,
                'is_payment' => ($index % 4 == 0), // her 4. temizlik ödeme haftası
            ];
            $date->addWeek();
            $index++;
        }

        // Seçilen ay içindeki temizlik tarihlerini filtrele
        $monthDates = array_filter($cleaningDates, function($item) use ($selectedYear, $selectedMonth) {
            return $item['date']->year == $selectedYear && $item['date']->month == $selectedMonth;
        });

        // Anahtar olarak ayın günü ile eşleştirme
        $cleaningByDay = [];
        foreach ($monthDates as $item) {
            $day = $item['date']->day;
            $cleaningByDay[$day] = $item;
        }

        // Aylık takvim görünümü için takvim grid'ini oluşturuyoruz.
        $firstOfMonth = Carbon::create($selectedYear, $selectedMonth, 1);
        $lastOfMonth = $firstOfMonth->copy()->endOfMonth();
        // ISO hafta: Pazartesi=1, Pazar=7; haftanın ilk günü için 1 çıkarıyoruz (0 tabanlı hesaplama)
        $startDayOfWeek = $firstOfMonth->dayOfWeekIso - 1;

        $weeks = [];
        $week = [];
        // İlk boş hücreler (eğer ay Pazartesi değilse)
        for ($i = 0; $i < $startDayOfWeek; $i++) {
            $week[] = null;
        }
        for ($day = 1; $day <= $lastOfMonth->day; $day++) {
            $week[] = $day;
            if (count($week) == 7) {
                $weeks[] = $week;
                $week = [];
            }
        }
        if (count($week) > 0) {
            while (count($week) < 7) {
                $week[] = null;
            }
            $weeks[] = $week;
        }

        // Aylar listesi
        $months = [
            1 => 'Ocak', 2 => 'Şubat', 3 => 'Mart', 4 => 'Nisan',
            5 => 'Mayıs', 6 => 'Haziran', 7 => 'Temmuz', 8 => 'Ağustos',
            9 => 'Eylül', 10 => 'Ekim', 11 => 'Kasım', 12 => 'Aralık'
        ];

        return view('admin.temizlik-plan.index', compact(
            'selectedYear', 'selectedMonth', 'months', 'weeks', 'cleaningByDay'
        ));
    }
}
