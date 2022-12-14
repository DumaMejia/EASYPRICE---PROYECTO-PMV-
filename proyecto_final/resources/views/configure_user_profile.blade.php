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

    <!-- Alertify -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
<div id="app" >
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
                            <li>
                            <div class="form-check form-switch">
                            <input class="form-check-input" @click="this.gps()" type="checkbox" role="switch" id="SwitchGps">
                            <label class="form-check-label" for="flexSwitchCheckDefault">GPS</label>
                            </div></li>
                            <li><div class="form-check form-switch">
                            <input class="form-check-input" @click="this.notification()" type="checkbox" role="switch" id="SwitchNoti">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Notificaciones</label>
                            </div></li>
                            <li><a @click="abrirayudaCu('favoritos')" class="dropdown-item" href="#">Ayuda</a></li>
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
   <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Sigue en contacto con nosotros:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>EasyPrice Company
          </h6>
          <p>
            Esperamos que su experiencia en EasyPrice sea grata y de utlidad.
            aqui te dejamos unos enlaces que pueden resultarte utiles.
            tambien tienes  nuestros contactos de empresa por si buscas ayuda.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Ventanas
          </h6>
          <p>
            <a href="#!" class="text-reset">Angular</a>
          </p>
          <p>
            <a href="#!" class="text-reset">React</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Vue</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Laravel</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Enlaces Utiles
          </h6>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Cuenta</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Orders</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Ayuda</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contacto</h6>
          <p><i class="fas fa-home me-3"></i> Usulutan, Usulutan, SV</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            easyprice@info.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 503 7209-9091</p>
          <p><i class="fas fa-print me-3"></i> + 503 2626-6767</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="https://easyprice.tk">EasyPrice Company</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.min.js"></script>
<script src="https://unpkg.com/vue-resizable@1"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script> 
<script src="{{ asset('js/app.js') }}"></script> 
<script>
    if("{{ Auth::user()->name }}"!='admin'){
                document.getElementById('admi').style.display = 'none';
    };

    window.onload = function cargarcomentarios(){

                navigator.geolocation.getCurrentPosition(sucess, error);
                
                if(Notification.permission == "granted"){
                    document.getElementById('SwitchNoti').disabled = true;
                    document.getElementById('SwitchNoti').checked = true;
                };
                if(Notification.permission !== "granted"){
                    document.getElementById('SwitchNoti').checked = false;
                };
                if(Notification.permission !== "granted"){
                        Notification.requestPermission(susnot);
                    };

                    
            };


            function gps(){
                if(document.getElementById('SwitchGps').checked){
                    if (navigator.geolocation){
                            navigator.geolocation.getCurrentPosition(sucess, error); 
                     };
                }else{
                    
                };
            };

            function sucess(geolocationPosition){
                document.getElementById('SwitchGps').checked = true;
                document.getElementById('SwitchGps').disabled = true;
                let coords = geolocationPosition.coords;
                 localStorage.setItem('lat', coords.latitude);
                localStorage.setItem('lng', coords.longitude);
             };

             function error(err){
                alertify.alert('Si quieres usar las funciones de GPS primero debes otorgar permisos de ubicacion a la aplicacion en tu navegador').setHeader('<img  src="image/logo2.png" width="100" height="30">');
                document.getElementById('SwitchGps').checked = false;
                document.getElementById('SwitchGps').checked;
             };

             function notification(){
                if(document.getElementById('SwitchNoti').checked){
                    if(!Notification){
                        alertify.alert('El navegador no soporta notificaciones').setHeader('<img  src="image/logo2.png" width="100" height="30">');

                        return
                    };
                    if(Notification.permission !== "granted"){
                        Notification.requestPermission();
                        if(Notification.permission == "granted"){
                            document.getElementById('SwitchNoti').checked = true;
                            document.getElementById('SwitchNoti').disabled = true;
                        }else{
                            alertify.alert('Si quieres usar las funciones de GPS primero debes otorgar permisos de notificaciones a la aplicacion en tu navegador').setHeader('<img  src="image/logo2.png" width="100" height="30">');
                            document.getElementById('SwitchNoti').checked = false;

                        };
                    };
                };

             };

             function susnot(granted){

                if(Notification.permission !== "granted"){
                    document.getElementById('SwitchNoti').checked = false;
                    document.getElementById('SwitchNoti').disabled = false;
                };
                if(Notification.permission == "granted"){
                    document.getElementById('SwitchNoti').checked = true;
                    document.getElementById('SwitchNoti').disabled = true;
                };


             };

             function ayuda(){
                alert('si');

            this.form['inicio'].mostrar = false;
            this.form['mapa'].mostrar = false;

             };




</script>

</body>
</html>
