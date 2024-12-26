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

        .card-header{
            background-color: #066170;
            color: #FFFFFF;
        }

        .card-body{
            color: #FFFFFF;
            background-color: #066170;
        }
        #success-message{
            background-color: #066170;
            color: #FFFFFF;
            width: 300px;
            margin-left: 220px;
            text-align: center;
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(session('error'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-header">Formulaire d'ajout d'équipe</div>
                    <div class="card-body">

                        <div class="form-container sign-up-container">
                            <form method="POST" action="{{ route('saveEquipe') }}">
                                @csrf
                                <h1>Create Equip</h1>

                                <label for="">Nom equipe</label>
                                <input type="text" class="form-control" placeholder="Name" name="name"  required />
                                <span class="invalid-feedback" role="alert">
                </span>
                                <label for="">Description</label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="3" required></textarea><br>
                                <span class="invalid-feedback" role="alert">
                </span>
                                <div class="form-group mt-2">
                                    <label class="control-label">Administrateur</label>
                                    <select class="form-control" id="chef_id" name="chef_id">
                                        <option value="0">Faites un choix</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <br><button type="submit">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
