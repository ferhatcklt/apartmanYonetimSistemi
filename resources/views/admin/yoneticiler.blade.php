@extends('layouts.app')

@section('title', 'Yöneticiler')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Yöneticiler</span>
    <a href="{{ route('admin.yoneticiler.create') }}" class="btn btn-success btn-sm">Yeni Yönetici Ekle</a>
  </div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>İsim</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        @foreach($admins as $admin)
          <tr>
            <td>{{ $admin->id }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
