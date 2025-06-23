<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion - CMSS</title>

  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Playfair Display', serif;
      background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .right-side {
      position: relative;
      width: 50vw;
      max-width: 600px;
      height: 80vh;
      background: linear-gradient(135deg, rgba(255 255 255 / 0.85) 0%, rgba(255 255 255 / 0.6) 100%);
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 60px 50px;
      overflow: hidden;
    }

    .top-right-logo {
      position: absolute;
      top: 20px;
      right: 20px;
      width: 100px;
      height: 100px;
      object-fit: contain;
      z-index: 2;
    }

    .form-box {
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      gap: 25px;
      padding-top: 20px;
    }

    .form-box h1 {
      color: #0a3d3f;
      font-size: 3rem;
      text-align: center;
      margin-bottom: 5px;
      font-weight: 700;
      text-shadow: 0 0 5px rgba(62, 162, 144, 0.5);
    }

    .form-box h3 {
      color: #00695c;
      text-align: center;
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 40px;
      letter-spacing: 2px;
      text-shadow: 0 0 3px rgba(0, 77, 64, 0.3);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    input[type="email"],
    input[type="password"] {
      padding: 18px 20px;
      font-size: 1.1rem;
      border-radius: 12px;
      border: 2px solid #3ea290;
      background-color: #f9fdfc;
      transition: all 0.3s ease;
      font-family: 'Segoe UI', sans-serif;
      box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      outline: none;
      border-color: #00695c;
      background-color: #fff;
      box-shadow: 0 0 12px 3px rgba(62, 162, 144, 0.6);
    }

    button {
      padding: 18px 20px;
      font-size: 1.2rem;
      font-weight: 700;
      color: white;
      background: linear-gradient(45deg, #3ea290, #00695c);
      border: none;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(0, 105, 92, 0.5);
      transition: background 0.4s ease, box-shadow 0.4s ease;
      font-family: 'Segoe UI', sans-serif;
    }

    button:hover {
      background: linear-gradient(45deg, #005140, #003d33);
      box-shadow: 0 8px 25px rgba(0, 81, 64, 0.75);
    }

    @media (max-width: 768px) {
      .right-side {
        width: 90vw;
        height: auto;
        padding: 40px 30px;
      }

      .form-box h1 {
        font-size: 2.2rem;
      }

      .form-box h3 {
        font-size: 1.2rem;
        margin-bottom: 30px;
      }

      input[type="email"],
      input[type="password"],
      button {
        font-size: 1rem;
        padding: 15px 18px;
      }

      .top-right-logo {
        width: 80px;
        height: 80px;
        top: 15px;
        right: 15px;
      }
    }
  </style>
</head>
<body>

  <div class="right-side">
    <!-- Logo en haut à droite -->
    <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="top-right-logo" />

    <div class="form-box">
      <h1>Gestion Courrier</h1>
      <h3 id="yearTitle">CMSS-2025</h3>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Matricule" required autofocus />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <button type="submit">Se connecter</button>
      </form>
    </div>
  </div>

  <script>
    const year = new Date().getFullYear();
    document.getElementById('yearTitle').innerText = CMSS-${year};
  </script>

</body>
</html>