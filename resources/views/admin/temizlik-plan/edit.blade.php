@extends('layouts.app')

@section('title', 'Temizlik Planı Düzenle')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>Hafta {{ $week }} - Temizlik Tarihi Düzenle ({{ $month }}/{{ $year }})</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.temizlik.plan.update') }}" method="POST">
      @csrf
      <input type="hidden" name="week" value="{{ $week }}">
      <input type="hidden" name="month" value="{{ $month }}">
      <input type="hidden" name="year" value="{{ $year }}">
      <div class="mb-3">
        <label class="form-label">Temizlik Tarihi</label>
        <input type="date" name="tarih" class="form-control" value="{{ $temizlik->tarih }}">
      </div>
      <button type="submit" class="btn btn-primary">Güncelle</button>
      <a href="{{ route('admin.temizlik.plan.index', ['month' => $month, 'year' => $year]) }}" class="btn btn-secondary">İptal</a>
    </form>
  </div>
</div>
@endsection
