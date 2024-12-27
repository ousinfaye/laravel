@extends('layouts.app')

@section('content')
    <style>
        #navbar {
            font-weight: bold;
            padding-top: 30px;
            background-color: #066170;
            margin-top: -7px;
            width: 100%;
            height: 80px;
        }

        .navbar-brand {
            margin-top: 18px;
        }

        .nav-link, .lien-nav {
            margin-top: 5px;
            color: #FF5733;
            font-size: 15px;
            font-family: "Arial Black";
        }

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

        .project-card {
            margin-bottom: 20px;
        }

        .cards-column {
            display: flex;
            flex-direction: column;
            width: 50%;
        }

        .chart-column {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
        }

        .row-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .card {
            margin-top: 20px;
            background-color: #066170;
            font-weight: bold;
            color: #FFFFFF;
        }

        .card-text-statut {
            margin-top: -2px;
            text-align: right;
        }

        .progress-bar {
            width: 100%;
            background-color: #FFFFFF;
            border-radius: 10px;
            overflow: hidden;
            height: 5px;
        }

        .progress {
            background-color: #FF5733;
            height: 100%;
        }

        .filter-form {
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
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

        <!-- Formulaire de Filtrage -->
        <form method="GET" action="{{ route('projects.index') }}" class="filter-form">
            <select name="statut" class="form-control">
                <option value="">-- Filtrer par Statut --</option>
                <option value="En_cours">En cours</option>
                <option value="Pas commencé">Pas commencé</option>
                <option value="Terminé">Terminé</option>
            </select>
            <select name="equipe" class="form-control">
                <option value="">-- Filtrer par Équipe --</option>
                @foreach($equipes as $equipe)
                    <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>

        <!-- Cartes pour les Projets -->
        <div class="row-container">
            <div class="cards-column">
                @foreach($projectTAsk as $projet)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $projet->nom }}</h5>
                            <p class="card-text">Tâches : {{ $projet->taches_count }}</p>
                            @if($projet->statute == "En_cours")
                                <div class="progress-bar">
                                    <div class="progress" style="width: 50%;"></div>
                                </div>
                            @elseif($projet->statute == "Pas commencé")
                                <div class="progress-bar">
                                    <div class="progress" style="width: 10%;"></div>
                                </div>
                            @endif
                            <p class="card-text-statut">Statut : {{ $projet->statute }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="pagination">
                    {{ $projectTAsk->links() }}
                </div>
            </div>

            <!-- Graphique -->
            <div class="chart-column">
                <canvas id="tasksChart" style="max-width: 500px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
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
