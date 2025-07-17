@extends('layouts.limtless')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
  .choice-box {
    position: relative;
    background: linear-gradient(to bottom right, #e0f7f5, #ffffff);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    width: 95%;
    max-width: 900px;
    margin: auto;
    font-family: 'Playfair Display', serif;
  }

  h1 {
    color: #0a3d3f;
    font-size: 32px;
    margin-bottom: 30px;
    text-align: center;
  }

  .top-bar {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 30px;
  }

  .top-bar a {
    background: #3AA090;
    padding: 8px 18px;
    border-radius: 6px;
    border: none;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.3s ease;
  }

  .top-bar a:hover {
    background: #2e847a;
  }

  form div {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #094746;
    font-size: 14px;
  }

  input[type=text] {
    width: 100%;
    padding: 10px 14px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    background-color: #f9fdfd;
    transition: box-shadow 0.3s ease;
  }

  input[type=text]:focus {
    outline: none;
    box-shadow: 0 0 5px #4ab9a7;
  }

  .submit-button {
    display: block;
    margin: 30px auto 0;
    background: #4AB9A7;
    border: none;
    padding: 14px 32px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .submit-button:hover {
    background: #3aa191;
  }

  .submit-button i {
    margin-right: 8px;
  }
</style>
@endpush

@section('title', 'Ajouter une référence de courrier départ')
@extends('layouts.limtless')


@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
								 <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de courrier</a>
                  <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}" class="breadcrumb-item active">courrier arrivee</a>
                 <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}" class="breadcrumb-item active">historique arrivee</a>
                  <a href="{{ route('courrier.depart.lier.arrivee', ['espace' => $espace]) }}" class="breadcrumb-item active">ajout de ref.d'arrivee</a>

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
<div class="choice-box">
  <div class="top-bar">
    <a href="{{ url()->previous() }}">⬅ Retour</a>
  </div>

  <h1>Ajouter une référence de courrier départ</h1>

  <p style="text-align:center; margin-bottom: 30px;">
    Courrier d'arrivée n° <strong>{{ $courrier->id }}</strong> — Référence : <strong>{{ $courrier->reference }}</strong>
  </p>

  <form method="POST" action="{{ route('courrier.arrive.lier.depart.store', $courrier->id) }}">
    @csrf
    <div>
      <label for="reference_courrierDepart">Référence du courrier départ :</label>
      <input
        type="text"
        name="reference_courrierDepart"
        id="reference_courrierDepart"
        value="{{ old('reference_courrierDepart', $courrier->reference_courrierDepart ?? '') }}"
        required
      >
      @error('reference_courrierDepart')
        <small style="color:#c00000;">{{ $message }}</small>
      @enderror
    </div>

    <button type="submit" class="submit-button">
      <i class="bi bi-save"></i> Enregistrer
    </button>
  </form>
</div>
@endsection