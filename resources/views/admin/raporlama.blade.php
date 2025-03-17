@extends('layouts.app')

@section('title', 'Raporlama')

@section('content')
<div class="card">
  <div class="card-header">Finansal Raporlama</div>
  <div class="card-body">
    <form method="GET" action="{{ route('admin.raporlama') }}" class="row g-3 mb-4">
      <div class="col-md-4">
        <label class="form-label">Ay</label>
        <input type="text" name="month" class="form-control" placeholder="Örn: 03">
      </div>
      <div class="col-md-4">
        <label class="form-label">Yıl</label>
        <input type="text" name="year" class="form-control" placeholder="Örn: 2025">
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Raporla</button>
      </div>
    </form>

    <div class="row">
      <div class="col-md-4">
        <div class="alert alert-success">
          <strong>Gelir:</strong> {{ number_format($gelir, 2, ',', '.') }} ₺
        </div>
      </div>
      <div class="col-md-4">
        <div class="alert alert-danger">
          <strong>Gider:</strong> {{ number_format($gider, 2, ',', '.') }} ₺
        </div>
      </div>
      <div class="col-md-4">
        <div class="alert alert-info">
          <strong>Beklenen Gelir:</strong> {{ number_format($beklenenGelir, 2, ',', '.') }} ₺
        </div>
      </div>
    </div>
    <h5 class="mt-4">Aidatını Vermeyen Daireler</h5>
    <ul class="list-group">
      @foreach($odemeyenDaire as $aidat)
        <li class="list-group-item">Daire: {{ $aidat->daire_no }}, Ay: {{ $aidat->ay }}</li>
      @endforeach
    </ul>
  </div>
</div>
@endsection
