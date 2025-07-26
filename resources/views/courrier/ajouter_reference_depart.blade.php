@extends('layouts.limtless')

@section('title', 'Ajouter une référence de courrier départ')
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home">
                    </i></a>
                <a href="{{ route('courrier.arrive.lier.depart', $courrier->id) }}" class="breadcrumb-item active">Ajouter
                    référence départ</a>
            </div>


            <a href="#breadcrumb_elements"
                class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                data-bs-toggle="collapse">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <div class="card" style="font-family: 'Playfair Display', serif;">
        <div class="card-header text-center bg-light">
            <h1 class="mb-0" style="font-size: 24px; color: #0a3d3f;">
                <i class="bi bi-link-45deg me-2"></i> Ajouter une référence de courrier départ
            </h1>
        </div>

        <div class="card-body">

            <div class="mb-4 text-center">
                <p>
                    Courrier d'arrivée n° <strong>{{ $courrier->id }}</strong> —
                    Référence : <strong>{{ $courrier->reference }}</strong>
                </p>
            </div>

            <form method="POST" action="{{ route('courrier.arrive.lier.depart.store', $courrier->id) }}"
                style="background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd; max-width: 600px; margin: auto;">
                @csrf

                <div class="mb-3">
                    <label for="reference_courrierDepart" class="form-label" style="font-size: 14px;">
                        Référence du courrier départ <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" id="reference_courrierDepart" name="reference_courrierDepart"
                        value="{{ old('reference_courrierDepart', $courrier->reference_courrierDepart ?? '') }}"
                        style="font-size: 14px; padding: 8px;" required>
                    @error('reference_courrierDepart')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save-fill me-1"></i> Enregistrer
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
