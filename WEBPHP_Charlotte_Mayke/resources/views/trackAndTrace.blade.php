@extends('layouts.app')

@section('content')
<div class="col-auto" style="margin: auto;">
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
            @if(!$package->hasLabel)
                <td>
                    <button class="btn btn-dark" style="width: 200px;"><a class="link" href="{{ route('makeLabel', [$package->shipment->id, 'PostNl']) }}">Maak PostNl label</a></button>
                    <button class="btn btn-dark" style="width: 200px;"><a class="link" href="{{ route('makeLabel', [$package->shipment->id, 'DHL']) }}">Maak DHL label</a></button>
                    <button class="btn btn-dark" style="width: 200px;"><a class="link" href="{{ route('makeLabel', [$package->shipment->id, 'UPS']) }}">Maak UPS label</a></button>
                </td>
            @else
            <td><p>Dit pakket heeft al een label</p></td>
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

