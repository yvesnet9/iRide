@extends('layouts.ecoride')

@section('title', 'Résultats de recherche')

@section('content')

<h1 class="fw-bold text-success mb-4">Résultats de recherche</h1>

{{-- =============================== --}}
{{--    FILTRES DE RECHERCHE (US4) --}}
{{-- =============================== --}}
<form method="GET" class="mb-4 d-flex align-items-center gap-3">

    <input type="hidden" name="departure" value="{{ request('departure') }}">
    <input type="hidden" name="arrival" value="{{ request('arrival') }}">
    <input type="hidden" name="date" value="{{ request('date') }}">

    <label>
        <input type="checkbox" name="electric" value="1" {{ request('electric') ? 'checked' : '' }}>
        Véhicules électriques
    </label>

    <label>
        <input type="checkbox" name="price_lowest" value="1" {{ request('price_lowest') ? 'checked' : '' }}>
        Prix les plus bas
    </label>

    <label>
        <input type="checkbox" name="early" value="1" {{ request('early') ? 'checked' : '' }}>
        Départs les plus tôt
    </label>

    <button class="btn btn-success">Filtrer</button>

</form>

{{-- =============================== --}}
{{--      AFFICHAGE DES RESULTATS    --}}
{{-- =============================== --}}
@if($trips->isEmpty())
    <p class="text-muted">Aucun covoiturage trouvé pour votre recherche.</p>

@else

    <div class="row">
    @foreach($trips as $trip)

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm p-3">

                <p class="fw-bold fs-5">Chauffeur : {{ $trip->driver_name }}</p>

                <p>{{ $trip->departure }} → {{ $trip->arrival }}</p>

                <p>
                    Le {{ \Carbon\Carbon::parse($trip->date)->format('d/m/Y') }}
                    à {{ substr($trip->time, 0, 5) }}
                </p>

                <p>Véhicule : {{ ucfirst($trip->vehicle_type) }}</p>

                <p class="fw-bold">Prix : {{ $trip->price }} €</p>

                <p>Places restantes : {{ $trip->seats }}</p>

                {{-- ⭐⭐ BOUTON US5 ⭐⭐ --}}
                <a href="{{ route('ecoride.show', $trip->id) }}" class="btn btn-success mt-3">
                    Voir le trajet
                </a>


            </div>
        </div>

    @endforeach
    </div>

@endif

@endsection
