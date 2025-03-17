@extends('layouts.app')

@section('title', 'Proje Detayları')

@section('content')
<div class="card">
  <div class="card-header">
    <h3>{{ $proje->baslik }}</h3>
  </div>
  <div class="card-body">
    <p class="card-text">{{ $proje->detay }}</p>
    <p class="card-text">
      <strong>Toplam Tutar:</strong> {{ number_format($proje->toplam_tutar, 2, ',', '.') }} ₺<br>
      <strong>Daire Başı Ödeme:</strong> {{ number_format($proje->daire_basi_odeme, 2, ',', '.') }} ₺
    </p>
  </div>
  <div class="card-footer text-end">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Geri Dön</a>
  </div>
</div>
@endsection
