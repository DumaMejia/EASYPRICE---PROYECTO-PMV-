@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white  bg-primary">{{ __('Verifica Tu Direccion de Email') }}</div>
                <div class="card-body">
                <p align="center"><img alt="" src="https://cdn-icons-png.flaticon.com/512/561/561127.png" width="150" height="150"></p>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un Nuevo Link De Verificacion Ha Sido Enviado') }}
                        </div>
                    @endif

                    {{ __('Antes de seguir, por favor revisa tu correo para encontrar el link de verificacion.') }}
                    {{ __('Si no has recibido el mensaje en tu correo') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click aqui para reenviar link de verificacion') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
