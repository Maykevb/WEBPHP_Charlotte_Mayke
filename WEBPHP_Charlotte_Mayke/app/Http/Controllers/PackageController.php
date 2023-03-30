<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\PickUpRequest;
use App\Models\Review;
use App\Models\Shipment;
use App\Repositories\CompanyRepo;
use App\Repositories\LabelRepo;
use App\Repositories\PickUpRequestRepo;
use App\Repositories\ShipmentRepo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    private ShipmentRepo $shipRepo;
    private LabelRepo $labRepo;
    private  CompanyRepo $compRepo;

    public function __construct()
    {
        $this->shipRepo = new ShipmentRepo();
        $this->labRepo = new LabelRepo();
        $this->compRepo = new CompanyRepo();
    }

    public function getAllPackages(Request $request)
    {
        if($request->filled('search') && isset($request->id_sort)) {
            $shipments = Shipment::search($request->search)
                ->where('webshop', Auth::user()->webshop)
                ->orderBy('id', $request->id_sort)
                ->paginate(8);
        }
        else if($request->filled('search') && isset($request->name_sort)) {
            $shipments = Shipment::search($request->search)
                ->where('webshop', Auth::user()->webshop)
                ->orderBy('name', $request->name_sort)
                ->paginate(8);
        }
        else if($request->filled('search')) {
            $shipments = Shipment::search($request->search)
                ->where('webshop', Auth::user()->webshop)
                ->paginate(8);
        }
        else if(isset($request->id_sort)) {
            $shipments = $this->shipRepo
                ->getAllOrderBy('id', $request->id_sort);
        }
        else if(isset($request->name_sort)) {
            $shipments = $this->shipRepo
                ->getAllOrderBy('name', $request->name_sort);
        }
        else {
            $shipments = Shipment::where('webshop', Auth::user()->webshop)->paginate(8);
        }

        return view('/labelList', compact('shipments'));
    }

    public function handleLabels(Request $request)
    {
        $hasLabel = false;
        $listShipments = [];
        foreach($this->shipRepo->getAll() as $package)
        {
            $id = $package->id;
            if($request->$id == "on")
            {
                switch ($request->input('action')) {
                    case 'Maak DHL label':
                    case 'Make DHL label':
                        if($this->shipRepo->find($id)->label_id == null)
                        {
                            $this->createLabelForPackage($id, "DHL");
                        }
                        else
                        {
                            $hasLabel = true;
                        }
                        break;
                    case 'Maak PostNL label':
                    case 'Make PostNL label':
                        if($this->shipRepo->find($id)->label_id == null)
                        {
                            $this->createLabelForPackage($id, "PostNL");
                        }
                        else
                        {
                            $hasLabel = true;
                        }
                        break;
                    case 'Maak UPS label':
                    case 'Make UPS label':
                        if($this->shipRepo->find($id)->label_id == null)
                        {
                            $this->createLabelForPackage($id, "UPS");
                        }
                        else
                        {
                            $hasLabel = true;
                        }
                        break;
                    case 'Downloaden':
                    case 'Download':
                        $listShipments[] = $id;
                        break;
                }
            }
        }

        if($request->input('action') == "Download" && count($listShipments) > 0)
        {
            return $this->printLabels($listShipments)->download('pdf_file.pdf');
        } else
        {
            if($hasLabel)
            {
                return redirect('labelList')
                    ->with('duplicate', 'Een of meer van de geselecteerde pakketjes hebben al een label. Voor deze pakketjes is geen nieuw label aangemaakt.');
            }
            else
            {
                return redirect('labelList');
            }
        }
    }

    public function createPickUpForShipment(Request $request)
    {
        $request->validate([
            'pickUpDate' => 'required|after_or_equal:' . now()->addDays(2),
            'pickUpTime' => 'required|before_or_equal: 15:00',
            'postcode' => 'required',
            'huisnummer' => 'required'
        ], [
            'pickUpDate.after_or_equal' => 'De pickup aanvraag moet minimaal 2 dagen van te voren geplanned worden.',
            'pickUpDate.required' => 'Het is verplicht een datum in te vullen',
            'pickUpTime.before_or_equal' => 'Een pickup aanvraag moet voor 15:00 plaats vinden',
            'pickUpTime.required' => 'Het is verplicht een tijdstip in te vullen',
            'postcode.required' => 'Het is verplicht een postcode in te vullen',
            'huisnummer.required' => 'Het is verplicht een postcode in te vullen'
        ]);

        $pickUp = new PickUpRequest();
        $pickUp->start = $request->pickUpDate;
        $pickUp->time = $request->pickUpTime;
        $pickUp->postcode = $request->postcode;
        $pickUp->huisnummer = $request->huisnummer;
        $pickUp->title = 'Bestelling: ' . $this->shipRepo->find($request->pickUpId)->id;
        $pickUp->end = $request->pickUpDate;
        $pickUp->save();

        $shipment = $this->shipRepo->find($request->pickUpId);
        $shipment->pickUpRequest_id = $pickUp->id;
        $this->shipRepo->update($shipment, $request->pickUpId);

        return redirect('labelList');
    }

    public function createLabelForPackage($id, $company)
    {
        $label = new Label();
        $label->trackAndTrace = $this->generateTrackAndTrace();
        $label->company_id = $this->compRepo->findWhere($company)->first();
        $label->save();

        $shipment = $this->shipRepo->find($id);
        $shipment->label_id = $label->id;
        $this->shipRepo->update($shipment, $id);

        return redirect('labelList');
    }

    public function printLabels($listShipments)
    {
        foreach($listShipments as $shipment)
        {
            $findLabel = $this->labRepo->find($this->shipRepo->find($shipment)->label_id);
            $findCompany = $this->compRepo->find($this->labRepo->find($this->shipRepo->find($shipment)->label_id)->company_id);
            $findShipment = $this->shipRepo->find($shipment);

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
