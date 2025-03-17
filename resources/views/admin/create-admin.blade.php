@extends('layouts.app')

@section('title', 'Yönetici Ekle')

@section('content')
<div class="card">
  <div class="card-header">Yeni Yönetici Ekle</div>
  <div class="card-body">
    <form action="{{ route('admin.yoneticiler.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">İsim</label>
        <input type="text" name="name" class="form-control" placeholder="İsim">
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email">
      </div>
      <div class="mb-3">
        <label class="form-label">Parola</label>
        <input type="password" name="password" class="form-control" placeholder="Parola">
      </div>
      <div class="mb-3">
        <label class="form-label">Parola Tekrar</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Parolayı Tekrar Girin">
      </div>
      <button type="submit" class="btn btn-primary">Ekle</button>
    </form>
  </div>
</div>
@endsection
