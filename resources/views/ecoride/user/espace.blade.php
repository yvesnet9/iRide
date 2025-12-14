@extends('layouts.ecoride')

@section('title', 'Mon espace utilisateur')

@section('content')

<div class="container mx-auto py-10">

    <!-- TITRE PRINCIPAL -->
    <h1 class="text-3xl font-bold mb-8 text-green-700">
        👤 Mon espace utilisateur
    </h1>

    <!-- MESSAGE DE CONFIRMATION -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif


    <!-- ===================================================== -->
    <!-- 🔹 SECTION 1 : CHOIX DU STATUT UTILISATEUR -->
    <!-- ===================================================== -->
    <div class="card shadow-sm mb-6 p-4">
        <h2 class="text-xl fw-bold mb-3 text-green-600">Statut utilisateur</h2>

        <form method="POST" action="{{ route('user.status') }}">
            @csrf

            <p class="mb-2 text-gray-700">Sélectionnez votre statut :</p>

            <div class="flex gap-4 mb-3">

                <label class="flex items-center gap-2">
                    <input type="radio" name="driver_status" value="passenger"
                        {{ $user->driver_status === 'passenger' ? 'checked' : '' }}>
                    Passager
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="driver_status" value="driver"
                        {{ $user->driver_status === 'driver' ? 'checked' : '' }}>
                    Chauffeur
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="driver_status" value="both"
                        {{ $user->driver_status === 'both' ? 'checked' : '' }}>
                    Chauffeur & Passager
                </label>

            </div>

            <button class="btn btn-success mt-2">Mettre à jour</button>
        </form>
    </div>


    <!-- NE PAS AFFICHER LA SECTION VEHICULES SI L’UTILISATEUR N’EST PAS CHAUFFEUR -->
    @if(in_array($user->driver_status, ['driver', 'both']))


    <!-- ===================================================== -->
    <!-- 🔹 SECTION 2 : FORMULAIRE D’AJOUT DE VÉHICULE -->
    <!-- ===================================================== -->
    <div class="card shadow-sm mb-6 p-4">

        <h2 class="text-xl fw-bold mb-4 text-green-600">Ajouter un véhicule</h2>

        <form action="{{ route('vehicle.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="form-label fw-bold">Plaque d'immatriculation</label>
                    <input type="text" name="plate" class="form-control" required>
                </div>

                <div>
                    <label class="form-label fw-bold">Date de 1re immatriculation</label>
                    <input type="date" name="first_registration" class="form-control" required>
                </div>

                <div>
                    <label class="form-label fw-bold">Marque</label>
                    <input type="text" name="brand" class="form-control" required>
                </div>

                <div>
                    <label class="form-label fw-bold">Modèle</label>
                    <input type="text" name="model" class="form-control" required>
                </div>

                <div>
                    <label class="form-label fw-bold">Couleur</label>
                    <input type="text" name="color" class="form-control" required>
                </div>

                <div>
                    <label class="form-label fw-bold">Nombre de places</label>
                    <input type="number" name="seats" min="1" max="8" class="form-control" required>
                </div>

            </div>

            <div class="mt-4">

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="smoker_allowed">
                    Autoriser fumeur
                </label>

                <label class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="pets_allowed">
                    Autoriser animaux
                </label>

            </div>

            <button class="btn btn-primary mt-3">Ajouter le véhicule</button>
        </form>
    </div>


    <!-- ===================================================== -->
    <!-- 🔹 SECTION 3 : LISTE DES VÉHICULES DU CHAUFFEUR -->
    <!-- ===================================================== -->
    <div class="card shadow-sm p-4">

        <h2 class="text-xl fw-bold mb-4 text-green-600">Mes véhicules</h2>

        @if($vehicles->isEmpty())
            <p class="text-gray-600">Vous n'avez enregistré aucun véhicule pour le moment.</p>
        @else

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                @foreach($vehicles as $v)
                <div class="border rounded p-4 shadow-sm bg-white">

                    <p><strong>Plaque :</strong> {{ $v->plate }}</p>
                    <p><strong>Immatriculation :</strong> {{ $v->first_registration }}</p>
                    <p><strong>Marque :</strong> {{ $v->brand }}</p>
                    <p><strong>Modèle :</strong> {{ $v->model }}</p>
                    <p><strong>Couleur :</strong> {{ $v->color }}</p>
                    <p><strong>Places :</strong> {{ $v->seats }}</p>

                    <p class="mt-2">
                        <strong>Fumeur :</strong> 
                        {{ $v->smoker_allowed ? 'Oui' : 'Non' }}
                    </p>

                    <p>
                        <strong>Animaux :</strong>
                        {{ $v->pets_allowed ? 'Oui' : 'Non' }}
                    </p>

                </div>
                @endforeach

            </div>

        @endif

    </div>

    @endif

</div>

@endsection
