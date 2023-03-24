@extends('layouts.app')

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" style="width: 500px; margin:auto; margin-bottom: 10px;">{{ $error }}</div>
        @endforeach
    @endif
    <div style="margin: auto; background-color: white; border: solid; border-color: black; padding: 20px; border-width: 2px; width: 500px; text-align: center;">
        <form action="{{ route('pickup') }}" method="post">
            @csrf
            <h3 style="text-align: center;">Plan een pick-up in voor bestelling: {{ $shipment->id }}</h3>
            <input type="hidden" name="pickUpId" value="{{ $shipment->id }}">
            <div class="row">
                <input type="date" class="form-control" name="pickUpDate" style="width: 200px; text-align: center; margin: auto;">
                <input type="time" class="form-control" name="pickUpTime" style="width: 200px; text-align: center; margin: auto;">
            </div>
            <input type="text" class="form-control" name="postcode" placeholder="postcode" style="width: 300px; text-align: center; margin: auto; margin-top: 10px; margin-bottom: 10px;">
            <input type="text" class="form-control" name="huisnummer" placeholder="huisnummer" style="width: 300px; text-align: center; margin: auto;">
            <button type="submit" class="btn btn-dark" name="submit" style="margin-top: 10px; width: 300px;">Submit</button>
        </form>
    </div>
@endsection
