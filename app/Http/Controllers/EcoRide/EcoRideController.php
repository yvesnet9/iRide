<?php

namespace App\Http\Controllers\EcoRide;

use App\Http\Controllers\Controller;

class EcoRideController extends Controller
{
    /**
     * Page d'accueil EcoRide (US1)
     */
    public function index()
    {
        return view('ecoride.home');
    }
}
