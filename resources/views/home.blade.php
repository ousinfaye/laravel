@extends('layouts.app')

@section('content')
    <style>
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

        .col-md-3{
            margin-top: 80px;
            margin-left: 72px;
            align-content: center;
        }

        .card {
            margin-top: 50px;
            background-color: #066170;
            font-weight: bold;
            color: #FFFFFF;
            height: 103px;
        }

        .card-text-statut{
            margin-top: -2px;
            text-align: right;
        }

        img {
            height: 100px;
        }

        .alert-info1, .alert-success1, .alert-warning1{
            background-color: #1a1d20;
        }

        #windev{
            height: 100px;
        }

        .progress-bar {
            width: 5%;
            background-color: #FFFFFF;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 5px;
            margin-left: 322px;
            margin-top: -10px;
        }

        .progress-bar .progress-fixed {
            background-color: white;
            width: 0;
            height: 100%;
            position: absolute;
            animation: progress-animation 2s linear infinite;
        }

        .progress-bar .progress {
            background-color: #FF5733;
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


    </style>

    <div class="container">
        <!-- Indicateurs Clés -->
        <div class="row">
            <div class="col-md-3">
                <div class="alert alert-info kpi-box">
                    <h4>Total Projets</h4>
                    <p>{{$nbprojects}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-success kpi-box">
                    <h4>Total Tâches</h4>
                    <p>{{$nbtasks}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning kpi-box">
                    <h4>Total Équipes</h4>
                    <p>{{$nbequip}}</p>
                </div>
            </div>
        </div>

        <!-- Cartes pour les Projets à gauche et graphique à droite -->
        <div class="row-container">
            <!-- Colonne gauche - Cards des projets -->
            <div class="cards-column">
                <div class="project-card">
                    @foreach($projectTAsk as $projet)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$projet->nom}}</h5>
                                <p class="card-text">Tâches : {{$projet->taches_count}} </p>
                                @if($projet->statute == "En_cours")
                                    <div class="progress-bar">
                                        <div class="progress"></div>
                                    </div>
                                @elseif($projet->statute == "Pas commencé")
                                    <div class="progress-bar">
                                        <div class="progress-fixed"></div>
                                    </div>
                                @endif
                                <p class="card-text-statut">Statut : {{$projet->statute}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Ajoute d'autres cartes si nécessaire -->
            </div>

            <!-- Colonne droite - Graphique -->
            <div class="chart-column">
                <canvas id="tasksChart" style="max-width: 500px;"></canvas>
            </div>
        </div>
    </div>


    <!-- Inclusion de Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('tasksChart').getContext('2d');
        var tasksChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pas commencé', 'En cours', 'Terminées'],
                datasets: [{
                    data: [{{$nbprojetPasCommence}}, {{$nbprojetencours}}, {{$nbprojetermine}}],
                    backgroundColor: ['rgb(163, 207, 186.6)', 'rgb(255, 242.6, 205.4)', 'rgb(158.2, 233.8, 249)'],
                }]
            }
        });
    </script>
@endsection
