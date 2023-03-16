<html>
<head>
    <title>hi</title>
</head>
<body>
<div class="col-4">
{{--    Order information--}}
    <h2>Order Information</h2>
    <p class="lead">Order Number: {{ $id }}</p>
    <p>Date of order: {{ $date }} </p>

    <h2>Shipping To</h2>
    <p>{{ $name }}</p>
    <p> {{ $sendingStreet . ' ' . $sendingNumber }}</p>
    <p>{{ $sendingPostal . ' ' . $place }}</p>
    <br>

{{--    Barcode--}}
    <?php
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML()
    ?>
    {!! $generator->getBarcode($trackAndTrace, $generator::TYPE_CODE_128) !!}
{{--    TrackAndTrace--}}
    <h3> {{ $trackAndTrace }}</h3>
</div>
</body>
</html>
