@extends('layouts.app')
@section('content')
<style>
    #envoyer {
        background-color: #FFFFFF;
        color: #FF5733;
    }

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

    .card-body, .card-header{
        background-color: #066170;
        color: #FF5733;
    }

    #titre{
        color: #FFFFFF;
        font-weight: bold;
    }

    img {
        border-radius: 50px;
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div id="titre" class="card-header">Formulaire de modification d'un Utilisateur</div>
                    <div class="card-body">
                        @if(isset($confirmation))
                            @if($confirmation)
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Utilisateur modifié avec succès
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @else
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Erreur lors de la modification du user.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        @endif
                        <form method="POST" action="{{ route('updateUser', ['id' => $user->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label">ID User</label>
                                <input type="text" class="form-control" id="id" name="id"  value="{{ $user->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name"  value="{{ $user->name }}">
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"  value="{{ $user->email }}">
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label">Role</label>
                                <input type="text" class="form-control" id="role" name="role"  value="{{ $user->role }}">
                            </div>
                            <div class="form-group mt-2">
                                <label class="control-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                @if ($user->image)
                                    <p>Image actuelle :</p>
                                    <img src="{{ asset($user->image)}}" style="width: 100px; height: auto;">
                                @endif
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-success" name="envoyer" id="envoyer">Envoyer</button>
                                <button type="button" class="btn btn-danger" name="annuler" id="annuler" onclick="window.history.back();">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
