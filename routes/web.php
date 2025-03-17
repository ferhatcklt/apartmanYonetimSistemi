<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GelirController;
use App\Http\Controllers\GiderController;
use App\Http\Controllers\ProjeController;
use App\Http\Controllers\DuyuruController;
use App\Http\Controllers\Admin\DaireSahibiController;

// Ziyaretçi ana sayfası
Route::get('/', [GuestController::class, 'index'])->name('guest.index');
Route::get('/proje/{proje}', [\App\Http\Controllers\ProjeController::class, 'detay'])->name('proje.detay');
Route::get('/gelirler', [GuestController::class, 'gelirIndex'])->name('guest.gelir');
Route::get('/giderler', [GuestController::class, 'giderIndex'])->name('guest.gider');
Route::get('/borclular', [GuestController::class, 'borclular'])->name('guest.borclular');
Route::get('/daire-sahipleri', [\App\Http\Controllers\GuestController::class, 'daireSahipleri'])->name('guest.daire-sahipleri');

// Yönetici paneli rotaları (auth middleware ile korunmalı)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Ayarlar
    Route::get('/ayarlar', [AdminController::class, 'ayarlar'])->name('admin.ayarlar');
    Route::post('/ayarlar', [AdminController::class, 'updateAyarlar'])->name('admin.ayarlar.update');

    // Yönetici İşlemleri
    Route::get('/yoneticiler', [AdminController::class, 'yoneticiler'])->name('admin.yoneticiler');
    Route::get('/yoneticiler/ekle', [AdminController::class, 'createAdmin'])->name('admin.yoneticiler.create');
    Route::post('/yoneticiler/ekle', [AdminController::class, 'storeAdmin'])->name('admin.yoneticiler.store');

    // Aidat Ödemeleri (Livewire)
    Route::get('/aidat', function () {
        return view('admin.aidat');
    })->name('admin.aidat');

    // Gelir Yönetimi
    Route::resource('gelir', GelirController::class);

    // Gider Yönetimi
    Route::resource('gider', GiderController::class);

    // Proje Yönetimi
    Route::resource('proje', \App\Http\Controllers\ProjeController::class);
    Route::get('/proje', [ProjeController::class, 'index'])->name('proje.index');
    Route::get('/proje/create', [ProjeController::class, 'create'])->name('proje.create');
    Route::post('/proje/ekle', [ProjeController::class, 'store'])->name('proje.store');

    // Duyurular
    Route::resource('duyuru', DuyuruController::class);

    // Raporlama
    Route::get('/raporlama', [AdminController::class, 'raporlama'])->name('admin.raporlama');
    Route::get('/temizlik-plan', [\App\Http\Controllers\TemizlikPlanController::class, 'index'])->name('admin.temizlik.plan.index');
    Route::get('/temizlik-plan/edit', [\App\Http\Controllers\TemizlikPlanController::class, 'edit'])->name('admin.temizlik.plan.edit');
    Route::post('/temizlik-plan/update', [\App\Http\Controllers\TemizlikPlanController::class, 'update'])->name('admin.temizlik.plan.update');
    Route::get('/aidat-gelir', [\App\Http\Controllers\AidatController::class, 'index'])->name('admin.aidat.gelir');
    Route::get('/aidat-gelir/edit/{id}', [\App\Http\Controllers\AidatController::class, 'edit'])->name('admin.aidat.gelir.edit');
    Route::put('/aidat-gelir/update/{id}', [\App\Http\Controllers\AidatController::class, 'update'])->name('admin.aidat.gelir.update');
    Route::delete('/aidat-gelir/destroy/{id}', [\App\Http\Controllers\AidatController::class, 'destroy'])->name('admin.aidat.gelir.destroy');
    Route::resource('daire-sahipleri', \App\Http\Controllers\Admin\DaireSahibiController::class);
    Route::get('/daire-sahipleri', [DaireSahibiController::class, 'index'])->name('admin.daire-sahipleri.index');
    Route::get('/daire-sahipleri/create', [DaireSahibiController::class, 'create'])->name('admin.daire-sahipleri.create');
    Route::post('/daire-sahipleri/store', [DaireSahibiController::class, 'store'])->name('admin.daire-sahipleri.store');
    Route::get('/daire-sahipleri/edit/{id}', [DaireSahibiController::class, 'edit'])->name('admin.daire-sahipleri.edit');
    Route::put('/daire-sahipleri/update/{id}', [DaireSahibiController::class, 'update'])->name('admin.daire-sahipleri.update');
    Route::delete('/daire-sahipleri/destroy/{id}', [DaireSahibiController::class, 'destroy'])->name('admin.daire-sahipleri.destroy');
});

// Laravel Authentication Routes
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
