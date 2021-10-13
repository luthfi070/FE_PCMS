<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use stdClass;

class ProgressReportController extends Controller
{

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
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function getProjectDetail()
    {
        $projectID = session('ProjectID');
        $contractorID = $_POST['contractorID'];
        $url = "/api/detailProject/" . $projectID . '/' . $contractorID;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getWorkProgress()
    {
        $projectID = session('ProjectID');
        $contractorID = $_POST['contractorID'];
        $docID = $_POST['docID'];
        $url = "/api/detailProject/" . $projectID . '/' . $contractorID;
        $responseBody = json_decode($this->getData($url));
        $days = ceil((strtotime($responseBody[0]->CompletionDate) - strtotime($responseBody[0]->CommencementDate)) / 84600);

        $urlDoc = "/api/DataDocumentByid/" . $docID;
        $responseBodyDocument = json_decode($this->getData($urlDoc));

        if($days!=0){
            $currentDays = ceil((strtotime($responseBodyDocument[0]->reportingDate) - strtotime($responseBody[0]->CommencementDate)) / 84600);
            $responseBody[0]->timeelapsed = ceil($currentDays);
            $responseBody[0]->percentelapse = ceil(($currentDays / $days) * 100);
            if (ceil(($currentDays / $days) * 100) < 70) {
                $responseBody[0]->timestatus = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i> LOW';
            } else if (ceil(($currentDays / $days) * 100) >= 70 && ceil(($currentDays / $days) * 100) <= 90) {
                $responseBody[0]->timestatus = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i> NORMAL';
            } else {
                $responseBody[0]->timestatus = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i> HIGH';
            }
        }else{
            $url = "/api/getTimeElapse/" . $projectID . '/' . $contractorID;
            $responseTime = json_decode($this->getData($url));
            $days = ceil((strtotime($responseTime[0]->maxDate) - strtotime($responseTime[0]->minDate)) / 84600);
        
            $currentDays = ceil((strtotime($responseTime[0]->maxDate)-strtotime($responseBodyDocument[0]->reportingDate) ) / 84600);
            $responseBody[0]->timeelapsed = ceil($days - $currentDays);
            $responseBody[0]->percentelapse = ceil((($days - $currentDays) / $days) * 100);
            if (ceil((($days - $currentDays) / $days) * 100) < 70) {
                $responseBody[0]->timestatus = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i> LOW';
            } else if (ceil((($days - $currentDays) / $days) * 100) >= 70 && ceil((($days - $currentDays) / $days) * 100) <= 90) {
                $responseBody[0]->timestatus = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i> NORMAL';
            } else {
                $responseBody[0]->timestatus = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i> HIGH';
            }
        }



        $url = "/api/getScheduledProgress";
        $sendData['projectID'] = $projectID;
        $sendData['contractorID'] = $contractorID;
        $sendData['date'] = date("Y-m-d", strtotime($responseBodyDocument[0]->reportingDate));
        $responseScheduled = json_decode($this->getByPostData($url, $sendData));
        $responseBody[0]->scheduledProgress = round($responseScheduled[0]->ScheduledPercent, 2);

        $url = "/api/getActualProgress";
        $sendData['projectID'] = $projectID;
        $sendData['contractorID'] = $contractorID;
        $sendData['docID'] = $docID;
       
        $responseActual = json_decode($this->getByPostData($url, $sendData));
        $responseBody[0]->actualProgress = round($responseActual[0]->All_actual, 2);
        $responseBody[0]->thisMonthProgress = round($responseActual[0]->ThisMonth, 2);
        $balance = round((($responseScheduled[0]->Total_planned_cost - $responseActual[0]->All_amount) / $responseScheduled[0]->Total_planned_cost) * 100, 2);
        
        $responseBody[0]->balance = $balance;
        $responseBody[0]->cost = round((100 - $balance), 2);
        if (round((100 - $balance), 2) < 70) {
            $responseBody[0]->coststatus = '<i class="fa fa-circle" aria-hidden="true" style="color:green"></i> LOW';
        } else if (round((100 - $balance), 2) >= 70 && round((100 - $balance), 2) <= 90) {
            $responseBody[0]->coststatus = '<i class="fa fa-circle" aria-hidden="true" style="color:orange"></i> NORMAL';
        } else {

            $responseBody[0]->coststatus = '<i class="fa fa-circle" aria-hidden="true" style="color:red"></i> HIGH';
        }

        return  json_encode($responseBody);
    }

    public function getProgressStatus()
    {
        $id = session('ProjectID');
        $url = "/api/ProjectDetail/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getIssue()
    {
        $projectID = session('ProjectID');
        $contractorID = $_POST['contractorID'];
        $url = "/api/getIssue/" . $projectID;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getIssueChart()
    {
        $id = session('ProjectID');
        $url = "/api/ProjectDetail/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getRiskReport()
    {
        $projectID = session('ProjectID');
        $contractorID = $_POST['contractorID'];
        $url = "/api/riskReport/" . $projectID . '/' . $contractorID;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getActualWbsDetail()
    {
        $id = $_POST['id'];
        $ProjectID = session('ProjectID');
        $contractorID = 0;

        $url = "/api/DataDocumentByid/" . $id;
        $responseBodyDocument = json_decode($this->getData($url));

        $sendData['projectID'] = $ProjectID;
        $sendData['contractorID'] = $contractorID;
        $sendData['docID'] = $id;
        $sendData['date'] = date("Y-m-d H:i", strtotime($responseBodyDocument[0]->reportingDate));

        $url = "/api/DataActualWbsDetail";
        $responseBody = json_decode($this->getByPostData($url, $sendData));
        $x = 0;
        $z = 1;
        $y = 1;
        $arr = array();
        for ($i = 0; $i < count($responseBody); $i++) {
            //     $responseBody[$i]->action = ' <button type="button" class="btn-form-child btn btn-info  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">Add Child Item</button>
            // <button class="edit-btn-parent btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            // <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
            if ($responseBody[$i]->price == "" || $responseBody[$i]->price == null) {
                $responseBody[$i]->price = 0;
            }

            $responseBody[$i]->cost = ($responseBody[$i]->qty * $responseBody[$i]->price);
            if ($responseBody[$i]->parentItem == null) {
                $responseBody[$i]->merge = $responseBody[$i]->no - $x;
                $responseBody[$i]->thisMonth = '<input type="text" readonly class="form-control form-this-month" style="background-color: rgba(21, 14, 14, 0)" min="0" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month_' . $responseBody[$i]->id . '" id="form-this-month_' . $responseBody[$i]->id . '" value="0">';
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
                $responseBody[$i]->thisMonth = '<input type="text" readonly class="form-control form-this-month" min="0" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month_' . $responseBody[$i]->id . '" id="form-this-month_' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->thisMonthQty . '">';
                $responseBody[$i]->accumulatedThisMonth = '<input type="text" readonly class="form-control form-this-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-this-month-accumulated' . $responseBody[$i]->id . '" id="form-this-month-accumulated' . $responseBody[$i]->id . '" value="' . ((int)$responseBody[$i]->accumulatedLastMonthQty + (int)$responseBody[$i]->thisMonthQty) . '">';
                $responseBody[$i]->actualAmount = '<input type="text" readonly class="form-control form-actual-amount" style="width: 100px;background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-amount' . $responseBody[$i]->id . '" id="form-actual-amount' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->actualAmount . '">';
                $responseBody[$i]->actualProgress = '<input type="text" readonly class="form-control form-actual-progress" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-actual-progress' . $responseBody[$i]->id . '" id="form-actual-progress' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->actualProgress . '">';
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
                    $responseBody[$i]->accumulatedLastMonthQty = '<input type="text" readonly class="form-control form-last-month-accumulated" style="background-color: rgba(21, 14, 14, 0)" data-ids="' . $responseBody[$i]->id . '" data-id="' . $i . '" name="form-last-month-accumulated' . $responseBody[$i]->id . '" id="form-last-month-accumulated' . $responseBody[$i]->id . '" value="' . $responseBody[$i]->accumulatedLastMonthQty . '">';
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

    public function monitoringCurve()
    {
        $projectID = session('ProjectID');
        $contractorID = $_POST['contractorID'];
        $url = "/api/getProgressCurve/" . $projectID . '/' . $contractorID;
        $responseBody = json_decode($this->getData($url));
        $url2 = "/api/getActualTable/" . $projectID . '/' . $contractorID;
        $responseBody2 = json_decode($this->getData($url2));
        $url3 = "/api/getCurrentTable/" . $projectID . '/' . $contractorID;
        $responseBody3 = json_decode($this->getData($url3));
        $x = 1;
        $month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        $month_length=count($responseBody);

        $responseBodyTemp = [];
        for ($i = 0; $i < $responseBody[$month_length-1]->idx; $i++) {
            $object = new stdClass();
            $object->month = $month[$i];
            $object->baseline =  0;
            $object->actual = 0;
            $object->current = 0;
            $object->idx = $i + 1;
            array_push($responseBodyTemp, $object);
        }
        for ($j = 0; $j < $responseBody[$month_length-1]->idx; $j++) {
            for ($i = 0; $i < count($responseBody); $i++) {
                if ($responseBodyTemp[$j]->idx == $responseBody[$i]->idx) {
                    $responseBodyTemp[$j]->baseline = round($responseBody[$i]->weight,2);
                }
            }
            for ($i = 0; $i < count($responseBody2); $i++) {
                if ($responseBodyTemp[$j]->idx == $responseBody2[$i]->idx) {
                    $responseBodyTemp[$j]->actual = round($responseBody2[$i]->weight,2);
                }
            }

            for ($i = 0; $i < count($responseBody3); $i++) {
                if ($responseBodyTemp[$j]->idx == $responseBody3[$i]->idx) {
                    $responseBodyTemp[$j]->current = round($responseBody3[$i]->weight,2);
                }
            }

            if($responseBodyTemp[$j]->baseline==0){
                $responseBodyTemp[$j]->baseline = round($responseBodyTemp[$j-1]->baseline,2);
            }
            if($responseBodyTemp[$j]->actual==0){
                $responseBodyTemp[$j]->actual = round($responseBodyTemp[$j-1]->actual,2);
            }
     
        }
        //print_r($responseBodyTemp);
        return json_encode($responseBodyTemp);
    }

    public function monitoringTable()
    {
        $projectID = session('ProjectID');
        $contractorID = $_POST['contractorID'];
        $url = "/api/getBaseline/" . $projectID . '/' . $contractorID;
        $responseBody = json_decode($this->getData($url));
        $url2 = "/api/getActualTable/" . $projectID . '/' . $contractorID;
        $responseBody2 = json_decode($this->getData($url2));
        $url3 = "/api/getCurrentTable/" . $projectID . '/' . $contractorID;
        $responseBody3 = json_decode($this->getData($url3));

        $month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $th = "";
        $table = "";
        $tr = "";

        $month_length=count($responseBody);

        $responseBodyTemp = [];
        for ($i = 0; $i < $responseBody[$month_length-1]->idx; $i++) {
            $object = new stdClass();
            $object->weight = 0;
            $object->month =  $month[$i];
            $object->idx = $i + 1;
            array_push($responseBodyTemp, $object);
        }
        for ($j = 0; $j < $responseBody[$month_length-1]->idx; $j++) {
            for ($i = 0; $i < count($responseBody); $i++) {
                if ($responseBodyTemp[$j]->idx == $responseBody[$i]->idx) {
                    $responseBodyTemp[$j]->weight = round($responseBody[$i]->weight,2);
                }
            }
            if($responseBodyTemp[$j]->weight==0){
                $responseBodyTemp[$j]->weight = round($responseBodyTemp[$j-1]->weight,2);
            }
            
        }

        
        $responseBodyTemp2 = [];
        for ($i = 0; $i < $responseBody[$month_length-1]->idx; $i++) {
            $object = new stdClass();
            $object->weight = 0;
            $object->month =  $month[$i];
            $object->idx = $i + 1;
            array_push($responseBodyTemp2, $object);
        }
        for ($j = 0; $j < $responseBody[$month_length-1]->idx; $j++) {
            for ($i = 0; $i < count($responseBody2); $i++) {
                if ($responseBodyTemp2[$j]->idx == $responseBody2[$i]->idx) {
                    $responseBodyTemp2[$j]->weight = round($responseBody2[$i]->weight,2);
                }
            }
            if($responseBodyTemp2[$j]->weight==0){
                $responseBodyTemp2[$j]->weight = round($responseBodyTemp2[$j-1]->weight,2);
            }
        }

        $responseBodyTemp3 = [];
        for ($i = 0; $i < $responseBody[$month_length-1]->idx; $i++) {
            $object = new stdClass();
            $object->weight = 0;
            $object->month =  $month[$i];
            $object->idx = $i + 1;
            array_push($responseBodyTemp3, $object);
        }
        for ($j = 0; $j < $responseBody[$month_length-1]->idx; $j++) {
            for ($i = 0; $i < count($responseBody3); $i++) {
                if ($responseBodyTemp3[$j]->idx == $responseBody3[$i]->idx) {
                    $responseBodyTemp3[$j]->weight = round($responseBody3[$i]->weight,2);
                }
            }
        }


        $td = "";
        $td = $td . '<td>1</td><td>BASELINE</td>';
        for ($j = 0; $j < count($responseBodyTemp); $j++) {
            if ($responseBodyTemp[$j]->idx == $j + 1) {
                $td = $td . '<td>' . $responseBodyTemp[$j]->weight . '</td>';
            } else {
                $td = $td . '<td>0</td>';
            }
        }

        $tr = $tr . '<tr>' . $td . '</tr>';

        $td = "";
        $td = $td . '<td>2</td><td>ACTUAL</td>';
        for ($j = 0; $j < count($responseBodyTemp2); $j++) {
            if ($responseBodyTemp2[$j]->idx == $j + 1) {
                $td = $td . '<td>' . $responseBodyTemp2[$j]->weight . '</td>';
            } else {
                $td = $td . '<td>0</td>';
            }
        }

        $tr = $tr . '<tr>' . $td . '</tr>';

        $td = "";
        $td = $td . '<td>3</td><td>CURRENT</td>';
        for ($j = 0; $j < count($responseBodyTemp3); $j++) {
            if ($responseBodyTemp3[$j]->idx == $j + 1) {
                $td = $td . '<td>' . $responseBodyTemp3[$j]->weight . '</td>';
            } else {
                $td = $td . '<td>0</td>';
            }
        }

        $tr = $tr . '<tr>' . $td . '</tr>';


       
        for ($i = 0; $i < $responseBody[$month_length-1]->idx; $i++) {

            $th = $th . '<th>' . $month[$i] . '</th>';
        }

        $table = '
            <thead>
                <tr>
                <th>NO</th>
                <th>ORIGINAL</th>
                ' . $th . '
                </tr>
            </thead>
            <tbody>' . $tr . '</tbody>';

        return $table;
    }
    public function monitoringTable2()
    {
    }
}
