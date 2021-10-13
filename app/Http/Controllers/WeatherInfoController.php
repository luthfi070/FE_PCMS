<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherInfoController extends Controller
{
    public function index()
    {
        $client = new Client();
        $response = $client->request('GET', env('API_URL').'/DataWeather',['verify' => false]);
        $weathers = json_decode($response->getBody());

        return view('weather_info/weather-info',compact('weathers'));
    }
    public function getData()
    {
        $client = new Client();
        $response = $client->request('GET', env('API_URL').'/weatherInfo',['verify' => true]);
        $responseBody = json_decode($response->getBody());

        return datatables($responseBody)
        ->addColumn('action',function($row){
            return '<a href="javascript:edit(\''.$row->id.'\')"><button class="edit-btn btn btn-warning  waves-effect waves-light m-1"">EDIT</button></a>

            <a href="javascript:del(\''.$row->id.'\')"><button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1"">DELETE</button>';
        })
        ->editColumn('symbol',function($row){
            return $row->symbol;
        })
        ->rawColumns(['action','symbol'])
        ->toJson();

        // return json_decode($responseBody);
    }

    public function postData(Request $request)
    {
        $client = new Client();
        $response = $client->request('post', env('API_URL').'/weatherInfo', ['form_params' => $request->post('inp')]);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function updateData(Request $request)
    {
        $client = new Client();
        $response = $client->request('post', env('API_URL').'/weatherInfo/'.$request->id, ['form_params' => $request->all()]);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function findData(Request $request)
    {
        $client = new Client();
        $response = $client->request('get', env('API_URL').'/weatherInfo/'.$request->id);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function deleteData(Request $request)
    {
        $client = new Client();
        $response = $client->request('delete', env('API_URL').'/weatherInfo/'.$request->id);
        $responseBody = $response->getBody();

        return $responseBody;    }
}
