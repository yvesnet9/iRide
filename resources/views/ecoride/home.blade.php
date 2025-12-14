@extends('layouts.ecoride')

@section('title', 'Accueil EcoRide')

@section('content')

<div class="container d-flex flex-column align-items-center mt-5">

    {{-- ★ FORMULAIRE CENTRÉ ET MIS EN VALEUR ★ --}}
    <div class="card shadow-sm p-4 mb-5 bg-white"
         style="max-width: 600px; width: 100%; border: 1px solid #e0e0e0;">

        <h2 class="text-success fw-bold mb-4 text-center">
            Trouvez votre covoiturage
        </h2>

        <form action="{{ route('ecoride.search') }}" method="GET" class="row g-3">

            <div class="col-12">
                <label for="departure" class="form-label fw-semibold">Départ</label>
                <input id="departure" type="text" name="departure"
                       class="form-control"
                       placeholder="Ville de départ" required>
            </div>

            <div class="col-12">
                <label for="arrival" class="form-label fw-semibold">Arrivée</label>
                <input id="arrival" type="text" name="arrival"
                       class="form-control"
                       placeholder="Ville d'arrivée" required>
            </div>

            <div class="col-12">
                <label for="date" class="form-label fw-semibold">Date</label>
                <input id="date" type="date" name="date"
                       class="form-control" required>
            </div>

            <div class="col-12 text-center mt-3">
                <button type="submit"
                        class="btn btn-success px-5 py-2 fw-bold shadow-sm">
                    🔍 Rechercher
                </button>
            </div>

        </form>
    </div>

    {{-- ★ IMAGE UNIQUE : LA VOITURE ISOLÉE ★ --}}
    <div class="text-center mb-5">
    <div class="inline-block bg-gray-50 p-4 rounded-lg shadow-sm">
        <img src="/images/car-isolated.png"
             alt="Voiture EcoRide"
             class="img-fluid"
             style="max-width: 420px;">
    </div>
</div>

    </div>

</div>

@endsection
