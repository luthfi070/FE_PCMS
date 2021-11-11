<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WbsController extends Controller
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

    private function getByPostData($url, $array)
    {
        $client = new Client();
        $url = config('global.api_url') . "" . $url;

        $response = $client->request('POST', $url, ['form_params' => $array]);

        $responseBody = $response->getBody();
        $responseBody = json_decode($responseBody);
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->no = $i + 1;
        }
        return json_encode($responseBody);
      
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


    public function getActualWbs()
    {
        $ProjectID=session('ProjectID');
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $url = "/api/DataActualWbs/".$contractorID.'/'.$ProjectID;
        $responseBody = json_decode($this->getData($url));
        $x = 0;
        $z = 1;
        $y = 1;
        $arr = array();
        for ($i = 0; $i < count($responseBody); $i++) {
            //     $responseBody[$i]->action = ' <button type="button" class="btn-form-child btn btn-info  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">Add Child Item</button>
            // <button class="edit-btn-parent btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            // <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            if($responseBody[$i]->price=="" ||$responseBody[$i]->price == null){
                $responseBody[$i]->price=0;
            }

            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            if ($responseBody[$i]->parentItem == null) {
                $responseBody[$i]->merge = $responseBody[$i]->no - $x;
                $responseBody[$i]->thisMonth = '<input type="number" readonly class="form-control form-this-month" style="background-color: rgba(21, 14, 14, 0)" min="0" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month_' . $responseBody[$i]->id . '" id="form-this-month_' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->accumulatedThisMonth = '<input type="text" readonly class="form-control form-this-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month-accumulated' . $responseBody[$i]->id . '" id="form-this-month-accumulated' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->startDate = '<input type="text" readonly class="form-control form-startDate" style="width: 150px;background-color: rgba(21, 14, 14, 0);" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-startDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->startDate . '">';
                $responseBody[$i]->endDate = '<input type="text" readonly class="form-control form-endDate" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-endDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->endDate . '">';
                $responseBody[$i]->actualAmount = '<input type="text" readonly class="form-control form-actual-amount" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-amount' . $responseBody[$i]->id . '" id="form-actual-amount' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->actualProgress = '<input type="text" readonly class="form-control form-actual-progress" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-progress' . $responseBody[$i]->id . '" id="form-actual-progress' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->qty = '<input type="text" readonly class="form-control form-qty" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-qty' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->accumulatedLastMonthQty = '<input type="text" readonly class="form-control form-last-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-last-month-accumulated' . $responseBody[$i]->id . '" id="form-last-month-accumulated' . $responseBody[$i]->id . '" value=0>';
                $y = 1;
            } else {
                $arrx = array(
                    'id' => $responseBody[$i]->id,
                    'mergeBase' => $responseBody[$i]->parentItem . '.' . $y
                );
                array_push($arr, $arrx);

                $responseBody[$i]->merge = $responseBody[$i]->parentItem . '.' . $y;
                //$responseBody[$i]->accumulatedThisMonthQty = '<div class="form-control form-this-month-accumulated-qty" data-ids="'.$responseBody[$i]->id.'" data-id="'.$i.'" name="form-this-month-accumulated-qty'.$responseBody[$i]->id.'" id="form-this-month-accumulated-qty'.$responseBody[$i]->id.'"></div>';
                $responseBody[$i]->thisMonth = '<input type="number" class="form-control form-this-month" min="0" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month_' . $responseBody[$i]->id . '" id="form-this-month_' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->accumulatedThisMonth = '<input type="text" readonly class="form-control form-this-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month-accumulated' . $responseBody[$i]->id . '" id="form-this-month-accumulated' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->actualAmount = '<input type="text" readonly class="form-control form-actual-amount" style="background-color: rgba(21, 14, 14, 0); width:150px" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-amount' . $responseBody[$i]->id . '" id="form-actual-amount' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->actualProgress = '<input type="text" readonly class="form-control form-actual-progress" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-progress' . $responseBody[$i]->id . '" id="form-actual-progress' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->startDate = '<input type="text" readonly class="form-control form-startDate" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" id="form-endDate' . $responseBody[$i]->id . '" name="form-startDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->startDate . '">';
                $responseBody[$i]->endDate = '<input type="text" readonly class="form-control form-endDate" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '"i d="form-endDate' . $responseBody[$i]->id . '" name="form-endDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->endDate . '">';
                if ($responseBody[$i]->qty == null || $responseBody[$i]->qty == "") {
                    $responseBody[$i]->qty = '<input type="text" readonly class="form-control form-qty" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-qty' . $responseBody[$i]->id . '" value="0">';
                } else {
                    $responseBody[$i]->qty = '<input type="text" readonly class="form-control form-qty" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-qty' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->qty . '">';
                }
                if ($responseBody[$i]->accumulatedThisMonthQty == null || $responseBody[$i]->accumulatedThisMonthQty == "") {
                    $responseBody[$i]->accumulatedLastMonthQty = '<input type="text" readonly class="form-control form-last-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-last-month-accumulated' . $responseBody[$i]->id . '" id="form-last-month-accumulated' . $responseBody[$i]->id . '" value=0>';
                } else {
                    $responseBody[$i]->accumulatedLastMonthQty = '<input type="text" readonly class="form-control form-last-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-last-month-accumulated' . $responseBody[$i]->id . '" id="form-last-month-accumulated' . $responseBody[$i]->id . '" value="'.$responseBody[$i]->accumulatedThisMonthQty.'">';
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

    public function getActualWbsDetail(){
        $id = $_POST['id'];
        $ProjectID=session('ProjectID');
        $contractorID=$_POST['contractorID'];

        $url = "/api/DataDocumentByid/".$id;
        $responseBodyDocument = json_decode($this->getData($url));

        $sendData['projectID']=$ProjectID;
        $sendData['contractorID']=$contractorID;
        $sendData['docID']=$id;
        $sendData['date']=date("Y-m-d H:i", strtotime($responseBodyDocument[0]->created_at));
        
        $url = "/api/DataActualWbsDetail";
        $responseBody = json_decode($this->getByPostData($url,$sendData));
        $x = 0;
        $z = 1;
        $y = 1;
        $arr = array();
        for ($i = 0; $i < count($responseBody); $i++) {
            //     $responseBody[$i]->action = ' <button type="button" class="btn-form-child btn btn-info  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">Add Child Item</button>
            // <button class="edit-btn-parent btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            // <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            if($responseBody[$i]->price=="" ||$responseBody[$i]->price == null){
                $responseBody[$i]->price=0;
            }

            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            if ($responseBody[$i]->parentItem == null) {
                $responseBody[$i]->merge = $responseBody[$i]->no - $x;
                $responseBody[$i]->thisMonth = '<input type="text" readonly class="form-control form-this-month" style="background-color: rgba(21, 14, 14, 0)" min="0" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month_' . $responseBody[$i]->id . '" id="form-this-month_' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->accumulatedThisMonth = '<input type="text" readonly class="form-control form-this-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month-accumulated' . $responseBody[$i]->id . '" id="form-this-month-accumulated' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->startDate = '<input type="text" readonly class="form-control form-startDate" style="width: 150px;background-color: rgba(21, 14, 14, 0);" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-startDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->startDate . '">';
                $responseBody[$i]->endDate = '<input type="text" readonly class="form-control form-endDate" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-endDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->endDate . '">';
                $responseBody[$i]->actualAmount = '<input type="text" readonly class="form-control form-actual-amount" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-amount' . $responseBody[$i]->id . '" id="form-actual-amount' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->actualProgress = '<input type="text" readonly class="form-control form-actual-progress" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-progress' . $responseBody[$i]->id . '" id="form-actual-progress' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->qty = '<input type="text" readonly class="form-control form-qty" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-qty' . $responseBody[$i]->id . '" value="0">';
                $responseBody[$i]->accumulatedLastMonthQty = '<input type="text" readonly class="form-control form-last-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-last-month-accumulated' . $responseBody[$i]->id . '" id="form-last-month-accumulated' . $responseBody[$i]->id . '" value=0>';
                $y = 1;
            } else {
                $arrx = array(
                    'id' => $responseBody[$i]->id,
                    'mergeBase' => $responseBody[$i]->parentItem . '.' . $y
                );
                array_push($arr, $arrx);

                $responseBody[$i]->merge = $responseBody[$i]->parentItem . '.' . $y;
                //$responseBody[$i]->accumulatedThisMonthQty = '<div class="form-control form-this-month-accumulated-qty" data-ids="'.$responseBody[$i]->id.'" data-id="'.$i.'" name="form-this-month-accumulated-qty'.$responseBody[$i]->id.'" id="form-this-month-accumulated-qty'.$responseBody[$i]->id.'"></div>';
                $responseBody[$i]->thisMonth = '<input type="text" readonly class="form-control form-this-month" min="0" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month_' . $responseBody[$i]->id . '" id="form-this-month_' . $responseBody[$i]->id . '" value="'.$responseBody[$i]->thisMonthQty .'">';
                $responseBody[$i]->accumulatedThisMonth = '<input type="text" readonly class="form-control form-this-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month-accumulated' . $responseBody[$i]->id . '" id="form-this-month-accumulated' . $responseBody[$i]->id . '" value="'.((int)$responseBody[$i]->accumulatedLastMonthQty+(int)$responseBody[$i]->thisMonthQty) .'">';
                $responseBody[$i]->actualAmount = '<input type="text" readonly class="form-control form-actual-amount" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-amount' . $responseBody[$i]->id . '" id="form-actual-amount' . $responseBody[$i]->id . '" value="'.$responseBody[$i]->actualAmount.'">';
                $responseBody[$i]->actualProgress = '<input type="text" readonly class="form-control form-actual-progress" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-progress' . $responseBody[$i]->id . '" id="form-actual-progress' . $responseBody[$i]->id . '" value="'.$responseBody[$i]->actualProgress.'">';
                $responseBody[$i]->startDate = '<input type="text" readonly class="form-control form-startDate" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" id="form-endDate' . $responseBody[$i]->id . '" name="form-startDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->startDate . '">';
                $responseBody[$i]->endDate = '<input type="text" readonly class="form-control form-endDate" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" id="form-endDate' . $responseBody[$i]->id . '" name="form-endDate' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->endDate . '">';
                if ($responseBody[$i]->qty == null || $responseBody[$i]->qty == "") {
                    $responseBody[$i]->qty = '<input type="text" readonly class="form-control form-qty" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-qty' . $responseBody[$i]->id . '" value="0">';
                } else {
                    $responseBody[$i]->qty = '<input type="text" readonly class="form-control form-qty" style="width: 150px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-qty' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->qty . '">';
                }
                if ($responseBody[$i]->accumulatedLastMonthQty == null || $responseBody[$i]->accumulatedLastMonthQty == "") {
                    $responseBody[$i]->accumulatedLastMonthQty = '<input type="text" readonly class="form-control form-last-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-last-month-accumulated' . $responseBody[$i]->id . '" id="form-last-month-accumulated' . $responseBody[$i]->id . '" value=0>';
                } else {
                    $responseBody[$i]->accumulatedLastMonthQty = '<input type="text" readonly class="form-control form-last-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-last-month-accumulated' . $responseBody[$i]->id . '" id="form-last-month-accumulated' . $responseBody[$i]->id . '" value="'.$responseBody[$i]->accumulatedLastMonthQty.'">';
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

    public function getActualWbschild()
    {
        $id = $_POST['idParent'];
        $url = "/api/DataActualWbschild/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            // $responseBody[$i]->action = '<button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            // <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            $responseBody[$i]->thisMonth = '<input type="number" class="form-control form-this-month" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month[' . $i . ']" id="form-this-month[' . $i . ']">';
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

    public function getDetailActualWbsChild()
    {
        $id = $_POST['id'];
        $url = "/api/DataDetailActualWbsByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }


    public function getActualWbsByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataActualWbsByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateActualWbs()
    {
        $id = $_POST['id'];
        $unitSymbol = $_POST['unitSymbol'];
        $name = $_POST['name'];
        $url = "/api/UpdateUnit/" . $id;
        $sendData['unitName'] = $name;
        $sendData['unitSymbol'] = $unitSymbol;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }


    public function addActualWbsParent()
    {

        $name = $_POST['parentItem'];
        $url = "/api/InsertDataActualWbs";
        $sendData['itemName'] = $name;
        $sendData['Created_By'] = 1;
        //$sendData['ProjectID'] = $name;
        //$sendData['contractorID'] = $name;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function addActualWbsChild()
    {
        $name = $_POST['childItem'];
        $level = $_POST['childLevel'];
        $unitTypechild = $_POST['unitTypechild'];
        $childQty = $_POST['childQty'];
        $currencyTypechild = $_POST['currencyTypechild'];
        $childAmount = $_POST['childAmount'];
        $parentID = $_POST['parentID'];

        $url = "/api/InsertDataActualWbs";

        $sendData['itemName'] = $name;
        $sendData['parentItem'] = $parentID;
        $sendData['hasChild'] = '';
        $sendData['qty'] = $childQty;
        $sendData['price'] = $childAmount;
        $sendData['amount'] = '';
        $sendData['weight'] = '';
        //$sendData['ProjectID'] = '1';
        $sendData['unitID'] = $unitTypechild;
        //$sendData['contractorID'] = '1';
        $sendData['CurrencyID'] = $currencyTypechild;
        $sendData['Created_By'] = 1;
        $responseBody = $this->insertData($url, $sendData);
        $responseBody = json_decode($responseBody);
        if ($responseBody->last_insert_id != null) {
            $url = "/api/UpdateDataActualWbs/" . $parentID;
            // $sendData2['hasChild'] = $responseBody->last_insert_id;
            $sendData2['hasChild'] = 'Y';
            $responseBody = $this->updateData($url, $sendData2);
            return  $responseBody;
        } else {
            return  json_encode($responseBody);
        }
    }

    public function generateBoq()
    {

        $url = "/api/getAllDataActualWbs";
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

            $url = "/api/InsertDataBoqHistory";
            $sendData['boqID'] = $boqID;
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
            $sendData['Created_By'] = 1;
            $this->insertData($url, $sendData);
        }
    }

    public function submitProgress()
    {
        $contractorID=$_POST['contractorID'];
        $dataReport['documentName'] = $_POST['title'];
        $dataReport['documentType'] = 'actualReport';
        $dataReport['author'] = $_POST['createdby'];
        $dataReport['desc'] = $_POST['description'];
        $dataReport['projectID'] = session('ProjectID');
        $dataReport['contractorID'] = $contractorID;
        $dataReport['reportingDate'] = $_POST['date'];

        $url = "/api/InsertDataDocument";
        
        $resp= $this->insertData($url, $dataReport);
        $resp = json_decode($resp);
        $docID=$resp->doc_insert_id;

        $arr_var = array();
        $arr_var_child = array();
        $idx = 0;
        foreach ($_POST as $x => $x_value) {
            if ($x != 'title' && $x != 'date' && $x != 'createdby' && $x != 'description') {
                array_push($arr_var, $x . '|' . $x_value);
                $idx++;
                if (($idx - 1) == 7) {
                    array_push($arr_var_child, $arr_var);
                    $arr_var = array();
                    $idx = 0;
                }
            }
        }

        for ($i = 0; $i < count($arr_var_child); $i++) {
            $sendData=[];
            $a = $arr_var_child[$i][0];
            $b = $arr_var_child[$i][1];
            $c = $arr_var_child[$i][2];
            $d = $arr_var_child[$i][3];
            $e = $arr_var_child[$i][4];
            $f = $arr_var_child[$i][5];
            $g = $arr_var_child[$i][6];
            $h = $arr_var_child[$i][7];
        
            $tempD = explode("|", $d);
            $tempE = explode("|", $e);
            $tempF = explode("|", $f);
            $tempG = explode("|", $g);
            $tempH = explode("|", $h);
            $tempEX = explode("_", $tempE[0]);

            $url = "/api/InsertDataProgressEvaluation";

            $sendData['periode'] = $_POST['date'];
            $sendData['progressName'] = $_POST['title'];
            $sendData['estimatedQty'] = '';
            $sendData['accumulatedLastMonthQty'] = $tempD[1];
            $sendData['thisMonthQty'] = $tempE[1];
            $sendData['accumulatedThisMonthQty'] = $tempF[1];
            $sendData['amount'] = $tempG[1];
            $sendData['weight'] = $tempH[1];
            $sendData['contractorID'] = $contractorID;
            $sendData['ProjectID'] = session('ProjectID');
            $sendData['ItemID'] = (int)$tempEX[1];
            $sendData['docID'] = $docID;
            $this->insertData($url, $sendData);
           
            //$z = explode($x);
        }

        $ProjectID=session('ProjectID');
        $url2 = "/api/DataActualWbs/".$contractorID.'/'.$ProjectID;
        $responseBody = json_decode($this->getData($url2));
        $FinalresponseBody="";
        $x = count($responseBody);
        for ($i = 0; $i < (int)$x; $i++) {
            $sendData2=[];
            $actualWbsID = $responseBody[$i]->id;
            $itemName = $responseBody[$i]->itemName;
            $parentItem = $responseBody[$i]->parentItem;
            $hasChild = $responseBody[$i]->hasChild;
            $qty = $responseBody[$i]->qty;
            $startDate = $responseBody[$i]->startDate;
            $endDate = $responseBody[$i]->endDate;
            $price = $responseBody[$i]->price;
            $unitID = $responseBody[$i]->unitID;
            $CurrencyID = $responseBody[$i]->CurrencyID;
            $level = $responseBody[$i]->level;
            $parentLevel = $responseBody[$i]->parentLevel;
            $weight=$responseBody[$i]->weight;

            $url = "/api/InsertDataDocumentDetail";
            $sendData2['actualWbsID'] = $actualWbsID;
            $sendData2['itemName'] = $itemName;
            $sendData2['parentItem'] = $parentItem;
            $sendData2['hasChild'] = $hasChild;
            $sendData2['qty'] = $qty;
            $sendData2['price'] = $price;
            $sendData2['startDate'] = $startDate;
            $sendData2['endDate'] = $endDate;
            $sendData2['amount'] = $qty*$price;
            $sendData2['weight'] = $weight;
            $sendData2['ProjectID'] = session('ProjectID');
            $sendData2['unitID'] = $unitID;
            $sendData2['contractorID'] = $contractorID;
            $sendData2['CurrencyID'] = $CurrencyID;
            $sendData2['Created_By'] = session('UserID');
            $sendData2['level'] = $level;
            $sendData2['parentlevel'] = $parentLevel;
            $FinalresponseBody=$this->insertData($url, $sendData2);
        }
        return  $FinalresponseBody;
    }

    public function getDocument(){
        $ProjectID=session('ProjectID');
        $contractorID=$_POST['contractorID'];
        $type="actualReport";
        $url = "/api/DataDocument/".$ProjectID.'/'.$contractorID.'/'.$type;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button class="detail-btn btn btn-primary  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '" data-date="' . $responseBody[$i]->created_at . '">DETAIL</button>
            <button type="button" id="btn-document" class="btn delete-btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }
        return  $responseBody;
    }

    public function deleteActualWbs()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataActualWbs/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    public function deleteActualReport()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataActualReportWbs/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================


}
