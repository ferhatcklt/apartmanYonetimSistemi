<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire; // Doğru namespace
use App\Http\Livewire\AidatYonetimi;
use App\Http\Livewire\ManualAidatEkle;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('aidat-yonetimi', AidatYonetimi::class);
        Livewire::component('manual-aidat-ekle', ManualAidatEkle::class);
    }
}
