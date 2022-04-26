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

                    <p class="card-text">El presente documento contiene reglas aplicables al uso del sitio web de EasyPrice. Cualquier persona natural 
                        , que desee comparar precios dentro de EasyPrice podra hacerlo con previa inscripcion o no como usuario en el sistema.
                        Tenga en Cuenta:
                        EasyPrice no es una tienda directa sino una plataforma de comparacion de precios. Por lo tanto, no es posible realizar pedidos de
                        productos.

                        Registro de la tienda 
                        Si desea registrar su tienda como socio a nuestra plataforma de comparacion de precios, puede contactarse con nosotrosa traves del
                        siguiente correo: easyprice@outlook.com

                        Terminos Generales y Condiciones 

                        Toda informacion proporcionada debera ser verdadera, exacta y completa 
                        Ele usuario es el unico y exclusivo responsabe de la informacion que brinda mediante el uso del sitio web

                        Al aceptar nuestros termnos y condiciones tambien esta sujeto a lo siguiente:

                        Estoy de acuerdo con EasyPrice pueda acceder con fines relativos a la cuenta de usuario, los datos que se detallan a cntiuacion:

                        elaboracion de perfiles de usuario y tratamiento de datos de mi cuneta de usuario.

                        almacenamiento y recopilacion de informacion.

                        notificaciones de ofertas en la ciudad seleccionada.

                        notificaciones de productos especificos.

                    </p>
                </div>
                
                <div class="col-md-6 offset-md-4">
                    <a href="{{ url('/gps') }}">
                     <button type="button" class="btn btn-primary">
                     <i class="fa fa-google mr-2"></i>
                     {{ __('Siguiente') }}
                     </button>
                    </a>
                </div>

              

                <div class="col-md-6 offset-md-4">
                    <a href="{{ url('/login') }}">
                     <button type="button" class="btn btn-primary">
                     <i class="fa fa-google mr-2"></i>
                     {{ __('Atras') }}
                     </button>
                    </a>
                </div>

               
            </div>
        </div>
    </div>
</div>
@endsection
