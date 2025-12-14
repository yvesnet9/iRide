<?php

namespace App\Http\Controllers\EcoRide;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Reservation;

class EmployeeController extends Controller
{
    /**
     * Dashboard employé (US12)
     */
    public function index()
    {
        // Sécurité : uniquement employé
        if (auth()->user()->role !== 'employee') {
            abort(403);
        }

        // Avis en attente de validation
        $pendingReviews = Review::with(['trip', 'user'])
            ->where('status', 'pending')
            ->get();

        // Trajets signalés comme problématiques
        $problemTrips = Reservation::with(['trip', 'user'])
            ->where('status', 'problem')
            ->get();

        return view('employee.dashboard', compact(
            'pendingReviews',
            'problemTrips'
        ));
    }

    /**
     * Valider un avis
     */
    public function approveReview($id)
    {
        if (auth()->user()->role !== 'employee') {
            abort(403);
        }

        $review = Review::findOrFail($id);
        $review->update(['status' => 'approved']);

        return back()->with('success', 'Avis validé.');
    }

    /**
     * Refuser un avis
     */
    public function rejectReview($id)
    {
        if (auth()->user()->role !== 'employee') {
            abort(403);
        }

        $review = Review::findOrFail($id);
        $review->update(['status' => 'rejected']);

        return back()->with('success', 'Avis refusé.');
    }
}
