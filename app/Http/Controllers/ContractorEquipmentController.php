<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ContractorEquipmentController extends Controller
{
    private $baseApi = "localhost:8001";

    private function getData($url)
    {
        $url = config('global.api_url') . "" . $url;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = $response->getBody();
        return $responseBody;
    }

    private function updateData($url, $array)
    {
        $client = new Client();
        $url = config('global.api_url') . "" . $url;

        $response = $client->request('POST', $url, ['form_params' => $array]);

        $responseBody = $response->getBody();

        return  $responseBody;
    }

    private function insertData($url, $array)
    {
        $client = new Client();
        $url = config('global.api_url') . "" . $url;

        $response = $client->request('POST', $url, ['form_params' => $array]);

        $responseBody = $response->getBody();

        return  $responseBody;
    }

    private function DeleteData($url)
    {
        $url = config('global.api_url') . "" . $url;
        $client = new Client();
        $response = $client->request('DELETE', $url, [
            'verify'  => false,
        ]);
        $responseBody = $response->getBody();
        return $responseBody;
    }
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function ContractorEquipment()
    {
        $url = "/api/DataContractorEquipment";
        $responseBody = $this->getData($url);

        return view('contractor_equipment.contractor-equipment', compact('responseBody'));
    }
    public function getContractorEquipment()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $url = "/api/DataContractorEquipment/".$contractorID;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->No = $i+1;
        }

        return  json_encode($responseBody);
    }

    public function getContractorEquipmentByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataContractorEquipmentByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateContractorEquipment()
    {
        $id = $_POST['id'];
        $EquipmentName= $_POST['EquipmentName'];
        $BusinessPartnerID= $_POST['BusinessPartnerID'];
        $UnitID= $_POST['UnitID'];
        $MobilizationDate= $_POST['MobilizationDate'];
        $DemobilizationDate= $_POST['DemobilizationDate'];
        $url = "/api/UpdateContractorEquipment/". $id;
        // $sendData['ProjectID'] = $ProjectID;
        $sendData['EquipmentName'] = $EquipmentName;
        $sendData['BusinessPartnerID'] = $BusinessPartnerID;
        $sendData['UnitID'] = $UnitID;
        $sendData['MobilizationDate'] = $MobilizationDate;
        $sendData['DemobilizationDate'] = $DemobilizationDate;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function InsertContractorEquipment()
    {
        $EquipmentName= $_POST['EquipmentName'];
        $BusinessPartnerID= $_POST['BusinessPartnerID'];
        $UnitID= $_POST['UnitID'];
        $MobilizationDate= $_POST['MobilizationDate'];
        $DemobilizationDate= $_POST['DemobilizationDate'];
        $url = "/api/InsertContractorEquipment";
        $sendData['ProjectID'] = session()->get('ProjectID');
        $sendData['EquipmentName'] = $EquipmentName;
        $sendData['BusinessPartnerID'] = $BusinessPartnerID;
        $sendData['UnitID'] = $UnitID;
        $sendData['MobilizationDate'] = $MobilizationDate;
        $sendData['DemobilizationDate'] = $DemobilizationDate;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function DeleteContractorEquipment()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteContractorEquipment/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    // public function SessionConsultant()
    // {
    //     $data = [
    //         'ContracNumber'         => $request->ContracNumber,
    //         'BusinessPartnerID'     => $request->BusinessPartnerID,
    //         'StartDate'             => $request->StartDate,
    //         'EndDate'               => $request->EndDate,
    //         'Length'                => $request->Length,
    //         'TotalAmount'           => $request->TotalAmount,
    //         'ScopeOfWork'           => $request->ScopeOfWork
    //     ];
    // }

}
