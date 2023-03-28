<?php /** @var Array $dataArray */ ?>
<html>
<head>
    <title>hi</title>
</head>
<body>
@foreach($dataArray as $data)
<div class="col-4">
{{--    Order information--}}
    <h2>{{__('Bestelling Informatie')}}</h2>
    <p class="lead">{{__('Bestelling nummer')}}: {{ $data['id'] }}</p>
    <p>{{__('Datum van bestelling')}}: {{ $data['date'] }} </p>

    <h2>{{__('Wordt verzonden naar')}}</h2>
    <p>{{ $data['name'] }}</p>
    <p> {{ $data['sendingStreet'] . ' ' . $data['sendingNumber'] }}</p>
    <p>{{ $data['sendingPostal'] . ' ' . $data['place'] }}</p>
    <br>

{{--    Barcode--}}
    <?php
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML()
    ?>
    {!! $generator->getBarcode($data['trackAndTrace'], $generator::TYPE_CODE_128) !!}
{{--    TrackAndTrace--}}
    <h3> {{ $data['trackAndTrace'] }}</h3>
</div>
<div style="page-break-after:always;"></div>
@endforeach
</body>
</html>

