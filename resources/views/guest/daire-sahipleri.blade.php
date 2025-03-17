@extends('layouts.app')

@section('title', 'Daire Sahipleri')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>Daire Sahipleri</h4>
  </div>
  <div class="card-body">
    @if($daireSahipleri->count() > 0)
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-light">
            <tr class="text-center">
              <th>Daire No</th>
              <th>İsim</th>
              <th>Email</th>
              <th>Telefon</th>
            </tr>
          </thead>
          <tbody>
            @foreach($daireSahipleri as $sahip)
              <tr class="text-center">
                <td>{{ $sahip->daire_no }}</td>
                <td>{{ $sahip->isim }}</td>
                <td>{{ $sahip->email }}</td>
                <td>{{ $sahip->telefon }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="alert alert-info">Daire sahibi kaydı bulunmamaktadır.</div>
    @endif
  </div>
</div>
@endsection
