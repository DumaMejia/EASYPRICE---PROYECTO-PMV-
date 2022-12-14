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
                            <li><a @click="abririnicio('inicio')" class="dropdown-item" href="#">Inicio</a></li>
                            <li><a id="admi" class="dropdown-item"  href="{{ url('/welcome') }}">Administracion</a></li>
                            <li><a @click="abrirmapa('mapa')" class="dropdown-item" href="#">Mapa</a></li>
                            </ul>
                        </li>
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
                            <li><a @click="abrirayuda('favoritos')" class="dropdown-item" href="#">Ayuda</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <mapa-component v-bind:form="forms" ref="mapa" v-show="forms['mapa'].mostrar" ></mapa-component>
        <favoritos-component v-bind:form="forms" ref="favoritos" v-show="forms['favoritos'].mostrar" ></favoritos-component>
        <inicio-component v-bind:form="forms" ref="inicio" v-show="forms['inicio'].mostrar" ></inicio-component>
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

