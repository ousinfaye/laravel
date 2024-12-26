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

        .card-header, .card-body{
            background-color: #066170;
            color: #FFFFFF;
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulaire d'ajout d'un utilisateur</div>
                    <div class="card-body">
                        @if(isset($confirmation))
                            @if($confirmation)
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Utilisateur ajouté avec succès
                                </div>
                            @else
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
                                    Erreur lors de l'ajout de l'utilisateur, l'email existe déjà.
                                </div>
                            @endif
                        @endif

                        <div class="form-container sign-up-container">
                            <form method="POST" action="{{ route('saveUser') }}" enctype="multipart/form-data">
                                @csrf
                                <h1>Create User</h1>
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" required />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" required autocomplete="off" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="off" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label>Avatar</label>
                                <input type="file" class="form-control" name="image" accept="image/*" />
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <button type="submit">Sign Up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const errorMessage = document.getElementById("error-message");
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.classList.remove("show");
                    setTimeout(() => {
                        errorMessage.style.display = "none";
                    }, 500); // Delay to allow fade-out effect
                }, 3000);
            }
        });
    </script>
@endsection
