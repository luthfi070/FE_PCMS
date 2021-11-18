<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BoqController extends Controller
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


    public function getBoq()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataBoq/" . $contractorID . '/' . $projectID;
        $responseBody = json_decode($this->getData($url));
        $x = 0;
        $z = 1;
        $y = 1;
        $parentNo = 0;
        $childNo = 1;
        $arr = array();
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->weight=round($responseBody[$i]->weight,2);
            $responseBody[$i]->action = ' <button type="button" class="btn-form-child btn btn-info  waves-effect waves-light m-1" data-lvl="' . $responseBody[$i]->parentLevel . '" data-id="' . $responseBody[$i]->id . '">Add Child Item</button>
            <button class="edit-btn-parent btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';


            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            if ($responseBody[$i]->parentItem == null) {
                $parentNo++;
                $responseBody[$i]->merge = $parentNo;
                $y = 1;
                $childNo = 1;
            } else {
                $arrx = array(
                    'id' => $responseBody[$i]->id,
                    'mergeBase' => $responseBody[$i]->parentItem . '.' . $y
                );
                array_push($arr, $arrx);
                $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
                <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
                $responseBody[$i]->merge = $parentNo . '.' . $childNo;
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

        // print_r($arr);die();

        return  json_encode($responseBody);
    }

    public function getBoqLevel()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataBoqLevel/" . $contractorID . '/' . $_POST['id'] . '/' . $projectID;
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

    public function getBoqchild()
    {
        $id = $_POST['idParent'];
        $url = "/api/DataBoqchild/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
        }

        return  json_encode($responseBody);
    }

    public function getBoqchildHistory()
    {
        $id = $_POST['idParent'];
        $url = "/api/DataBoqchildHistory/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
        }

        return  json_encode($responseBody);
    }

    public function getBoqHistory()
    {
        $url = "/api/DataBoqHistory";
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

    public function getBoqHistoryDetail()
    {
        // $ProjectID = $_POST['ProjectID'];
        $ProjectID = 1;
        // $contractorID = $_POST['contractorID'];
        $contractorID = '1';
        $created_at = explode(" ", $_POST['created_at']);
        $url = "/api/DataBoqByidHistory/" . $ProjectID . "/" . $contractorID . "/" . $created_at[0] . "/" . $created_at[1];
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


    public function getBoqByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataBoqByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateBoqParent()
    {
        $id = $_POST['parentIDMain'];
        $name = $_POST['parentItem'];
        $level = $_POST['parentLevel'];
        $url = "/api/UpdateBoq/" . $id;
        $url2 = "/api/UpdateBoqChildParentLevel/" . $id;
        $sendData['itemName'] = $name;
        $sendData['Created_By'] = 1;
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

    public function updateBoqChild()
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

        $url = "/api/UpdateBoq/" . $id;
        $sendData['itemName'] = $name;
        $sendData['hasChild'] = '';
        $sendData['qty'] = $childQty;
        $sendData['price'] = $childAmount;
        $sendData['amount'] = $childQty*$childAmount;
        $ProjectID = session('ProjectID');
        $contractorID =$_POST['contractorID'];
 

        $sendData['weight'] = '';
        //$sendData['ProjectID'] = '1';
        $sendData['unitID'] = $unitTypechild;
        //$sendData['contractorID'] = '1';
        $sendData['CurrencyID'] = $currencyTypechild;
        $sendData['Created_By'] = 1;
        $sendData['level'] = $level;
        $responseBody = $this->updateData($url, $sendData);
        
        $urlWeight = "/api/getWeightBoq/" . $ProjectID . '/' . $contractorID;
        $responseBodyWeight = json_decode($this->getData($urlWeight));
        if ($responseBodyWeight != null) {
            for ($i = 0; $i < count($responseBodyWeight); $i++) {
                $url1 = "/api/UpdateBoq/" . $responseBodyWeight[$i]->parentID;
                $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                $this->updateData($url1, $sendDataWeight);
                $url2 = "/api/DataBoqchild/" . $responseBodyWeight[$i]->parentID;
                $responseBodyChild = json_decode($this->getData($url2));
                for ($j = 0; $j < count($responseBodyChild); $j++) {
                    $url1 = "/api/UpdateBoq/" . $responseBodyChild[$j]->id;
                    $sendDataWeight['weight'] = ($responseBodyChild[$j]->amount / $responseBodyWeight[$i]->All_TOTAL)*100;
                    $this->updateData($url1, $sendDataWeight);
                }
            }
        }

        return  $responseBody;
    }


    public function addBoqParent()
    {

        $name = $_POST['parentItem'];
        $level = $_POST['parentLevel'];
        $contractorID = $_POST['contractorID'];
        $url = "/api/InsertDataBoq";
        $sendData['itemName'] = $name;
        $sendData['Created_By'] = session('UserID');
        $sendData['level'] = 0;
        $sendData['parentlevel'] = $level;
        $sendData['ProjectID'] = session('ProjectID');
        $sendData['contractorID'] = $contractorID;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function addBoqChild()
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
        $urlWeight = "/api/getWeightBoq/" . $ProjectID . '/' . $contractorID;
        $responseBodyWeight = json_decode($this->getData($urlWeight));
        if ($responseBodyWeight != null) {
            $AllWeight = $responseBodyWeight[0]->All_TOTAL;
            $weight = (($childQty * $childAmount) / ($AllWeight + ($childQty * $childAmount))) * 100;
        } else {
            $weight = 100;
        }



        $url = "/api/InsertDataBoq";

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
            $url = "/api/UpdateBoq/" . $parentID;
            // $sendData2['hasChild'] = $responseBody->last_insert_id;
            $sendData2['hasChild'] = 'Y';
            $responseBody = $this->updateData($url, $sendData2);

            $urlWeight = "/api/getWeightBoq/" . $ProjectID . '/' . $contractorID;
            $responseBodyWeight = json_decode($this->getData($urlWeight));
            if ($responseBodyWeight != null) {
                for ($i = 0; $i < count($responseBodyWeight); $i++) {
                    $url = "/api/UpdateBoq/" . $responseBodyWeight[$i]->parentID;
                    $sendDataWeight['weight'] = $responseBodyWeight[$i]->ParentWeight;
                    $this->updateData($url, $sendDataWeight);
                    $url = "/api/DataBoqchild/" . $responseBodyWeight[$i]->parentID;
                    $responseBodyChild = json_decode($this->getData($url));
                    for ($j = 0; $j < count($responseBodyChild); $j++) {
                        $url = "/api/UpdateBoq/" . $responseBodyChild[$j]->id;
                        $sendDataWeight['weight'] = ($responseBodyChild[$j]->amount / $responseBodyWeight[$i]->All_TOTAL)*100;
                        $this->updateData($url, $sendDataWeight);
                    }
                }
            }
            return  $responseBody;
        } else {
            return  json_encode($responseBody);
        }
    }

    public function generateBoq()
    {

        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        // $url = "/api/getAllBoq/" . $contractorID . '/' . $projectID;
        $url = "/api/getAllBoqParent/" . $contractorID . '/' . $projectID;

        $responseBody = json_decode($this->getData($url));
        $x = count($responseBody);
        for ($i = 0; $i < (int)$x; $i++) {
            $boqID = $responseBody[$i]->id;
            $itemName = $responseBody[$i]->itemName;
            $parentItem = $responseBody[$i]->parentItem;
            $hasChild = $responseBody[$i]->hasChild;
            $qty = $responseBody[$i]->qty;
            $price = $responseBody[$i]->price;
            $unitID = $responseBody[$i]->unitID;
            $CurrencyID = $responseBody[$i]->CurrencyID;
            $level = $responseBody[$i]->level;
            $parentLevel = $responseBody[$i]->parentLevel;
            $weight=$responseBody[$i]->weight;
            $amount=$responseBody[$i]->amount;

            $url = "/api/InsertDataBoqHistory";
            $sendData['boqID'] = $boqID;
            $sendData['itemName'] = $itemName;
            $sendData['parentItem'] = $parentItem;
            $sendData['hasChild'] = $hasChild;
            $sendData['qty'] = $qty;
            $sendData['price'] = $price;
            $sendData['amount'] = $amount;
            $sendData['weight'] = $weight;
            $sendData['ProjectID'] = $projectID;
            $sendData['unitID'] = $unitID;
            $sendData['contractorID'] = $contractorID;
            $sendData['CurrencyID'] = $CurrencyID;
            $sendData['Created_By'] = session('UserID');
            $sendData['level'] = $level;
            $sendData['parentlevel'] = $parentLevel;
            $id_boq_history = $this->insertData($url, $sendData);
            $id_boq_history = json_decode($id_boq_history);
            $id_boq_history = $id_boq_history->last_insert_id;
            
            $sendDataWbs['itemName'] = $itemName;
            $sendDataWbs['parentItem'] = $parentItem;
            $sendDataWbs['hasChild'] = $hasChild;
            $sendDataWbs['qty'] = $qty;
            $sendDataWbs['price'] = $price;
            $sendDataWbs['amount'] = $amount;
            $sendDataWbs['startDate'] = '';
            $sendDataWbs['endDate'] = '';
            $sendDataWbs['weight'] = $weight;
            $sendDataWbs['ProjectID'] = $projectID;
            $sendDataWbs['unitID'] = $unitID;
            $sendDataWbs['contractorID'] = $contractorID;
            $sendDataWbs['CurrencyID'] = $CurrencyID;
            $sendDataWbs['Created_By'] = session('UserID');
            $sendDataWbs['level'] = $level;
            $sendDataWbs['parentlevel'] = $parentLevel;
            $url ="/api/InsertDataWbs";
            // echo "<br>";
            // print_r($sendDataWbs);
            $id_wbs = $this->insertData($url, $sendDataWbs);
            $id_wbs = json_decode($id_wbs);
            $id_wbs = $id_wbs->last_insert_id;
            $urlActual ="/api/InsertDataActualWbs";
            $id_actual_wbs = $this->insertData($urlActual, $sendDataWbs);
            $id_actual_wbs = json_decode($id_actual_wbs);
            $id_actual_wbs = $id_actual_wbs->last_insert_id;
            

            $url = "/api/getAllBoqChild/" . $responseBody[$i]->id;

            $responseBodyChild = json_decode($this->getData($url));
            for ($j=0; $j < count($responseBodyChild); $j++) { 
                $boqID = $responseBodyChild[$j]->id;
                $itemName = $responseBodyChild[$j]->itemName;
                $hasChild = $responseBodyChild[$j]->hasChild;
                $qty = $responseBodyChild[$j]->qty;
                $price = $responseBodyChild[$j]->price;
                $unitID = $responseBodyChild[$j]->unitID;
                $CurrencyID = $responseBodyChild[$j]->CurrencyID;
                $level = $responseBodyChild[$j]->level;
                $parentLevel = $responseBodyChild[$j]->parentLevel;
                $weight=$responseBodyChild[$j]->weight;
                $amount=$responseBodyChild[$j]->amount;

                $url = "/api/InsertDataBoqHistory";
                $sendData['boqID'] = $boqID;
                $sendData['itemName'] = $itemName;
                $sendData['parentItem'] = $id_boq_history;
                $sendData['hasChild'] = $hasChild;
                $sendData['qty'] = $qty;
                $sendData['price'] = $price;
                $sendData['amount'] = $amount;
                $sendData['weight'] = $weight;
                $sendData['ProjectID'] = $projectID;
                $sendData['unitID'] = $unitID;
                $sendData['contractorID'] = $contractorID;
                $sendData['CurrencyID'] = $CurrencyID;
                $sendData['Created_By'] = session('UserID');
                $sendData['level'] = $level;
                $sendData['parentlevel'] = $parentLevel;
                $this->insertData($url, $sendData);
                
                $sendDataWbs['itemName'] = $itemName;
                $sendDataWbs['parentItem'] = $id_wbs;
                $sendDataWbs['hasChild'] = $hasChild;
                $sendDataWbs['qty'] = $qty;
                $sendDataWbs['price'] = $price;
                $sendDataWbs['amount'] = $amount;
                $sendDataWbs['startDate'] = '';
                $sendDataWbs['endDate'] = '';
                $sendDataWbs['weight'] = $weight;
                $sendDataWbs['ProjectID'] = $projectID;
                $sendDataWbs['unitID'] = $unitID;
                $sendDataWbs['contractorID'] = $contractorID;
                $sendDataWbs['CurrencyID'] = $CurrencyID;
                $sendDataWbs['Created_By'] = session('UserID');
                $sendDataWbs['level'] = $level;
                $sendDataWbs['parentlevel'] = $parentLevel;
                $url ="/api/InsertDataWbs";
                // echo "<br>";
                // print_r($sendDataWbs);
                $this->insertData($url, $sendDataWbs);
                $sendDataWbs['parentItem'] =  $id_actual_wbs;
                $urlActual ="/api/InsertDataActualWbs";
                $this->insertData($urlActual, $sendDataWbs);
                
            }
        }
    }

    public function deleteBoq()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteBoq/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================


}
