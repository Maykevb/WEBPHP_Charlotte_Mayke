@extends('layouts.app')

@section('content')
    @if ($message = Session::get('duplicate'))
        <div class="alert alert-danger" style="width: 90%; margin: auto; margin-bottom: 10px;">
            <strong>{{ $message }}</strong>
        </div>
    @endif
<div class="col-auto" style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
    <form method="GET">
        <table class="table" style="width: 100%; margin: auto;">
            <tbody>
                <tr style="display: flex; width: 70%; margin: auto; text-align: center;  justify-content: center;">
                    <td>
                        <div class="input-group mb-3">
                            <select class="form-select" name="sorting">
                                <option value="0" @if(request()->get('sorting') == 0 || request()->get('sorting') == null) selected @endif>
                                    {{__('Sorteren')}}...
                                </option>
                                <option value="id_desc" @if(request()->get('sorting') == "id_desc") selected @endif>
                                    {{__('Sorteer ID')}} ↓
                                </option>
                                <option value="id_asc" @if(request()->get('sorting') == "id_asc") selected @endif>
                                    {{__('Sorteer ID')}} ↑
                                </option>
                                <option value="name_desc" @if(request()->get('sorting') == "name_desc") selected @endif>
                                    {{__('Sorteer Naam')}} ↓
                                </option>
                                <option value="name_asc" @if(request()->get('sorting') == "name_asc") selected @endif>
                                    {{__('Sorteer Naam')}} ↑
                                </option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group mb-3">
                            <select class="form-select" name="filter">
                                <option value="0" @if(request()->get('filter') == 0 || request()->get('filter') == null) selected @endif>
                                    {{__('Alle Verzendingen')}}...
                                </option>
                                <option value="1" @if(request()->get('filter') == 1) selected @endif>
                                    {{__('Heeft Label')}}
                                </option>
                                <option value="2" @if(request()->get('filter') == 2) selected @endif>
                                    {{__('Geen Label')}}
                                </option>
                                <option value="3" @if(request()->get('filter') == 3) selected @endif>
                                    {{__('Heeft Pickup')}}
                                </option>
                                <option value="4" @if(request()->get('filter') == 4) selected @endif>
                                    {{__('Geen Pickup')}}
                                </option>
                            </select>
                        </div>
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
                @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                    <h4 style="text-align: center"><strong>{{__('Labels maken')}}</strong></h4>
                    <input type="submit" class="btn btn-dark" name="action" id="DHL" value="{{__('Maak DHL label')}}" style="width: 200px;"/>
                    <input type="submit" class="btn btn-dark" name="action" id="PostNL" value="{{__('Maak PostNL label')}}" style="width: 200px;"/>
                    <input type="submit" class="btn btn-dark" name="action" id="UPS" value="{{__('Maak UPS label')}}" style="width: 200px;"/><br><br>
                @endif
                <h4 style="text-align: center"><strong>{{__('Labels printen')}}</strong></h4>
                <input type="submit" class="btn btn-dark" name="action" id="download" value="{{__('Downloaden')}}" style="width: 200px;"/>
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
                <td><input type="checkbox" name="{{ $package->id }}" id="checkbox{{ $package->id }}"/></td>
                <td>{{ $package->id }}</td>
                <td>{{ $package->name }}</td>
                @if ($package->label_id == null)
                    <td>
                       <p>{{__('Dit pakket heeft nog geen label')}}</p>
                    </td>
                @else
                    <td><p>{{__('Dit pakket heeft al een label')}}</p></td>
                @endif
                @if ($package->pickUpRequest_id == null && (Auth::user()->role_id == 3 || Auth::user()->role_id == 4))
                    <td>
                        <a href=" {{ route('startRequest', $package->id) }}" id="request{{ $package->id }}" class="btn btn-dark" style="width: 200px;">{{__('Plan pick-up')}}</a>
                    </td>
                @elseif($package->pickUpRequest_id == null && Auth::user()->role_id != 3 && Auth::user()->role_id != 4)
                    <td><p>{{__('Je hebt geen rechten om een pickup aanvraag te maken')}}</p></td>
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

