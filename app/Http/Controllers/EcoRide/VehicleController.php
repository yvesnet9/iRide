<?php

namespace App\Http\Controllers\EcoRide;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'plate'              => 'required|string|max:20',
            'first_registration' => 'required|date',
            'brand'              => 'required|string|max:50',
            'model'              => 'required|string|max:50',
            'color'              => 'required|string|max:30',
            'seats'              => 'required|integer|min:1|max:8',
        ]);

        Vehicle::create([
    'user_id'            => auth()->id(),
    'name'               => $request->brand . ' ' . $request->model,
    'type'               => 'car',
    'autonomy'           => 0, // 🔴 LIGNE CLÉ (legacy)
    'plate'              => $request->plate,
    'first_registration' => $request->first_registration,
    'brand'              => $request->brand,
    'model'              => $request->model,
    'color'              => $request->color,
    'seats'              => $request->seats,
    'smoker_allowed'     => $request->has('smoker_allowed'),
    'pets_allowed'       => $request->has('pets_allowed'),
        ]);

        return back()->with('success', 'Véhicule ajouté avec succès.');
    }
}
