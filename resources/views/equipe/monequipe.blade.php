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
            color: #066170;
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

        .cardC{
            margin-left: 300px;
        }

        .card, .cardC {
            display: flex;
            flex-direction: row;
            background-color: #066170;
            color: #FFFFFF;
            font-weight: bold;
            height: 150px;
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

        #inexist{
            font-weight: bold;
            text-align: center;
            margin-top: 300px;
            color: #066170;
            font-size: 40px;
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
    @if($users == null)
        <h2 id="inexist">Vous n'êtes pas encore intégré dans une equipe </h2>
    @else
    <div class="container">
        <h2 id="titre">EQUIPE: {{$equipe->nom}}</h2>
        <div class="cardC">
            <div class="card-content">
                <h5 class="card-title">Chef de l'équipe : {{ $chef->name }}</h5>
                <h5 class="card-title">Role : {{ $chef->role }}</h5>
                <h5 class="card-title">Contact : {{ $chef->email }}</h5>
            </div>
            <!-- Image et nom du chef à droite -->
            <div class="card-image">
                <img src="{{ asset($chef->image) }}" alt="">
            </div>
        </div>
        <div class="row">
            @foreach($users as $index => $user)
                @if ($index % 2 === 0 && $index != 0)
        </div><div class="row">
            @endif
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Nom User : {{ $user->name }}</h5>
                        <h5 class="card-title">Role : {{ $user->role }}</h5>
                        <h5 class="card-title">Contact : {{ $user->email }}</h5>
                    </div>
                    <!-- Image et nom du chef à droite -->
                    <div class="card-image">
                                <img src="{{ asset($user->image) }}" alt="">
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
    @endif

@endsection
