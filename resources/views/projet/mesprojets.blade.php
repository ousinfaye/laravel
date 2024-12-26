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

        #navbarDropdown2{
            color: #FF5733;
        }

        #navbarDropdown2:hover{
            color: #FFFFFF;
        }

        #navbarDropdown{
            color: #FF5733;
        }

        #navbarDropdown:active, #navbarDropdown:focus, #navbarDropdown:after{
            color: #FFFFFF;
        }

        .navbar-brand{
            margin-top: 18px;
        }

        .nav-link{
            margin-top: 5px;
            color: #FF5733;
            font-size: 15px;
            font-family: "Arial Black";
        }

        p {
            color: #FFFFFF;
            font-weight: bold;
        }

        .project-card {
            background-color: #066170;
            font-weight: bold;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .project-header {
            font-size: 1.25rem;
            font-weight: bold;
            color: #FF5733; /* Changer la couleur ici */
            margin-bottom: 10px;
        }

        .project-details {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        #inexist{
            font-weight: bold;
            text-align: center;
            margin-top: 300px;
            color: #066170;
            font-size: 40px;
        }

        .project-actions {
            display: flex;
            gap: 10px; /* Espacement entre les boutons */
            margin-top: 10px;
        }

        .btn-view, .btn-edit, .btn-delete {
            font-weight: bold;
        }

        h2{
            margin-top: 70px;
        }

        #success-message{
            background-color: #066170;
            color: #FFFFFF;
            width: 300px;
            margin-left: 400px;
            text-align: center;
        }
    </style>

@if($projets == null)
    <h2 id="inexist">Aucun projet pour vous pour le moment </h2>
@else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Liste des Projets</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @foreach($projets as $projet)
                    <div class="project-card">
                        <div class="project-header">{{ $projet->nom }}</div>
                        <div class="project-details">
                            <p><strong>Description :</strong> {{ $projet->description }}</p>
                            <p><strong>Date de Début :</strong> {{ $projet->date_debut }}</p>
                            <p><strong>Date de Fin :</strong> {{ $projet->date_fin }}</p>
                            @foreach($equipes as $equip)
                                @if($equip->id == $projet->equip_id)
                                    <p><strong>Équipe :</strong> {{ $equip->nom }}</p>
                                @endif
                            @endforeach
                        </div>
                        <div class="project-actions">
                            <!-- Bouton pour ouvrir le modal -->
                            <button type="button" class="btn btn-info btn-view" data-bs-toggle="modal" data-bs-target="#pdfModal{{$projet->id}}">
                                Voir
                            </button>

                            <!-- Modal pour afficher le PDF -->
                            <div class="modal fade" id="pdfModal{{$projet->id}}" tabindex="-1" aria-labelledby="pdfModalLabel{{$projet->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pdfModalLabel{{$projet->id}}">Aperçu du PDF : {{ $projet->nom }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Affichage du PDF dans une iframe -->
                                            <iframe src="{{ asset($projet->pdf) }}" width="100%" height="500px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script >
        document.addEventListener("DOMContentLoaded", function() {
            const messageElement = document.getElementById("success-message");
            if (messageElement) {
                setTimeout(() => {
                    messageElement.style.display = "none";
                }, 3000); // 3000 ms = 3 secondes
            }
        });
    </script>
@endif
@endsection
