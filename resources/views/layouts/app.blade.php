<style>
    #navbar {
        font-weight: bold;
        padding-top: 30px;
        background-color: #066170;
        width: 1280px;
        height: 80px;
        padding-bottom: 30px;
        position: fixed;
        top: 0;
        z-index: 999;
    }

    .card{
        margin-top: 30px;
    }

    /* Styles généraux pour les liens */
    .nav-link, .lien-nav {
        color: #FF5733;
        text-decoration: none;
        font-weight: bold;
    }


    .navbar-brand, .nav-link {
        color: #FF5733;
        font-weight: bold;
    }

    #navbarDropdown1 {
        margin-left: 50px;
        margin-right: -50px;
    }
    .lien-nav{
        color: #FF5733;
        text-decoration: none;
        font-weight: bold;
    }

    .nav-item:active, .nav-item:focus{
        color: #FFFFFF;
    }

    #navbarDropdown, #navbarDropdown1 {
        color: #FF5733;
    }

    #navbarDropdown:focus, #navbarDropdown:active, #navbarDropdown.active, #navbarDropdown:hover,
    #navbarDropdown:focus, #navbarDropdown:active, #navbarDropdown.active, #navbarDropdown1:hover{
        color: #FFFFFF;
    }
    /* Style pour les KPIs */
    .kpi-box {
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }

    .kpi-box h4 {
        font-size: 24px;
        font-weight: bold;
    }

    /* Cadres pour les projets */
    .project-card {
        margin-bottom: 20px;
    }

    /* Disposition des cards et du graphique */
    .cards-column {
        display: flex;
        flex-direction: column;
        width: 50%;
    }

    .chart-column {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .row-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .col-md-3{
        margin-top: 50px;
        margin-left: 72px;
        align-content: center;
    }

    #navbarDropdown2 {
        color: #FF5733;
    }

    #navbarDropdown2.active {
        color: white;
    }

    .card {
        margin-top: 80px;
        background-color: #FF5733;
        font-weight: bold;
        color: #FFFFFF;
        height: 100px;
    }

    .card-text-statut{
        margin-top: -5px;
        text-align: right;
    }

    img {
        height: 100px;
    }

    .alert-info1, .alert-success1, .alert-warning1{
        background-color: #1a1d20;
    }

    #windev{
        height: 100px;
    }

    .progress-bar {
        width: 5%;
        background-color: #ccc;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        height: 5px;
        margin-left: 322px;
        margin-top: -10px;
    }

    img{
        width: 200px;
    }

    .progress-bar .progress {
        background-color: #FFFFFF;
        width: 0;
        height: 100%;
        position: absolute;
        animation: progress-animation 2s linear infinite;
    }

    @keyframes progress-animation {
        0% { left: -100%; width: 100%; }
        50% { left: 0; width: 100%; }
        100% { left: 100%; width: 0; }
    }


</style>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TO-DO APP') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav id="navbar" class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/logo_app.png') }}" style="height: 200px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                    @auth
                                        <a href="{{ url('/home') }}" class="lien-nav">Home</a>
                                    @else
                                        <a href="{{ route('login') }}" class="lien-nav">Connexion</a>
                                    @endauth
                                </div>
                            @endif
                        @else
                            @if(Auth::user()->role == "admin")
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Projets
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('createProjet')}}">
                                        {{ __('Ajouter Projet') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('listerProjet')}}">
                                        {{ __('Lister Projets') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('listArchivedProject')}}">
                                        {{ __('Archives') }}
                                    </a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Tâches
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('createTask')}}">
                                        {{ __('Ajouter Tâche') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('listerTask') }}">
                                        {{ __('Lister Tâches') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('listArchivedTask')}}">
                                        {{ __('Archives') }}
                                    </a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Equipes
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('createEquipe')}}">
                                        {{ __('Ajouter Equipes') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('listerEquipe')}}">
                                        {{ __('Lister Equipes') }}
                                    </a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Notifications
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('createNotification')}}">
                                        {{ __('Ajouter Notification') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('listNotification')}}">
                                        {{ __('Lister Notifications') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Administrateur
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('createUser')}}">
                                        {{ __('Ajouter Utilisateur') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('listerUser')}}">
                                        {{ __('Lister Utilisateurs') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('listArchivedUser')}}">
                                        {{ __('Archives') }}
                                    </a>

                                </div>
                            </li>
                            @else
                                <li class="nav-item">
                                    <a id="navbarDropdown2" class="nav-link" href="{{route('listerMesprojets')}}" onclick="setActive(this)"  >
                                        Mes Projets
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="navbarDropdown" class="nav-link " href="{{route('listMyTask')}}" role="button">
                                        Tâches
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="navbarDropdown" class="nav-link " href="{{route('myEquip')}}" role="button">
                                        Equipes
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="navbarDropdown" class="nav-link" href="{{route('listMyNotification')}}" role="button">
                                        Notifications
                                    </a>
                                </li>

                            @endif
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown1" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
</body>
<script>
    // Sélectionner tous les éléments dropdown
    const dropdowns = document.querySelectorAll('.nav-item.dropdown');

    dropdowns.forEach(dropdown => {
        const link = dropdown.querySelector('.nav-link');

        // Écouter l'événement 'show.bs.dropdown' pour modifier la couleur quand le menu s'ouvre
        dropdown.addEventListener('show.bs.dropdown', () => {
            link.style.color = '#FFFFFF'; // Texte en blanc quand le menu est ouvert
        });

        // Écouter l'événement 'hide.bs.dropdown' pour réinitialiser la couleur quand le menu se ferme
        dropdown.addEventListener('hide.bs.dropdown', () => {
            link.style.color = '#FF5733'; // Couleur originale après fermeture
        });

    });

    function setActive(element) {
        element.classList.add('active');
    }
</script>

</html>
