<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Shipment;
use App\Models\TotalShipment;
use App\Repositories\CompanyRepo;
use App\Repositories\LabelRepo;
use App\Repositories\ShipmentRepo;
use Barryvdh\DomPDF\Facade\Pdf;
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
            if($repo->find($shipment->id)->label_id != null)
            {
                if($repo->find($shipment->id)->pickUpRequest_id != null)
                {
                    $total = new TotalShipment($shipment, true, true);
                } else
                {
                    $total = new TotalShipment($shipment, true, false);
                }
                array_push($shipments, $total);
            }
            else
            {
                if($repo->find($shipment->id)->pickUpRequest_id != null)
                {
                    $total = new TotalShipment($shipment, false, true);
                } else
                {
                    $total = new TotalShipment($shipment, false, false);
                }
                array_push($shipments, $total);
            }

        }
        return $shipments;
    }

    public function handleLabels(Request $request)
    {
        $repo2 = new ShipmentRepo();

        $listShipments = [];
        foreach($this->getAllPackages() as $package)
        {
            $id = $package->shipment->id;
            if($request->$id == "on")
            {
                switch ($request->input('action')) {
                    case 'Maak DHL label':
                        if($repo2->find($id)->label_id == null)
                        {
                            $this->createLabelForPackage($id, "DHL");
                        }
                        break;
                    case 'Maak PostNL label':
                        if($repo2->find($id)->label_id == null)
                        {
                            $this->createLabelForPackage($id, "PostNL");
                        }
                        break;
                    case 'Maak UPS label':
                        if($repo2->find($id)->label_id == null)
                        {
                            $this->createLabelForPackage($id, "UPS");
                        }
                        break;
                    case 'Download':
                        $listShipments[] = $id;
                        break;
                }
            }
        }

        if($request->input('action') == "Download" && count($listShipments) > 0)
        {
            return $this->printLabels($listShipments)->download('pdf_file.pdf');
        }
        else
        {
            return redirect('labelList');
        }
    }

    public function createLabelForPackage($id, $company)
    {
        $repo = new LabelRepo();
        $repo2 = new ShipmentRepo();
        $repo3 = new CompanyRepo();

        $label = new Label();
        $label->trackAndTrace = $this->generateTrackAndTrace();
        $label->company_id = $repo3->findWhere($company)->first();
        $label->save();

        $shipment = $repo2->find($id);
        $shipment->label_id = $label->id;
        $repo2->update($shipment, $id);

        return redirect('labelList');
    }

    public function printLabels($listShipments)
    {
        $repo = new LabelRepo();
        $repo2 = new ShipmentRepo();
        $repo3 = new CompanyRepo();

        foreach($listShipments as $shipment)
        {
            $findLabel = $repo->find($repo2->find($shipment)->label_id);
            $findCompany = $repo3->find($repo->find($repo2->find($shipment)->label_id)->company_id);
            $findShipment = $repo2->find($shipment);

            $data = ['id' => $findLabel->id,
                'name' => $findShipment->lable,
                'place' => $findShipment->place,
                'date' => $findShipment->created_at,
                'trackAndTrace' => $findLabel->trackAndTrace,
                'company' => $findCompany->naam,
                'sendingStreet' => $findShipment->streetName,
                'sendingNumber' => $findShipment->houseNumber,
                'sendingPostal' => $findShipment->postalCode];

            $dataArray[] = $data;
        }
        $array = ['dataArray' => $dataArray];

        $pdf = PDF::loadView('bulkLabel', $array);
        return $pdf;
    }

    public function generateTrackAndTrace()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 10;

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (Label::select()->where('trackAndTrace', $code)->exists()) {
            $this->generateTrackAndTrace();
        }

        return $code;
    }
}
