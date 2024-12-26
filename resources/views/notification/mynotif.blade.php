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

        #bouton{
            background-color: #FF5733;
            font-weight: bold;
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
        .container h1 {
            margin-top: 90px;
            color: #066170;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #066170;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .view-button {
            color: #fff;
            background-color: #FF5733;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .view-button:hover {
            background-color: #FF4500;
        }

        .notification-table th, .notification-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .modal{
            margin-top: 8%;
        }

        .modal-header{
            background-color: #066170;
            color: #FFFFFF;
            font-weight: bold;
        }

        .modal-footer{
            background-color: #066170;
            color: #FFFFFF;
            font-weight: bold;
        }
    </style>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <div class="container">
        <h1>Notifications</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($notifs->isEmpty())
            <p>Aucune notification trouvée.</p>
        @else
            <table class="notification-table">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Envoyé Par</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notifs as $notification)
                    <tr>
                        <td>{{ $notification->title }}</td>
                        <td>
                            @foreach($users as $user)
                                @if($user->id == $notification->auteur_id)
                                    {{ $user->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <button class="view-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#notificationModal"
                                    onclick="viewNotification('{{ $notification->message }}')">
                                Voir
                            </button>
                            <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="notificationModalLabel">Détails de la Notification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Logo de l'application -->
                                            <div class="text-center mb-3">
                                                <img id="logoMessage" src="{{ asset('images/logo_app.png') }}" alt="Logo de l'application" style="width: 100px;">
                                            </div>
                                            <!-- Contenu de la notification -->
                                            <p id="notificationMessage"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="bouton" type="button" class="btn" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script>
        function viewNotification(message) {
            // Ajouter le message dans le paragraphe du modal
            document.getElementById('notificationMessage').innerText = message;
        }
    </script>
@endsection
