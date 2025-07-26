<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login page</title>

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
