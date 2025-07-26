@extends('layouts.superVisorStati')

@section('title', 'Espace Superviseur')

@section('breadcrumb')
    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{ route('choix.espace') }}" class="breadcrumb-item" style="color: black"><i class="fa fa-home"></i></a>
                <a href="{{ route('gestion.superviseur') }}" class="breadcrumb-item active">Espace Superviseur</a>
            </div>
            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
        <div class="collapse d-lg-block ms-lg-auto" id="breadcrumb_elements">
            <div class="d-lg-flex mb-2 mb-lg-0">
                {{-- éventuels éléments complémentaires --}}
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="page-content">
    <div class="content-wrapper">
        <div class="content-inner">

            <div class="page-header">
                <div class="page-header-content container d-lg-flex">
                    <h4 class="page-title mb-0">Accueil - <span class="fw-normal">Espace Superviseur</span></h4>
                </div>
            </div>

            <div class="content container pt-0">

                {{-- Statistiques simples --}}
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h6 class="mb-1 text-muted">📥 Courriers arrivés</h6>
                                <h2 class="fw-bold">{{ $totalArrive ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h6 class="mb-1 text-muted">📤 Courriers départs</h6>
                                <h2 class="fw-bold">{{ $totalDepart ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h6 class="mb-1 text-muted">📂 Objets</h6>
                                <h2 class="fw-bold">{{ $totalObjets ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h6 class="mb-1 text-muted">👥 Utilisateurs</h6>
                                <h2 class="fw-bold">{{ $totalUsers ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistiques par département --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Statistiques par département (Courriers arrivés et départs)</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($departements as $departement)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $departement->nom }}
                                    <span>
                                        <span class="badge bg-success rounded-pill me-2">
                                            Arrivés: {{ $courriersArriveParDepartement[$departement->id]->total ?? 0 }}
                                        </span>
                                        <span class="badge bg-info rounded-pill">
                                            Départs: {{ $courriersDepartParDepartement[$departement->id]->total ?? 0 }}
                                        </span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Statistiques par objet --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Statistiques par objet (Courriers arrivés et départs)</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($objets as $objet)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $objet->nom }}
                                    <span>
                                        <span class="badge bg-success rounded-pill me-2">
                                            Arrivés: {{ $courriersArriveParObjet[$objet->id]->total ?? 0 }}
                                        </span>
                                        <span class="badge bg-info rounded-pill">
                                            Départs: {{ $courriersDepartParObjet[$objet->id]->total ?? 0 }}
                                        </span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Courriers par espace --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Courriers arrivés par espace</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    @foreach($courriersArriveParEspace as $espace => $count)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ strtoupper($espace) }}
                                            <span class="badge bg-success rounded-pill">{{ $count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Courriers départs par espace</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    @foreach($courriersDepartParEspace as $espace => $count)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ strtoupper($espace) }}
                                            <span class="badge bg-info rounded-pill">{{ $count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
