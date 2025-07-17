@extends('layouts.limtless')

@section('title', 'Ajouter une référence de courrier arrivé - CMSS')

@push('styles')
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
  body {
    font-family: 'Playfair Display', serif;
    background: linear-gradient(135deg, #d5f0ef 0%, #f9fafb 100%);
    min-height: 100vh;
  }

  .container-form {
    max-width: 650px;
    margin: 60px auto 80px;
    background: #ffffffdd;
    padding: 40px 40px 50px;
    border-radius: 18px;
    box-shadow: 0 15px 35px rgb(0 0 0 / 0.12);
    transition: box-shadow 0.3s ease;
  }
  .container-form:hover {
    box-shadow: 0 25px 55px rgb(0 0 0 / 0.18);
  }

  .top-bar {
    margin-bottom: 30px;
  }
  .top-bar a {
    color: #3AA090;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: color 0.3s ease;
  }
  .top-bar a:hover {
    color: #2e847a;
    text-decoration: underline;
  }

  h1 {
    font-weight: 700;
    font-size: 2.4rem;
    color: #0a3d3f;
    text-align: center;
    margin-bottom: 30px;
  }

  p.description {
    text-align: center;
    font-size: 1.1rem;
    color: #2f5552;
    margin-bottom: 40px;
  }

  label {
    font-weight: 600;
    color: #0e4b48;
    margin-bottom: 8px;
    display: block;
    font-size: 0.95rem;
  }

  input[type="text"] {
    width: 100%;
    padding: 14px 16px;
    border-radius: 12px;
    border: 1.8px solid #9fc9c6;
    font-size: 1.05rem;
    color: #1a3636;
    background-color: #f8fdfd;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }
  /* Bordure rouge si erreur */
  input.is-invalid {
    border-color: #d9534f !important;
    box-shadow: 0 0 5px 1px rgba(217, 83, 79, 0.7);
  }

  input[type="text"]:focus {
    outline: none;
    border-color: #4ab9a7;
    box-shadow: 0 0 10px 2px #b5e4e1;
    background-color: #f0fbfa;
  }

  small.text-error {
  color: #d9534f !important;
  font-weight: 600;
  font-size: 0.9rem;
}


  .btn-submit {
    display: block;
    margin: 40px auto 0;
    background-color: #4AB9A7;
    border: none;
    padding: 14px 42px;
    border-radius: 14px;
    color: white;
    font-weight: 700;
    font-size: 1.2rem;
    cursor: pointer;
    box-shadow: 0 6px 14px rgba(74, 185, 167, 0.7);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
  }
  .btn-submit:hover {
    background-color: #3aa191;
    box-shadow: 0 8px 20px rgba(58, 161, 145, 0.85);
  }
  .btn-submit i {
    margin-right: 10px;
    font-size: 1.3rem;
    vertical-align: middle;
  }

  @media (max-width: 576px) {
    .container-form {
      margin: 30px 20px 60px;
      padding: 30px 25px 40px;
    }
    h1 {
      font-size: 1.9rem;
    }
    .btn-submit {
      width: 100%;
      padding: 16px 0;
      font-size: 1.1rem;
    }
  }
</style>
@endpush
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
								 <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de courrier</a>
                  <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}" class="breadcrumb-item active">courrier arrivee</a>
                 <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}" class="breadcrumb-item active">historique arrivee</a>
                  <a href="{{ route('courrier.arrive.lier.depart', ['espace' => $espace]) }}" class="breadcrumb-item active">ajout de ref.départ</a>

							</div>
              

							<a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
							</a>
						</div>

						<div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
							<div class="d-lg-flex mb-2 mb-lg-0">
								

								
							</div>
						</div>
					</div>
@endsection
@section('content')
<div class="container-form" role="main" aria-labelledby="pageTitle">
  <nav class="top-bar" aria-label="Navigation retour">
    <a href="{{ url()->previous() }}">
      <i class="bi bi-arrow-left-circle-fill" aria-hidden="true"></i> Retour
    </a>
  </nav>

  <h1 id="pageTitle">Ajouter une référence de courrier arrivé</h1>

  <p class="description" aria-live="polite">
    Courrier de départ n° <strong>{{ $courrier->id }}</strong> — Référence : <strong>{{ $courrier->reference }}</strong>
  </p>

  <form method="POST" action="{{ route('courrier.depart.lier.arrivee.store', $courrier->id) }}" novalidate>
    @csrf

    <div class="mb-4">
      <label for="reference_courrierArrive">Référence du courrier arrivé :</label>
      <input
        type="text"
        id="reference_courrierArrive"
        name="reference_courrierArrive"
        placeholder="Entrez la référence ici"
        value="{{ old('reference_courrierArrive') }}"
        required
        aria-describedby="referenceError"
        aria-invalid="@error('reference_courrierArrive') true @else false @enderror"
        class="@error('reference_courrierArrive') is-invalid @enderror"
      >
      @error('reference_courrierArrive')
        <small id="referenceError" class="text-error" role="alert">{{ $message }}</small>
      @enderror
    </div>

    <button type="submit" class="btn-submit" aria-label="Enregistrer la référence du courrier arrivé">
      <i class="bi bi-save"></i> Enregistrer
    </button>
  </form>
</div>
@endsection