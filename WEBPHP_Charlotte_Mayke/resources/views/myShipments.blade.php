@extends('layouts.app')

@section('content')
    <div class="col-auto" style="margin: auto;">
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center">
            <div class="col-sm-8" style="text-align: center;">
                @if (isset($shipments))
                    @if($shipments->count() > 0 && $shipments[0] != null)
{{--                    TODO: only if logged in--}}
                        <h4 style="text-align: center"><strong>{{__('Verzending')}}</strong></h4>
                        <div>
                            <table class="table" style="width: 50%; margin: auto;">
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('Track en Trace code')}}</th>
                                        <th scope="col">{{__('Status')}}</th>
                                        @if($shipments[0]->status == "Afgeleverd" && $shipments[0]->stars == null)
                                            <th scope="col">{{__('Review')}}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $shipments[0]->trackAndTrace }}</td>
                                        <td>{{ $shipments[0]->status }}</td>
                                        @if($shipments[0]->status == "Afgeleverd" && $shipments[0]->stars == null)
                                            <form action="{{route('writeReview')}}" method="get">
                                                @csrf
                                                <td>
                                                    <button type="submit" value="submit" class="btn btn-dark">{{__('Schrijf een review')}}</button>
                                                </td>
                                                <input hidden value="{{ $shipments[0]->id }}" name="id"><br><br>
                                            </form>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h4 style="text-align: center"><strong>{{__('Verzending')}}</strong></h4>
                        <div>
                            <p>{{__('Geen verzending met deze Track en Trace code kunnen vinden')}}.</p>
                        </div>
                    @endif
                @else
                    <div>
                        <h4 style="text-align: center"><strong>{{__('Volg je pakket')}}</strong></h4>
                        <form action="{{route('myShipmentsGet')}}" method="post">
                            @csrf
                            <p>{{__('Track en Trace code')}}:</p>
                            <input type="text" name="code"><br><br>
                            <button type="submit" value="submit" class="btn btn-dark">{{__('Volg je pakket')}}</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .link {
        all: unset;
    }
</style>
