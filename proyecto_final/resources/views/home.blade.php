<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EASYPRICE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
            
    <body> 
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary  text-white">
            <div class="container-fluid">
            <img  src="image/easypricelogo.png" width="100" height="30">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Menu</a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Inicio</a></li>
                            <li><a class="dropdown-item" href="{{ url('/welcome') }}">Administracion</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex col">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Buscar</button>
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
                            <li><a class="dropdown-item" href="#">Usuario</a></li>
                            <li><a class="dropdown-item" href="#">Permisos</a></li>
                            <li><a class="dropdown-item" href="#">Notificaciónes</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>


    <div class="container m-3">
        
    
    <form align="center">
    <div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Selecciona un departamento
  </button>
  <ul class="dropdown-menu dropdown-menu-lg-end">
    <li><button class="dropdown-item" type="button">Ahuachapan</button></li>
    <li><button class="dropdown-item" type="button">Cabañas</button></li>
    <li><button class="dropdown-item" type="button">Usulutan</button></li>
  </ul>
</div>

{{ __('                                         ') }}

<div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Selecciona un municipio
  </button>
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
    <li><button class="dropdown-item" type="button">Usulutan</button></li>
    <li><button class="dropdown-item" type="button">Santa Maria</button></li>
    <li><button class="dropdown-item" type="button">Ozatlan</button></li>
  </ul>
</div>
    </form>

    

    </div>
        

        <div>

        
                        
            


            <div class="map">
              
            <GmapMap
                :center="{lat:10, lng:10}"
                :zoom="7"
                :style="width: 100%, height: 320%;"
            ></GmapMap>
                
            </div>

            

            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" width="1000" height="100" align="center">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000" >


        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://cdn-pro.elsalvador.com/wp-content/uploads/2019/10/Imagen-shutterstock_152186840.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://copades.com/monec/wp-content/uploads/2021/07/ca-1-720x340.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://s3.amazonaws.com/prod-wp-hrn/wp-content/uploads/2021/02/canasta-basica-subio.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
          
        </div>

    </div>

    <div class="carousel-item" data-bs-interval="2000">


    <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://cdn-pro.elsalvador.com/wp-content/uploads/2019/10/Imagen-shutterstock_152186840.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://copades.com/monec/wp-content/uploads/2021/07/ca-1-720x340.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://s3.amazonaws.com/prod-wp-hrn/wp-content/uploads/2021/02/canasta-basica-subio.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
          
        </div>

    </div>

    <div class="carousel-item">

    <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://cdn-pro.elsalvador.com/wp-content/uploads/2019/10/Imagen-shutterstock_152186840.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://copades.com/monec/wp-content/uploads/2021/07/ca-1-720x340.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">Ver aqui</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://s3.amazonaws.com/prod-wp-hrn/wp-content/uploads/2021/02/canasta-basica-subio.png" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Canasta basica</h5>
                        <p class="card-text">Productos en oferta</p>
                        <a href="#" class="btn btn-primary">ver aqui</a>
                    </div>
                </div>
            </div>
          
        </div>

    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
                
        </div>


        


            
                
        </div>
        <script src="{{ asset('js/app.js') }}"></script>    
    </body>
</html>

