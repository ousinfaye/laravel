@extends(' layouts.app')

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
                    <div id="titre" class="card-header">Formulaire d'ajout d'un projet</div>
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
                            <form method="POST" action="{{ route('saveProjet') }}" enctype="multipart/form-data">
                                @csrf
                                <h1>Create Project</h1>


                                <!-- Name Input -->
                                <label for="">Nom projet</label>
                                <input type="text" class="form-control" placeholder="Name" name="name"  required />
                </span>
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="3" required></textarea>
                </span>
                                <label for="">Date de démarrage du projet</label>
                                <input type="date" class="form-control" placeholder="Date de début" name="date_debut" required />
                                <label for="">Date limite</label>
                                <input type="date" class="form-control" placeholder="Date de début" name="date_fin" required />
                                <label for="">Fichier</label>
                                <input class="form-control" type="file" name="pdf_file" id="pdf_file" accept=".pdf">
                                <div class="form-group mt-2">
                                    <label class="control-label">Equipes</label>
                                    <select class="form-control" id="equipe_id" name="equipe_id">
                                        <option value="0">Faites un choix</option>
                                        @foreach($equipes as $equipe)
                                            <option name="equipe_id" value="{{$equipe->id}}" >{{$equipe->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                </span>
                                <br><button type="submit">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
