@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo indirizzo email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Ti abbiamo spedito una mail con il link per la conferma del tuo account!') }}
                        </div>
                    @endif

                    {{ __('Prima di andare avanti, controlla la tua mail per confermare l\'account) }}
                    {{ __('Se non hai ricevuto la mail') }}, <a href="{{ route('verification.resend') }}">{{ __('Clicca qui per richiederne un'altra) }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
