<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentCertificateController extends Controller
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

    //=========================================================================================
    //=========================================================================================

    public function getPaymentCertificate(){
        $projectID =session('ProjectID');
        $url = "/api/getList/" . $projectID;
        $responseBody = json_decode($this->getData($url));
        for($i=0;$i<count($responseBody);$i++){
            $responseBody[$i]->action='<a href="/payment-certificate-report-detail/'.$responseBody[$i]->docID.'" class="btn btn-primary waves-effect waves-light m-1">Details</button>';
        }
        return  json_encode($responseBody);
    }

    public function getPaymentList(){
        $docID = $_POST['docID'];
        $url = "/api/paymentItemList/" . $docID;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getPaymentVAT(){
        $docID = $_POST['docID'];
        $url = "/api/getItemVat/" . $docID;
        $responseBody = json_decode($this->getData($url));
        for($i=0;$i<count($responseBody);$i++){
            $responseBody[$i]->action='<button class="btn btn-danger waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">Delete</button>';
        }
        return  $responseBody;
    }

    public function getPaymentNonVAT(){
        $docID = $_POST['docID'];
        $url = "/api/getItemNonVat/" . $docID;
        $responseBody = json_decode($this->getData($url));
        for($i=0;$i<count($responseBody);$i++){
            $responseBody[$i]->action='<button class="btn btn-danger waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">Delete</button>';
        }
        return  $responseBody;
    }

    public function getPaymentListDetail(){
        $docID = $_POST['docID'];
        $url = "/api/paymentItemList/" . $docID;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getCertificateTitle(){
        $docID = $_POST['docID'];
        $url = "/api/getCertificateTitle/" . $docID;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function addItemNonVat(){
        $docID = $_POST['docID'];
        $url = "/api/createDeduction";

        $sendData['PaymentID']=$_POST['PaymentID'];
        $sendData['DeductionItem']=$_POST['DeductionItem'];
        $sendData['Value']=$_POST['Value'];
        $sendData['type']=1;
        $responseBody = $this->insertData($url, $sendData);
        return $responseBody;
    }

    public function addItemVat(){
        $docID = $_POST['docID'];
        $url = "/api/createDeduction";
      
        $sendData['PaymentID']=$_POST['PaymentID'];
        $sendData['DeductionItem']=$_POST['DeductionItem'];
        $sendData['Value']=$_POST['Value'];
        $sendData['type']=2;
        $responseBody = $this->insertData($url, $sendData);
        return $responseBody;
    }

    public function addCertificate(){
        $docID = $_POST['docID'];
        $url = "/api/createCertificate";
      
        $sendData['ReportDate']=$_POST['ReportDate'];
        $sendData['Comment']=$_POST['Comment'];
        $sendData['docID']=$docID;
        $responseBody = json_decode($this->insertData($url, $sendData));
        $responseBody->last_insert_id;
        return $responseBody;
    }
    
    public function deleteDeductionItem()
    {
        $id = $_POST['id'];
        $url = "/api/deleteDeduction/" . $id;
        $responseBody = $this->DeleteData($url);
        return $responseBody;
    }

    public function addPayment(){
        $docID=$_POST['docID'];
        $datePayment=$_POST['datePayment'];
        $contractorID=$_POST['contractorID'];  
        $commentPayment=$_POST['commentPayment'];
        $deduction=json_decode($_POST['deduction']);
        $vat=json_decode($_POST['vat']);

        $sendTitle['ReportDate']=$datePayment;
        $sendTitle['Comment']=$commentPayment;
        $sendTitle['docID']=$docID;
        $url = "/api/createCertificate";
        $responseBody = json_decode($this->insertData($url, $sendTitle));
       
        for($i=0;$i<count($deduction);$i++){
            $url = "/api/createDeduction";
            $sendDeduction['DeductionItem']= $deduction[0]->name;
            $sendDeduction['Value']= $deduction[0]->value;
            $sendDeduction['type']=1;
            $sendDeduction['PaymentID']= $responseBody->last_insert_id;
            $this->insertData($url, $sendDeduction);
        }
        for($i=0;$i<count($vat);$i++){
            $url = "/api/createDeduction";
            $sendDeduction['DeductionItem']= $vat[0]->name;
            $sendDeduction['Value']= $vat[0]->value;
            $sendDeduction['type']=2;
            $sendDeduction['PaymentID']= $responseBody->last_insert_id;
            $this->insertData($url, $sendDeduction);
        }

        return json_encode($responseBody);

    }

}