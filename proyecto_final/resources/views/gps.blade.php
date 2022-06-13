<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                
                <img  src="image/easypricelogo.png" width="100" height="30">
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
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
                    </ul>
                </div>
            </div>
        </nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white  bg-primary">{{ __('Permiso de uso de ubicacion') }}</div>

                <div class="card-body">
                

                <p>Es momento de configurar algunas cosas 
                    Para poder  mostrarte las promociones y comercios cercanos a ti es indispensable 
                    que nos proporciones tu ubicacion
                </p>
                <div id="mymap">

                </div>


                <p align="center"><img  src="image/GPS.png" width="70   " height="100"></p>

                <p></p>
                <div class="form-check" >
                        <input id="flexCheckDefault" class="form-check-input" type="checkbox" value="" onclick="if (navigator.geolocation){
                            navigator.geolocation.getCurrentPosition(sucess); 
                            }">
                        <label class="form-check-label" for="flexCheckDefault">
                        Permitir acceso a mi ubicacion
                        </label>
                        </div>
                </div>
                <div class="col-md-6 offset-md-4">
                    <a href="{{ url('/') }}">
                     <button type="button" class="btn btn-primary">
                     <i class="fa fa-google mr-2"></i>
                     {{ __('Siguiente') }}
                     </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

 
<script>
    
    

   function sucess(geolocationPosition){
    let coords = geolocationPosition.coords;
    document.getElementById("mymap").innerHTML =  "latitude" + coords.latitude + "<br>" + "longitude" + coords.longitude;
   }
</script>
<script src="{{ mix('js/app.js') }}"></script> 
<script src="{{ asset('js/app.js') }}"></script>   
</body>

