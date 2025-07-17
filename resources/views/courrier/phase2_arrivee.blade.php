



@extends('layouts.limtless')

@section('title', 'Choix d\'espace - CMSS')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
						<div class="d-flex">
							<div class="breadcrumb py-2">
								<a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">     </i></a>
								 <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de courrier</a>
                  <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}" class="breadcrumb-item active">courrier arrivee</a>
                 <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}" class="breadcrumb-item active">historique arrivee</a>
                <a href="{{ route('courrier.arrive.phase2.form', ['espace' => $espace, 'id' => $courrier->id]) }}" class="breadcrumb-item active">
  Phase de traitement
</a>


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
    <h1>Phase 2 – Traitement du courrier : {{ $courrier->reference }}</h1>

    <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn-return">
        ← Retour à l'historique
    </a>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('courrier.arrive.phase2.store', ['espace' => $espace]) }}">
        @csrf
        <input type="hidden" name="courrier_id" value="{{ $courrier->id }}">

        <div class="form-row">
            <div>
                <label>Annotation :</label>
                <textarea name="annotation" rows="3">{{ old('annotation', $courrier->annotation) }}</textarea>
            </div>
            <div>
                <label>Date d'envoi :</label>
                <input type="date" name="date_envoi"
                    value="{{ old('date_envoi', $courrier->date_envoi ? \Carbon\Carbon::parse($courrier->date_envoi)->format('Y-m-d') : '') }}"
                    required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label>Réponse attendue :</label>
                <select name="reponse_id" required>
                    <option value="">-- Sélectionner une réponse --</option>
                    @foreach($reponses as $reponse)
                    <option value="{{ $reponse->id }}" {{ $courrier->reponse_id == $reponse->id ? 'selected' : '' }}>
                        {{ $reponse->choix }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="submit-button">✅ Enregistrer Phase 2</button>
    </form>
</div>
@endsection 





























{{-- @extends('layouts.app')
@include('components.logo')

@section('title', 'Phase 2 – Traitement du courrier - ' . strtoupper($espace))

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
.choice-box {
    padding: 40px;
    max-width: 900px;
    margin: 60px auto;
    background: #f8fefc;
    border-radius: 20px;
    font-family: 'Playfair Display', serif;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    font-size: 30px;
    margin-bottom: 30px;
    color: #0a3d3f;
}

a.btn-return {
    display: inline-block;
    margin-bottom: 30px;
    background: #3aa090;
    color: white;
    padding: 10px 22px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.3s ease;
}

a.btn-return:hover {
    background: #2f827a;
}

.form-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 16px;
}

.form-row > div {
    flex: 1 1 48%;
    min-width: 200px;
}

label {
    font-weight: bold;
    color: #094746;
    display: block;
    margin-bottom: 5px;
}

input[type=text], input[type=date], select, textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background: #f9fdfd;
    font-size: 15px;
}

textarea {
    resize: vertical;
}

.submit-button {
    background: #4AB9A7;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
    float: right;
}

.submit-button:hover {
    background: #399e8c;
}

.alert-success {
    background-color: #d2f7e6;
    color: #11633a;
    padding: 12px 18px;
    border-radius: 6px;
    border: 1px solid #8be4b4;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
}
</style>
@endpush

@section('content')
<div class="choice-box">
    <h1>Phase 2 – Traitement du courrier : {{ $courrier->reference }}</h1>

    <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn-return">
        ← Retour à l'historique
    </a>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('courrier.arrive.phase2.store', ['espace' => $espace]) }}">
        @csrf
        <input type="hidden" name="courrier_id" value="{{ $courrier->id }}">

        <div class="form-row">
            <div>
                <label>Annotation :</label>
                <textarea name="annotation" rows="3">{{ old('annotation', $courrier->annotation) }}</textarea>
            </div>
            <div>
                <label>Date d'envoi :</label>
                <input type="date" name="date_envoi"
                    value="{{ old('date_envoi', $courrier->date_envoi ? \Carbon\Carbon::parse($courrier->date_envoi)->format('Y-m-d') : '') }}"
                    required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label>Réponse attendue :</label>
                <select name="reponse_id" required>
                    <option value="">-- Sélectionner une réponse --</option>
                    @foreach($reponses as $reponse)
                    <option value="{{ $reponse->id }}" {{ $courrier->reponse_id == $reponse->id ? 'selected' : '' }}>
                        {{ $reponse->choix }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="submit-button">✅ Enregistrer Phase 2</button>
    </form>
</div>
@endsection --}}
