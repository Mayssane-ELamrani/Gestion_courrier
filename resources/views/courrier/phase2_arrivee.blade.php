@extends('layouts.limtless')

@section('title', "Phase 2 – Traitement du courrier : $courrier->reference")
@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black">
                    <i class="fa fa-home"> </i>
                </a>
                <a href="{{ route('choix.espace', ['espace' => $espace]) }}" class="breadcrumb-item active">choix d'espace</a>
                <a href="{{ route('choix.courrier', ['espace' => $espace]) }}" class="breadcrumb-item active">choix de
                    courrier</a>
                <a href="{{ route('courrier.arrivee.form', ['espace' => $espace, 'type' => 'arrive']) }}"
                    class="breadcrumb-item active">courrier arrivee</a>
                <a href="{{ route('courrier.arrivee.historique', ['espace' => $espace]) }}"
                    class="breadcrumb-item active">historique arrivee</a>


                <a href="{{ route('courrier.arrive.phase2.form', ['espace' => $espace, 'id' => $courrier->id]) }}"
                    class="breadcrumb-item active">phase 2 arrivée</a>
            </div>

            <a href="#breadcrumb_elements"
                class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
@endsection
@section('breadcrumb')
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card shadow-sm" style="font-family: 'Playfair Display', serif; max-width: 800px; margin: auto;">
        <div class="card-header bg-light text-center">
            <h1 class="mb-0" style="font-size: 24px; color: #0a3d3f;">
                <i class="bi bi-pencil-square me-2"></i> Phase 2 – Traitement du courrier
            </h1>
            <p class="mt-2 mb-0" style="color: #26712b;">
                Référence : <strong>{{ $courrier->reference }}</strong>
            </p>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('courrier.arrive.phase2.store', ['espace' => $espace]) }}"
                style="background: #f8f9fa; padding: 20px; border-radius: 12px; border: 1px solid #ddd;">
                @csrf
                <input type="hidden" name="courrier_id" value="{{ $courrier->id }}">

                {{-- Annotation --}}
                <div class="mb-3">
                    <label for="annotation" class="form-label">
                        Annotation <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('annotation') is-invalid @enderror" id="annotation" name="annotation"
                        rows="4" required>{{ old('annotation', $courrier->annotation) }}</textarea>
                    @error('annotation')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date d'envoi --}}
                <div class="mb-3">
                    <label for="date_envoi" class="form-label">
                        Date d'envoi <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control @error('date_envoi') is-invalid @enderror" id="date_envoi"
                        name="date_envoi" required
                        value="{{ old('date_envoi', $courrier->date_envoi ? \Carbon\Carbon::parse($courrier->date_envoi)->format('Y-m-d') : '') }}">
                    @error('date_envoi')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Réponse attendue --}}
                <div class="mb-4">
                    <label for="reponse_id" class="form-label">
                        Réponse attendue <span class="text-danger">*</span>
                    </label>
                    <select class="form-select select2 @error('reponse_id') is-invalid @enderror" id="reponse_id"
                        name="reponse_id" required>
                        <option value="">-- Sélectionner une réponse --</option>
                        @foreach ($reponses as $reponse)
                            <option value="{{ $reponse->id }}"
                                {{ old('reponse_id', $courrier->reponse_id) == $reponse->id ? 'selected' : '' }}>
                                {{ $reponse->choix }}
                            </option>
                        @endforeach
                    </select>
                    @error('reponse_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Boutons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('courrier.arrive.historique', ['espace' => $espace]) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle-fill me-1"></i> Enregistrer Phase 2
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: "Sélectionner...",
                allowClear: true
            });
        });
    </script>
@endpush
