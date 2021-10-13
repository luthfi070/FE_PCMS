<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MonthlyMeetingController extends Controller
{
    public function getData()
    {
        $client = new Client();
        $response = $client->request('GET', env('API_URL').'/meeting',['verify' => false]);
        $responseBody = json_decode($response->getBody());

        return datatables($responseBody)
        ->addColumn('action',function($row){
            return '<a href="javascript:edit(\''.$row->id.'\')"><button class="edit-btn btn btn-warning  waves-effect waves-light m-1"">EDIT</button></a>

            <a href="javascript:del(\''.$row->id.'\')"><button type="button" class="btn btn-danger confirm-btn-alert waves-effect waves-light m-1"">DELETE</button>';
        })
        ->rawColumns(['action'])
        ->toJson();

        // return json_decode($responseBody);
    }

    public function postData(Request $request)
    {
        $inp = $request->post('inp');
        $inp['file'] = chunk_split(base64_encode(file_get_contents($request->file('inp')['file'])));

        $client = new Client();
        $response = $client->request('post', env('API_URL').'/meeting', ['form_params' => $inp]);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function updateData(Request $request)
    {
        $inp = $request->post('edit');
        if (!empty($request->file('edit')['file'])) {
            $inp['file'] = chunk_split(base64_encode(file_get_contents($request->file('edit')['file'])));
        }

        $client = new Client();
        $response = $client->request('post', env('API_URL').'/meeting/'.$request->id, ['form_params' => $inp]);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function findData(Request $request)
    {
        $client = new Client();
        $response = $client->request('get', env('API_URL').'/meeting/'.$request->id);
        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function deleteData(Request $request)
    {
        $client = new Client();
        $response = $client->request('delete', env('API_URL').'/meeting/'.$request->id);
        $responseBody = $response->getBody();

        return $responseBody;    }
}
