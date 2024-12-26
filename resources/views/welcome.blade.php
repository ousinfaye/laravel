@extends('layouts.app')

@section('content')
    <style>
        #navbar {
            font-weight: bold;
            padding-top: 15px;
            background-color: #066170;
            margin-top: 0px;
            width: 1280px;
            height: 75px;
            position: fixed;
            top: 0;
            z-index: 999;
        }

        .navbar-brand{
            margin-top: 25px;
        }

        .lien-nav{
            position: absolute;
            left: 80%;
            transform: translateX(-50%);
            transform: translateY(-15%);
            font-family: "Arial Black";
            color: #FF5733;
            font-size: 20px;
            font-weight: bold;
        }

        #navbarDropdown1 {
            margin-left: 50px;
            margin-right: -50px;
        }

        #navbarDropdown, #navbarDropdown1 {
            font-weight: bold;
            color: #FF5733;
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
            margin-top: 5px;
            background-color: #066170;
            font-weight: bold;
            color: #FFFFFF;
            height: 100px;
        }

        .card-text-statut{
            margin-top: -5px;
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
            background-color: #ccc;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 5px;
            margin-left: 322px;
            margin-top: -10px;
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


    </style>

    <div class="container">
        <!-- Indicateurs Clés -->
        <div class="row">
            <div class="col-md-3">
                <div class="alert alert-info kpi-box">
                    <h4>Total Projets</h4>
                    <p>12</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-success kpi-box">
                    <h4>Total Tâches</h4>
                    <p>43</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning kpi-box">
                    <h4>Total Équipes</h4>
                    <p>8</p>
                </div>
            </div>
        </div>

        <!-- Cartes pour les Projets à gauche et graphique à droite -->
        <div class="row-container">
            <!-- Colonne gauche - Cards des projets -->
            <div class="cards-column">
                <div class="project-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projet A</h5>
                            <p class="card-text">Tâches : 5</p>
                            <div class="progress-bar">
                                <div class="progress"></div>
                            </div>
                            <p class="card-text-statut">Statut : En cours</p>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projet B</h5>
                            <p class="card-text">Tâches : 8</p>
                            <p class="card-text-statut">Statut : En attente</p>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projet C</h5>
                            <p class="card-text">Tâches : 2</p>
                            <p class="card-text-statut">Statut : En cours</p>
                        </div>
                    </div>
                </div>

                <div class="project-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projet D</h5>
                            <p class="card-text">Tâches : 5</p>
                            <p class="card-text-statut">Statut : En cours</p>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projet E</h5>
                            <p class="card-text">Tâches : 9</p>
                            <p class="card-text-statut">Statut : En attente</p>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Projet F</h5>
                            <p class="card-text">Tâches : 11</p>
                            <p class="card-text-statut">Statut : Terminée</p>
                        </div>
                    </div>
                </div>
                <!-- Ajoute d'autres cartes si nécessaire -->
            </div>

            <!-- Colonne droite - Graphique -->
            <div class="chart-column">
                <canvas id="tasksChart" style="max-width: 500px;"></canvas>
            </div>
        </div>
        <div id="logo-app" class="row">
            <div class="col-md-3">
                <div class="alert alert-info1 kpi-box">
                    <img src="{{asset('images/laravel-logo.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-success1 kpi-box">
                    <img src="{{asset('images/php-logo.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning1 kpi-box">
                    <img src="{{asset('images/java-logo.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning1 kpi-box">
                    <img id="windev" src="{{asset('images/windev-logo.webp')}}" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning1 kpi-box">
                    <img id="windev" src="{{asset('images/WordPress-logo.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-warning1 kpi-box">
                    <img id="windev" src="{{asset('images/canva-logo.png')}}" alt="">
                </div>
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
                labels: ['En attente', 'En cours', 'Terminées'],
                datasets: [{
                    data: [12, 19, 7], // Exemples de données
                    backgroundColor: ['rgb(163, 207, 186.6)', 'rgb(255, 242.6, 205.4)', 'rgb(158.2, 233.8, 249)'],
                }]
            }
        });
    </script>
@endsection
