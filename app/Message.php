<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $repoUserFullName = [

    ];
    protected $fillable = [
        'project_id',
        'user_id',
        'message_text',
        'created_at',
        'updated_at',
    ];

    public function userFullName(){
        $user_id = $this->user_id;
        if(!empty($this->repoUserFullName[$user_id])){
            return $this->repoUserFullName[$user_id];
        }else{
        $url = config('global.api_url') .'/api/getUserFullName/'. $user_id;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $responseBody = $response->getBody();
        $responseBody = json_decode($responseBody);
        $this->repoUserFullName[$user_id] = $responseBody->Userfullname;
        return $responseBody->Userfullname;
    }
    }
}
