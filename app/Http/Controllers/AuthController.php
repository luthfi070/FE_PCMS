<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // private $baseApi = "http://127.0.0.1:8081";

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

    private function getPostData($url)
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

    //================================================================================================================
    //================================================================================================================
    //================================================================================================================


    public function CheckAuth(Request $request)
    {
        $username = $request->InputUsername;
        $pass = $request->InputPassword;
        $url = "/api/getUser";
        $sendData['UserLogin'] = $username;
        $sendData['password'] = $pass;
        $responseBody = $this->insertData($url, $sendData);
        $respons = json_decode($responseBody);
       
        if ($responseBody) {
            session(['Userfullname' => $respons[0]->Userfullname]);
            session(['UserID' => $respons[0]->UserID]);
            session(['BussinessPartnerID' => $respons[0]->BussinessPartnerID]);
            session(['UserMail' => $respons[0]->UserMail]);
            session(['PrivilegedStatus' => $respons[0]->PrivilegedStatus]);
            $BussinessID=$respons[0]->BussinessPartnerID;
            $url = "/api/getUserProject";
            $sendData2['BusinessPartnerID'] = $BussinessID;
            $responseBody2 = $this->insertData($url, $sendData2);
            $respons2 = json_decode($responseBody2);
            if(count($respons2)>0){
                session(['ProjectID' => $respons2[0]->ProjectID]);
            }else{
                session(['ProjectID' => 0]);
            }
            
        }
        if ($respons[0]->UserLogin == $username && $respons[0]->password == $pass) {
            return $responseBody;
        } else {
            return json_encode(["status" => "404"]);
        }
    }

    public function CheckAuthGuest()
    {
        $username = $_POST['InputUsername'];
        $pass = $_POST['InputPassword'];
        $url = "/api/getGuest";
        $sendData['UserLogin'] = $username;
        $sendData['password'] = $pass;
        $responseBody = $this->insertData($url, $sendData);
        $respons = json_decode($responseBody);
       
        if ($responseBody) {
            session(['Userfullname' => $respons[0]->Userfullname]);
            session(['UserID' => $respons[0]->UserID]);
            session(['UserMail' => $respons[0]->UserMail]);
            session(['ProjectID' => $respons[0]->project]);
            
        }
        if ($respons[0]->UserLogin == $username && $respons[0]->password == $pass) {
            return $responseBody;
        } else {
            return json_encode(["status" => "404"]);
        }
    }

    public function getPrivilegedPage()
    {
        $id = session('UserID');
        $url = "/api/getUserPrivileged/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }
}
