@extends('layouts.app')

@section('content')
<div class="col-auto" style="margin: auto;">
    {{--    <h4 style="text-align: center"><strong>Losse labels maken</strong></h4>--}}

    <form action=" {{route('list')}}" method="post">
        @csrf
        <div class="row" style="margin:0 auto; text-align: center;  justify-content: center">
            <div class="col-sm-8" style="text-align: center;">
                <h4 style="text-align: center"><strong>Labels maken</strong></h4>
                <input type="submit" class="btn btn-dark" name="action" value="Maak DHL label" style="width: 200px;"/>
                <input type="submit" class="btn btn-dark" name="action" value="Maak PostNL label" style="width: 200px;"/>
                <input type="submit" class="btn btn-dark" name="action" value="Maak UPS label" style="width: 200px;"/>
                <br><br>

                <h4 style="text-align: center"><strong>Labels printen</strong></h4>
                <input type="submit" class="btn btn-dark" name="action" value="Download" style="width: 200px;"/>

            </div>
        </div>
        <br>

        <table class="table" style="width: 50%; margin: auto;">
            <thead>
            <tr>
                <th scope="col">
                    <input type="checkbox" id="cc" onclick="checkAll(this)"> Select all </input>
                </th>
                <th scope="col">Shipment ID</th>
                <th scope="col">Label status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listPackages as $package)
            <tr>
                <td><input type="checkbox" name="{{ $package->shipment->id }}"/></td>
                <td>{{ $package->shipment->id }}</td>
                @if(!$package->hasLabel)
                    <td>
                       <p>Dit pakket heeft nog geen label</p>
                    </td>
                @else
                    <td><p>Dit pakket heeft al een label</p></td>
                @endif

            </tr>
            @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection

<style>
    .link
    {
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

