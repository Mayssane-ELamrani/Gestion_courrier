{{-- <!DOCTYPE html>
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

    html, body {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .right-side {
      background: rgba(255, 255, 255, 0.95);
      width:  100vw;
      max-width: 600px;
      padding: 60px 50px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .logo-centered {
      width: 100px;
      height: auto;
      margin-bottom: 30px;
    }

    .form-box {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .form-box h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.8rem;
      color: #0a3d3f;
      text-align: center;
      margin-bottom: 5px;
    }

    .form-box h3 {
      font-size: 1.4rem;
      color: #00695c;
      text-align: center;
      letter-spacing: 1px;
      margin-bottom: 15px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    input[type="text"],
    input[type="password"] {
      padding: 18px 20px;
      font-size: 1.1rem;
      border: 1.5px solid #3ea290;
      background-color: #f9fdfc;
      width: 100%;
    }

    input:focus {
      outline: none;
      border-color: #00695c;
      background-color: #fff;
    }

    button {
      padding: 18px 20px;
      font-size: 1.2rem;
      font-weight: 600;
      color: white;
      background: linear-gradient(45deg, #3ea290, #00695c);
      border: none;
      cursor: pointer;
    }

    button:hover {
      background: linear-gradient(45deg, #005140, #003d33);
    }

    .error-box {
      background-color: #fce4e4;
      border: 1px solid #f44336;
      color: #d8000c;
      padding: 12px 15px;
      font-size: 0.95rem;
    }

    @media (max-width: 768px) {
      .right-side {
        width: 90vw;
        padding: 40px 30px;
      }

      .form-box h1 {
        font-size: 2.2rem;
      }

      .form-box h3 {
        font-size: 1.1rem;
      }

      input,
      button {
        font-size: 1rem;
        padding: 15px 18px;
      }

      .logo-centered {
        width: 80px;
      }
    }
  </style>
</head>
<body>

  <div class="right-side">
    <img src="{{ asset('images/LOGO_CMSS_ONEE_NEW-13.png') }}" alt="Logo CMSS" class="logo-centered" />

    <div class="form-box">
      <h1>Gestion Courrier</h1>
      <h3 id="yearTitle">CMSS-2025</h3>

      @if ($errors->any())
        <div class="error-box">
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('acceuil.login') }}">
        @csrf
        <input type="text" name="matricule" placeholder="Entrer votre matricule" pattern="\d{5}" maxlength="5" value="{{ old('matricule') }}" required autofocus />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <button type="submit">Se connecter</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('yearTitle').innerText = 'CMSS-' + new Date().getFullYear();
  </script>

</body>
</html> --}}


{{-- 
@dd(Auth::check()) --}}
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset("global_assets/css/icons/icomoon/styles.min.css")}}" rel="stylesheet" type="text/css">
	<link href="{{asset("assets/css/all.min.css")}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset("global_assets/js/main/jquery.min.js")}}"></script>
	<script src="{{asset("global_assets/js/main/bootstrap.bundle.min.js")}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset("assets/js/app.js")}}"></script>
	<!-- /theme JS files -->

</head>

<body background={{asset('images/background.jpg')}}  width="130" alt="">




	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login form -->
				 <form method="POST" action="{{ route('acceuil.login') }}" class="login-form">
        @csrf
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<img src="{{asset('images/LOGO_CMSS_ONEE_NEW-13.png')}}" width="130" alt="">
									<h5 class="mb-0">connectez-vous</h5>
									<span class="d-block text-muted">Entrer votre informations</span>
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="text" pattern="\d{5}" maxlength="5" value="{{ old('matricule') }}" required autofocu class="form-control @error('matricule') is-invalid @enderror" name="matricule" placeholder="Matricule">
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
                  @error('matricule')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
								</div>

								<div class="form-group form-group-feedback form-group-feedback-left">
									<input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
                     @error('password')
                  <div class="invalid-feedback">{{$message}}</div>
                  @enderror
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-success btn-block">Se connecter</button>
								</div>

								
							</div>
						</div>
					</form>
					<!-- /login form -->

				</div>
				<!-- /content area -->



			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
