@extends('layouts.app')

@section('content')
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

                <p align="center"><img  src="image/GPS.png" width="70   " height="100"></p>

                <p>Permitir acceso a mi ubicacion</p>
                    
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
@endsection