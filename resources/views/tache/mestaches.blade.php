@extends('layouts.app')

@section('content')
    <style>

        #bouton{
            margin-top: -55px;
            margin-left: 270px;
        }

        #bouton1{
            margin-top: -55px;
        }

        #navbar{
            font-weight: bold;
            padding-top: 30px;
            background-color: #066170;
            margin-top: -7px;
            width: 1280px;
            height: 80px;
        }

        .navbar-brand{
            margin-top: 18px;
        }

        .nav-link, .lien-nav{
            margin-top: 5px;
            color: #FF5733;
            font-size: 15px;
            font-family: "Arial Black";
        }

        #navbarDropdown1 {
            margin-left: 50px;
            margin-right: -50px;
        }

        #navbarDropdown, #navbarDropdown1 {
            font-weight: bold;
        }

        /* Style pour les KPIs */
        .kpi-box {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .kpi-box h4 {
            font-size: 24px;
            font-weight: bold;
        }

        /* Cadres pour les projets */
        .project-card {
            margin-bottom: 20px;
        }

        /* Disposition des cards et du graphique */
        .cards-column {
            display: flex;
            flex-direction: column;
            width: 50%;
        }

        .chart-column {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .row-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .alert.alert-info{
            text-align: left;
            background-color: #066170;
            color: #FFFFFF;
            font-weight: bold;
            height: 180px;
        }

        .col-md-3{
            margin-top: 80px;
            margin-left: 50px;
            align-content: center;
            width: 500px;
        }

        .card {
            margin-top: 50px;
            background-color: #066170;
            font-weight: bold;
            color: #FFFFFF;
            height: 60px;
        }

        .card-text-statut{
            margin-top: -5px;
            text-align: right;
        }

        img {
            height: 100px;
        }

        #windev{
            height: 100px;
        }

        #titre{
            color: #FFFFFF;
            font-weight: bold;
        }
        .progress-bar {
            width: 5%;
            background-color: #ccc;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 5px;
            margin-left: 322px;
            margin-top: -10px;
        }

        h1{
            margin-top: 70px;
            text-align: center;
        }

        h4{
            text-align: center;
        }

        .progress-bar .progress {
            background-color: #FFFFFF;
            width: 0;
            height: 100%;
            position: absolute;
            animation: progress-animation 2s linear infinite;
        }

        @keyframes progress-animation {
            0% { left: -100%; width: 100%; }
            50% { left: 0; width: 100%; }
            100% { left: 100%; width: 0; }
        }

        .row{
            margin-top: -50px;
        }

        #success-message, #error-message{
            background-color: #066170;
            color: #FFFFFF;
            font-weight: bold;
            width: 500px;
            margin-left: 300px;
            text-align: center;
        }

        .modal {
            margin-left: 40px;
            align-items: center;
            justify-content: center;
            margin-top: 100px;
            color: black;
        }

        #inexist{
            font-weight: bold;
            text-align: center;
            margin-top: 300px;
            color: #066170;
            font-size: 40px;
        }

        .modal-header{
            height: 40px;
        }

        h2{
            margin-top: -2px;
            color: #FFFFFF;
        }

        .modal-header, .modal-footer {
            background-color: #066170;
        }
    </style>
    @if($tasks == null)
        <h2 id="inexist">Aucune tâche pour vous pour le moment </h2>
    @else
    <div class="container">
        <h1>Liste des Tâches</h1>
        <!-- Indicateurs Clés -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                {{ session('success') }}
            </div>
        @endif
        @if(session('Error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="error-message">
                {{ session('Error') }}
            </div>
        @endif
        <div class="row">
            @foreach($tasks as $task)
                <div class="col-md-3">
                    <div class="alert alert-info kpi-box">
                        <h4 id="titre">Titre: {{$task->titre}}</h4>
                        <p>Description: {{$task->description}}</p>
                        @foreach($projects as $project)
                            @if($project->id == $task->project_id)
                                <h5>Projet: {{$project->nom}}</h5>
                            @endif
                        @endforeach
                        <h5>User: {{Auth::user()->name}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
