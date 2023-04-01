@extends('layouts.app')

@section('content')
    <div class="col-auto" style="margin: auto;">
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center">
            <div class="col-sm-8" style="text-align: center;">
                @if (isset($shipments))
                    @if($shipments->count() > 0 && $shipments[0] != null)
                        <div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
                            <h4 style="text-align: center"><strong>{{__('Verzending')}}</strong></h4>
                            <table class="table" style="width: 90%; margin: auto;">
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
                                        <td>{{__($shipments[0]->status)}}</td>
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
                        <div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
                            <h4 style="text-align: center"><strong>{{__('Verzending')}}</strong></h4>
                            <p>{{__('Geen verzending met deze Track en Trace code kunnen vinden')}}.</p>
                        </div>
                    @endif
                @else
                    <div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
                        <h4 style="text-align: center"><strong>{{__('Volg je pakket')}}</strong></h4>
                        <form action="{{route('myShipmentsGet')}}" method="post">
                            @csrf
                            <p>{{__('Track en Trace code')}}:</p>
                            <input type="text" name="code" value="{{ request()->get('search') }}" class="form-control-sm"
                                   placeholder="{{__('Zoeken')}}..." aria-label="Search" aria-describedby="button-addon2"><br><br>
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
