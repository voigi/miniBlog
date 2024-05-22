<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @layer demo {
            button{
                all:unset;
            }

        }
      .container
      {
        margin-left:62px;
      }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a @class(["nav-link", "active"=>request()->route()->getName()=== 'blog.index']) aria-current="page" href="{{route('blog.index')}}">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>

      </ul>
      <div class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth
         {{\Illuminate\Support\Facades\Auth::user()->name}}
         <form class="nav-item" action="{{route('auth.logout')}}" method="post">
         @method("delete")
         @csrf
         <button class="nav-link"> Se deconnecter</button>
        </form>
        @endauth
        @guest
        <div class="nav-item">
          <a class="nav-link" href="{{route('auth.login')}}">Se connecter</a>
        </div>
          
        @endguest
      </div>
    </div>
  </div>
</nav>
   <div class="container">
    @if(session('success'))
     <div class=" alert alert-success">
        {{session('success')}};
     </div>
    @endif
     @yield('content')
   </div>
</body>
</html>