<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Choix d'espace - CMSS</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      font-family: 'Playfair Display', serif;
      background: linear-gradient(to right, #e1f5f4, #f5fafa);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .choice-container {
      background: #ffffff;
      padding: 60px 40px;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 600px;
      height: auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }

    .choice-container .logo {
      position: absolute;
      top: 30px;
      right: 50px;
      width: 120px;
      height: 120px;
      object-fit: contain;
    }

    h1 {
      color: #0a3d3f;
      font-size: 30px;
      margin-bottom: 20px;
      margin-top: 40px;
      text-align: center;
    }

    h3 {
      font-size: 20px;
      margin-bottom: 40px;
      font-weight: bold;
      color: #004d40;
      text-align: center;
    }

    .options {
      display: flex;
      gap: 40px;
      justify-content: center;
      width: 100%;
    }

    .option {
      flex: 1;
      background-color: #3ea290;
      color: white;
      border-radius: 8px;
      padding: 30px 20px;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(62, 162, 144, 0.4);
      transition: background-color 0.3s ease, transform 0.2s ease;
      user-select: none;
    }

    .option:hover {
      background-color: #2a7a6f;
      transform: scale(1.05);
    }

    a {
      color: inherit;
      text-decoration: none;
      display: block;
      height: 100%;
      width: 100%;
    }
  </style>
</head>
<body>

  <div class="choice-container">
    <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="logo" />

    <h1>Choisissez votre espace</h1>
    <h3 id="yearTitle">CMSS-{{ date('Y') }}</h3>

    <div class="options">
      <div class="option">
        <a href="{{ route('espace.cmss') }}">Espace CMSS</a>
      </div>
      <div class="option">
        <a href="{{ route('espace.cmcas') }}">Espace CMCAS</a>
      </div>
    </div>
  </div>

</body>
</html>
