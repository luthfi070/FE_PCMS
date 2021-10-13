<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PerformanceAnalysisController extends Controller
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
        $responseBody = json_decode($responseBody);
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->no = $i + 1;
        }
        return json_encode($responseBody);
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
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function getPerformanceList(){
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url='/api/getPerformanceList/'. $projectID . "/" . $contractorID;
        $responseBody = json_decode($this->getData($url));
        for($i=0;$i<count($responseBody);$i++){
            $responseBody[$i]->action = '<a type="button" class="detail-btn btn btn-primary  waves-effect waves-light m-1" href="/performanceanalysisreportdetail/' . $responseBody[$i]->id . '">Details</a>';
        }
        return json_encode($responseBody);
    }

    public function getPerformanceDetail()
    {
        // $contractorid=$_POST['contractorid'];
        // $projectid=$_POST['contractorid'];
        // $contractorID = $_POST['contractorID'];
        // $projectID = session('ProjectID');
        $docID=$_POST['docID'];
        $url = "/api/getPerformanceDetail/".$docID;
        $responseBody = json_decode($this->getData($url));
       
        for ($i = 0; $i < count($responseBody); $i++) {
    
            if($responseBody[$i]->CV < 0){
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->CV > 0){
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->SV < 0){
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->SV > 0){
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->CPI < 1){
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->CPI > 1){
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->SPI < 1){
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->SPI > 1){
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }
            
        }
        return  json_encode($responseBody);
    }
    
    public function getPerformance()
    {
        // $contractorid=$_POST['contractorid'];
        // $projectid=$_POST['contractorid'];
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/getPerformance/" . $projectID . "/" . $contractorID;
        $responseBody = json_decode($this->getData($url));
        $actualcost=0;
        $plancost=0;
        $EV=0;
        $CV=0;
        $SV=0;
        $CPI=0;
        $SPI=0;
        $EAC1=0;
        $EAC3=0;
        $EAC4=0;
        for ($i = 0; $i < count($responseBody); $i++) {
            $actualcost+=$responseBody[$i]->TOTAL_ACTUAL_COST;
            $plancost+=$responseBody[$i]->ACC_TOTAL_PLANNED_COST;
            $EV+=$responseBody[$i]->EV;
        $CV+=$responseBody[$i]->CV;
        $SV+=$responseBody[$i]->SV;
        $CPI+=$responseBody[$i]->CPI;
        $SPI+=$responseBody[$i]->SPI;
        $EAC1+=$responseBody[$i]->EAC1;
        $EAC3+=$responseBody[$i]->EAC3;
        $EAC4+=$responseBody[$i]->EAC4;
        }
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->ALL_ACTUAL_COST=$actualcost;
            $responseBody[$i]->ALL_PLAN_COST=$plancost;
            $responseBody[$i]->ALL_EV=$EV;
            $responseBody[$i]->ALL_CV=$CV;
            $responseBody[$i]->ALL_SV=$SV;
            $responseBody[$i]->ALL_CPI=$CPI;
            $responseBody[$i]->ALL_SPI=$SPI;
            $responseBody[$i]->ALL_EAC1=$EAC1;
            $responseBody[$i]->ALL_EAC3=$EAC3;
            $responseBody[$i]->ALL_EAC4=$EAC4;
            if($responseBody[$i]->CV < 0){
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->CV > 0){
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->SV < 0){
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->SV > 0){
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->CPI < 1){
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->CPI > 1){
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->SPI < 1){
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->SPI > 1){
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            $responseBody[$i]->EAC2='<input type="number" style="width:150px" class="form-control EAC2" name="EAC'.$i.'" id="EAC'.$i.'"/>';
            
        }
        return  json_encode($responseBody);
    }

    public function getDataPerformance($id)
    {
        // $contractorid=$_POST['contractorid'];
        // $projectid=$_POST['contractorid'];
        $contractorID = $id;
        $projectID = session('ProjectID');
        $url = "/api/getPerformance/" . $projectID . "/" . $contractorID;
        $responseBody = json_decode($this->getData($url));
        $actualcost=0;
        $plancost=0;
        $EV=0;
        $CV=0;
        $SV=0;
        $CPI=0;
        $SPI=0;
        $EAC1=0;
        $EAC3=0;
        $EAC4=0;
        for ($i = 0; $i < count($responseBody); $i++) {
            $actualcost+=$responseBody[$i]->TOTAL_ACTUAL_COST;
            $plancost+=$responseBody[$i]->ACC_TOTAL_PLANNED_COST;
            $EV+=$responseBody[$i]->EV;
        $CV+=$responseBody[$i]->CV;
        $SV+=$responseBody[$i]->SV;
        $CPI+=$responseBody[$i]->CPI;
        $SPI+=$responseBody[$i]->SPI;
        $EAC1+=$responseBody[$i]->EAC1;
        $EAC3+=$responseBody[$i]->EAC3;
        $EAC4+=$responseBody[$i]->EAC4;
        }
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->ALL_ACTUAL_COST=$actualcost;
            $responseBody[$i]->ALL_PLAN_COST=$plancost;
            $responseBody[$i]->ALL_EV=$EV;
            $responseBody[$i]->ALL_CV=$CV;
            $responseBody[$i]->ALL_SV=$SV;
            $responseBody[$i]->ALL_CPI=$CPI;
            $responseBody[$i]->ALL_SPI=$SPI;
            $responseBody[$i]->ALL_EAC1=$EAC1;
            $responseBody[$i]->ALL_EAC3=$EAC3;
            $responseBody[$i]->ALL_EAC4=$EAC4;
            if($responseBody[$i]->CV < 0){
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->CV > 0){
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_1 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->SV < 0){
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->SV > 0){
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_2 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->CPI < 1){
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->CPI > 1){
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_3 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            if($responseBody[$i]->SPI < 1){
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i>';
            }else if($responseBody[$i]->SPI > 1){
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i>';
            }else{
                $responseBody[$i]->status_4 = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i>';
            }

            $responseBody[$i]->EAC2='<input type="number" style="width:150px" class="form-control EAC2" name="EAC'.$i.'" id="EAC'.$i.'"/>';
            
        }
        return  $responseBody;
    }

    public function saveReport(){
        $contractorID = $_POST['contractorID'];
        $eac2=$_POST['eac2'];
        $dataReport['documentName'] = $_POST['title'];
        $dataReport['documentType'] = 'performanceReport';
        $dataReport['author'] = $_POST['createdby'];
        $dataReport['desc'] = $_POST['description'];
        $dataReport['projectID'] = session('ProjectID');
        $dataReport['contractorID'] = $contractorID;
        $dataReport['reportingDate'] = $_POST['date'];

        $data=$this->getDataPerformance($contractorID);
        $url = "/api/InsertDataDocument";
        $resp= $this->insertData($url, $dataReport);
        $resp = json_decode($resp);
        $docID=$resp->doc_insert_id;

        for($i=0;$i<count($data);$i++){
            
            $sendData['itemID']=$data[$i]->parentItem;
            $sendData['AC']=$data[$i]->TOTAL_ACTUAL_COST;
            $sendData['PC']=$data[$i]->ACC_TOTAL_PLANNED_COST;
            $sendData['EV']=$data[$i]->EV;
            $sendData['CV']=$data[$i]->CV;
            $sendData['SV']=$data[$i]->SV;
            $sendData['CPI']=$data[$i]->CPI;
            $sendData['SPI']=$data[$i]->SPI;
            $sendData['EAC1']=$data[$i]->EAC1;
            $sendData['EAC2']=$eac2;
            $sendData['EAC3']=$data[$i]->EAC3;
            $sendData['EAC4']=$data[$i]->EAC4;
            $sendData['docID']=$docID;
            $url = "/api/InsertPerformance";
            $responseBody=$this->insertData($url, $sendData);
        }

        return $responseBody;
        
    }


}
