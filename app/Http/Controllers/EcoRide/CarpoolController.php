<?php

namespace App\Http\Controllers\EcoRide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Reservation;

class CarpoolController extends Controller
{
    /**
     * Recherche les trajets (US3 + filtres US4)
     */
    public function search(Request $request)
    {
        $request->validate([
            'departure' => 'required|string',
            'arrival'   => 'required|string',
            'date'      => 'required|date',
        ]);

        $query = Trip::where('departure', 'LIKE', '%' . $request->departure . '%')
            ->where('arrival', 'LIKE', '%' . $request->arrival . '%')
            ->whereDate('date', $request->date);

        // --- Filtres US4 ---
        if ($request->filled('electric')) {
            $query->where('vehicle_type', 'electrique');
        }

        if ($request->filled('price_lowest')) {
            $query->orderBy('price', 'asc');
        }

        if ($request->filled('early') && Trip::whereNotNull('time')->exists()) {
            $query->orderBy('time', 'asc');
        }

        $trips = $query->get();

        return view('ecoride.carpools.index', compact('trips'));
    }

    /**
     * Détails d’un trajet (US5)
     */
    public function show($id)
    {
        $trip = Trip::findOrFail($id);

        return view('ecoride.carpools.show', compact('trip'));
    }


    /**
     * Réserver un trajet (US6)
     */
    public function reserve($id)
    {
        $trip = Trip::findOrFail($id);

        if ($trip->seats <= 0) {
            return back()->with('error', 'Ce trajet est complet.');
        }

        // Vérifier double réservation
        $exists = Reservation::where('trip_id', $trip->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'Vous avez déjà réservé ce trajet.');
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'trip_id' => $trip->id,
        ]);

        // Réduire le nombre de places
        $trip->decrement('seats');

        return back()->with('success', 'Votre réservation a été enregistrée !');
    }
}
