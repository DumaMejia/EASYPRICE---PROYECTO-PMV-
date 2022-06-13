@extends('layouts.app')

@section('content')
<body>
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

                <p>{{coordinates.lat}}, {{coordinates.lng}}</p>

                <p align="center"><img  src="image/GPS.png" width="70   " height="100"></p>

                <p></p>
                <div class="form-check" >
                        <input  class="form-check-input" type="checkbox" value="" id="flexCheckDefault" id="check">
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
<script>
    export default {
        data() {
            return {
                coordinates: {
                    lat: 0,
                    lng: 0
                }  
            }
        },
        created() {
            this.$getlocation({})
            .then(coordinates => {
                this.coordinates = coordinates;
            })
        }
    }

</script>
</body>

@endsection