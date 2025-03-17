@extends('layouts.app')

@section('title', 'Aidat Ödemeleri')

@section('content')
<div class="card">
    <div class="card-header"><h5>Manuel Aidat Girişi</h5></div>
    <div class="card-body">
        @livewire('manual-aidat-ekle')
    </div>
</div>
<hr class="my-4">
<div class="card">
  <div class="card-header">Yıllık Aidat Ödeme Tablosu</div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Livewire Aidat Ödeme Tablosu -->
    @livewire('aidat-yonetimi')



  </div>
</div>
@endsection
