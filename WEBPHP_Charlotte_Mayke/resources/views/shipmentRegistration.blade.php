@extends('layouts.app')

@section('content')
{{--    TODO: add standard layout--}}
    <div class="col-auto" style="margin: auto;">
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center">
            <div class="col-sm-8" style="text-align: center;">
                <h4 style="text-align: center"><strong>{{__('Bulk verzending aanmelden')}}</strong></h4>
                <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                    <p>{{__('Om een bulk verzending aan te melden, upload een .csv bestand hieronder')}}</p>
                    <p>{{__('Zorg ervoor dat het bestand de volgende kolommen bevat')}}:</p>
                    <p>id, name, place, streetName, houseNumber, postalCode</p>
                    @csrf
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('fail'))
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="chooseFile">
                        <label class="custom-file-label" for="chooseFile">{{__('Selecteer bestand')}}</label>
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-dark">{{__('Upload Bestanden')}}</button>
                </form>
                <br><br>

                <h4 style="text-align: center"><strong>{{__('Enkele verzending aanmelden')}}</strong></h4>
                <p>{{__('Om een enkele verzending aan te melden, voer de volgende informatie in de zoekbalk in')}}:</p>
                <p>{{__('/api/{account token}/{email}/{naam ontvanger}/{straat}/{huisnummer}/{postcode}/{plaats}')}}</p>
                <br><br>

                <h4 style="text-align: center"><strong>{{__('Verzendig status updaten')}}</strong></h4>
                <p>{{__('Status opties')}}:</p>
                <p>{{__('"Aangemeld"')}}, {{__('"Uitgeprint"')}}, {{__('"Opgehaald"')}}, {{__('"Sorteercentrum"')}}, {{__('"Onderweg"')}}, {{__('"Afgeleverd"')}}</p>
                <br>
                <p>{{__('Om een de status van een verzending aan te passen, voer de volgende informatie in de zoekbalk in')}}:</p>
                <p>{{__('/api/{account token}/{email}/{pakket id}/{nieuwe status}')}}</p>
            </div>
        </div>
        <br>
    </div>
@endsection

<style>
    .link {
        all: unset;
    }
</style>
