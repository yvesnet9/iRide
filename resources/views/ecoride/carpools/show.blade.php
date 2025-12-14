@extends('layouts.ecoride')

@section('title', 'Détails du trajet')

@section('content')

<div class="card shadow-sm p-4">

    <h2 class="text-success fw-bold mb-4">
        🚗 Détails du trajet
    </h2>

    {{-- Chauffeur --}}
    <p><strong>Chauffeur :</strong> {{ $trip->driver_name }}</p>

    {{-- Trajet --}}
    <p><strong>Trajet :</strong> {{ $trip->departure }} → {{ $trip->arrival }}</p>

    {{-- Date et heure --}}
    <p><strong>Date :</strong>
        {{ \Carbon\Carbon::parse($trip->date)->format('d/m/Y') }}
        @if($trip->time)
            à {{ substr($trip->time, 0, 5) }}
        @endif
    </p>

    {{-- Type de véhicule --}}
    <p><strong>Véhicule :</strong> {{ ucfirst($trip->vehicle_type) }}</p>

    {{-- Prix --}}
    <p><strong>Prix :</strong> {{ $trip->price }} €</p>

    {{-- Places restantes --}}
    <p><strong>Places restantes :</strong> {{ $trip->seats }}</p>

    {{-- MESSAGE Succès / Erreur --}}
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    {{-- Bouton réservation – US6 --}}
    @auth
        @if($trip->seats > 0)

            <form method="POST" action="{{ route('ecoride.reserve', $trip->id) }}">
                @csrf
                <button class="btn btn-success mt-3">
                    Réserver ce trajet
                </button>
            </form>

        @else
            <p class="text-danger fw-bold mt-3">Trajet complet</p>
        @endif
    @else
        <p class="mt-3">
            <a href="{{ route('login') }}" class="text-primary">
                Connectez-vous pour réserver.
            </a>
        </p>
    @endauth

    {{-- Bouton retour --}}
    <a href="{{ route('ecoride.home') }}" class="btn btn-secondary mt-4">
        ← Retour
    </a>

</div>

@endsection
