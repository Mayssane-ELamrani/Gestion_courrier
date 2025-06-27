<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'CMSS')</title>

  <!-- Police + icônes -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Styles globaux + sidebar -->
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body, html {
      width: 100%; height: 100%;
      font-family: 'Playfair Display', serif;
      background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
      background-size: cover;
    }
    .menu-toggle {
      position: absolute; top: 20px; left: 20px;
      font-size: 28px; background: none; border: none;
      color: #0a3d3f; z-index: 1100; cursor: pointer;
    }
    .sidebar {
      position: fixed; top: 0; left: -260px;
      width: 260px; height: 100%;
      background-color: #0a3d3f; color: white;
      padding: 30px 20px;
      box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
      transition: left 0.3s ease; z-index: 1050;
    }
    .sidebar.open { left: 0; }
    .sidebar .profile-pic {
      width: 100px; height: 100px; border-radius: 50%;
      object-fit: cover; margin: 0 auto 15px;
      display: block; border: 3px solid white;
      box-shadow: 0 0 8px rgba(255,255,255,0.6);
    }
    .sidebar .username {
      background-color: #2a7a6f; padding: 12px 20px;
      border-radius: 12px; text-align: center;
      font-size: 20px; font-weight: bold; margin-bottom: 30px;
      user-select: none; box-shadow: 0 0 10px rgba(42,122,111,0.7);
    }
    .sidebar a {
      display: block; color: white; text-decoration: none;
      font-size: 18px; margin: 15px 0; padding: 10px;
      border-radius: 6px; transition: background-color 0.3s;
    }
    .sidebar a:hover { background-color: #1c5759; }
    .content { display: flex; justify-content: center; align-items: center;
      min-height: 100vh; padding: 40px 20px; transition: margin-left 0.3s ease; }
    .content.shifted { margin-left: 260px; }
    @media (max-width: 768px) {
      .menu-toggle { top: 10px; left: 10px; }
      .content, .content.shifted { margin-left: 0; }
    }
  </style>
  @stack('styles')
</head>
<body>
  <!-- Menu et sidebar -->
  <button class="menu-toggle" id="menuToggleBtn" aria-label="Toggle menu">
    <i class="bi bi-list"></i>
  </button>

  <div class="sidebar" id="sidebar">
    <img src="{{ asset('images/profile.jpeg') }}" alt="Photo profil" class="profile-pic" />
    <div class="username">{{ Auth::user()->nom_complet }}</div>
    <a href="{{ route('profile.index') }}"><i class="bi bi-person-circle me-2"></i> Mon Profil</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
      @csrf
    </form>
  </div>

  <!-- Contenu de la page -->
  <div class="content" id="content">
    @yield('content')
  </div>

  <!-- Script menu sidebar -->
  <script>
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    menuToggleBtn?.addEventListener('click', () => {
      sidebar.classList.toggle('open');
      content.classList.toggle('shifted');
    });

    document.addEventListener('click', (e) => {
      const isClickInsideSidebar = sidebar.contains(e.target);
      const isClickOnToggleBtn = menuToggleBtn.contains(e.target);
      if (!isClickInsideSidebar && !isClickOnToggleBtn && sidebar.classList.contains('open')) {
        sidebar.classList.remove('open');
        content.classList.remove('shifted');
      }
    });
  </script>

  @stack('scripts')
</body>
</html>
