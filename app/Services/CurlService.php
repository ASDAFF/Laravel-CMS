<?php

namespace App\Services;

use App\Services\BaseService;

class CurlService extends BaseService
{
    public function call_curl($url, $method = 'get', $body = null, $authorization = null)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        if($method === 'POST'){
           curl_setopt($curl, CURLOPT_POST, 1);
        }
        else{
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);

        if($authorization){
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'accept: application/json',
                $authorization,
            ]);
        }

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }
}
