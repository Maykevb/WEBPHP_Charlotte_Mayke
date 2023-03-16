@extends('layouts.app')

@section('content')
    <div class="col-auto" style="margin: auto;">
        <h4 style="text-align: center"><strong>Pickup aanvraag plannen</strong></h4>
        <table class="table" style="width: 50%; margin: auto;">
            <thead>
            <tr>
                <th scope="col">Shipment ID</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($listPackages as $package)
                <tr>
                    <td>{{ $package->shipment->id }}</td>
                    @if(!$package->hasPickup)
                        @if($package->hasLabel)
                        <td>
                            <button class="btn btn-dark" style="width: 200px;"><a class="link" href="{{ route('startRequest') }}">Plan aanvraag</a></button>
                        </td>
                        @else
                        <td><p>Dit pakket heeft nog geen label </p></td>
                        @endif
                    @else
                        <td><p>Dit pakket heeft al een pickup </p></td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

<style>
    .link
    {
        all: unset;
    }
</style>
