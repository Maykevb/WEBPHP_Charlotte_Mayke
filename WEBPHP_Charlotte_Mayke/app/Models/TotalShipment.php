<?php

namespace App\Models;


class TotalShipment
{
    public Shipment $shipment;
    public bool $hasLabel;
    public bool $hasPickup;

    public function __construct($shipment, $hasLabel, $hasPickup)
    {
        $this->shipment = $shipment;
        $this->hasLabel = $hasLabel;
        $this->hasPickup = $hasPickup;
    }
}
