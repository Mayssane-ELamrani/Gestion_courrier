{{-- @extends('layouts.limtless')



@section('title', 'Choix d\'espace - CMSS')

@section('content')
<div class="container">
    <h1>Gestion administrative</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

 
 <!-- Formulaire ajout utilisateur -->
    <section>
        <h2>➕ Ajouter un utilisateur</h2>
        <form method="POST" action="{{ route('admin.utilisateur.store') }}">
            @csrf
            <input type="text" name="nom_complet" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="matricule" placeholder="Matricule" required>
            <select name="role" required>
                <option value="" disabled selected>Rôle</option>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>
            <input type="password" name="password" placeholder="Mot de passe" required minlength="6">
            <button type="submit">Créer l'utilisateur</button>
        </form>
    </section>
    <!-- Liste utilisateurs -->
    <section>
        <h2>👤 Utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Matricule</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($utilisateurs as $user)
                <tr>
                    <td>{{ $user->nom_complet }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->matricule }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.utilisateur.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="role" class="role-select" onchange="this.form.submit()">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if(auth()->id() !== $user->id)
                        <form method="POST" action="{{ route('admin.utilisateur.delete', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Confirmer la suppression ?')">🗑 Supprimer</button>
                        </form>
                        @else
                            Vous
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Liste départements -->
    <section>
        <h2>🏢 Départements</h2>
        <form method="POST" action="{{ route('admin.departement.store') }}">
            @csrf
            <input type="text" name="nom" placeholder="Nom du département" required>
            <button type="submit">Ajouter</button>
        </form>

        <ul>
            @foreach($departements as $d)
            <li>
                {{ $d->nom }}
                <form method="POST" action="{{ route('admin.departement.delete', $d->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Supprimer ce département ?')">Supprimer</button>
                </form>
            </li>
            @endforeach
        </ul>
    </section>

    <!-- Liste objets -->
    <section>
        <h2>📄 Objets</h2>
        <form method="POST" action="{{ route('admin.objet.store') }}">
            @csrf
            <input type="text" name="nom" placeholder="Nom de l'objet" required>
            <button type="submit">Ajouter</button>
        </form>

        <ul>
            @foreach($objets as $o)
            <li>
                {{ $o->nom }}
                <form method="POST" action="{{ route('admin.objet.delete', $o->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Supprimer cet objet ?')">Supprimer</button>
                </form>
            </li>
            @endforeach
        </ul>
    </section>
</div>
@endsection --}}


























































@extends('layouts.limtless')



@section('title', 'Choix d\'espace - CMSS')

