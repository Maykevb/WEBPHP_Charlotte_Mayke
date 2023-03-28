@extends('layouts.app')

@section('content')
    <div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%; padding-bottom: 10px">
        <form method="GET">
            <div class="input-group mb-3" style="width:50%; margin:auto;">
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
                       placeholder="{{__('Zoeken')}}..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-dark" type="submit" id="button-addon2">{{__('Zoeken')}}</button>
            </div>
        </form>
        <form method="GET" action="{{route('reviewsOverview')}}">
            <input type="hidden" name="search" value="{{ request()->get('search') }}" class="form-control"
                   placeholder="{{__('Zoeken')}}..." aria-label="Search" aria-describedby="button-addon2">
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

                <tr>
                    <td >
                        <button type="submit" name="id_sort" value="desc" class="btn btn-dark">↓</button>
                        <button type="submit" name="id_sort" value="asc" class="btn btn-dark">↑</button>
                    </td>
                    <td >
                        <button type="submit" name="description_sort" value="desc" class="btn btn-dark">↓</button>
                        <button type="submit" name="description_sort" value="asc" class="btn btn-dark">↑</button>
                    </td>
                    <td >
                        <button type="submit" name="star_sort" value="desc" class="btn btn-dark">↓</button>
                        <button type="submit" name="star_sort" value="asc" class="btn btn-dark">↑</button>
                    </td>
                    <td >
                        <button type="submit" name="order_sort" value="desc" class="btn btn-dark">↓</button>
                        <button type="submit" name="order_sort" value="asc" class="btn btn-dark">↑</button>
                    </td>
                    <td>
                        <button type="submit" name="date_sort" value="desc" class="btn btn-dark">↓</button>
                        <button type="submit" name="date_sort" value="asc" class="btn btn-dark">↑</button>
                    </td>
                </tr>

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
        </form>
        <br>
        <div class="d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
    </div>
@endsection
