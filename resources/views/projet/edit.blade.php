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
        button, .btn-danger {
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

        .card-header{
            background-color: #066170;
            color: #FFFFFF;
        }

        .card-body{
            background-color: #066170;
        }

        label{
            color: #FFFFFF;
        }

        h1{
            color: #FF5733;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulaire de modification d'un projet</div>
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
                            <form method="POST" action="{{ route('updateProjet', ['id' => $project->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <h1>Update Project</h1>


                                <!-- Name Input -->
                                <label for="">Nom projet</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{$project->nom}}"  required />
                                </span>
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="3" required>{{$project->description}}</textarea>
                                </span>
                                <label for="">Date de démarrage du projet</label>
                                <input type="date" class="form-control"  name="date_debut" value="{{$project->date_debut}}" required />
                                <label for="">Date limite</label>
                                <input type="date" class="form-control" value="{{$project->date_fin}}" name="date_fin" required />
                                <div class="form-group mt-2">
                                    <label class="control-label">Statute</label>
                                    <select class="form-control" id="statute" name="statute">
                                        @foreach($statute as $statutes)
                                            <option name="statute" value="{{$statutes}}" >{{ucfirst($statutes)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="control-label">Equipes</label>
                                    <select class="form-control" id="equipe_id" name="equipe_id">
                                        <option value="{{$project->equip_id}}">{{$project->equipes->nom}}</option>
                                        @foreach($equipes as $equipe)
                                            <option name="equipe_id" value="{{$equipe->id}}" >{{$equipe->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </span>
                                <br><button type="submit">Envoyer</button>
                                <button type="button" class="btn btn-danger" name="annuler" id="annuler" onclick="window.history.back();">Annuler</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