@push('styles')
<style>
    body, input, select, button {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 16px;
        background-color: #f5f8fa;
        color: #2c3e50;
    }
    .container {
        max-width: 1100px;
        margin: 30px auto 60px;
        padding: 0 20px;
    }
    h1 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 40px;
        color: #0e5a22;
    }
    section {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 25px 30px;
        margin-bottom: 40px;
        transition: box-shadow 0.3s ease;
    }
    section:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    section h2 {
        font-weight: 600;
        margin-bottom: 25px;
        color: #34495e;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.4rem;
    }

    /* Grille cartes statistiques */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit,minmax(180px,1fr));
        gap: 20px;
    }

    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px 25px;
        box-shadow: 0 4px 12px rgba(20, 134, 22, 0.15);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        transition: box-shadow 0.3s ease;
        min-height: 120px;
    }

    .stat-card:hover {
        box-shadow: 0 8px 25px rgba(20, 134, 22, 0.25);
    }

    .stat-icon {
        font-size: 2.8rem;
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 2.4rem;
        font-weight: 700;
        color: #148616;
        margin-bottom: 6px;
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .stat-label.strong {
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 8px;
    }

    .stat-small {
        font-size: 0.9rem;
        color: #555;
        margin: 3px 0;
    }

    /* Formulaire styles */
    form {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }
    form input[type="text"],
    form input[type="email"],
    form input[type="number"],
    form input[type="password"],
    form select {
        flex: 1 1 220px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        transition: border-color 0.3s ease;
    }
    form input[type="text"]:focus,
    form input[type="email"]:focus,
    form input[type="number"]:focus,
    form input[type="password"]:focus,
    form select:focus {
        border-color:  #148616;
        outline: none;
    }
    form button {
        background-color:   #148616;
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        flex-shrink: 0;
        transition: background-color 0.3s ease;
    }
    form button:hover {
        background-color: #0f6f1e;
    }

    /* Tableau utilisateurs */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e1e4e8;
    }
    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #2c3e50;
    }
    tr:hover {
        background-color: #f1f6fb;
    }
    select.role-select {
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    select.role-select:hover, select.role-select:focus {
        border-color: #148616;
        outline: none;
    }
    button.delete-btn {
        background: #e74c3c;
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
    }
    button.delete-btn:hover {
        background-color: #c0392b;
    }

    /* Liste départements et objets */
    ul {
        list-style: none;
        padding-left: 0;
    }
    ul li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8f9fa;
        padding: 8px 15px;
        border-radius: 6px;
        box-shadow: inset 0 0 5px #ddd;
    }
    ul li form button {
        margin: 0;
        padding: 4px 8px;
        font-size: 1.1rem;
    }

    /* Alertes */
    .alert {
        max-width: 600px;
        margin: 10px auto 30px;
        padding: 15px 20px;
        border-radius: 6px;
        font-weight: 600;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .alert-success {
        background-color: #dff0d8;
        color: #148616;
        border: 1px solid #d0e9c6;
    }
    .alert-error {
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #ebccd1;
    }

    /* Responsive */
    @media (max-width: 768px) {
        form {
            flex-direction: column;
        }
        form input, form select, form button {
            flex: 1 1 100%;
        }
    }
    @media (max-width: 480px) {
        .stat-card {
            min-height: 110px;
            padding: 15px 20px;
        }
        .stat-number {
            font-size: 2rem;
        }
        .stat-icon {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1>Gestion administrative</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Statistiques générales -->
    <section>
        <h2>📊 Statistiques générales</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📥</div>
                <div class="stat-number">{{ $totalArrive }}</div>
                <div class="stat-label">Courriers arrivés</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📤</div>
                <div class="stat-number">{{ $totalDepart }}</div>
                <div class="stat-label">Courriers départs</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏢</div>
                <div class="stat-number">{{ $totalCmssArrive }}</div>
                <div class="stat-label">CMSS (arrivés)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏢</div>
                <div class="stat-number">{{ $totalCmssDepart }}</div>
                <div class="stat-label">CMSS (départs)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏢</div>
                <div class="stat-number">{{ $totalCmcasArrive }}</div>
                <div class="stat-label">CMCAS (arrivés)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏢</div>
                <div class="stat-number">{{ $totalCmcasDepart }}</div>
                <div class="stat-label">CMCAS (départs)</div>
            </div>
        </div>
    </section>

    <!-- Statistiques par Département -->
    <section>
      
        <h2>🏢 Statistiques par Département</h2>
        <div class="stats-grid">
            @foreach($parDepartement as $d)
                <div class="stat-card">
                    <div class="stat-label strong">{{ $d->nom }}</div>
                    <div class="stat-small">Arrivés : {{ $d->courriers_arrives_count }}</div>
                    <div class="stat-small">Départs : {{ $d->courriers_depart_count }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Statistiques par Objet -->
    <section>
       
        <h2>📄 Statistiques par Objet</h2>
        <div class="stats-grid">
            @foreach($parObjet as $o)
                <div class="stat-card">
                    <div class="stat-label strong">{{ $o->nom }}</div>
                    <div class="stat-small">Arrivés : {{ $o->courriers_arrives_count }}</div>
                    <div class="stat-small">Départs : {{ $o->courriers_depart_count }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Formulaire ajout utilisateur -->
    <section>
        <h2>➕ Ajouter un utilisateur</h2>
        <form method="POST" action="{{ route('admin.utilisateur.store') }}">
            @csrf
            <input type="text" name="nom_complet" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="matricule" placeholder="Matricule" required>
            <select name="role" required>
                <option value="" disabled selected>Rôle</option>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>
            <input type="password" name="password" placeholder="Mot de passe" required minlength="6">
            <button type="submit">Créer l'utilisateur</button>
        </form>
    </section>

    <!-- Liste utilisateurs -->
    <section>
        <h2>👤 Utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Matricule</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($utilisateurs as $user)
                <tr>
                    <td>{{ $user->nom_complet }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->matricule }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.utilisateur.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <select name="role" class="role-select" onchange="this.form.submit()">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @if(auth()->id() !== $user->id)
                        <form method="POST" action="{{ route('admin.utilisateur.delete', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Confirmer la suppression ?')">🗑 Supprimer</button>
                        </form>
                        @else
                            Vous
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Liste départements -->
    <section>
        <h2>🏢 Départements</h2>
        <form method="POST" action="{{ route('admin.departement.store') }}">
            @csrf
            <input type="text" name="nom" placeholder="Nom du département" required>
            <button type="submit">Ajouter</button>
        </form>

        <ul>
            @foreach($departements as $d)
            <li>
                {{ $d->nom }}
                <form method="POST" action="{{ route('admin.departement.delete', $d->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Supprimer ce département ?')">Supprimer</button>
                </form>
            </li>
            @endforeach
        </ul>
    </section>

    <!-- Liste objets -->
    <section>
        <h2>📄 Objets</h2>
        <form method="POST" action="{{ route('admin.objet.store') }}">
            @csrf
            <input type="text" name="nom" placeholder="Nom de l'objet" required>
            <button type="submit">Ajouter</button>
        </form>

        <ul>
            @foreach($objets as $o)
            <li>
                {{ $o->nom }}
                <form method="POST" action="{{ route('admin.objet.delete', $o->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn" onclick="return confirm('Supprimer cet objet ?')">Supprimer</button>
                </form>
            </li>
            @endforeach
        </ul>
    </section>
</div>
@endsection 
