<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserManagementController extends Controller
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
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function PrivilegedName()
    {
        $url = "/api/DataPrivilegedName";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.unit', compact('responseBody'));
    }

    public function getPrivilegedName()
    {
        $url = "/api/DataPrivilegedName";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button class="btn btn-info waves-effect waves-light m-1 formmodalright" data-id="' . $responseBody[$i]->id . '">RIGHT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getPrivilegedNameByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataPrivilegedNameByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updatePrivilegedName()
    {
        $id = $_POST['idPrivilegedName'];
        $PrivilegedNameEdit = $_POST['PrivilegedNameEdit'];
        $url = "/api/UpdatePrivilegedName/" . $id;
        $sendData['PrivilegedName'] = $PrivilegedNameEdit;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }


    public function addPrivilegedName()
    {
        $name = $_POST['PrivilegedName'];
        $url = "/api/InsertDataPrivilegedName";
        $sendData['PrivilegedName'] = $name;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteProfile()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataProfile/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function Privileged()
    {
        $url = "/api/DataPrivileged";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.unit', compact('responseBody'));
    }

    public function getPrivileged()
    {
        $url = "/api/DataPrivileged";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button class="btn btn-info waves-effect waves-light m-1 formmodalright" data-id="' . $responseBody[$i]->id . '">RIGHT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getPrivilegedByid($setID = "")
    {
        if ($setID != '') {
            $id = $setID;
        } else {
            $id = $_POST['id'];
        }
        $url = "/api/DataPrivilegedByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getSpecPrivilegedByid($setID = "")
    {
        if ($setID != '') {
            $id = $setID;
        } else {
            $id = $_POST['id'];
        }
        $url = "/api/DataSpecPrivilegedByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }


    public function updatePrivileged()
    {
        $id = $_POST['idPrivilegedName'];
        $PrivilegedNameEdit = $_POST['PrivilegedNameEdit'];
        $url = "/api/UpdatePrivileged/" . $id;
        $sendData['PrivilegedName'] = $PrivilegedNameEdit;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }


    public function addPrivileged()
    {
        $right = $_POST['UserRight'];
        $id = $_POST['idPrivilegedNameRight'];
        $temp = array();
        $temp2 = array();
        foreach (json_decode($this->getPrivilegedByid($id)) as $struct) {
            array_push($temp, $struct->UserPrivileged);
            array_push($temp2, $struct->UserPrivileged . '/' . $struct->status);
        }
        $resultDiff = array_values(array_diff($temp, $right));
        $url = "/api/InsertDataPrivileged";

        if (count($resultDiff) > 0) {
            for ($j = 0; $j < count($resultDiff); $j++) {
                $sendData['PrivilegedNameID'] = $id;
                $sendData['UserPrivileged'] = $resultDiff[$j];
                $sendData['status'] = '0';
                $responseBody = $this->insertData($url, $sendData);
            }
        }

        //print_r($resultDiff);

        for ($i = 0; $i < count($right); $i++) {


            $sendData['PrivilegedNameID'] = $id;
            $sendData['UserPrivileged'] = $right[$i];
            $sendData['status'] = '1';

           
            $responseBody = $this->insertData($url, $sendData);
        }

         return  $responseBody;
    }

    public function deletePrivileged()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataPrivileged/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //==================================================================================================================================================================================================
    //==================================================================================================================================================================================================

    public function users()
    {
        $url = "/api/DataUser";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.unit', compact('responseBody'));
    }

    public function getUser()
    {
        $url = "/api/DataUser";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button class="btn btn-info waves-effect waves-light m-1 btn-formmodalright" data-id="' . $responseBody[$i]->id . '">RIGHT</button>
            <button class="edit-pass btn btn-secondary waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">PASSWORD</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getUserByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataUserByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getUserPrivilegedByid(){
        $id = $_POST['id'];
        $url = "/api/DataUserPrivilegedByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }
    public function updateUserPassword()
    {
        $id = $_POST['idUser2'];
        $password=$_POST['passwordEdit'];
        $url = "/api/UpdateUser/" . $id;
        $sendData['id'] = $id;
        $sendData['password'] = $password;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }
    public function updateUser()
    {
        $id = $_POST['idUser'];
        $UserfullnameEdit = $_POST['UserfullnameEdit'];
        $UserLoginEdit = $_POST['UserLoginEdit'];
        $UserMailEdit = $_POST['UserMailEdit'];
        $UserProfileEdit = $_POST['UserProfileEdit'];
        $PrivilegedStatusEdit = isset($_POST['PrivilegedStatusEdit']) == null ? 0 : $_POST['PrivilegedStatusEdit'];
        $GuestStatus = isset($_POST['GuestStatusEdit']) ?  $_POST['GuestStatusEdit'] :0;
        $project= isset($_POST['viewProjectEdit']) ?  $_POST['viewProjectEdit'] :0;

        $url = "/api/UpdateUser/" . $id;
        $sendData['id'] = $id;
        $sendData['Userfullname'] = $UserfullnameEdit;
        $sendData['UserLogin'] = $UserLoginEdit;
        $sendData['UserMail'] = $UserMailEdit;
        $sendData['UserProfile'] = $UserProfileEdit;
        $sendData['PrivilegedStatus'] = $PrivilegedStatusEdit;
        $sendData['guest'] = $GuestStatus;
        $sendData['project'] = $project;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }


    public function addUser()
    {
        $Userfullname = $_POST['Userfullname'];
        $UserLogin = $_POST['UserLogin'];
        $UserMail = $_POST['UserMail'];
        $UserProfile = $_POST['UserProfile'];
        $PrivilegedStatus = isset($_POST['PrivilegedStatus']) ?  $_POST['PrivilegedStatus'] :0;
        $GuestStatus = isset($_POST['GuestStatus']) ?  $_POST['GuestStatus'] :0;
        $project= isset($_POST['viewProject']) ?  $_POST['viewProject'] :0;
        $password = $_POST['password'];

        $url = "/api/InsertDataUser";

        $sendData['Userfullname'] = $Userfullname;
        $sendData['UserLogin'] = $UserLogin;
        $sendData['UserMail'] = $UserMail;
        $sendData['UserProfile'] = $UserProfile;
        $sendData['PrivilegedStatus'] = $PrivilegedStatus;
        $sendData['password'] = $password;
        $sendData['guest'] = $GuestStatus;
        $sendData['project'] = $project;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteUser()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataUser/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    
}
