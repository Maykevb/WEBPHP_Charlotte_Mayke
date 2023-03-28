@extends('layouts.app')

@section('content')
<div class="col-auto" style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
    <form method="GET" action="{{route('labelList')}}">
        <table class="table" style="width: 100%; margin: auto;">
            <tbody>
            <tr style="display: flex; width: 70%; margin: auto; text-align: center;  justify-content: center;">
                <td style="align-self: flex-start">
                    <button type="submit" name="id_sort" value="desc" class="btn btn-dark">{{__('Sorteer ID')}} ↓</button>
                    <button type="submit" name="id_sort" value="asc" class="btn btn-dark">{{__('Sorteer ID')}} ↑</button>
                </td>
                <td style="align-self: flex-end">
                    <button type="submit" name="name_sort" value="desc" class="btn btn-dark">{{__('Sorteer Naam')}} ↓</button>
                    <button type="submit" name="name_sort" value="asc" class="btn btn-dark">{{__('Sorteer Naam')}} ↑</button>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="input-group mb-3" style="width:50%; margin:auto;">
            <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
                   placeholder="{{__('Zoeken')}}..." aria-label="Search" aria-describedby="button-addon2">
            <button class="btn btn-dark" type="submit" id="button-addon2">{{__('Zoeken')}}</button>
        </div>
    </form>

    <form action="{{ route('list') }}" method="post">
        @csrf
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center;">
            <div class="col-sm-8" style="text-align: center;">
                <h4 style="text-align: center"><strong>{{__('Labels maken')}}</strong></h4>
                <input type="submit" class="btn btn-dark" name="action" value="{{__('Maak DHL label')}}" style="width: 200px;"/>
                <input type="submit" class="btn btn-dark" name="action" value="{{__('Maak PostNL label')}}" style="width: 200px;"/>
                <input type="submit" class="btn btn-dark" name="action" value="{{__('Maak UPS label')}}" style="width: 200px;"/><br><br>

                <h4 style="text-align: center"><strong>{{__('Labels printen')}}</strong></h4>
                <input type="submit" class="btn btn-dark" name="action" value="{{__('Downloaden')}}" style="width: 200px;"/>
            </div>
        </div>
        <br>

        <table class="table" style="width: 70%; margin: auto;">
            <thead>
            <tr>
                <th scope="col">
                    <input type="checkbox" id="cc" onclick="checkAll(this)"> {{__('Selecteer alles')}}</input>
                </th>
                <th scope="col">{{__('Verzending ID')}}</th>
                <th scope="col">{{__('Naam')}}</th>
                <th scope="col">{{__('Label status')}}</th>
                <th scope="col">{{__('Pick-Up aanvraag')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shipments as $package)
            <tr>
                <td><input type="checkbox" name="{{ $package->id }}"/></td>
                <td>{{ $package->id }}</td>
                <td>{{$package->name}}</td>
                @if($package->label_id == null)
                    <td>
                       <p>{{__('Dit pakket heeft nog geen label')}}</p>
                    </td>
                @else
                    <td><p>{{__('Dit pakket heeft al een label')}}</p></td>
                @endif
                @if($package->pickUpRequest_id == null)
                    <td>
                        <a href=" {{ route('startRequest', $package->shipment->id) }}" class="btn btn-dark" style="width: 200px;">{{__('Plan pick-up')}}</a>
                    </td>
                @else
                    <td><p>{{__('Dit pakket heeft al een pickup aanvraag')}}</p></td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
    </form>
    <div class="d-flex justify-content-center">
        {{ $shipments->links() }}
    </div>
</div>
@endsection

<style>
    .link {
        all: unset;
    }
</style>

<script>
    function checkAll(o) {
        var boxes = document.getElementsByTagName("input");
        for (var x = 0; x < boxes.length; x++) {
            var obj = boxes[x];
            if (obj.type === "checkbox") {
                if (obj.name !== "check")
                    obj.checked = o.checked;
            }
        }
    }
</script>

