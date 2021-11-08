<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class IssueManagementController extends Controller
{
    public function getData()
    {
        $client = new Client();
        $response = $client->request('GET', config('global.api_url').'/api/issue',['verify' => false]);
        $responseBody = json_decode($response->getBody());

        return datatables($responseBody)
        ->addColumn('action',function($row){
            return '<a href="javascript:edit(\''.$row->id.'\')"><button class="edit-btn btn btn-warning  waves-effect waves-light m-1"">EDIT</button></a>

            <a href="javascript:del(\''.$row->id.'\')"><button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1"">DELETE</button>';
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function postData(Request $request)
    {
        $client = new Client();
        $response = $client->request('post', config('global.api_url').'/api/issue', ['form_params' => $request->post('inp')]);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function updateData(Request $request)
    {
        $client = new Client();
        $response = $client->request('post', config('global.api_url').'/api/issue/'.$request->id, ['form_params' => $request->all()]);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function findData(Request $request)
    {
        $client = new Client();
        $response = $client->request('get', config('global.api_url').'/api/issue/'.$request->id);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function deleteData(Request $request)
    {
        $client = new Client();
        $response = $client->request('delete', config('global.api_url').'/api/issue/'.$request->id);
        $responseBody = $response->getBody();

        return $responseBody;
    }
}
