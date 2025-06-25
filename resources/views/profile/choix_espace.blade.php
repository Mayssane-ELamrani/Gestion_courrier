<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Choix d'espace - CMSS</title>

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      width: 100%;
      height: 100%;
      font-family: 'Playfair Display', serif;
      background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
      background-size: cover;
    }

    .menu-toggle {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 28px;
      background: none;
      border: none;
      color: #0a3d3f;
      z-index: 1100;
      cursor: pointer;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: -260px;
      width: 260px;
      height: 100%;
      background-color: #0a3d3f;
      color: white;
      padding: 30px 20px;
      box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
      transition: left 0.3s ease;
      z-index: 1050;
    }

    .sidebar.open {
      left: 0;
    }

    .sidebar .profile-pic {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 15px;
      display: block;
      border: 3px solid white;
      box-shadow: 0 0 8px rgba(255,255,255,0.6);
    }

    .sidebar .username {
      background-color: #2a7a6f;
      padding: 12px 20px;
      border-radius: 12px;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 30px;
      user-select: none;
      box-shadow: 0 0 10px rgba(42, 122, 111, 0.7);
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      font-size: 18px;
      margin: 15px 0;
      padding: 10px;
      border-radius: 6px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #1c5759;
    }

    .content {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 40px 20px;
      transition: margin-left 0.3s ease;
    }

    .content.shifted {
      margin-left: 260px;
    }

    .choice-box {
      position: relative;
      background: rgba(255, 255, 255, 0.95);
      padding: 60px 50px;
      border-radius: 16px;
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 900px;
    }

    .choice-box .logo {
      position: absolute;
      top: 20px;
      right: 30px;
      width: 100px;
      height: 100px;
      object-fit: contain;
    }

    .choice-box h1 {
      color: #0a3d3f;
      font-size: 36px;
      margin-top: 10px;
      text-align: center;
    }

    .choice-box h3 {
      color: #004d40;
      font-size: 22px;
      text-align: center;
      margin-bottom: 50px;
    }

    .options {
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

    .option-tile.identique {
      background: #4AB9A7;
      color: white;
      padding: 25px;
      border-radius: 12px;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      transition: 0.3s ease;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      cursor: pointer;
    }

    .option-tile.identique:hover {
      background-color: #3AA090;
      transform: translateY(-4px);
    }

    .option-tile.identique a {
      color: white;
      text-decoration: none;
      display: block;
    }

    footer {
      margin-top: 40px;
      text-align: center;
      font-size: 14px;
      color: #555;
    }

    @media (max-width: 768px) {
      .choice-box {
        padding: 40px 20px;
      }

      .choice-box .logo {
        position: static;
        display: block;
        margin: 0 auto 20px;
      }

      .menu-toggle {
        left: 10px;
        top: 10px;
      }

      .content,
      .content.shifted {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <button class="menu-toggle" id="menuToggleBtn" aria-label="Toggle menu">
    <i class="bi bi-list"></i>
  </button>

  <div class="sidebar" id="sidebar">
    <img src="{{ asset('images/profile.jpeg') }}" alt="Photo profil" class="profile-pic" />
    <div class="username">{{ Auth::user()->name }}</div>
    <a href="{{ route('profil') }}"><i class="bi bi-person-circle me-2"></i> Mon Profil</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
      @csrf
    </form>
  </div>

  <div class="content" id="content">
    <div class="choice-box">
      <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="logo" />
      <h1>Choisissez votre espace</h1>
      <h3>CMSS-<span id="year"></span></h3>
      <div class="options">
        <div class="option-tile identique">
          <a href="{{ route('espace.cmss') }}">
            <i class="bi bi-building-fill me-2"></i> Espace CMSS
          </a>
        </div>
        <div class="option-tile identique">
          <a href="{{ route('espace.cmcas') }}">
            <i class="bi bi-bank2 me-2"></i> Espace CMCAS
          </a>
        </div>
      </div>
      <footer>© <span id="footerYear"></span> CMSS - Tous droits réservés</footer>
    </div>
  </div>

  <script>
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    menuToggleBtn.addEventListener('click', () => {
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

    const year = new Date().getFullYear();
    document.getElementById('year').innerText = year;
    document.getElementById('footerYear').innerText = year;
  </script>

</body>
</html>
