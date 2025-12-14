@extends('layouts.ecoride')


@section('title', 'Espace Employé')

@section('content')
<div class="container">
    <h1 class="mb-4">Espace Employé</h1>

    <div class="alert alert-success">
        Bienvenue dans votre espace employé.
    </div>

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5>Mes trajets</h5>
                <p>Consulter vos trajets passés et futurs.</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5>Démarrer un trajet</h5>
                <p>Lancer ou arrêter un trajet de covoiturage.</p>
            </div>
        </div>

    </div>
</div>
@endsection
