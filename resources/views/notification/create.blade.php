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

        .btn{
            margin-top: 10px;
            background-color: #FF5733;
            color: #FFFFFF;
            font-weight: bold;
        }

        .btn:hover{
            background-color: #FF5733;
        }

        .nav-link{
            margin-top: 5px;
            color: #FF5733;
            font-size: 15px;
            font-family: "Arial Black";
        }
        h1{
            margin-top: 80px;
        }

        .col-md-8{
            margin-left: 20%;
            margin-top: 8%;
        }

        .row{
            background-color: #066170;
            color: #FFFFFF;
            border: 3px solid;
            border-radius: 10px;
            border-color: #066170;
        }

        #error-message, #success-message{
            background-color: #066170;
            color: #FFFFFF;
            width: 500px;
            font-weight: bold;
            margin-left: 360px;
            text-align: center;
            margin-top: 8%;
        }
    </style>
    <div class="container">
        @if(session('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="error-message">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert" id="success-message">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-8">
            <div class="row">
        <h1>Envoyer une Notification</h1>

        <form action="{{ route('saveNotification') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Titre de la notification</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="equip_id">Sélectionner une équipe (optionnel)</label>
                <select id="equip_id" name="equip_id" class="form-control">
                    <option value="">-- Aucune --</option>
                    @foreach($equipes as $equipe)
                        <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">Sélectionner un utilisateur (optionnel)</label>
                <select id="user_id" name="user_id" class="form-control">
                    <option value="">-- Aucun --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn">Envoyer</button>
        </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messageElement = document.getElementById("error-message");
            if (messageElement) {
                setTimeout(() => {
                    messageElement.style.display = "none";
                }, 3000); // 3000 ms = 3 secondes
            }
        });
    </script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection
