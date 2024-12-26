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

        #success-message, #error-message{
            background-color: #066170;
            color: #FFFFFF;
            width: 300px;
            margin-left: 400px;
            text-align: center;
        }
    </style>


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
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
                        {{ session('error') }}
                    </div>
                @endif

                @foreach($liste_project as $projet)
                    <div class="project-card">
                        <div class="project-header">{{ $projet->nom }}</div>
                        <div class="project-details">
                            <p><strong>Description :</strong> {{ $projet->description }}</p>
                            <p><strong>Date de Début :</strong> {{ $projet->date_debut }}</p>
                            <p><strong>Date de Fin :</strong> {{ $projet->date_fin }}</p>
                            <p><strong>Équipe :</strong> {{ $projet->equipes->nom }}</p>
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
                                            <h5 class="modal-title" id="pdfModalLabel{{$projet->id}}">Aperçu du PDF : {{ $projet->name }}</h5>
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

                            <a href="{{route('editProjet', ['id' => $projet->id])}}" class="btn btn-primary btn-edit">Éditer</a>
                            <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $projet->id }}">
                                Supprimer
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $projet->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $projet->id }}">Supprimer Le projet</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous  supprimer ce projet.Le projet ne sera pas supprimer définitivement.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('deleteProjet', ['id' => $projet->id])}}">
                                                <button type="button" class="btn btn-danger">Supprimer</button>
                                            </a>
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

        document.addEventListener("DOMContentLoaded", function() {
            const messageElement = document.getElementById("error-message");
            if (messageElement) {
                setTimeout(() => {
                    messageElement.style.display = "none";
                }, 3000); // 3000 ms = 3 secondes
            }
        });
    </script>
@endsection
