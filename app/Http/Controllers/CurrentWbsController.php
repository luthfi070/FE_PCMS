<?php

namespace App\Http\Controllers;

use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CurrentWbsController extends Controller
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


    public function getCurrentWbs()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataCurrentWbs/" . $contractorID . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));
        $responseBodyFix ="";
        if(count($responseBody)>0){
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
                    $responseBody[$i]->duration = $duration.' D';
                    $responseBody[$i]->startDates = str_replace('/', '-', $responseBody[$i]->startDate);
    
                    $responseBody[$i]->endDates = str_replace('/', '-', $responseBody[$i]->endDate);
    
    
                    for ($j = 0; $j < count($arr); $j++) {
                        if ($arr[$j]['id'] == $responseBody[$i]->parentItem) {
                            $responseBody[$i]->merge = $arr[$j]['mergeBase'] . '.' . ($z);
                            $z += 1;
                        }
                    }
                    $y += 1;
                    $childNo++;
                    $x += 1;
                }

                // add total duration for parent
                foreach($responseBody as $item){
                    if($item->parentItem == null){
                        if(isset($totalDuration[$item->id])){
                            $item->duration = $totalDuration[$item->id].' D';
                        }
                    }
                }
            }
            $responseBodyFix=$responseBody;
        }else{
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
                    $responseBody[$i]->merge = $parentNo . '.' . $y;
                    $responseBody[$i]->duration = $duration.' D';
                    $responseBody[$i]->startDates = str_replace('/', '-', $responseBody[$i]->startDate);
    
                    $responseBody[$i]->endDates = str_replace('/', '-', $responseBody[$i]->endDate);
    
    
                    for ($j = 0; $j < count($arr); $j++) {
                        if ($arr[$j]['id'] == $responseBody[$i]->parentItem) {
                            $responseBody[$i]->merge = $arr[$j]['mergeBase'] . '.' . ($z);
                            $z += 1;
                        }
                    }
                    $y += 1;
                    $childNo++;
                    $x += 1;
                }

                // add total duration for parent
                foreach($responseBody as $item){
                    if($item->parentItem == null){
                        if(isset($totalDuration[$item->id])){
                            $item->duration = $totalDuration[$item->id].' D';
                        }
                    }
                }
            }
            $responseBodyFix=$responseBody;
        }
   
        // print_r($arr);die();

        return  json_encode($responseBodyFix);
    }

    public function getCurrentRescheduleWbs()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataCurrentWbs/" . $contractorID . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));
        $x = 0;
        $z = 1;
        $y = 1;
        $arr = array();
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->weight=round($responseBody[$i]->weight,2);
            $responseBody[$i]->action = ' <button type="button" class="btn-form-child btn btn-info  waves-effect waves-light m-1" data-lvl="' . $responseBody[$i]->parentLevel . '" data-id="' . $responseBody[$i]->id . '">Add Child Item</button>
            <button class="edit-btn-parent btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->duration = '<input type="text" readonly class="form-control" style="background-color: rgba(21, 14, 14, 0)" id="parent_duration_' . $responseBody[$i]->id . '" value="0"/>';
            $responseBody[$i]->startDates = '';
            $responseBody[$i]->endDates = '';

            $responseBody[$i]->cost = "0";
            if ($responseBody[$i]->parentItem == null) {
                $responseBody[$i]->merge = $responseBody[$i]->no - $x;
                $y = 1;
            } else {
                $arrx = array(
                    'id' => $responseBody[$i]->id,
                    'mergeBase' => $responseBody[$i]->parentItem . '.' . $y
                );
                array_push($arr, $arrx);
                $responseBody[$i]->cost = '<input type="text" readonly style="width:70px" class="form-control" style="background-color: rgba(21, 14, 14, 0)" id="cost_' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->qty * $responseBody[$i]->price . '"/>';
                $responseBody[$i]->qty = '<input type="number" style="width:70px" class="qty form-control" data-id="' . $responseBody[$i]->id . '" id="qty_' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->qty . '"/>';
                $responseBody[$i]->price = '<input type="number" class="prices form-control" data-id="' . $responseBody[$i]->id . '" id="price_' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->price . '"/>';
                $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
                <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
                $responseBody[$i]->merge = $responseBody[$i]->parentItem . '.' . $y;
                $responseBody[$i]->duration = '<input type="text" readonly class="form-control" style="background-color: rgba(21, 14, 14, 0)" id="duration_' . $responseBody[$i]->id . '" value="' . ((strtotime($responseBody[$i]->endDate) - strtotime($responseBody[$i]->startDate)) / 86400) . '"/>';
                $responseBody[$i]->startDates = '<input type="date" class="startDate form-control" name ="startDate_' . $responseBody[$i]->id . '" id ="startDate_' . $responseBody[$i]->id . '" data-id="' . $responseBody[$i]->id . '" value="' . str_replace('/', '-', $responseBody[$i]->startDate) . '">';
                if ($responseBody[$i]->endDate == null) {
                    $responseBody[$i]->endDates = '<input type="date" readonly class="endDate form-control" name ="endDate_' . $responseBody[$i]->id . '" id ="endDate_' . $responseBody[$i]->id . '" data-id="' . $responseBody[$i]->id . '" value="' . str_replace('/', '-', $responseBody[$i]->endDate) . '">';
                } else {
                    $responseBody[$i]->endDates = '<input type="date" class="endDate form-control" name ="endDate_' . $responseBody[$i]->id . '" id ="endDate_' . $responseBody[$i]->id . '" data-id="' . $responseBody[$i]->id . '" value="' . str_replace('/', '-', $responseBody[$i]->endDate) . '">';
                }

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

    public function getCurrentWbsLevel()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataCurrentWbsLevel/" . $contractorID . '/' . $_POST['id'] . '/' . $projectID;
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

    public function getCurrentWbschild()
    {
        $id = $_POST['idParent'];
        $url = "/api/DataCurrentWbschild/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
        }

        return  json_encode($responseBody);
    }

    public function getCurrentWbschildHistory()
    {
        $id = $_POST['idParent'];
        $url = "/api/DataCurrentWbschildHistory/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
        }

        return  json_encode($responseBody);
    }

    public function getCurrentWbsHistory()
    {
        $url = "/api/DataCurrentWbsHistory";
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

    public function getCurrentWbsHistoryDetail()
    {
        // $ProjectID = $_POST['ProjectID'];
        $ProjectID = 1;
        // $contractorID = $_POST['contractorID'];
        $contractorID = '1';
        $created_at = explode(" ", $_POST['created_at']);
        $url = "/api/DataCurrentWbsByidHistory/" . $ProjectID . "/" . $contractorID . "/" . $created_at[0] . "/" . $created_at[1];
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


    public function getCurrentWbsByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataCurrentWbsByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateCurrentWbsParent()
    {
        $id = $_POST['parentIDMain'];
        $name = $_POST['parentItem'];
        $level = $_POST['parentLevel'];
        $url = "/api/UpdateCurrentWbs/" . $id;
        $url2 = "/api/UpdateCurrentWbsChildParentLevel/" . $id;
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

    public function updateCurrentWbsChildDate()
    {
        $id = $_POST['id'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];


        $url = "/api/UpdateCurrentWbs/" . $id;

        $sendData['startDate'] = $startDate;
        $sendData['endDate'] = $endDate;

        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    public function updateCurrentWbsChildCost()
    {
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $ProjectID=session('ProjectID');
        $contractorID=$_POST['contractorID'];
        $urlWeight = "/api/getWeightCurrentWbsByItem/" . $id;
        $responseBodyWeight = json_decode($this->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
        }

        $weight = round((($qty * $price) / $AllWeight) * 100,2);


        $url = "/api/UpdateCurrentWbs/" . $id;

        $sendData['qty'] = $qty;
        $sendData['price'] = $price;
        $sendData['amount'] = $price * $qty;
        $sendData['weight'] = $weight;

        $responseBody = $this->updateData($url, $sendData);
        if ($responseBody) {
            // $urlWeight = "/api/getWeightCurrentWbsByItem/" . $id;
            // $responseBodyWeight = json_decode($this->getData($urlWeight));
            // if ($responseBodyWeight != null) {
            //     for ($i = 0; $i < count($responseBodyWeight); $i++) {
            //         $url = "/api/UpdateCurrentWbs/" . $responseBodyWeight[$i]->parentID;
            //         $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
            //         $this->updateData($url, $sendDataWeight);
            //     }
            // }
            $urlWeight = "/api/getWeightCurrentWbs/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($this->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url1 = "/api/UpdateCurrentWbs/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $this->updateData($url1, $sendDataWeight);
                    $url2 = "/api/DataCurrentWbschild/" . $responseBodyWeight[$i]->parentID;
                    $responseBodyChild = json_decode($this->getData($url2));
                    for ($j = 0; $j < count($responseBodyChild); $j++) {
                        $url1 = "/api/UpdateCurrentWbs/" . $responseBodyChild[$j]->id;
                        $sendDataWeight['weight'] = ($responseBodyChild[$j]->amount / $responseBodyWeight[$i]->All_TOTAL)*100;
                        $this->updateData($url1, $sendDataWeight);
                    }
                }
            }
        }
        return  $responseBody;
    }


    public function updateCurrentWbsChild()
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

        $urlWeight = "/api/getWeightCurrentWbsByItem/" . $id;
        $responseBodyWeight = json_decode($this->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
        }
        $weight = round((($childQty * $childAmount) / $AllWeight) * 100,2);

        $url = "/api/UpdateCurrentWbs/" . $id;

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

            $urlWeight = "/api/getWeightCurrentWbs/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($this->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url1 = "/api/UpdateCurrentWbs/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $this->updateData($url1, $sendDataWeight);
                    $url2 = "/api/DataCurrentWbschild/" . $responseBodyWeight[$i]->parentID;
                    $responseBodyChild = json_decode($this->getData($url2));
                    for ($j = 0; $j < count($responseBodyChild); $j++) {
                        $url1 = "/api/UpdateCurrentWbs/" . $responseBodyChild[$j]->id;
                        $sendDataWeight['weight'] = ($responseBodyChild[$j]->amount / $responseBodyWeight[$i]->All_TOTAL)*100;
                        $this->updateData($url1, $sendDataWeight);
                    }
                }
            }
        }
        return  $responseBody;
    }

    public function addCurrentWbsParent()
    {

        $name = $_POST['parentItem'];
        $level = $_POST['parentLevel'];
        $contractorID = $_POST['contractorID'];
        $url = "/api/InsertDataCurrentWbs";
        $sendData['itemName'] = $name;
        $sendData['Created_By'] = session('UserID');
        $sendData['level'] = 0;
        $sendData['parentlevel'] = $level;
        $sendData['ProjectID'] = session('ProjectID');
        $sendData['contractorID'] = $contractorID;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function addCurrentWbsChild()
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
        $urlWeight = "/api/getWeightCurrentWbs/" . $ProjectID . '/' . $contractorID;
        $responseBodyWeight = json_decode($this->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
        }

        $weight = round((($childQty * $childAmount) / $AllWeight) * 100,2);


        $url = "/api/InsertDataCurrentWbs";

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
            $url = "/api/UpdateCurrentWbs/" . $parentID;
            // $sendData2['hasChild'] = $responseBody->last_insert_id;
            $sendData2['hasChild'] = 'Y';
            $responseBody = $this->updateData($url, $sendData2);

            $urlWeight = "/api/getWeightCurrentWbs/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($this->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url = "/api/UpdateCurrentWbs/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $this->updateData($url, $sendDataWeight);
                }
            }
            return  $responseBody;
        } else {
            return  json_encode($responseBody);
        }
    }

    public function rescheduleCurrentWbs()
    {
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/getAllCurrentWbs/" . $contractorID . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));
        $x = count($responseBody);
        if ($x < 0) {
            
        }
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
            $weight = $responseBody[$i]->weight;
            $startDate = $responseBody[$i]->startDate;
            $endDate = $responseBody[$i]->endDate;

            $url = "/api/InsertDataCurrentWbsHistory";
            $sendData['actualWbsID'] = $WbsID;
            $sendData['itemName'] = $itemName;
            $sendData['parentItem'] = $parentItem;
            $sendData['hasChild'] = $hasChild;
            $sendData['qty'] = $qty;
            $sendData['price'] = $price;
            $sendData['startDate'] = $startDate;
            $sendData['endDate'] = $endDate;
            $sendData['amount'] = $qty * $price;
            $sendData['weight'] = $weight;
            $sendData['ProjectID'] = session('ProjectID');
            $sendData['unitID'] = $unitID;
            $sendData['contractorID'] = $contractorID;
            $sendData['CurrencyID'] = $CurrencyID;
            $sendData['Created_By'] =  session('UserID');
            $sendData['level'] = $level;
            $sendData['parentLevel'] = $parentLevel;
            $this->insertData($url, $sendData);
        }

        if ($x > 0) {
            return json_encode(["status" => "success"]);
        } else {
            return json_encode(["status" => "fail"]);
        }
    }

    public function getCurrentWbsGantt()
    {
        $id = $_POST['id'] == null ? 0 : $_POST['id'];
        $projectID = session('ProjectID');
        $url = "/api/DataCurrentWbs/" . $id . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));

        if(count($responseBody)>0){
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
        }else{
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
        
       
    }

    public function getCurrentWbsChart()
    {
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataCurrentWbs/" . $contractorID . '/' . $projectID;
        $responseBodyWbs = json_decode($this->getData($url));
        
        if(count($responseBodyWbs)>0){
            $url = "/api/getCurrentWbsChart/" . $projectID . "/" . $contractorID;
        }else{
            $url = "/api/getBaselineChart/" . $projectID . "/" . $contractorID;
        }
        
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    
    public function getCurrentWbsChartProgress()
    {
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataCurrentWbs/" . $contractorID . '/' . $projectID;
        $responseBodyWbs = json_decode($this->getData($url));
        if(count($responseBodyWbs)>0){
            $url = "/api/getCurrentWbsChart/" . $projectID . "/" . $contractorID;
        }else{
            $url = "/api/getBaselineChart/" . $projectID . "/" . $contractorID;
        }
        $totalCostEstimate=0;
        $totalCostActual=0;
        $responseBody = json_decode($this->getData($url));
        for($i=0;$i<count($responseBody);$i++){
            $totalCostEstimate+=$responseBody[$i]->baseline;
            $totalCostActual+=$responseBody[$i]->actual;
         }
        for($i=0;$i<count($responseBody);$i++){
            $responseBody[$i]->current=0;
            $responseBody[$i]->totalCostEstimate=$totalCostEstimate;
            $responseBody[$i]->totalCostActual=$totalCostActual;
         }
         
        return  json_encode($responseBody);
    }

    public function deleteCurrentWbs()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteCurrentWbs/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================


}
