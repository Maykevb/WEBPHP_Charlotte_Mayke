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
            <td>{{ $package->id }}</td>
            <td><button class="btn btn-dark" style="width: 200px;">Maak pakketlabel</button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

