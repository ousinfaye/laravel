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

        .user-images {
            display: flex;
            gap: 10px; /* Espace entre les images */
            flex-wrap: wrap; /* Pour qu’elles passent à la ligne si l'espace est insuffisant */
            margin-top: 10px;
        }

        .user-images img {
            width: 50px; /* Réduction de la taille de l'image */
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        button {
            border-radius: 20px;
            border: 1px solid #066170;
            background-color: #FF5733;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        h1 {
            color: #FFFFFF;
            font-weight: bold;
        }

        .modal {
            margin-left: 40px;
            align-items: center;
            justify-content: center;
            margin-top: 100px;
            color: black;
        }

        .modal-header, .modal-footer {
            background-color: #066170;
        }

        .btn {
            background-color: #FF5733;
            color: #FFFFFF;
            font-weight: bold;
            margin-top: 10px;

        }

        .btn:hover {
            color: #066170;
            background-color: #FFFFFF;
            border-color: #FFFFFF;
        }

        #voirplus {
            background-color: #FF5733;
        }

        #voirplus:hover{
            background-color: #FFFFFF;
        }

        .card {
            display: flex;
            flex-direction: row;
            background-color: #066170;
            color: #FFFFFF;
            font-weight: bold;
            height: 200px;
            width: 500px;
            margin-top: 20px;
            padding: 20px;
            align-items: center;
        }

        #titre{
            margin-top: 70px;
            text-align: center;
        }

        .card-content {
            flex: 1;
            padding-right: 20px;
        }

        .card-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .card-text {
            margin-top: 10px;
            text-align: justify;
        }

        .card-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-image img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
        }

        .see-more {
            display: inline-flex;
            align-items: center;
            color: #FFFFFF;
            font-weight: bold;
            text-decoration: none;
            margin-top: 15px;
        }

        .see-more .arrow {
            margin-left: 5px;
            font-size: 1.2em;
            transition: transform 0.2s ease-in-out;
        }

        .see-more:hover .arrow {
            transform: translateX(5px);
        }

        #success-message{
            background-color: #066170;
            color: #FFFFFF;
            width: 300px;
            margin-left: 400px;
            text-align: center;
        }
    </style>

    <div class="container">
        <h2 id="titre">Liste des équipes</h2>
        @if(session('confirmation'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                {{ ('Equipe creer avec succés') }}
            </div>
        @endif
        <div class="row">
            @foreach($equipes as $index => $equip)
                @if ($index % 2 === 0 && $index != 0)
        </div><div class="row">
            @endif

            <div class="col-md-6 mb-4">
                <div class="card">
                    <!-- Contenu de l'équipe -->
                    <div class="card-content">
                        <h5 class="card-title">Nom équipe : {{ $equip->nom }}</h5>

                        <!-- Images et noms des utilisateurs sur une ligne -->
                        <div class="user-images">
                            @foreach($equip->user as $user)
                                <div class="text-center">
                                    <img src="{{ asset($user->image) }}" alt="Image utilisateur">
                                    <div>{{ $user->name }}</div>
                                </div>
                            @endforeach
                        </div>

                        <button id="voirplus" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $equip->id }}">
                            Voir plus →
                        </button>

                        <!-- Modal Voir plus -->
                        <div class="modal fade" id="exampleModal{{ $equip->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $equip->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel{{ $equip->id }}">Informations complètes de l'équipe</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $equip->description }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('editEquipe', ['id' => $equip->id])}}">
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $equip->id }}">Editer</button>
                                        </a>
                                        <button type="button" class="btn" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addUserModal{{ $equip->id }}">
                            Add User
                        </button>
                        <div class="modal fade" id="addUserModal{{ $equip->id }}" tabindex="-1" aria-labelledby="addUserModalLabel{{ $equip->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addUserModalLabel{{ $equip->id }}">Ajouter un utilisateur dans l'équipe</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('addUserToEquipe', ['equipeId' => $equip->id]) }}">
                                            @csrf
                                            <div class="form-group mt-2">
                                                <label class="control-label">Utilisateur</label>
                                                <select class="form-control" id="user_id" name="user_id">
                                                    <option value="0">Faites un choix</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}" >{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br><button class="form-control" type="submit">Envoyer</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image et nom du chef à droite -->
                    <div class="card-image">
                        @foreach($users as $user)
                            @if($user->id == $equip->chef_id)
                                <img src="{{ asset($user->image) }}" alt="Image du capitaine">
                                <span>{{ $user->name }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messageElement = document.getElementById("success-message");
            if (messageElement) {
                setTimeout(() => {
                    messageElement.style.display = "none";
                }, 3000); // 3000 ms = 3 secondes
            }
        });
    </script>
@endsection
