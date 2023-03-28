@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Verifieer Jouw Email Adres')}}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{__('Een nieuwe verificatie link is verzonden naar jouw email address')}}.
                        </div>
                    @endif

                    {{__('Voordat je verder gaat, check eerst je email voor een verificatie link a.u.b.')}}.
                    {{__('Als je de email niet hebt gekregen')}},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{__('klik hier om een nieuwe aan te vragen')}}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
