@extends('layouts.app')

@section('title', 'Aidat Gelirleri')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>Aidat Gelirleri</h4>
  </div>
  <div class="card-body">
    <!-- Filtreleme Formu -->
    <form method="GET" action="{{ route('admin.aidat.gelir') }}" class="row g-3 mb-4">
      <div class="col-md-3">
        <label class="form-label">Daire No</label>
        <input type="number" name="daire_no" class="form-control" value="{{ request('daire_no') }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">Ay</label>
        <input type="text" name="ay" class="form-control" placeholder="Örn: Ocak" value="{{ request('ay') }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">Yıl</label>
        <input type="number" name="yil" class="form-control" value="{{ request('yil') }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">Ödeme Durumu</label>
        <select name="status" class="form-select">
          <option value="">Tümü</option>
          <option value="odendi" {{ request('status') == 'odendi' ? 'selected' : '' }}>Ödendi</option>
          <option value="odenmedi" {{ request('status') == 'odenmedi' ? 'selected' : '' }}>Ödenmedi</option>
        </select>
      </div>
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Filtrele</button>
      </div>
    </form>

    @if($aidatlar->count() > 0)
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr class="text-center">
              <th>ID</th>
              <th>Daire No</th>
              <th>Ay</th>
              <th>Yıl</th>
              <th>Miktar (₺)</th>
              <th>Ödeme Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody>
            @foreach($aidatlar as $aidat)
              <tr class="text-center">
                <td>{{ $aidat->id }}</td>
                <td>{{ $aidat->daire_no }}</td>
                <td>{{ $aidat->ay }}</td>
                <td>{{ $aidat->yil }}</td>
                <td class="text-end">{{ number_format($aidat->miktar, 2, ',', '.') }} ₺</td>
                <td>
                  @if($aidat->status === 'odendi')
                    <span class="badge bg-success">Ödendi</span>
                  @else
                    <span class="badge bg-danger">Ödenmedi</span>
                  @endif
                </td>
                <td>{{ $aidat->created_at->format('d/m/Y') }}</td>
                <td>
                  <a href="{{ route('admin.aidat.gelir.edit', $aidat->id) }}" class="btn btn-sm btn-primary">Düzenle</a>
                  <form action="{{ route('admin.aidat.gelir.destroy', $aidat->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Sayfalama Linkleri -->
      <div class="d-flex justify-content-center">
        {{ $aidatlar->links() }}
      </div>
    @else
      <div class="alert alert-info">Aidat geliri kaydı bulunmamaktadır.</div>
    @endif
  </div>
</div>
@endsection
