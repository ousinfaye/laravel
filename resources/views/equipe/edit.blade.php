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

        table {
            margin-left: 100px;
            width: 500px;
            background-color: #FFFFFF;
            border: 2px solid #FF5733; /* Bordure noire autour du tableau */
            border-collapse: collapse; /* Fusionne les bordures adjacentes */
        }

        table th,
        table td {
            border: 2px solid #FF5733; /* Bordure noire autour des cellules */
            padding: 10px; /* Espacement interne pour les cellules */
            text-align: center;
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

        input {
            background-color: #eee;
            border: none;
            padding: 20px 15px;
            margin: 8px 0;
            width: 100%;
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

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        .card-header{
            background-color: #066170;
            color: #FFFFFF;
        }

        .card-body{
            color: #FF5733;
            background-color: #066170;
        }

        #success-message{
            background-color: #066170;
            color: #FFFFFF;
            font-weight: bold;
            width: 500px;
            margin-left: 120px;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-header">Formulaire de Modification d'une equipe</div>
                    <div class="card-body">
                        <div class="form-container sign-up-container">
                            <form method="POST" action="{{ route('updateEquipe', ['id' => $equipe->id]) }}">
                                @csrf
                                <h1>Edit Equip</h1>
                                <label for="">Nom equipe</label>
                                <input type="text" class="form-control" name="name" value="{{$equipe->nom}}" required />
                                <span class="invalid-feedback" role="alert">
                </span>
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="3" required>{{$equipe->description}}</textarea><br>
                                <span class="invalid-feedback" role="alert">
                </span>
                                <div class="form-group mt-2">
                                    <label class="control-label">Administrateur</label>
                                    <select class="form-control" id="chef_id" name="chef_id">
                                        <option value="{{$equipe->chef_id}}">{{$equipe->chef->name}}</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                <table id="myTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($equipeUsers as $user)

                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <button id="supp" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                                        <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8z"/>
                                                    </svg>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $user->id }}">Supprimer {{$user->name}} de l'équipe</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Voulez-vous vraiment supprimer l'utilisateur de cette equipe.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                                <a href="{{route('deleteUserEquip', ['id' => $user->id])}}">
                                                                    <button type="button" class="btn btn-danger">Supprimer</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                <br><button type="submit">Envoyer</button>
                                <button type="button" onclick="history.back()">Retour</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });

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
