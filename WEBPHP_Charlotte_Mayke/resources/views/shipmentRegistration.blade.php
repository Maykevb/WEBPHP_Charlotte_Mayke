@extends('layouts.app')

@section('content')
    <div class="col-auto" style="margin: auto;">
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center">
            <div class="col-sm-8" style="text-align: center;">
                <h4 style="text-align: center"><strong>Bulk verzending aanmelden</strong></h4>
                <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                    <p>Om een bulk verzending aan te melden, upload een .csv bestand hieronder:</p>
                    <p>Zorg ervoor dat het bestand de volgende kolommen bevat:</p>
                    <p>id, name, place, streetName, houseNumber, postalCode</p>
                    @csrf
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
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
                        <label class="custom-file-label" for="chooseFile">Selecteer bestand</label>
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-dark">Upload Bestanden</button>
                </form>
                <br><br>

                <h4 style="text-align: center"><strong>Enkele verzending aanmelden</strong></h4>
                <p>Om een enkele verzending aan te melden, voer de volgende informatie in de zoekbalk in:</p>
{{--                TODO: website naam voor /api/--}}
                <p>/api/{naam van ontvanger}/{bezorg adres straat}/{bezorg adres huisnummer}/{bezorg adres postcode}/{bezorg adres plaats}</p>
            </div>
        </div>
        <br>
    </div>
@endsection

<style>
    .link
    {
        all: unset;
    }
</style>
