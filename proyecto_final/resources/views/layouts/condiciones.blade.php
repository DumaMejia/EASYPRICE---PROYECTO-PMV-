@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white  bg-primary ">{{ __('Terminos y condiciones') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 align="center">Terminos y condiciones </h1>
                    <body>
                    <p>El presente documento contiene reglas aplicables al uso del sitio web de EasyPrice. Cualquier persona natural, que desee comparar precios dentro de EasyPrice podra hacerlo con previa inscripcion o no como usuario en el sistema.</p>
                        <p><strong>Tenga En Cuenta:</strong></p>

                        <p> No es una tienda directa sino una plataforma de comparacion de precios. Por lo tanto, no es posible realizar pedidos de
                        productos.</p>

                        <p><strong>Registro De La Tienda </strong></p>

                        <p>Si desea registrar su tienda como socio a nuestra plataforma de comparacion de precios, puede contactarse con nosotrosa traves del
                        siguiente correo: easyprice@outlook.com</p>

                        <p><strong>Terminos Generales y Condiciones  </strong></p>

                        <p>Toda informacion proporcionada debera ser verdadera, exacta y completa 
                        Ele usuario es el unico y exclusivo responsabe de la informacion que brinda mediante el uso del sitio web.</p>

                        <p><strong>Al aceptar nuestros termnos y condiciones tambien esta sujeto a lo siguiente:</strong></p>

                        <div class="form-check" >
                        <input href="{{ url('/gps') }}" class="form-check-input" type="checkbox" value="" id="flexCheckDefault" id="check" 
                        onchange="event.preventDefault();
                                                     document.getElementById('').disabled= false; this.disabled= 'true';">
                        <label class="form-check-label" for="flexCheckDefault">
                        Estoy de acuerdo con EasyPrice pueda acceder con fines relativos a la cuenta de usuario, los datos que se detallan a continuacion:
                        </label>
                        </div>
                        <p></p>
                        <UL>
                        <li>Elaboracion de perfiles de usuario y tratamiento de datos de mi cuenta de usuario.

                        <li>Almacenamiento y recopilacion de informacion.

                       <li> Notificaciones de ofertas en la ciudad seleccionada.

                        <li>Notificaciones de productos especificos.

                         </UL>

                         
                    </body>
                  
                </div>

                                <div class="d-grid gap-2 col-2 mx-auto">
                                    <a href="{{ route('home') }}" class="btn btn-primary">
                                        {{ __('Volver') }}
                                    </a>

                                    
                                    
                                    <a href="{{ url('/gps') }}" class="btn btn-primary" disabled="true" id="bts" disabled>
                                        {{ __('Siguiente') }}
                                    </a>
                                </div>

                                <p></p>
                
            </div>
        </div>
    </div>
</div>
@endsection


