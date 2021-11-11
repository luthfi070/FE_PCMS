<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MobilizationDateController extends Controller
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

    public function MobilizationDate()
    {
        $url = "/api/DataMobilizationDate";
        $responseBody = $this->getData($url);

        return view('risk_management.risk-management', compact('responseBody'));
    }
    public function getMobilizationDate()
    {
        $url = "/api/DataMobilizationDate";
        $responseBody = json_decode($this->getData($url));

        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->No = $i+1;
        }

        return  json_encode($responseBody);
    }

   

    public function getMobilizationDateByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataMobilizationDateByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    
    public function InsertMobilizationDate()
    {
        $BusinessPartnerID= $_POST['BusinessPartnerID'];
        $PersonilID= $_POST['PersonilID'];
        $PositionCatID= $_POST['PositionCatID'];
        $PositionID= $_POST['PositionID'];
        $MobilDate = request('MobilDate');
        $dataMobilDate = json_decode($MobilDate, true);

        $StarDateMobilization = $dataMobilDate[0];
        $EndDateMobilization = $dataMobilDate[1];
        
        $url = "/api/InsertMobilizationDate";
        $sendData['ProjectID'] = session()->get('ProjectID');
        $sendData['BusinessPartnerID'] = $BusinessPartnerID;
        $sendData['PersonilID'] = $PersonilID;
        $sendData['PositionCatID'] = $PositionCatID;
        $sendData['PositionID'] = $PositionID;
        $sendData['StarDateMobilization'] = $StarDateMobilization;
        $sendData['EndDateMobilization'] = $EndDateMobilization;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function updateMobilizationDate()
    {
        $id = $_POST['id'];
        $BusinessPartnerID= $_POST['BusinessPartnerID'];
        $PersonilID= $_POST['PersonilID'];
        $PositionCatID= $_POST['PositionCatID'];
        $PositionID= $_POST['PositionID'];
        $MobilDate = request('MobilDate');
        $dataMobilDate = json_decode($MobilDate, true);

        $StarDateMobilization = $dataMobilDate[0];
        $EndDateMobilization = $dataMobilDate[1];
        
        $url = "/api/UpdateMobilizationDate". $id;
        // $sendData['ProjectID'] = session()->get('ProjectID');
        $sendData['BusinessPartnerID'] = $BusinessPartnerID;
        $sendData['PersonilID'] = $PersonilID;
        $sendData['PositionCatID'] = $PositionCatID;
        $sendData['PositionID'] = $PositionID;
        $sendData['StarDateMobilization'] = $StarDateMobilization;
        $sendData['EndDateMobilization'] = $EndDateMobilization;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    public function DeleteMobilizationDate()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteMobilizationDate/" . $id;
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

    public function getMobilizationPositionCategory(){
        $id = $_POST['id'];
        $url = "/api/DataMobilizationPositionCat/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getMobilizationPosition(){
        $id = $_POST['id'];
        $url = "/api/DataMobilizationPosition/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }
}
