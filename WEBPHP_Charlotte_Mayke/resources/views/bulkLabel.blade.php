<?php /** @var Array $dataArray */ ?>
<html>
<head>
    <title>hi</title>
</head>
<body>
@foreach($dataArray as $data)
<div class="col-4">
    {{--    Order information--}}
    <h2>Order Information</h2>
    <p class="lead">Order Number: {{ $data['id'] }}</p>
    <p>Date of order: {{ $data['date'] }} </p>

    <h2>Shipping To</h2>
    {{--    TODO: add name + plaats (+ land)--}}
    <p> {{ $data['sendingStreet'] . ' ' . $data['sendingNumber'] }}</p>
    <p>{{ $data['sendingPostal'] }}</p>
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

