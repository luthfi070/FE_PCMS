<?php

namespace App\Http\Controllers;

use App\Imports\WbsImport;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BaselineWbsController extends Controller
{
    private $baseApi = "localhost:8001";

    public function getData($url)
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

    public function updateData($url, $array)
    {
        $client = new Client();
        $url = config('global.api_url') . "" . $url;

        $response = $client->request('POST', $url, ['form_params' => $array]);

        $responseBody = $response->getBody();

        return  $responseBody;
    }

    public function insertData($url, $array)
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


    public function getWbs()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataWbs/" . $contractorID . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));
        $x = 0;
        $z = 1;
        $y = 1;
        $parentNo = 0;
        $childNo = 1;
        $arr = array();
        $totalDuration = array();
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->weight=round($responseBody[$i]->weight,2);
            $responseBody[$i]->action = ' <button type="button" class="btn-form-child btn btn-info  waves-effect waves-light m-1" data-lvl="' . $responseBody[$i]->parentLevel . '" data-id="' . $responseBody[$i]->id . '">Add Child Item</button>
            <button class="edit-btn-parent btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->duration = '<input type="text" readonly class="form-control" style="background-color: rgba(21, 14, 14, 0)" id="parent_duration_' . $responseBody[$i]->id . '" value="0"/>';
            $responseBody[$i]->startDates = '';
            $responseBody[$i]->endDates = '';

            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            if ($responseBody[$i]->parentItem == null) {
                $parentNo++;
                $responseBody[$i]->merge = $parentNo;
                $y = 1;
                $childNo = 1;
                $totalDuration[$responseBody[$i]->id] = 0;
            } else {
                $arrx = array(
                    'id' => $responseBody[$i]->id,
                    'mergeBase' => $responseBody[$i]->parentItem . '.' . $y
                );
                array_push($arr, $arrx);
                $duration = (new DateTime($responseBody[$i]->startDate))->diff(new DateTime($responseBody[$i]->endDate))->format("%a");
                $totalDuration[$responseBody[$i]->parentItem] += $duration;
                $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
                <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
                $responseBody[$i]->merge = $parentNo . '.' . $childNo;
                $responseBody[$i]->duration = '<input type="text" readonly class="form-control" style="background-color: rgba(21, 14, 14, 0)" id="duration_' . $responseBody[$i]->id . '" value="'.$duration." Days".'"/>';
                $responseBody[$i]->startDates = '<input type="date" class="startDate form-control" name ="startDate_' . $responseBody[$i]->id . '" id ="startDate_' . $responseBody[$i]->id . '" data-id="' . $responseBody[$i]->id . '" value="'.str_replace('/','-',$responseBody[$i]->startDate) .'">';
                if($responseBody[$i]->endDate==null){
                    $responseBody[$i]->endDates = '<input type="date" readonly class="endDate form-control" name ="endDate_' . $responseBody[$i]->id . '" id ="endDate_' . $responseBody[$i]->id . '" data-id="' . $responseBody[$i]->id . '" value="'.str_replace('/','-',$responseBody[$i]->endDate) .'">';
                }else{
                    $responseBody[$i]->endDates = '<input type="date" class="endDate form-control" name ="endDate_' . $responseBody[$i]->id . '" id ="endDate_' . $responseBody[$i]->id . '" data-id="' . $responseBody[$i]->id . '" value="'.str_replace('/','-',$responseBody[$i]->endDate) .'">';
                }
                
                for ($j = 0; $j < count($arr); $j++) {
                    if ($arr[$j]['id'] == $responseBody[$i]->parentItem) {
                        $responseBody[$i]->merge = $arr[$j]['mergeBase'] . '.' . ($z);
                        $z += 1;
                    }
                }
                $y += 1;
                $x += 1;
                $childNo++;
            }
        }

        // add total duration for parent
        foreach($responseBody as $item){
            if($item->parentItem == null){
                if(isset($totalDuration[$item->id])){
                    $item->duration = '<input type="text" readonly class="form-control" style="background-color: rgba(21, 14, 14, 0)" id="parent_duration_' . $item->id . '" value="'. $totalDuration[$item->id].' Days' .'"/>';
                }
            }
        }

        // print_r($arr);die();

        return  json_encode($responseBody);
    }

    public function getWbsLevel()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataWbsLevel/" . $contractorID . '/' . $_POST['id'] . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));
        $x = 0;
        $z = 1;
        $y = 1;
        $arr = array();
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button type="button" class="btn-form-child btn btn-info  waves-effect waves-light m-1" data-lvl="' . $responseBody[$i]->parentLevel . '" data-id="' . $responseBody[$i]->id . '">Add Child Item</button>
            <button class="edit-btn-parent btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';


            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            if ($responseBody[$i]->parentItem == null) {
                $responseBody[$i]->merge = $responseBody[$i]->no - $x;
                $y = 1;
            } else {
                $arrx = array(
                    'id' => $responseBody[$i]->id,
                    'mergeBase' => $responseBody[$i]->parentItem . '.' . $y
                );
                array_push($arr, $arrx);
                $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
                <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
                $responseBody[$i]->merge = $responseBody[$i]->parentItem . '.' . $y;
                for ($j = 0; $j < count($arr); $j++) {
                    if ($arr[$j]['id'] == $responseBody[$i]->parentItem) {
                        $responseBody[$i]->merge = $arr[$j]['mergeBase'] . '.' . ($z);
                        $z += 1;
                    }
                }
                $y += 1;
                $x += 1;
            }
        }

        // print_r($arr);die();

        return  json_encode($responseBody);
    }

    public function getWbschild()
    {
        $id = $_POST['idParent'];
        $url = "/api/DataWbschild/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
        }

        return  json_encode($responseBody);
    }

    public function getWbschildHistory()
    {
        $id = $_POST['idParent'];
        $url = "/api/DataWbschildHistory/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
        }

        return  json_encode($responseBody);
    }

    public function getWbsHistory()
    {
        $url = "/api/DataWbsHistory";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="detail-btn btn btn-secondary  waves-effect waves-light m-1" 
            data-id="' . $responseBody[$i]->id . '" 
            data-idContractor="' . $responseBody[$i]->contractorID . '" 
            data-createdAt="' . $responseBody[$i]->created_at . '" 
            data-idProject="' . $responseBody[$i]->ProjectID . '">DETAIL</button>';
            $responseBody[$i]->version = 'Version ' . $responseBody[$i]->no;
        }



        return  json_encode($responseBody);
    }

    public function getWbsHistoryDetail()
    {
        // $ProjectID = $_POST['ProjectID'];
        $ProjectID = 1;
        // $contractorID = $_POST['contractorID'];
        $contractorID = '1';
        $created_at = explode(" ", $_POST['created_at']);
        $url = "/api/DataWbsByidHistory/" . $ProjectID . "/" . $contractorID . "/" . $created_at[0] . "/" . $created_at[1];
        $responseBody = json_decode($this->getData($url));
        $x = 0;
        $z = 1;
        $y = 1;
        $arr = array();
        for ($i = 0; $i < count($responseBody); $i++) {

            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            if ($responseBody[$i]->parentItem == null) {
                $responseBody[$i]->merge = $responseBody[$i]->no - $x;
            } else {
                $arrx = array(
                    'id' => $responseBody[$i]->id,
                    'mergeBase' => $responseBody[$i]->parentItem . '.' . $y
                );
                array_push($arr, $arrx);

                $responseBody[$i]->merge = $responseBody[$i]->parentItem . '.' . $y;
                for ($j = 0; $j < count($arr); $j++) {
                    if ($arr[$j]['id'] == $responseBody[$i]->parentItem) {
                        $responseBody[$i]->merge = $arr[$j]['mergeBase'] . '.' . ($z);
                        $z += 1;
                    }
                }
                $y += 1;
                $x += 1;
            }
        }
        return  json_encode($responseBody);
    }


    public function getWbsByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataWbsByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getWbsParentDuration($id){
        $url = "/api/getWbsParentDuration/" . $id;
        $url = config('global.api_url') . "" . $url;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = $response;
        return $responseBody;
    }

    public function updateWbsParent()
    {
        $id = $_POST['parentIDMain'];
        $name = $_POST['parentItem'];
        $level = $_POST['parentLevel'];
        $url = "/api/UpdateWbs/" . $id;
        $url2 = "/api/UpdateWbsChildParentLevel/" . $id;
        $sendData['itemName'] = $name;
        $sendData['Created_By'] = session('UserID');
        $sendData['level'] = 0;
        if ($level != null || $level != "") {
            $sendData['parentlevel'] = $level;
            //$sendData['ProjectID'] = $name;
            //$sendData['contractorID'] = $name;
            $responseBody = $this->updateData($url, $sendData);
            $sendDataLevel['parentlevel'] = $level;
            $responseBody2 = $this->updateData($url2, $sendDataLevel);
        } else {
            $responseBody = $this->updateData($url, $sendData);
        }


        return  $responseBody;
    }

    public function updateWbsChildDate()
    {
        $id = $_POST['id'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];


        $url = "/api/UpdateWbs/" . $id;
        $url2 = "/api/UpdateCurrentWbs/" . $id;

        $sendData['startDate'] = $startDate;
        $sendData['endDate'] = $endDate;

        $responseBody = $this->updateData($url, $sendData);
        $responseBody2 = $this->updateData($url2, $sendData);

        return  $responseBody;
    }


    public function updateWbsChild()
    {
        $id = $_POST['childID'];
        $name = $_POST['childItem'];
        $level = $_POST['childLevel'];
        $parentlevel = $_POST['parentLvl'];
        $unitTypechild = $_POST['unitTypechild'];
        $childQty = $_POST['childQty'];
        $currencyTypechild = $_POST['currencyTypechild'];
        $childAmount = $_POST['childAmount'];
        $parentID = $_POST['parentID'];
        $ProjectID=session('ProjectID');
        $contractorID=$_POST['contractorID'];

        $urlWeight = "/api/getWeightBaselineWbsByItem/" . $id;
        $responseBodyWeight = json_decode($this->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
        }
        $weight = round((($childQty * $childAmount) / $AllWeight) * 100,2);

        $url = "/api/UpdateWbs/" . $id;

        $sendData['itemName'] = $name;
        $sendData['hasChild'] = '';
        $sendData['qty'] = $childQty;
        $sendData['price'] = $childAmount;
        $sendData['amount'] = $childQty*$childAmount;
        $sendData['weight'] = $weight;
        //$sendData['ProjectID'] = '1';
        $sendData['unitID'] = $unitTypechild;
        //$sendData['contractorID'] = '1';
        $sendData['CurrencyID'] = $currencyTypechild;
        $sendData['Created_By'] =  session('UserID');
        $sendData['level'] = $level;
        $responseBody = $this->updateData($url, $sendData);
        if ($responseBody) {

            $urlWeight = "/api/getWeightWbs/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($this->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url1 = "/api/UpdateWbs/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $this->updateData($url1, $sendDataWeight);
                    $url2 = "/api/DataWbschild/" . $responseBodyWeight[$i]->parentID;
                    $responseBodyChild = json_decode($this->getData($url2));
                    for ($j = 0; $j < count($responseBodyChild); $j++) {
                        $url1 = "/api/UpdateWbs/" . $responseBodyChild[$j]->id;
                        $sendDataWeight['weight'] = ($responseBodyChild[$j]->amount / $responseBodyWeight[$i]->All_TOTAL)*100;
                        $this->updateData($url1, $sendDataWeight);
                    }
                }
            }
        }
        return  $responseBody;
    }

    public function addWbsParent()
    {

        $name = $_POST['parentItem'];
        $level = $_POST['parentLevel'];
        $contractorID = $_POST['contractorID'];
        $url = "/api/InsertDataWbs";
        $sendData['itemName'] = $name;
        $sendData['Created_By'] = session('UserID');
        $sendData['level'] = 0;
        $sendData['parentlevel'] = $level;
        $sendData['ProjectID'] = session('ProjectID');
        $sendData['contractorID'] = $contractorID;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function addWbsChild()
    {
        $name = $_POST['childItem'];
        $level = $_POST['childLevel'];
        $parentlevel = $_POST['parentLvl'];
        $unitTypechild = $_POST['unitTypechild'];
        $childQty = $_POST['childQty'];
        $currencyTypechild = $_POST['currencyTypechild'];
        $childAmount = $_POST['childAmount'];
        $parentID = $_POST['parentID'];
        $AllWeight = 0;
        $parentWeight = 0;

        $contractorID = $_POST['contractorID'];
        $ProjectID = session('ProjectID');
        $urlWeight = "/api/getWeightWbs/" . $ProjectID . '/' . $contractorID;
        $responseBodyWeight = json_decode($this->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
            $weight = (($childQty * $childAmount) / $AllWeight) * 100;
        }else{
            $weight = 100;
        }
            


        $url = "/api/InsertDataWbs";

        $sendData['itemName'] = $name;
        $sendData['parentItem'] = $parentID;
        $sendData['hasChild'] = '';
        $sendData['qty'] = $childQty;
        $sendData['price'] = $childAmount;
        $sendData['amount'] =  $childQty * $childAmount;
        $sendData['weight'] = $weight;
        $sendData['ProjectID'] = $ProjectID;
        $sendData['unitID'] = $unitTypechild;
        $sendData['contractorID'] = $contractorID;
        $sendData['CurrencyID'] = $currencyTypechild;
        $sendData['Created_By'] = session('UserID');
        $sendData['level'] = $level;
        $sendData['parentlevel'] = $parentlevel;
        $responseBody = $this->insertData($url, $sendData);
        $responseBody = json_decode($responseBody);
        if ($responseBody->last_insert_id != null) {
            $url = "/api/UpdateWbs/" . $parentID;
            // $sendData2['hasChild'] = $responseBody->last_insert_id;
            $sendData2['hasChild'] = 'Y';
            $responseBody = $this->updateData($url, $sendData2);

            $urlWeight = "/api/getWeightWbs/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($this->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url = "/api/UpdateWbs/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $this->updateData($url, $sendDataWeight);
                }
            }
            return  $responseBody;
        } else {
            return  json_encode($responseBody);
        }
    }

    public function generateWbs()
    {
        $contractorID=$_POST['contractorID'];
        $projectID=session('ProjectID');
        $url = "/api/getAllWbs/".$contractorID.'/'.$projectID;
        $responseBody = json_decode($this->getData($url));
        $x = count($responseBody);
        for ($i = 0; $i < (int)$x; $i++) {
            $WbsID = $responseBody[$i]->id;
            $itemName = $responseBody[$i]->itemName;
            $parentItem = $responseBody[$i]->parentItem;
            $hasChild = $responseBody[$i]->hasChild;
            $qty = $responseBody[$i]->qty;
            $price = $responseBody[$i]->price;
            $unitID = $responseBody[$i]->unitID;
            $CurrencyID = $responseBody[$i]->CurrencyID;
            $level = $responseBody[$i]->level;
            $parentLevel = $responseBody[$i]->parentLevel;

            $url = "/api/InsertDataWbsHistory";
            $sendData['WbsID'] = $WbsID;
            $sendData['itemName'] = $itemName;
            $sendData['parentItem'] = $parentItem;
            $sendData['hasChild'] = $hasChild;
            $sendData['qty'] = $qty;
            $sendData['price'] = $price;
            $sendData['amount'] = '';
            $sendData['weight'] = '';
            //$sendData['ProjectID'] = '1';
            $sendData['unitID'] = $unitID;
            //$sendData['contractorID'] = '1';
            $sendData['CurrencyID'] = $CurrencyID;
            $sendData['Created_By'] =  session('UserID');
            $sendData['level'] = $level;
            $sendData['parentLevel'] = $parentLevel;
            $this->insertData($url, $sendData);
        }
    }

    public function getWbsGantt()
    {
        $id = $_POST['id'] == null ? 0 : $_POST['id'];
        $projectID = session('ProjectID');
        $url = "/api/DataWbs/" . $id . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));
        $arrTemp = [];
        $tasks = [];
        $days = 0;
        for ($i = 0; $i < count($responseBody); $i++) {
            $x = strtotime($responseBody[$i]->endDate) - strtotime($responseBody[$i]->startDate);
            $days = floor($x / 86400);
            $a = array(
                "id" => $responseBody[$i]->id,
                "text" => $responseBody[$i]->itemName,
                "start_date" => date("d-m-Y", strtotime($responseBody[$i]->startDate)),
                "duration" => $days,
                "progress" => $responseBody[$i]->weight,
                "parent" => $responseBody[$i]->parentItem == null ? 0 : $responseBody[$i]->parentItem
            );
            array_push($arrTemp, $a);
        }
        
        $responseBody[0]->tasks = $arrTemp;
        return json_encode($responseBody[0]->tasks = $arrTemp);
    }
    
    public function getBaselineChart()
    {
        $contractorID = $_POST['contractorID'];
        $projectID=session('ProjectID');
        $url = "/api/getBaselineChart/" . $projectID."/".$contractorID;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function deleteWbs()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteWbs/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    public function importBaselineWbs(Request $request)
    {
        ini_set('max_execution_time', 0);
        $projectID = session('ProjectID');
        $contractorID = $request->contractorID;
        $createdByID = session('UserID');
        Excel::import(new WbsImport($projectID, $contractorID, $createdByID), $request->file('fileExcel'));
        return 'success';
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================


}
