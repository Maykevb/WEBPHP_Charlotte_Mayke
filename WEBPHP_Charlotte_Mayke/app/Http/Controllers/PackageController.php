<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\TotalShipment;
use App\Repositories\CompanyRepo;
use App\Repositories\LabelRepo;
use App\Repositories\ShipmentRepo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

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
            if($repo->find($shipment->id)->label_id != null)
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

    public function createLabelForPackage(Request $request)
    {

        $id = $request->id;
        $company = $request->company;

        $repo = new LabelRepo();
        $repo2 = new ShipmentRepo();
        $repo3 = new CompanyRepo();

        $label = new Label();
        $label->trackAndTrace = '12345';
        $label->company_id = $repo3->findWhere($company)->first();
        $label->save();

        $shipment = $repo2->find($id);
        $shipment->label_id = $label->id;
        $repo2->update($shipment, $id);

        $data = ['id' => $repo->find($repo2->find($id)->label_id)->id];
        $pdf = PDF::loadView('label', $data);
        return $pdf->download('pdf_file.pdf');

        return redirect('trackAndTrace');
    }
}
