@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('content')
<div class="row g-3">
  <!-- Finansal Özet Kartlar -->
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

<!-- Son 5 Gelir ve Gider Kayıtları -->
<div class="row mt-4">
  <!-- Son 5 Gelir Kartı -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Son 5 Gelir</h5>
        <a href="{{ route('guest.gelir') }}" class="btn btn-sm btn-outline-primary">Tüm Gelirler</a>
      </div>
      <ul class="list-group list-group-flush">
        @foreach($sonGelirler as $gelir)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong>{{ $gelir->baslik }}</strong><br>
              <small class="text-muted">{{ $gelir->tarih }}</small>
            </div>
            <span class="badge bg-success fs-6">{{ number_format($gelir->miktar, 2, ',', '.') }} ₺</span>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <!-- Son 5 Gider Kartı -->
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Son 5 Gider</h5>
        <a href="{{ route('guest.gider') }}" class="btn btn-sm btn-outline-primary">Tüm Giderler</a>
      </div>
      <ul class="list-group list-group-flush">
        @foreach($sonGiderler as $gider)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong>{{ $gider->baslik }}</strong><br>
              <small class="text-muted">{{ $gider->tarih }}</small>
            </div>
            <span class="badge bg-danger fs-6">{{ number_format($gider->miktar, 2, ',', '.') }} ₺</span>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<!-- Aidat Çizelgesi Bölümü -->
<div class="mt-5">
  <h4>Aidat Çizelgesi ({{ $selectedYear }})</h4>

  <!-- Yıl Seçimi Formu -->
  <form action="{{ route('guest.index') }}" method="GET" class="mb-3">
    <div class="input-group">
      <label class="input-group-text" for="yearSelect">Yıl</label>
      <select name="year" id="yearSelect" style="flex:none;width: auto;" class="form-select">
        @foreach($years as $year)
          <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary">Göster</button>
    </div>
  </form>

  <!-- Aidat Tablosu -->
  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>Daire No</th>
          @foreach(['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'] as $month)
            <th>{{ $month }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @for($i = 1; $i <= $ayar->daire_sayisi; $i++)
          <tr class="text-center">
            <td class="fw-bold">{{ $i }}</td>
            @foreach(['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'] as $month)
              @php
                $status = isset($aidatGrid[$i][$month]) ? $aidatGrid[$i][$month] : null;
              @endphp
              <td>
                @if($status === 'odendi')
                  <i class="bi bi-check-circle-fill text-success fs-4"></i>
                @elseif($status === 'odenmedi')
                  <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                @else
                  <i class="bi bi-exclamation-circle-fill text-warning fs-4"></i>
                @endif
              </td>
            @endforeach
          </tr>
        @endfor
      </tbody>
    </table>
  </div>

  <p class="mt-2"><em>Not: Aidat güncellemeleri yalnızca yönetici panelinden yapılır.</em></p>
</div>

<!-- Projeler Bölümü -->
<div class="mt-5">
  <h4>Projeler</h4>
  <div class="row">
    @foreach($projeler as $proje)
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          <div class="card-header">{{ $proje->baslik }}</div>
          <div class="card-body">
            <p class="card-text">{{ Str::limit($proje->detay, 100) }}</p>
            <p class="card-text"><small>Daire Başı: {{ number_format($proje->daire_basi_odeme, 2, ',', '.') }} ₺</small></p>
          </div>
          <div class="card-footer text-end">
            <a href="{{ route('proje.detay', $proje->id) }}" class="btn btn-sm btn-primary">Detaylar</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
