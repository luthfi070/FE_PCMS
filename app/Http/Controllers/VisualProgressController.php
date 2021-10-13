<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VisualProgressController extends Controller
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

    public function getVisualProgress()
    {
        // $contractorid=$_POST['contractorid'];
        // $projectid=$_POST['contractorid'];
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/DataVisualProgress/" . $projectID . "/" . $contractorID;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button type="button" class="delete-btn btn btn-danger  waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->idVisual . '">Delete</button>
            <button type="button" class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->idVisual . '">Edit</button>
            <button type="button" class="detail-btn btn btn-primary waves-effect waves-light m-1" data-id="' . $responseBody[$i]->idVisual . '">Details</button>';
        }
        return  json_encode($responseBody);
    }

    public function getOtherVisualProgress()
    {
        $contractorID = $_POST['contractorID'] == null ? 0 : $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/OtherDataVisualProgress/" . $projectID . "/" . $contractorID;
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = '<button type="button" class="delete-btn btn btn-danger  waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->idVisual . '">Delete</button>
            <button type="button" class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->idVisual . '">Edit</button>
            <button class="detail-btn btn btn-primary  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->idVisual . '">Details</button>';
        }
        return  json_encode($responseBody);
    }

    public function getVisualProgressDetail()
    {
        $id = $_POST['id'];
        $url = "/api/DataVisualProgressDetail/".$id;
        $responseBody = json_decode($this->getData($url));
        $imgItem = "";
        $img="";
        for ($i = 0; $i < count($responseBody); $i++) {
            $divHead = "";
            if ($i == 0) {
                $divHead = '<div class="carousel-item active">';
            } else {
                $divHead = '<div class="carousel-item">';
            }
            $divBody = $divHead . '<div class="row">
            <div class="col-sm-8">
                <img class="d-block w-100" src="' . $responseBody[$i]->imgUrl . '" alt="First slide">
            </div>
            <div class="col-sm-3">
                <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION:</label>
                <div class="col-sm-10">
                ' . $responseBody[$i]->visualDesc . '
                </div>
                <div class="container p-3 my-3 border">
                    <p>Extension : ' . $responseBody[$i]->imgExt . '</p>
                    <p>File Name : ' . $responseBody[$i]->imgName . '</p>
                    <p>Created At : ' . $responseBody[$i]->created_at . '</p>
                </div>
                <!-- <button type="button" class="edit-img-btn btn btn-warning col-lg-12 mt-3" id="" data-id="' . $responseBody[$i]->id . '"><i class="fa fa-edit"></i> Edit</button> -->
        <button type="button" class="delete-img-btn btn btn-danger col-lg-12 mt-3" data-id="' . $responseBody[$i]->id . '"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>

    </div>';
            $imgItem = $imgItem . "" . $divBody;
        }
        $img = ' <div class="col-sm-12">
        <div id="carouselExampleControls" class="carousel slide" data-interval="false">
            <div class="carousel-inner">
                ' . $imgItem . '
            </div>
            <a class="carousel-control-prev" style="width:5%" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" style="width:5%" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>';
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->img = $img;
        }
        return  json_encode($responseBody);
    }

    public function getOtherVisualProgressDetail()
    {
        $id = $_POST['id'];
        $url = "/api/OtherDataVisualProgressDetail/".$id;
        $responseBody = json_decode($this->getData($url));
        $imgItem = "";
        $img="";
        for ($i = 0; $i < count($responseBody); $i++) {
            $divHead = "";
            if ($i == 0) {
                $divHead = '<div class="carousel-item active">';
            } else {
                $divHead = '<div class="carousel-item">';
            }
            $divBody = $divHead . '<div class="row">
            <div class="col-sm-8">
                <img class="d-block w-100" src="' . $responseBody[$i]->imgUrl . '" alt="First slide">
            </div>
            <div class="col-sm-3">
                <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION:</label>
                <div class="col-sm-10">
                ' . $responseBody[$i]->visualDesc . '
                </div>
                <div class="container p-3 my-3 border">
                    <p>Extension : ' . $responseBody[$i]->imgExt . '</p>
                    <p>File Name : ' . $responseBody[$i]->imgName . '</p>
                    <p>Created At : ' . $responseBody[$i]->created_at . '</p>
                </div>
                <!-- <button type="button" class="edit-img-btn btn btn-warning col-lg-12 mt-3" id="" data-id="' . $responseBody[$i]->id . '"><i class="fa fa-edit"></i> Edit</button> -->
        <button type="button" class="delete-img-btn btn btn-danger col-lg-12 mt-3" data-id="' . $responseBody[$i]->id . '"><i class="fa fa-trash"></i> Delete</button>
            </div>
        </div>

    </div>';
            $imgItem = $imgItem . "" . $divBody;
        }
        $img = ' <div class="col-sm-12">
        <div id="carouselExampleControlsOther" class="carousel slide" data-interval="false">
            <div class="carousel-inner">
                ' . $imgItem . '
            </div>
            <a class="carousel-control-prev" style="width:5%" href="#carouselExampleControlsOther" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" style="width:5%" href="#carouselExampleControlsOther" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>';
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->img = $img;
        }
        return  json_encode($responseBody);
    }

    public function addVisualImage()
    {
        // {{url('image')}}


        $name = $_FILES["imgAddVisual"]["name"];
        $type = explode('/',$_FILES["imgAddVisual"]["type"]);
        $path="image/" . $_FILES['imgAddVisual']['name'];
        move_uploaded_file($_FILES["imgAddVisual"]["tmp_name"], "image/" . $_FILES['imgAddVisual']['name']);

        $url = "/api/InsertVisualProgressImage";

        $sendData['visualDesc'] = $_POST['descAddVisual'];
        $sendData['imgUrl'] = $path;
        $sendData['visualDate'] = $_POST['visualDateAddVisual'];
        $sendData['imgName'] = $name;
        $sendData['imgExt'] =  $type[1];
        $sendData['visualProgressID'] = $_POST['IdvisualItemAddVisual'];
        $responseBody = $this->insertData($url, $sendData);
        return  $responseBody;
    }

    public function addOtherVisualImage()
    {
        // {{url('image')}}


        $name = $_FILES["imgAddVisualOther"]["name"];
        $type = explode('/',$_FILES["imgAddVisualOther"]["type"]);
        $path="image/" . $_FILES['imgAddVisualOther']['name'];
        move_uploaded_file($_FILES["imgAddVisualOther"]["tmp_name"], "image/" . $_FILES['imgAddVisualOther']['name']);

        $url = "/api/InsertVisualProgressImage";

        $sendData['visualDesc'] = $_POST['descAddVisualOther'];
        $sendData['imgUrl'] = $path;
        $sendData['visualDate'] = $_POST['visualDateAddVisualOther'];
        $sendData['imgName'] = $name;
        $sendData['imgExt'] =  $type[1];
        $sendData['visualProgressID'] = $_POST['IdvisualItemAddVisualOther'];
        $responseBody = $this->insertData($url, $sendData);
        return  $responseBody;
    }

    public function addVisualProgress()
    {
        //$itemVisualName=$_POST[''];
        $itemID = $_POST['itemList'];
        // $contractorID=$_POST[''];
        // $projectID=$_POST[''];
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/InsertVisualProgress";

        $sendData['itemVisualName'] = null;
        $sendData['itemID'] = $itemID;
        $sendData['contractorID'] = $contractorID;
        $sendData['projectID'] = $projectID;
        $responseBody = $this->insertData($url, $sendData);
        return  $responseBody;
    }

    public function addOtherVisualProgress()
    {
        $itemVisualName=$_POST['otherItemName'];
        //$itemID = $_POST['itemList'];
        // $contractorID=$_POST[''];
        // $projectID=$_POST[''];
        $contractorID = $_POST['contractorID'];
        $projectID = session('ProjectID');
        $url = "/api/InsertVisualProgress";

        $sendData['itemVisualName'] = $itemVisualName;
        $sendData['itemID'] = 0;
        $sendData['contractorID'] = $contractorID;
        $sendData['projectID'] = $projectID;
        $responseBody = $this->insertData($url, $sendData);
        return  $responseBody;
    }

    public function editVisualProgress(){
        $id=$_POST['progressID'];
        $url="/api/EditVisualProgress/".$id;
        $sendData['itemID'] =$_POST['itemListEdit'];
        $responseBody = $this->insertData($url, $sendData);
        return  $responseBody;
    }

    public function editOtherVisualProgress(){
        $id=$_POST['progressOtherID'];
        $url="/api/EditVisualProgress/".$id;
        $sendData['itemVisualName'] =$_POST['otherItemNameEdit'];
        $responseBody = $this->insertData($url, $sendData);
        return  $responseBody;
    }

    public function deleteImage(){
        $id = $_POST['id'];
        $url = "/api/DeleteImage/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    public function deleteVisual(){
        $id = $_POST['id'];
        $url = "/api/DeleteVisual/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }
}
