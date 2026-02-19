<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title','URL Shortener')
    </title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet">

    <style>
        body {
            background:#f4f6f9;
        }

        .custom-container{
            margin-top:30px;
        }

        .footer{
            margin-top:40px;
            padding:15px;
            background:#eee;
            text-align:center;
        }

    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('dashboard') }}">
            URL Shortener
        </a>

        <div class="collapse navbar-collapse justify-content-end">

            @auth
                <ul class="navbar-nav mb-2 mb-lg-0">

                    <li class="nav-item">
                        <span class="nav-link text-white">
                            {{ Auth::user()->name }} ( {{ Auth::user()->role }} )
                        </span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    @if(Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('invitations.index') }}">
                                Invitations
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-danger ms-2" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            @endauth

        </div>
    </div>
</nav>

<div class="container custom-container">


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif



    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
