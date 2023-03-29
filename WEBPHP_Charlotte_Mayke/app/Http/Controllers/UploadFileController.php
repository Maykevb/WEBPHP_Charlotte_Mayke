<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Shipment;
use App\Http\Controllers\Controller;

class UploadFileController extends Controller {

    private ShipmentController $shipmentCont;

    public function __construct() {
        $this->shipmentCont = new ShipmentController();
    }

    public function createForm(){
        return view('uploadFile');
    }

    public function fileUpload(Request $req){
        $req->validate([
            'file' => 'required|mimetypes:text/csv,text/plain,application/csv,text/comma-separated-values,text/
            anytext,application/octet-stream,application/txt|max:2048'
        ]);
        if($req->file()) {
            $file = $req->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $req->file('file')->storeAs('public/files', $filename);

            $uploaded = $this->shipmentCont->importCsv($filename);

            if ($uploaded) {
                return back()
                    ->with('success',"Bestand is geüpload.")
                    ->with('file', $filename);
            }
            else {
                return back()
                    ->with('fail',"Er ging iets mis, bestand is niet geüpload. Kloppen alle kolom namen? Check dit en probeer opnieuw.")
                    ->with('file', $filename);
            }
        }
    }
}
