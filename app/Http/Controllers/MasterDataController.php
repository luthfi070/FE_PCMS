<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MasterDataController extends Controller
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



    public function business_type()
    {
        $url = "/api/DataBussinessType";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.business-type', compact('responseBody'));
    }

    public function getType()
    {
        $url = "/api/DataBussinessType";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getTypeByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataBussinessTypeByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateType()
    {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $url = "/api/UpdateDataBussinessType/" . $id;
        $sendData['BussinessTypeName'] = $type;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    public function addType()
    {
        $type = $_POST['type'];
        $url = "/api/InsertDataBussinessType";
        $sendData['BussinessTypeName'] = $type;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteType()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataBussinessType/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function country()
    {
        $url = "/api/DataCountry";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.country', compact('responseBody'));
    }

    public function getCountry()
    {
        $url = "/api/DataCountry";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getLastInputCountry()
    {
        $url = "/api/DataLastInput";
        $responseBody = json_decode($this->getData($url));
        if(empty($responseBody)){
            return '1';
        }else{
            return $responseBody[0]->id;
        }
    }

    public function getCountryByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataCountryByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateCountry()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $url = "/api/UpdateCountry/" . $id;
        $sendData['CountryName'] = $name;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addCountry()
    {
        $name = $_POST['name'];
        $url = "/api/InsertDataCountry";
        $sendData['CountryName'] = $name;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function addCountrySeeder()
    {
        //ini_set('max_execution_time', 1800);
        $client = new Client();

        $url = "https://countriesnow.space/api/v0.1/countries";
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = $response->getBody();
        $states = json_decode($responseBody);

        $url2 = "https://countriesnow.space/api/v0.1/countries/currency";

        foreach ($states->data as $state) {
            $url = "/api/InsertDataCountry";
            $sendData['CountryName'] = $state->country;
            $responseBody = $this->insertData($url, $sendData);
            $lastInputCountryID=$this->getLastInputCountry();
            $url = "/api/InsertDataCurrency";
            $response2 = $client->request('POST', $url2, ['json' => ['country' => $state->country ]]);
            $responseBody2 = json_decode($response2->getBody());
            $sendData['CountryID'] = $lastInputCountryID;
            $sendData['CurrencyName'] = $responseBody2->data->currency;
            $responseBody2 = $this->insertData($url, $sendData);
            foreach ($state->cities as $city) {
                $url = "/api/InsertDataCity";
                $sendData['CountryID'] = $lastInputCountryID;
                $sendData['CityName'] = $city;
                $responseBody = $this->insertData($url, $sendData);
            }
        }


        return  $responseBody;
        //print_r($states->data[0]->country);
    }

    public function deleteCountry()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataCountry/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

      //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function city()
    {
        $url = "/api/DataCity";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.city', compact('responseBody'));
    }

    public function getCity()
    {
        $url = "/api/DataCity";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getCityByCountryId()
    {
        $id = $_POST['id'];
        $url = "/api/DataCityByCountryId/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function getCityByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataCityByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateCity()
    {
        $id = $_POST['id'];
        $idCountry=$_POST['idCountry'];
        $name = $_POST['name'];
        $url = "/api/UpdateCity/" . $id;
        $sendData['CountryID'] = $idCountry;
        $sendData['CityName'] = $name;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addCity()
    {
        $name = $_POST['name'];
        $idCountry=$_POST['idCountry'];
        $url = "/api/InsertDataCity";
        $sendData['CountryID'] = $idCountry;
        $sendData['CityName'] = $name;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteCity()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataCity/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    
      //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function currency()
    {
        $url = "/api/DataCurrency";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.currency', compact('responseBody'));
    }

    public function getCurrency()
    {
        $url = "/api/DataCurrency";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getOrInsertCurrencyByName($currency){
        $url = "/api/getOrInsertCurrencyByName/" . $currency;
        $url = config('global.api_url') . $url;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        return  $responseBody;
    }

    public function getCurrencyByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataCurrencyByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateCurrency()
    {
        $id = $_POST['id'];
        $idCountry=$_POST['idCountry'];
        $name = $_POST['name'];
        $url = "/api/UpdateCurrency/" . $id;
        $sendData['CountryID'] = $idCountry;
        $sendData['CurrencyName'] = $name;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addCurrency()
    {
        $name = $_POST['name'];
        $idCountry=$_POST['idCountry'];
        $url = "/api/InsertDataCurrency";
        $sendData['CountryID'] = $idCountry;
        $sendData['CurrencyName'] = $name;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteCurrency()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataCurrency/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

      //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function unit()
    {
        $url = "/api/DataUnit";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.unit', compact('responseBody'));
    }

    public function getUnit()
    {
        $url = "/api/DataUnit";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getOrInsertUnitBySymbol($symbol){
        $url = "/api/getOrInsertUnitBySymbol/" . $symbol;
        $url = config('global.api_url') . $url;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody());
        return  $responseBody;
    }

    public function getUnitByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataUnitByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateUnit()
    {
        $id = $_POST['id'];
        $unitSymbol=$_POST['unitSymbol'];
        $name = $_POST['name'];
        $url = "/api/UpdateUnit/" . $id;
        $sendData['unitName'] = $name;
        $sendData['unitSymbol'] = $unitSymbol;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addUnit()
    {
        $name = $_POST['name'];
        $unitSymbol=$_POST['unitSymbol'];
        $url = "/api/InsertDataUnit";
        $sendData['unitName'] = $name;
        $sendData['unitSymbol'] = $unitSymbol;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteUnit()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataUnit/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

     //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function positionCategory()
    {
        $url = "/api/DataUnit";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.position-category', compact('responseBody'));
    }

    public function getPositionCategory()
    {
        $url = "/api/DataPositionCategory";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getPositionCategoryByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataPositionCategoryByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updatePositionCategory()
    {
        $id = $_POST['id'];
        $categoryDesc=$_POST['categoryDesc'];
        $name = $_POST['name'];
        $url = "/api/UpdatePositionCategory/" . $id;
        $sendData['CategoryName'] = $name;
        $sendData['CategoryDesc'] = $categoryDesc;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addPositionCategory()
    {
        $name = $_POST['name'];
        $categoryDesc=$_POST['categoryDesc'];
        $url = "/api/InsertDataPositionCategory";
        $sendData['CategoryName'] = $name;
        $sendData['CategoryDesc'] = $categoryDesc;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deletePositionCategory()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataPositionCategory/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

      //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function position()
    {
        $url = "/api/DataPosition";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.position', compact('responseBody'));
    }

    public function getPosition()
    {
        $url = "/api/DataPosition";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getPositionByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataPositionByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updatePosition()
    {
        $id = $_POST['id'];
        $CategoryID=$_POST['PositionCatID'];
        $name = $_POST['name'];
        $url = "/api/UpdatePosition/" . $id;
        $sendData['PositionName'] = $name;
        $sendData['PositionCatID'] = $CategoryID;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addPosition()
    {
        $name = $_POST['name'];
        $CategoryID=$_POST['PositionCatID'];
        $url = "/api/InsertDataPosition";
        $sendData['PositionName'] = $name;
        $sendData['PositionCatID'] = $CategoryID;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deletePosition()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataPosition/" . $id;
        $responseBody = $this->DeleteData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function weather()
    {
        $url = "/api/DataWeather";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.weather-condition', compact('responseBody'));
    }

    public function getWeather()
    {
        $url = "/api/DataWeather";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getWeatherByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataWeatherByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateWeather()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $symbol=$_POST['symbol'];
        $url = "/api/UpdateWeather/" . $id;
        $sendData['weatherName'] = $name;
        $sendData['symbol'] = $symbol;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addWeather()
    {
        $name = $_POST['name'];
        $symbol=$_POST['symbol'];
        $url = "/api/InsertDataWeather";
        $sendData['weatherName'] = $name;
        $sendData['symbol'] = $symbol;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteWeather()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataWeather/" . $id;
        $responseBody = $this->DeleteData($url);
        return $responseBody;
    }

    
    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function BusinessPartner()
    {
        $url = "/api/DataBusinessPartner";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.business-partner', compact('responseBody'));
    }

    public function getBusinessPartner()
    {
        $url = "/api/DataBusinessPartner";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getBusinessPartnerByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataBusinessPartnerByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateBusinessPartner()
    {
        $id = $_POST['idPartner'];
        $name= $_POST['businessNameEdit'];
        $address= $_POST['AddressEdit'];
        $country= $_POST['CountryNameEdit'];
        $city= $_POST['CityNameEdit'];
        $phone= $_POST['phoneNumberEdit'];
        $fax= $_POST['faxNumberEdit'];
        $email= $_POST['EmailEdit'];
        $web= $_POST['webEdit'];
        $mobile= $_POST['mobileNumberEdit'];
        $type= $_POST['BusinessTypeEdit'];
        $url = "/api/UpdateDataBusinessPartner/" . $id;
        $sendData['BussinessName'] = $name;
        $sendData['BussinessTypeID'] = $type;
        $sendData['Address'] = $address;
        $sendData['CountryID'] = $country;
        $sendData['CityID'] = $city;
        $sendData['Phone'] = $phone;
        $sendData['Fax'] = $fax;
        $sendData['MobilePhone'] = $mobile;
        $sendData['Email'] = $email;
        $sendData['Web'] = $web;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addBusinessPartner()
    {
        $name= $_POST['businessName'];
        $address= $_POST['Address'];
        $country= $_POST['CountryName'];
        $city= $_POST['CityName'];
        $phone= $_POST['phoneNumber'];
        $fax= $_POST['faxNumber'];
        $email= $_POST['Email'];
        $web= $_POST['web'];
        $mobile= $_POST['mobileNumber'];
        $type= $_POST['BusinessType'];
        $url = "/api/InsertDataBusinessPartner";
        $sendData['BussinessName'] = $name;
        $sendData['BussinessTypeID'] = $type;
        $sendData['Address'] = $address;
        $sendData['CountryID'] = $country;
        $sendData['CityID'] = $city;
        $sendData['Phone'] = $phone;
        $sendData['Fax'] = $fax;
        $sendData['MobilePhone'] = $mobile;
        $sendData['Email'] = $email;
        $sendData['Web'] = $web;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteBusinessPartner()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataBusinessPartner/" . $id;
        $responseBody = $this->DeleteData($url);
        return $responseBody;
    }

    public function getContractor(){
        $id = $_POST['id'];
        $url = "/api/DataContractor/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    //=============================================================================================================================================================================================================
    //=============================================================================================================================================================================================================

    public function HumanResources()
    {
        $url = "/api/DataPersonil";
        $responseBody = $this->getData($url);

        return view('user_management.master_data_management.business-partner', compact('responseBody'));
    }

    public function getHumanResources()
    {
        $url = "/api/DataPersonil";
        $responseBody = json_decode($this->getData($url));
        for ($i = 0; $i < count($responseBody); $i++) {
            $responseBody[$i]->action = ' <button class="edit-btn btn btn-warning  waves-effect waves-light m-1" data-id="' . $responseBody[$i]->id . '">EDIT</button>
            <button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1" data-ids="' . $responseBody[$i]->id . '">DELETE</button>';
        }

        return  json_encode($responseBody);
    }

    public function getHumanResourcesByid()
    {
        $id = $_POST['id'];
        $url = "/api/DataPersonilByid/" . $id;
        $responseBody = $this->getData($url);
        return  $responseBody;
    }

    public function updateHumanResources()
    {
        $idPersonil = $_POST['idPersonil'];
        $BusinessNameEdit= $_POST['BusinessNameEdit'];
        $PersonilNameEdit= $_POST['PersonilNameEdit'];
        $PersonilAddressEdit= $_POST['PersonilAddressEdit'];
        $CountryNameEdit= $_POST['CountryNameEdit'];
        $CityNameEdit= $_POST['CityNameEdit'];
        $PostZipEdit= $_POST['PostZipEdit'];
        $PersonilPhoneEdit= $_POST['PersonilPhoneEdit'];
        $PersonilHpEdit= $_POST['PersonilHpEdit'];
        $PersonilEmailEdit= $_POST['PersonilEmailEdit'];
        $PositionNameEdit= $_POST['PositionNameEdit'];
        $url = "/api/UpdateDataPersonil/" . $idPersonil;
        $sendData['BussinessPartnerID'] = $BusinessNameEdit;
        $sendData['PersonilName'] = $PersonilNameEdit;
        $sendData['Address'] = $PersonilNameEdit;
        $sendData['Postzip'] = $PersonilAddressEdit;
        $sendData['CountryID'] = $CountryNameEdit;
        $sendData['CityID'] = $CityNameEdit;
        $sendData['Postzip'] = $PostZipEdit;
        $sendData['Phone'] = $PersonilPhoneEdit;
        $sendData['Hp'] = $PersonilHpEdit;
        $sendData['Email'] = $PersonilEmailEdit;
        $sendData['PositionID'] = $PositionNameEdit;
        $responseBody = $this->updateData($url, $sendData);

        return  $responseBody;
    }

    
    public function addHumanResources()
    {
        $BusinessName= $_POST['BusinessName'];
        $PersonilName= $_POST['PersonilName'];
        $PersonilAddress= $_POST['PersonilAddress'];
        $CountryName= $_POST['CountryName'];
        $CityName= $_POST['CityName'];
        $PostZip= $_POST['PostZip'];
        $PersonilPhone=$_POST['PersonilPhone'];
        $PersonilHp= $_POST['PersonilHp'];
        $PersonilEmail= $_POST['PersonilEmail'];
        $PositionName= $_POST['PositionName'];
        $url = "/api/InsertDataPersonil";
        $sendData['BussinessPartnerID'] = $BusinessName;
        $sendData['PersonilName'] = $PersonilName;
        $sendData['Address'] = $PersonilAddress;
        $sendData['Postzip'] = $PostZip;
        $sendData['CountryID'] = $CountryName;
        $sendData['CityID'] = $CityName;
        $sendData['Phone'] = $PersonilPhone;
        $sendData['Hp'] = $PersonilHp;
        $sendData['Email'] = $PersonilEmail;
        $sendData['PositionID'] = $PositionName;
        $responseBody = $this->insertData($url, $sendData);

        return  $responseBody;
    }

    public function deleteHumanResources()
    {
        $id = $_POST['id'];
        $url = "/api/DeleteDataPersonil/" . $id;
        $responseBody = $this->DeleteData($url);
        return $responseBody;
    }

    
    public function getHumanResourcesbypartner()
    {
        $id = $_POST['id'];
        $url = "/api/DataPersonilbyPartner/".$id;
        $responseBody = $this->getData($url);
        return $responseBody;
       
    }
    
    public function getHumanResourcesbypartnerProject(){
        $id = session('ProjectID');
        $url = "/api/DataPersonilbyPartnerProject/".$id;
        $responseBody = $this->getData($url);
        return $responseBody;
    }

    public function getMobilizationDateByBusinessPartner()
    {
        $id = $_POST['id'];
        $url = "/api/DataMobilizationDateByBusinessPartner/".$id;
        $responseBody = $this->getData($url);
        return $responseBody;

       
    }

    public function getPartnerBytype()
    {
        $type = $_GET['types'];
  
        $url = "/api/DataBussinessTypeby/" . $type;
        $responseBody = $this->getData($url);
        return  $responseBody;

        
    }

    public function getPositionbyPersonil()
    {
        $id = $_POST['id'];
        $url = "/api/DataPositionbyPersonil/".$id;
        $responseBody = $this->getData($url);
        return $responseBody;

       
    }

}
