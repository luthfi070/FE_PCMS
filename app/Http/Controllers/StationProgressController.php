<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StationProgressController extends Controller
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

    public function getParentItem()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/GetActualParentItem/" . $projectID . "/" . $contractorID;
        $responseBody = json_decode($this->getData($url));
        $option = '';
        for ($i = 0; $i < count($responseBody); $i++) {
            $option = $option . '<option value="' . $responseBody[$i]->id . '">' . $responseBody[$i]->itemName . '</option>';
        }

        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->option = $option;
        }
        return  json_encode($responseBody);
    }

    public function getChildItem()
    {
        $id = $_POST['id'];
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/GetActualChildItem/" . $projectID . "/" . $contractorID . "/" . $id;
        $responseBody = json_decode($this->getData($url));
        $option = '';
        for ($i = 0; $i < count($responseBody); $i++) {
            $option = $option . '<option value="' . $responseBody[$i]->id . '">' . $responseBody[$i]->itemName . '</option>';
        }

        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->option = $option;
        }
        return  json_encode($responseBody);
    }

    public function addStation()
    {
        //$contractor=$_POST['contractorName'];
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $Item = $_POST['parentItem'];
        $desc = $_POST['descStation'];
        $station = explode(",", $_POST['list']);

        $url = "/api/InsertDataStation";
        for ($i = 0; $i < count($station); $i++) {
            $sendData['stationName'] = $station[$i];
            $sendData['description'] = $desc;
            $sendData['itemID'] = $Item;
            $sendData['ProjectID'] = $projectID;
            $sendData['ContractorID'] = $contractorID;
            $responseBody = $this->insertData($url, $sendData);
        }
        return $responseBody;
    }

    public function addSubItem()
    {
        //$contractor=$_POST['contractorid'];



        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $item = $_POST['generalItemID'];
        $child = $_POST['childItem'];


        $url = "/api/getStationByParent/" . $item;
        $responseBodyStation = json_decode($this->getData($url));

        $url = "/api/InsertDataSubItem";
        for ($i = 0; $i < count($responseBodyStation); $i++) {
            $sendData['itemID'] = $child;
            $sendData['parentID'] = $item;
            $sendData['stationID'] = $responseBodyStation[$i]->id;
            $sendData['completedStatus'] = 0;
            $sendData['completionDate'] = null;
            $responseBody = $this->insertData($url, $sendData);
        }

        return  $responseBody;
    }

    public function editCompletion()
    {
        $id = $_POST['EditItemDetailID'];
        $itemID= $_POST['itemID'];
        $url = "/api/UpdateSubItem/" . $itemID."/".$_POST['optionStationItemDetail'];

        $sendData['stationID'] = $_POST['optionStationItemDetail'];
        $sendData['completedStatus'] = $_POST['ProgressStatus'];
        $sendData['completionDate'] = $_POST['dateItemDetail'];

        $responseBody = $this->updateData($url, $sendData);
        return  $responseBody;
    }

    public function editStation()
    {
        $id = $_POST['parentItemEdit'];
        $url = "/api/updateStation/" . $id;

        $sendData['description'] = $_POST['descStationEdit'];

        $responseBody = $this->updateData($url, $sendData);
        return  $responseBody;
    }

    public function getSubItem()
    {
        $id = $_POST['id'];
        $url = "/api/getSubItem/" . $id;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button type="button" class="delete-btn btn btn-danger  waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">Remove</button>';
        }

        return  json_encode($responseBody);
    }

    public function stationDetail()
    {
        $id = $_POST['id'];
        $url = "/api/DataStationDetail/" . $id;
        $responseBody = $this->getData($url);


        return $responseBody;
    }


    public function getSubItemStation()
    {
        $id = $_POST['id'];
        $url = "/api/getSubItemTable/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getSubItemTableRow()
    {
        $id = $_POST['id'];
        $url = "/api/getSubItemTable/" . $id;
        $responseBody = json_decode($this->getData($url));
        $url2 = "/api/getSubItemRowTable/" . $id;
        $responseBody2 = json_decode($this->getData($url2));
        $th = "";
        $table = "";
        $tr = "";

        for ($i = 0; $i < count($responseBody2); $i++) {
            $td = "";
            $td = $td . '<td>' . $responseBody2[$i]->no . '</td><td>' . $responseBody2[$i]->itemName . '</td>';

            for ($j = 0; $j < count($responseBody); $j++) {
                
                    $td = $td . '<td id="progressTab_'.$responseBody2[$i]->itemID2.'_' . $responseBody[$j]->id . '"></td>';
               
            }
            $td = $td . '<td><button type="button" class="edit-btn-detail btn btn-warning px-5" id="btn-editdetailitem" data-name="' . $responseBody2[$i]->itemName . '" data-itemID="'.$responseBody2[$i]->itemID2.'" data-id="' . $responseBody2[$i]->idSubItem . '"><i class="fa fa-edit"></i> Edit</button></td>';
            $tr = $tr . '<tr>' . $td . '</tr>';
        }

        for ($i = 0; $i < count($responseBody); $i++) {

            $th = $th . '<th>' . $responseBody[$i]->stationName . '</th>';
        }
        $table = '
            <thead>
                <tr>
                <th>NO</th>
                <th>ITEM NAME</th>
                ' . $th . '
                <th>ACTION</th>
                </tr>
            </thead>
            <tbody>' . $tr . '</tbody>';

        return  $table;
    }

    public function getCompletion(){
        $id = $_POST['id'];
        $url = "/api/getCompSubItemTable/" . $id;
        $responseBody = $this->getData($url);
        return $responseBody;
    }

    public function getStationData()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataStation/" . $projectID . "/" . $contractorID;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button type="button" class="edit-btn  btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">Edit</button>
            <button type="button" class="delete-btn btn btn-danger  waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">Delete</button>
            <button type="button" class="detail-btn btn btn-primary  waves-effect waves-light m-1" data-contractor="' . $responseBody[$i]->BussinessName . '" data-item="' . $responseBody[$i]->itemName . '" data-id="' . $responseBody[$i]->id . '" data-idStation="' . $responseBody[$i]->idStation . '">Details</button>';
        }

        return  json_encode($responseBody);
    }

    public function deleteSub()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteSubItem/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }


    public function deleteItem()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteStation/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================


}
