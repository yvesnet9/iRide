<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MongoService;

class IncidentController extends Controller
{
    public function store(Request $request, MongoService $mongo)
    {
        $mongo->collection('incidents')->insertOne([
            'trip_id' => $request->trip_id,
            'passenger_id' => $request->user()->id,
            'driver_id' => $request->driver_id,
            'comment' => $request->comment,
            'created_at' => now(),
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Incident enregistré et transmis à un employé'
        ]);
    }

    public function index(MongoService $mongo)
    {
        return response()->json(
            $mongo->collection('incidents')->find()->toArray()
        );
    }
}
