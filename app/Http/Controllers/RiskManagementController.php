<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RiskManagementController extends Controller
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

    public function RiskManagement()
    {
        $url = "/api/DataRiskManagement";
        $responseBody = $this->getData($url);

        return view('risk_management.risk-management', compact('responseBody'));
    }
    public function getRiskManagement()
    {
        $url = "/api/DataRiskManagement";
        $responseBody = json_decode($this->getData($url));

        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->No = $i+1;
        }

        return  json_encode($responseBody);
    }

    public function getRiskManagementByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataRiskManagementByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateRiskManagement()
    {
        $id = $_POST['id'];
        $DescriptionRisk= $_POST['DescriptionRisk'];
        $ProjectID= $_POST['ProjectID'];
        $PersonilID= $_POST['PersonilID'];
        $Rank= $_POST['Rank'];
        $DueDateRisk= $_POST['DueDateRisk'];
        $Mitigation= $_POST['Mitigation'];
        $url = "/api/UpdateRiskManagement/". $id;
        $sendData['DescriptionRisk'] = $DescriptionRisk;
        $sendData['ProjectID'] = $ProjectID;
        $sendData['PersonilID'] = $PersonilID;
        $sendData['Rank'] = $Rank;
        $sendData['DueDateRisk'] = $DueDateRisk;
        $sendData['Mitigation'] = $Mitigation;

        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function InsertRiskManagement()
    {
        $DescriptionRisk= $_POST['DescriptionRisk'];
        $PersonilID= $_POST['PersonilID'];
        $Rank= $_POST['Rank'];
        $DueDateRisk= $_POST['DueDateRisk'];
        $Mitigation= $_POST['Mitigation'];
        $url = "/api/InsertRiskManagement";
        $sendData['ProjectID'] = session()->get('ProjectID');
        $sendData['DescriptionRisk'] = $DescriptionRisk;
        $sendData['PersonilID'] = $PersonilID;
        $sendData['Rank'] = $Rank;
        $sendData['DueDateRisk'] = $DueDateRisk;
        $sendData['Mitigation'] = $Mitigation;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function DeleteRiskManagement()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteRiskManagement/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    public function SessionConsultant(Request $request)
    {
        $data = [
            'ContracNumber'         => $request->ContracNumber,
            'BusinessPartnerID'     => $request->BusinessPartnerID,
            'StartDate'             => $request->StartDate,
            'EndDate'               => $request->EndDate,
            'Length'                => $request->Length,
            'TotalAmount'           => $request->TotalAmount,
            'ScopeOfWork'           => $request->ScopeOfWork
        ];
    }
}
