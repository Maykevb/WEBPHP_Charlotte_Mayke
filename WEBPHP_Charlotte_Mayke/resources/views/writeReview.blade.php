@extends('layouts.app')

@section('content')
<div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
   <div class="col-auto" style="margin: auto;">
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center">
            <div class="col-sm-8" style="text-align: center;">
                @if (isset($shipment) && $shipment->stars == null)
                    <h4 style="text-align: center"><strong>{{__('Schrijf een review')}}</strong></h4>
                    <form action="{{route('writtenReview')}}" method="post">
                        @csrf
                        <br>
                        <textarea type="text" name="text" id="reviewTextArea"></textarea>
                        <br><br>
                        <p>{{__('Aantal sterren')}}:</p>
                        <input type="radio" name="stars" checked value="1"> 1
                        <input type="radio" name="stars" value="2"> 2
                        <input type="radio" name="stars" value="3"> 3
                        <input type="radio" name="stars" value="4"> 4
                        <input type="radio" name="stars" value="5"> 5
                        <br><br>
                        <button type="submit" value="submit" class="btn btn-dark">{{__('Verzend review')}}</button>
                        <input type="text" hidden name="id" value="{{ $shipment->id }}"><br><br>
                        <input type="text" hidden name="accountId" value="{{Auth::user()->id}}"><br><br>
                    </form>
                @elseif (isset($shipment) && $shipment->stars != null)
                    <h4 style="text-align: center"><strong>{{__('Review geschreven')}}</strong></h4>
                    <p>{{__('Bedankt voor het schrijven van een review')}}!</p>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection

<style>
    .link {
        all: unset;
    }

    #reviewTextArea {
        width: 500px;
        height: 200px;
    }
</style>
