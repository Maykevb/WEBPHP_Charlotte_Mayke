@extends('layouts.app')

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" style="width: 500px; margin:auto; margin-bottom: 10px;">{{ $error }}</div>
        @endforeach
    @endif
    <div style="margin: auto; background-color: white; border: solid; border-color: black; padding: 20px; border-width: 2px; width: 500px; text-align: center;">
        @if(Auth::user()->role_id == 3)
        <form action="{{ route('pickup') }}" method="post">
            @csrf
            <h3 style="text-align: center;">{{__('Plan een pick-up in voor de eerder geselecteerde bestellingen')}}</h3>
            @if (isset($list))
                @foreach($list as $item)
                    <input type="hidden" name="listPickup[]" value="{{ $item }}">
                @endforeach
            @else
                @foreach($listPickup as $item)
                    <input type="hidden" name="listPickup[]" value="{{ $item }}">
                @endforeach
            @endif
            <div class="row">
                <input type="date" class="form-control" name="pickUpDate" style="width: 200px; text-align: center; margin: auto;">
                <input type="time" class="form-control" name="pickUpTime" style="width: 200px; text-align: center; margin: auto;">
            </div>
            <input type="text" class="form-control" name="postcode" placeholder="{{__('postcode')}}" style="width: 300px; text-align: center; margin: auto; margin-top: 10px; margin-bottom: 10px;">
            <input type="text" class="form-control" name="huisnummer" placeholder="{{__('huisnummer')}}" style="width: 300px; text-align: center; margin: auto;">
            <button type="submit" class="btn btn-dark" name="submit" style="margin-top: 10px; width: 300px;">{{__('Indienen')}}</button>
        </form>
        @else
            <h3>{{__('Je hebt geen rechten om een pickup aanvraag te maken')}}</h3>
        @endif
    </div>
@endsection
