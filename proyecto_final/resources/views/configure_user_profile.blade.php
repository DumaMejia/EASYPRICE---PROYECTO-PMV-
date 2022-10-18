<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EASYPRICE</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-primary  text-white">
            <div class="container-fluid">
            <img alt="" src="image/easypricelogo.png" width="100" height="30">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Menu</a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/home') }}">Inicio</a></li>
                            <li><a id="admi" class="dropdown-item" href="{{ url('/welcome') }}">Administracion</a></li>
                            <li><a class="dropdown-item" href="{{ url('/chat') }}">Chat de usuarios</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex col">
            </form>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Opciones</a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item"  href="{{ route('NewPassword') }}">Mi Cuenta</a></li>
                            <li><a class="dropdown-item" href="#">Permisos</a></li>
                            <li><a class="dropdown-item" href="#">Notificaciónes</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<!--- Mensajes -->

<h2 class="text-center">Actualizar mis datos <hr></h2>
  <div class="row justify-content-center">
      <div class="col-md-8">
      
                <form action="{{route('changePassword')}}" method="POST"  class="needs-validation" novalidate>
            @csrf 

            <div class="row mb-3">
                <div class="form-group mt-3">
                    <label for="name">Nombre de Usuario</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" required>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>    
            <div class="row mb-3">
              <div class="form-group mt-3">
                  <label for="password_actual">Contraseña Actual</label>
                  <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" required>
                    @error('password_actual')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group mt-3">
                    <label for="new_password ">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group mt-3">
                    <label for="confirm_password">Confirmar Nueva Contraseña</label>
                    <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required>
                    @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row text-center mb-4 mt-5">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-outline-primary" id="formSubmit">

                    <em class="fa fa-google mr-2"></em>
                 <img alt="" src="image/save.png" width="20" height="20">
                  
                </button>

                    <a href="/home" class="btn btn-outline-danger" ><img alt="" src="image/cancel3.png" width="20" height="20"></a>
                </div>
            </div>
        </form>

                
        
        
    </div>
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script> 
<script>
    if("{{ Auth::user()->name }}"!='admin'){
                document.getElementById('admi').style.display = 'none';
            }
</script>

</body>
</html>
