@extends('layouts.ecoride')

@section('title', 'Historique des covoiturages')

@section('content')

<div class="container mx-auto py-10">

    <h1 class="text-3xl font-bold mb-8 text-green-700">
        📜 Historique de mes covoiturages
    </h1>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ===================== --}}
    {{-- TRAJETS CHAUFFEUR --}}
    {{-- ===================== --}}
    <h2 class="text-xl font-bold mb-4">🚗 En tant que chauffeur</h2>

    @forelse($driverTrips as $trip)
        <div class="card mb-3 p-4 shadow-sm">
            <p><strong>{{ $trip->departure }} → {{ $trip->arrival }}</strong></p>
            <p>{{ $trip->date }} à {{ substr($trip->time, 0, 5) }}</p>
            <p>Places restantes : {{ $trip->seats }}</p>

            <form method="POST" action="{{ route('trip.cancel', $trip->id) }}">
                @csrf
                <button class="btn btn-danger mt-2">
                    Annuler le trajet
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500">Aucun trajet créé.</p>
    @endforelse


    {{-- ===================== --}}
    {{-- TRAJETS PASSAGER --}}
    {{-- ===================== --}}
    <h2 class="text-xl font-bold mt-10 mb-4">🧍 En tant que passager</h2>

    @forelse($passengerReservations as $res)
        <div class="card mb-3 p-4 shadow-sm">
            <p>
                <strong>
                    {{ $res->trip->departure }} → {{ $res->trip->arrival }}
                </strong>
            </p>
            <p>{{ $res->trip->date }}</p>

            <form method="POST" action="{{ route('reservation.cancel', $res->id) }}">
                @csrf
                <button class="btn btn-warning mt-2">
                    Annuler ma participation
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500">Aucune réservation.</p>
    @endforelse

</div>

@endsection
