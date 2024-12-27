@extends('layouts.app')

@section('content')
    <!-- En-tête avec Carrousel -->
    <header class="mb-4">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Carrousel 1">
                    <div class="carousel-caption">
                        <h5>Des Solutions Logicielles Sur Mesure</h5>
                        <p>Adaptées aux besoins de votre entreprise.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Carrousel 2">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </header>

    <!-- Contenu Principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Gauche -->
            <aside class="col-md-2 bg-light p-3">
                <h5>Liens Rapides</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
                <h6 class="mt-4">Actualités</h6>
                <p>Nouvelle version de notre logiciel ERP bientôt disponible !</p>
            </aside>

            <!-- Contenu Principal -->
            <main class="col-md-8">
                <!-- Section Présentation -->
                <section class="text-center mb-4">
                    <h2>Bienvenue chez SoftWeb Solution</h2>
                    <p>Votre partenaire idéal pour des logiciels innovants.</p>
                </section>

                <!-- Section Services -->
                <section class="services text-center mb-4">
                    <h3>Nos Services</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <i class="bi bi-laptop display-4"></i>
                                <h5>Développement Web</h5>
                                <p>Des sites performants et sur-mesure.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <i class="bi bi-phone display-4"></i>
                                <h5>Applications Mobiles</h5>
                                <p>Des solutions mobiles efficaces.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <i class="bi bi-pc-display display-4"></i>
                                <h5>Applications Desktop</h5>
                                <p>Des logiciels de bureau adaptés à vos besoins.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Témoignages -->
                <section class="testimonials text-center mb-4">
                    <h3>Témoignages Clients</h3>
                    <div id="testimonialCarousel" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <p>"Excellent service, très professionnel !"</p>
                                <h6>- Jean Dupont</h6>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <!-- Sidebar Droite -->
            <aside class="col-md-2 bg-light p-3">
                <h5>Contact Rapide</h5>
                <form>
                    <input type="text" class="form-control mb-2" placeholder="Nom">
                    <input type="email" class="form-control mb-2" placeholder="Email">
                    <textarea class="form-control mb-2" placeholder="Message"></textarea>
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </aside>
        </div>
    </div>
@endsection
