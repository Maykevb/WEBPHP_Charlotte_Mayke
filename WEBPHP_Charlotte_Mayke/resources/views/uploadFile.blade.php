@extends('layouts.app')

@section('content')
    <div class="col-auto" style="margin: auto;">
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center">
            <div class="col-sm-8" style="text-align: center;">
                <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                    <h3 class="text-center mb-5">Upload .csv bestand</h3>
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
                    <button type="submit" name="submit" class="btn btn-dark">
                        Upload Bestanden
                    </button>
                </form>
            </div>
        </div>
        <br>
    </div>
@endsection
