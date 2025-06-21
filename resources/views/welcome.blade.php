<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion - CMSS</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #e1f5f4, #f5fafa);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background: white;
      width: 90%;
      max-width: 480px;
      padding: 40px 30px 40px 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .header {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 10px;
    }

    .logo {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }

    .title {
      color: #00695c;
      font-weight: bold;
      font-size: 28px;
      user-select: none;
    }

    .subtitle {
      color: #333;
      font-size: 18px;
      text-align: center;
      margin-bottom: 25px;
      user-select: none;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input {
      width: 100%;
      padding: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
      box-sizing: border-box;
    }

    input:focus {
      border-color: #0077cc;
      outline: none;
      box-shadow: 0 0 5px #0077cc;
    }

    .btn {
      width: 100%;
      padding: 15px;
      background-color: #0077cc;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #005fa3;
    }

    .forgot {
      text-align: right;
      margin-top: 10px;
    }

    .forgot a {
      text-decoration: none;
      color: #0077cc;
      font-size: 14px;
    }

    .forgot a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="logo" />
      <div class="title" id="yearTitle">CMSS</div>
    </div>
    <div class="subtitle">Gestion Courrier</div>

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <input type="text" name="text" placeholder="Matricule" required autofocus />
      <input type="password" name="password" placeholder="Mot de passe" required />
      <button type="submit" class="btn">Connexion</button>
    </form>

   

  <script>
    // Affiche CMSS-année courante automatiquement
    const year = new Date().getFullYear();
    document.getElementById('yearTitle').innerText = `CMSS-${year}`;
  </script>
</body>
</html>
