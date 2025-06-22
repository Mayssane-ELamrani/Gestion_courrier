<!DOCTYPE html>
<html lang="fr">
<head>
 
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion - CMSS</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
    font-family: 'Playfair Display', serif;
    }

    .main-container {
      display: flex;
      height: 100%;
      width: 100%;
    }

    .left-side {
      flex: 1;
      background: url('{{ asset('images/background.jpg') }}') no-repeat center center;
      background-size: cover;
    }

    .right-side {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(to right, #e1f5f4, #f5fafa);
    }

    .form-box {
      background: #ffffff;
      padding: 60px 40px;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 600px;
      height: 80%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }

    .form-box .logo {
      position: absolute;
      top: 30px;
      right: 50px;
      width: 120px;
      height: 120px;
      object-fit: contain;
    }

    .form-box h1 {
      text-align: center;
      color: #0a3d3f;
      font-size: 30px;
      margin-bottom: 10px;
      margin-top: 40px;
    }

    .form-box h3 {
      text-align: center;
      font-size: 20px;
      margin-bottom: 30px;
      font-weight: bold;
      color: #004d40;
    }

    .form-box form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form-box input {
      padding: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    .form-box input:focus {
      border-color: #3ea290;
      outline: none;
      box-shadow: 0 0 5px #3ea290;
    }

    .form-box button {
      padding: 16px;
      background-color:#3ea290;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .form-box button:hover {
      background-color: #3ea290;
    }
  </style>
</head>
<body>

<div class="main-container">
  <div class="left-side"></div>
  <div class="right-side">
    <div class="form-box">
      <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="logo" />

      <h1>Gestion Courrier</h1>
     {{-- <x-salutation/> --}}
      <h3 id="yearTitle">CMSS-2025</h3>
   

      <form method="POST" action="{{ route('acceuil.login') }}">
        @csrf
        <input type="text" name="text" placeholder="Matricule" required autofocus />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <button type="submit">Se connecter</button>
      </form>
    </div>
  </div>
</div>
<script>
  const year = new Date().getFullYear();
  document.getElementById('yearTitle').innerText = CMSS-${year};
</script>

</body>
</html> 