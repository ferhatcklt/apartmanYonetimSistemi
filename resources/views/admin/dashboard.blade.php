@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row g-3">
  <!-- Özet Kartları -->
  <div class="col-12 col-md-3">
    <div class="card text-white bg-success">
      <div class="card-body">
        <h5 class="card-title">Toplam Gelir</h5>
        <p class="card-text fs-4">{{ number_format($toplamGelir, 2, ',', '.') }} ₺</p>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-3">
    <div class="card text-white bg-danger">
      <div class="card-body">
        <h5 class="card-title">Toplam Gider</h5>
        <p class="card-text fs-4">{{ number_format($toplamGider, 2, ',', '.') }} ₺</p>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-3">
    <div class="card text-white bg-info">
      <div class="card-body">
        <h5 class="card-title">Beklenen Gelir</h5>
        <p class="card-text fs-4">{{ number_format($beklenenGelir, 2, ',', '.') }} ₺</p>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-3">
    <div class="card text-white bg-warning">
      <div class="card-body">
        <h5 class="card-title">Ödenmeyen Daire</h5>
        <p class="card-text fs-4">{{ $odemeyenDaireSayisi }}</p>
      </div>
    </div>
  </div>
</div>

<div class="card mt-4">
  <div class="card-header">Güncel Kasa</div>
  <div class="card-body">
    <h5 class="card-title fs-3">{{ number_format($guncelKasa, 2, ',', '.') }} ₺</h5>
  </div>
</div>


<!-- Aidat Çizelgesi (Livewire bileşeni) -->
<div class="mt-5">
  <h4 class="mb-3">Aidat Çizelgesi</h4>
  @livewire('aidat-yonetimi')
</div>
@endsection
