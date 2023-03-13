<?php

namespace App\Models;


class TotalShipment
{
    public Shipment $shipment;
    public bool $hasLabel;

    public function __construct($shipment, $hasLabel)
    {
        $this->shipment = $shipment;
        $this->hasLabel = $hasLabel;
    }
}
