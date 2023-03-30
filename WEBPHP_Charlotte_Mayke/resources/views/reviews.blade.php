@extends('layouts.app')

@section('content')
    <div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%; padding-bottom: 10px">
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
                                    <option value="id-desc" @if(request()->get('sorting') == "id-desc") selected @endif>
                                        {{__('Sorteer ID')}} ↓
                                    </option>
                                    <option value="id-asc" @if(request()->get('sorting') == "id-asc") selected @endif>
                                        {{__('Sorteer ID')}} ↑
                                    </option>
                                    <option value="text-desc" @if(request()->get('sorting') == "text-desc") selected @endif>
                                        {{__('Sorteer Omschrijving')}} ↓
                                    </option>
                                    <option value="text-asc" @if(request()->get('sorting') == "text-asc") selected @endif>
                                        {{__('Sorteer Omschrijving')}} ↑
                                    </option>
                                    <option value="stars-desc" @if(request()->get('sorting') == "stars-desc") selected @endif>
                                        {{__('Sorteer Sterren')}} ↓
                                    </option>
                                    <option value="stars-asc" @if(request()->get('sorting') == "stars-asc") selected @endif>
                                        {{__('Sorteer Sterren')}} ↑
                                    </option>
                                    <option value="shipment_id-desc" @if(request()->get('sorting') == "shipment_id-desc") selected @endif>
                                        {{__('Sorteer Bestelling ID')}} ↓
                                    </option>
                                    <option value="shipment_id-asc" @if(request()->get('sorting') == "shipment_id-asc") selected @endif>
                                        {{__('Sorteer Bestelling ID')}} ↑
                                    </option>
                                    <option value="created_at-desc" @if(request()->get('sorting') == "created_at-desc") selected @endif>
                                        {{__('Sorteer Datum')}} ↓
                                    </option>
                                    <option value="created_at-asc" @if(request()->get('sorting') == "created_at-asc") selected @endif>
                                        {{__('Sorteer Datum')}} ↑
                                    </option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group mb-3">
                                <select class="form-select" name="filter">
                                    <option value="0" @if(request()->get('filter') == 0 || request()->get('filter') == null) selected @endif>
                                        {{__('Alle Reviews')}}...
                                    </option>
                                    <option value="1" @if(request()->get('filter') == 1) selected @endif>
                                        1 {{__('ster')}}
                                    </option>
                                    <option value="2" @if(request()->get('filter') == 2) selected @endif>
                                        2 {{__('sterren')}}
                                    </option>
                                    <option value="3" @if(request()->get('filter') == 3) selected @endif>
                                        3 {{__('sterren')}}
                                    </option>
                                    <option value="4" @if(request()->get('filter') == 4) selected @endif>
                                        4 {{__('sterren')}}
                                    </option>
                                    <option value="5" @if(request()->get('filter') == 5) selected @endif>
                                        5 {{__('sterren')}}
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
            <table class="table" style="width: 70%; margin: auto;">
                <thead>
                    <tr>
                        <th scope="col">{{__('Review ID')}}</th>
                        <th scope="col">{{__('Omschrijving')}}</th>
                        <th scope="col">{{__('Sterren')}}</th>
                        <th scope="col">{{__('Bestelling ID')}}</th>
                        <th scope="col">{{__('Datum')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->text}}</td>
                            <td>{{ $review->stars }}</td>
                            <td>{{ $review->shipment_id }}</td>
                            <td>{{ $review->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <br>
        <div class="d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
    </div>
@endsection
