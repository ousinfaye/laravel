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

        .card{
            margin-top: 80px;
        }

        #titre{
            color: white;
            font-weight: bold;
        }

        .card-header, .card-body{
            background-color: #066170;
            color: #FFFFFF;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div id="titre" class="card-header">Formulaire de création de taches</div>
                    <div class="card-body">
                        @if(isset($confirmation))
                            @if($confirmation)
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Utilisateur ajouté avec succes
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @else
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Erreur lors de l'ajout de l'utilisateur, l'email existe déjà.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        @endif
                        <div class="form-container sign-up-container">
                            <form method="POST" action="{{ route('updateTask', ['id' => $task->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <h1>Update Task</h1>


                                <!-- Name Input -->
                                <label for="">Titre</label>
                                <input type="text" class="form-control" value="{{$task->titre}}" name="titre"  required />
                                </span>
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="3" required>{{$task->description}}</textarea>
                                </span>
                                <label for="">Date de démarrage du tache</label>
                                <input type="date" class="form-control" value="{{$task->date_debut}}" name="date_debut" required />
                                <label for="">Date limite</label>
                                <input type="date" class="form-control" value="{{$task->date_fin}}" name="date_fin" required />
                                <div class="form-group mt-2">
                                    <label class="control-label">Statute</label>
                                    <select class="form-control" id="statute" name="statute">
                                        @foreach($statute as $statutes)
                                            <option name="statute" value="{{$statutes}}" >{{ucfirst($statutes)}}</option>
                                        @endforeach
                                    </select>
                                    <label class="control-label">User</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value="{{$task->user_id}}">{{$task->user->name}}</option>
                                        @foreach($users as $user)
                                            <option name="user_id" value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    <label class="control-label">Projet</label>
                                    <select class="form-control" id="projet_id" name="projet_id">
                                        <option value="{{$task->project_id}}">{{$task->project->nom}}</option>
                                        @foreach($projects as $project)
                                            <option name="projet_id" value="{{$project->id}}" >{{$project->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </span>
                                <br><button type="submit">Envoyer</button>
                                <button type="button" name="annuler" id="annuler" onclick="window.history.back();">Annuler</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
