<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\TotalShipment;
use App\Repositories\LabelRepo;
use App\Repositories\ShipmentRepo;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        //TODO: add di
    }

    public function getAllPackages()
    {
        $repo = new ShipmentRepo();
        $repo2 = new LabelRepo();

        $shipments = array();
        foreach($repo->getAll() as $shipment)
        {
            if($repo2->find($shipment->id) != null)
            {
                $total = new TotalShipment($shipment, true);
                array_push($shipments, $total);
            }
            else
            {
                $total = new TotalShipment($shipment, false);
                array_push($shipments, $total);
            }

        }
        return $shipments;
    }

    public function createLabelForPackage()
    {
        $repo = new LabelRepo();

        $label = new Label();
        $label->barcode = '12345';
        $label->

        $repo->create($label);
    }
}
