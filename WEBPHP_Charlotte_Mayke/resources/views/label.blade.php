<html>
<head>
    <title>hi</title>
</head>
<body>
<div class="col-4">
    Order information
    <h2>{{__('Bestelling Informatie')}}</h2>
    <p class="lead">{{__('Bestelling nummer')}}: {{ $id }}</p>
    <p>{{__('Datum van bestelling')}}: {{ $date }} </p>

    <h2>{{__('Wordt verzonden naar')}}</h2>
    <p>{{ $name }}</p>
    <p> {{ $sendingStreet . ' ' . $sendingNumber }}</p>
    <p>{{ $sendingPostal . ' ' . $place }}</p>
    <br>

    Barcode
    <?php
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML()
    ?>
    {!! $generator->getBarcode($trackAndTrace, $generator::TYPE_CODE_128) !!}
    TrackAndTrace
    <h3> {{ $trackAndTrace }}</h3>
</div>
</body>
</html>
