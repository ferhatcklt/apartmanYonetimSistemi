<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - Apartman Yönetim Sistemi</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <!-- Özel stil (opsiyonel) -->
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  @livewireStyles
  <style>
    body { background-color: #f8f9fa; padding-top: 70px; }
    .card { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .navbar-brand { font-weight: 700; }
  </style>
</head>
<body>
  <!-- Navigasyon -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ auth()->check() ? route('admin.dashboard') : route('guest.index') }}">
        Apartman Yönetim Sistemi
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
              aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto">
          @auth
            <!-- Yönetici menüsü -->
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Ana Sayfa</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Finans</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('gelir.index') }}">Gelir</a></li>
                <li><a class="dropdown-item" href="{{ route('gider.index') }}">Gider</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.aidat') }}">Aidat Ödemeleri</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.aidat.gelir') }}">Aidat Gelirleri</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('proje.index') }}">Projeler</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('duyuru.index') }}">Duyurular</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.daire-sahipleri.index') }}">Daire Sahipleri</a></li>

            <li class="nav-item"><a class="nav-link" href="{{ route('admin.temizlik.plan.index') }}">Temizlik Plan</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Ayarlar</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.raporlama') }}">Raporlama</a></li>
                <li><a class="dropdown-item" hhref="{{ route('admin.ayarlar') }}">Ayarlar</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.yoneticiler') }}">Yöneticiler</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-light" type="submit">Çıkış</button>
              </form>
            </li>
          @else
            <!-- Ziyaretçi menüsü -->
            <li class="nav-item"><a class="nav-link" href="{{ route('guest.index') }}">Ana Sayfa</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('guest.gelir') }}">Gelir</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('guest.gider') }}">Gider</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('guest.borclular') }}">Borçlular</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('guest.daire-sahipleri') }}">Daire Sahipleri</a></li>

          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <!-- Ana İçerik -->
  <main class="container mt-5 pt-4">
    @yield('content')
  </main>

  <!-- Footer (opsiyonel) -->
  <footer class="bg-light py-3 mt-5">
    <div class="container text-center">
      <small>© {{ date('Y') }} Apartman Yönetim Sistemi. Tüm hakları saklıdır.</small>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @livewireScripts
</body>
</html>
