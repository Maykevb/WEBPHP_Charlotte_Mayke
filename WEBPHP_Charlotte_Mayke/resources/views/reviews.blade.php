@extends('layouts.app')

@section('content')
    <div style="margin: auto; background-color: white; border: solid; border-width: 1px; border-color: lightgray; padding: 50px; width: 90%;">
        <form method="GET">
            <div class="input-group mb-3" style="width:50%; margin:auto;">
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
                       placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-dark type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <table class="table" style="width: 70%; margin: auto;">
            <thead>
            <tr>
                <th scope="col">Review ID</th>
                <th scope="col">Omschrijving</th>
                <th scope="col">Sterren</th>
                <th scope="col">Bestelling ID</th>
                <th scope="col">Datum</th>
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
    </div>
@endsection
