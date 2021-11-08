<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
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

    private function updateDataSetDefault($url)
    {
        $client = new Client();
        $url = config('global.api_url') . "" . $url;

        $response = $client->request('POST', $url);

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

    public function Project()
    {
        $url = "/api/GetDataProject";

        $responseBody = $this->getData($url);
        return view('project.project', compact('responseBody'));
    }
    public function getProject()
    {
        // if (isset($_GET['idPartner'])) {
        //     $url = "/api/GetDataProject/".$_GET['idPartner'];
        //     // $session = session('ProjectID');
        //     $responseBody = json_decode($this->getData($url));
        //     // $session = session('ProjectID');

        //     for ($i = 0; $i < count($responseBody); $i++) {
        //         $responseBody[$i]->action = ' <button type="button" class="btn btn-info  waves-effect waves-light m-1"  data-id="' . $responseBody[$i]->ProjectID . '">Set Default</button>
        //     <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->ProjectID . '">EDIT</button>
        //     <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->ProjectID . '">DELETE</button>';
        //         $responseBody[$i]->No = $i + 1;
        //     }

        //     return  json_encode($responseBody);
        // } else {
            $url = "/api/GetDataProject";
            // $session = session('ProjectID');
            $responseBody = json_decode($this->getData($url));
            // $session = session('ProjectID');

            for ($i = 0; $i < count($responseBody); $i++) {
                if(session('PrivilegedStatus')==1){
                    
                    $responseBody[$i]->action = ' <button type="button" class="btn btn-info  waves-effect waves-light m-1"  data-id="' . $responseBody[$i]->ProjectID . '">Set Default</button>
                <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->ProjectID . '">EDIT</button>
                <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->ProjectID . '">DELETE</button>';
                    $responseBody[$i]->No = $i + 1;
                }else{
                    $responseBody[$i]->action = ' <button type="button" class="btn btn-info  waves-effect waves-light m-1"  data-id="' . $responseBody[$i]->ProjectID . '">Set Default</button>';
                        $responseBody[$i]->No = $i + 1;
                }
            // }

        }
        return  json_encode($responseBody);
    }

    public function getProjectByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataProjectByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

       public function getprojectnumberByidproject()
    {
        $id = $_POST['id'];
        $url = "/api/DataProjectnumberByid/" . $id;
        // $responseBody = $this->getData($url);
        $responseBody = json_decode($this->getData($url));
        // $session = session('ProjectID');

        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id. '">DELETE</button>';
            // $responseBody[$i]->No = $i+1;
        }
        return  $responseBody;
    }
    public function getprojectnumberByidprojectContractor()
    {
        $id = $_POST['id'];
        $url = "/api/DataProjectnumberByidContractor/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id. '">DELETE</button>';
            // $responseBody[$i]->No = $i+1;
        }
        return  $responseBody;
    }

    public function updateProject()
    {
        $id = $_POST['id'];
        $ProjectName = $_POST['ProjectName'];
        $ProjectOwner = $_POST['ProjectOwner'];
        $ProjectDesc = $_POST['ProjectDesc'];
        $ProjectManager = $_POST['ProjectManager'];
        $ContractAmount = $_POST['ContractAmount'];
        $village_id = $_POST['village_id'];
        $url = "/api/UpdateDataProject/" . $id;
        $sendData['ProjectName'] = $ProjectName;
        $sendData['ProjectOwner'] = $ProjectOwner;
        $sendData['ProjectDesc'] = $ProjectDesc;
        $sendData['ProjectManager'] = $ProjectManager;
        $sendData['ContractAmount'] = $ContractAmount;
        $sendData['village_id'] = $village_id;
        
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }




    public function InsertProject()
    {

        $ProjectName = $_POST['ProjectName'];
        $ProjectOwner = $_POST['ProjectOwner'];
        $ProjectDesc = $_POST['ProjectDesc'];
        $ProjectManager = $_POST['ProjectManager'];
        $ContractAmount = $_POST['ContractAmount'];
        $consultant = request('Consultant');
        $constructor = request('Constructor');
        $village_id = $_POST['village_id'];

        $dataConstructor = json_decode($constructor, true);
        $dataConsultant = json_decode($consultant, true);

        $ContractNumberConsultant = $dataConsultant[0];
        $Consultant = $dataConsultant[1];
        $ProjectManagerConsultant = $dataConsultant[2];
        $PositionConsultant = $dataConsultant[3];
        $ScopeOfWorkConsultant = $dataConsultant[4];
        $StartConsultant = $dataConsultant[5];
        $EndConsultant = $dataConsultant[6];
        $ContractAmountConsultant = $dataConsultant[7];


        $ContractNumberContractor = $dataConstructor[0];
        $Contractor = $dataConstructor[1];
        $ProjectManagerContractor = $dataConstructor[2];
        $PositionContractor = $dataConstructor[3];
        $ScopeOfWorkContractor = $dataConstructor[4];
        $StartContractor = $dataConstructor[5];
        $EndContractor = $dataConstructor[6];
        $ContractAmountContractor = $dataConstructor[7];











        // return response()->json($insertConsultant);


        // $Length= $_POST['Length'];
        // $CommencementDate= $_POST['CommencementDate'];
        // $CompletionDate= $_POST['CompletionDate'];
        // $ProjectDuration= $_POST['ProjectDuration'];

        $CurrencyType = $_POST['CurrencyType'];
        $url = "/api/InsertDataProject";
        $projectNumber = "/api/InsertProjectNumber";
        $sendData['ProjectName'] = $ProjectName;
        $sendData['ProjectOwner'] = $ProjectOwner;
        $sendData['ProjectDesc'] = $ProjectDesc;
        $sendData['ProjectManager'] = $ProjectManager;
        $sendData['ContractAmount'] = $ContractAmount;
        $sendData['village_id'] = $village_id;

        $sendData['Length'] = 0;
        $sendData['CommencementDate'] =  null; //$StartConsultant;
        $sendData['CompletionDate'] =  null; //$EndConsultant;
        $sendData['ProjectDuration'] = (strtotime($EndConsultant) - strtotime($StartConsultant)) / 84600;
        $sendData['CurrencyType'] = $CurrencyType;
        $responseBodyProject = $this->insertData($url, $sendData);

        $url = "/api/getLastProjectID/";
        $responseBody = $this->getData($url);
        $id = json_decode($responseBody, true);

        $senDataPN['ContractNumber'] =  $ContractNumberConsultant;
        $senDataPN['ProjectID'] =  $id;
        $senDataPN['BusinessPartnerID'] =  $Consultant;
        //$senDataPN ['PositionID'] =  $PositionConsultant;
        $senDataPN['ScopeOfWork'] =  $ScopeOfWorkConsultant;
        $senDataPN['StartDate'] =  $StartConsultant;
        $senDataPN['EndDate'] =  $EndConsultant;
        $senDataPN['TotalAmount'] =  $ContractAmountConsultant;
        $urlPN = "/api/InsertProjectNumber";
        $responseBodyPN = $this->insertData($urlPN, $senDataPN);

        $senDataPN['ContractNumber'] =  $ContractNumberContractor;
        $senDataPN['BusinessPartnerID'] =  $Contractor;
        //$senDataPN ['PositionID'] =  $PositionContractor;
        $senDataPN['ScopeOfWork'] =  $ScopeOfWorkContractor;
        $senDataPN['StartDate'] =  $StartContractor;
        $senDataPN['EndDate'] =  $EndContractor;
        $senDataPN['TotalAmount'] =  $ContractAmountContractor;

        $responseBodyPN = $this->insertData($urlPN, $senDataPN);

        return  $responseBodyProject;
    }

    public function getLastProjectID()
    {

        $url = "/api/getLastProjectID/";
        $responseBody = $this->getData($url);
        $id = json_decode($responseBody, true);
        return $id;
    }

    public function ProjectIDConsultant(){
       
        $id = $_POST['id'];
        $url = "/api/getProjectIDConsultant/".$id;
        $responseBody = $this->getData($url);
        $ProjectID = json_decode($responseBody, true);
        return  $responseBody;
    }
    public function ProjectIDContractor(){
       
        $id = $_POST['id'];
        $url = "/api/getProjectIDConContractor/".$id;
        $responseBody = $this->getData($url);
        $ProjectID = json_decode($responseBody, true);
        return  $responseBody;
    }

    public function addProjectNumber()
    {
        $ContractNumberConsultant= $_POST['ContractNumberConsultant'];
        $Consultant= $_POST['Consultant'];
        // $segments = request()->segments();
        // $last  = end($segments);
        $ProjectidConsultant= $_POST['ProjectidConsultant'];
        $StartConsultant= $_POST['StartConsultant'];
        $EndConsultant= $_POST['EndConsultant'];
        $ContractAmountConsultant= $_POST['ContractAmountConsultant'];
        $ScopeOfWorkConsultant= $_POST['ScopeOfWorkConsultant'];
        // $idProject= $_POST['idProject'];

        // 

        $url = "/api/InsertProjectNumber";
        $senData ['ContractNumber'] = $ContractNumberConsultant;
        $senData ['ProjectID'] =  $ProjectidConsultant;
        $senData ['BusinessPartnerID'] =  $Consultant;
        $senData ['ScopeOfWork'] =  $ScopeOfWorkConsultant;
        $senData ['StartDate'] =  $StartConsultant;
        $senData ['EndDate'] =  $EndConsultant;
        $senData ['TotalAmount'] =  $ContractAmountConsultant;
        $responseBody = $this->insertData($url, $senData);

        return  $responseBody;
    }

    public function addProjectNumberContractor()
    {
        $ContractNumberContractor= $_POST['ContractNumberContractor'];
        $Contractor= $_POST['Contractor'];
        // $segments = request()->segments();
        // $last  = end($segments);
        $ProjectidContractor= $_POST['ProjectidContractor'];
        $StartContractor= $_POST['StartContractor'];
        $EndContractor= $_POST['EndContractor'];
        $ContractAmountContractor= $_POST['ContractAmountContractor'];
        $ScopeOfWorkContractor= $_POST['ScopeOfWorkContractor'];
        // $idProject= $_POST['idProject'];

        // 

        $url = "/api/InsertProjectNumber";
        $senData ['ContractNumber'] = $ContractNumberContractor;
        $senData ['ProjectID'] =  $ProjectidContractor;
        $senData ['BusinessPartnerID'] =  $Contractor;
        $senData ['ScopeOfWork'] =  $ScopeOfWorkContractor;
        $senData ['StartDate'] =  $StartContractor;
        $senData ['EndDate'] =  $EndContractor;
        $senData ['TotalAmount'] =  $ContractAmountContractor;
        $responseBody = $this->insertData($url, $senData);

        return  $responseBody;
    }

    public function getLastProjectnumber(){
       
        $url = "/api/DataLastProjectnumber/";
        $responseBody = $this->getData($url);
        $id = json_decode($responseBody, true);
        return $id+1;
    }



    public function deleteProject()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataProject/" . $id;
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

    public function updateProjectSetDefault()
    {

        $id = $_POST['id'];
        // $SetDefault=$_POST['SetDefault'];
        $url = "/api/UpdateDataProjectSetDefault/" . $id;
        // $sendData['SetDefault'] = $SetDefault;
        $responseBody = $this->updateDataSetDefault($url);
        $this->getProjectiDSetDefault();
        return  $responseBody;
    }

    public function getProjectiDSetDefault()
    {

        $url = "/api/GetDataProjectSetDefault";
        $responseBody = $this->getData($url);
        $project = json_decode($responseBody, true);
        session()->put('ProjectID', $project['ProjectID']);
        session()->put('ProjectName', $project['ProjectName']);
    }

    public function getProjectOwner()
    {
        $url = "/api/GetDataProjectOwner";
        $responseBody = $this->getData($url);
        return $responseBody;
    }

    public function getProjectManagerOwner()
    {
        $id = $_POST['id'];
        $url = "/api/GetDataProjectManagerOwner/" . $id;
        $responseBody = $this->getData($url);
        return $responseBody;
    }
}
