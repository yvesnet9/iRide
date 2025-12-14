<?php

namespace App\Http\Controllers\EcoRide;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TripCancelledMail;

class HistoryController extends Controller
{
    /**
     * Historique des covoiturages (US10)
     */
    public function index()
    {
        $user = auth()->user();

        // Trajets en tant que chauffeur
        $driverTrips = Trip::where('driver_name', $user->pseudo)->get();

        // Réservations en tant que passager
        $passengerReservations = Reservation::where('user_id', $user->id)
            ->with('trip')
            ->get();

        return view('ecoride.history', compact(
            'driverTrips',
            'passengerReservations'
        ));
    }

    /**
     * Annulation par un passager
     */
    public function cancelReservation($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $trip = $reservation->trip;

        // Rendre la place
        $trip->increment('seats');

        // Rendre le crédit au passager
        auth()->user()->increment('credits', 1);

        $reservation->delete();

        return back()->with('success', 'Réservation annulée avec succès.');
    }

    /**
     * Annulation par le chauffeur
     */
    public function cancelTrip($id)
    {
        $trip = Trip::findOrFail($id);

        // Sécurité : seul le chauffeur peut annuler
        if ($trip->driver_name !== auth()->user()->pseudo) {
            abort(403);
        }

        $reservations = $trip->reservations;

        foreach ($reservations as $reservation) {
            // Rendre le crédit
            $reservation->user->increment('credits', 1);

            // Mail aux participants
            Mail::to($reservation->user->email)
                ->send(new TripCancelledMail($trip));
        }

        $trip->reservations()->delete();
        $trip->delete();

        return back()->with('success', 'Trajet annulé et participants notifiés.');
    }

    /**
     * 🚗 Démarrer un covoiturage (US11)
     */
    public function startTrip($id)
    {
        $trip = Trip::findOrFail($id);

        if ($trip->driver_name !== auth()->user()->pseudo) {
            abort(403);
        }

        if ($trip->status !== 'planned') {
            return back()->with('error', 'Le trajet ne peut pas être démarré.');
        }

        $trip->update(['status' => 'started']);

        return back()->with('success', 'Covoiturage démarré.');
    }

    /**
     * 🏁 Arrivée à destination (US11)
     */
    public function finishTrip($id)
    {
        $trip = Trip::findOrFail($id);

        if ($trip->driver_name !== auth()->user()->pseudo) {
            abort(403);
        }

        if ($trip->status !== 'started') {
            return back()->with('error', 'Le trajet ne peut pas être terminé.');
        }

        $trip->update(['status' => 'finished']);

        // Les participants recevront ensuite la demande de validation (US11 suite)
        return back()->with('success', 'Trajet terminé. En attente de validation des passagers.');
    }
}
