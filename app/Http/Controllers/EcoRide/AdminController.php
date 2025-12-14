<?php

namespace App\Http\Controllers\EcoRide;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Trip;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Dashboard administrateur (US13)
     */
    public function index()
    {
        // Sécurité supplémentaire (défense en profondeur)
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        // Graphique 1 : nombre de covoiturages par jour
        $tripsByDay = Trip::select(
                DB::raw('date as day'),
                DB::raw('count(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Graphique 2 : crédits gagnés par jour
        // 1 réservation = 1 crédit plateforme
        $creditsByDay = Reservation::select(
                DB::raw('date(created_at) as day'),
                DB::raw('count(*) as credits')
            )
            ->groupBy(DB::raw('date(created_at)'))
            ->orderBy('day')
            ->get();

        // Total crédits plateforme
        $totalCredits = Reservation::count();

        // Comptes gérables (users + employees)
        $users = User::whereIn('role', ['user', 'employee'])->get();

        return view('admin.dashboard', compact(
            'tripsByDay',
            'creditsByDay',
            'totalCredits',
            'users'
        ));
    }

    /**
     * Création d’un compte employé
     */
    public function createEmployee(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'employee',
            'credits'  => 0,
        ]);

        return back()->with('success', 'Compte employé créé avec succès.');
    }

    /**
     * Suspension d’un compte utilisateur ou employé
     */
    public function suspend($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'suspended_at' => now(),
        ]);

        return back()->with('success', 'Compte suspendu.');
    }
}
