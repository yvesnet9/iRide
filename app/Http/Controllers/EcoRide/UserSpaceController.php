<?php

namespace App\Http\Controllers\EcoRide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserSpaceController extends Controller
{
    /**
     * Page "Mon espace"
     */
    public function index()
    {
        $user = auth()->user();
        $vehicles = $user->vehicles ?? collect();

        return view('ecoride.user.espace', compact('user', 'vehicles'));
    }


    /**
     * Mise à jour du statut chauffeur / passager / les deux (US8)
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'driver_status' => 'required|in:driver,passenger,both',
        ]);

        $user = auth()->user();
        $user->driver_status = $request->driver_status;
        $user->save();

        return back()->with('success', 'Votre statut a bien été mis à jour.');
    }
}
