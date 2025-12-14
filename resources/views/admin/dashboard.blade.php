@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Tableau de bord Administrateur</h1>

    <div class="alert alert-info">
        Vous êtes connecté en tant qu'administrateur.
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Gestion des utilisateurs</h5>
                <p>Créer, modifier ou supprimer des utilisateurs.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Suivi des covoiturages</h5>
                <p>Voir la liste des trajets, conducteurs et passagers.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Paramètres</h5>
                <p>Configurer les options globales de l'application.</p>
            </div>
        </div>
    </div>
</div>
@endsection
