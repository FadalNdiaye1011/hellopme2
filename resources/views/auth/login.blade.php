@include('layouts.header')
<body class="hold-transition login-page">
<div class="sub-head">
    <div class="container">
        <div class="d-flex">
            <a href="" class="mb-0">Accueil / </a>
            <p class="mb-0"> Connexion</p>
        </div>
    </div>
</div>
<div class="login-box">
    {{--<div class="login-logo">
        <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
    </div>--}}

    <div class="card card-connection">
        <div class="card-body login-card-body">
            <p class="title-connexion">Connexion</p>

            <form method="post" action="{{ url('/login') }}">
                @csrf
                <div class="form-group">
                    <label for=""><b>Adresse Mail</b></label>
                    <input type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for=""><b>Mot de passe</b></label>
                    <input type="password"
                        name="password"
                        placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>
                <div class="d-flex justify-content-end text-forget">
                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="btn btn-se-connecter">Se connecter</button>
                <a href="/register" class="text-center text-no-compte">Je n'ai pas de compte</a>

                <div class="">
                    <p class="text-Se-connecter">Se connecter via</p>
                    <div class="group-btn d-flex justify-content-center">
                        <a href="" class="btn btn-sociaux">
                            <img src="{{asset('img/apple.svg')}}" alt="">
                        </a>
                        <a href="" class="btn btn-sociaux">
                            <img src="{{asset('img/facebook.svg')}}" alt="">
                        </a>
                        <a href="" class="btn btn-sociaux">
                            <img src="{{asset('img/google.svg')}}" alt="">
                        </a>
                    </div>
                </div>

            </form>

        </div>
        <!-- /.login-card-body -->
    </div>

</div>

@extends('layouts.footer')


</body>
</html>
