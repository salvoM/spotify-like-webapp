<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SearchController extends Controller
{
    //
    public function show(){
        $collections = Auth::user()->collections;
        return view('search', compact('collections'));
    }

    public function do_search(Request $request){
        $search_value = request('searchtag');
        $client_id = "1abf4468493c4373ae4b65c11bd540c3";
        $client_secret = "45785dda8dce48aca957d56df4021765";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $token = json_decode($result)->access_token;
        $curl = curl_init();
        $headers = array("Authorization: Bearer ".$token);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = http_build_query(array("q" => $search_value, "type" => "track"));
        curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
        $result = curl_exec($curl);
        curl_close($curl);
        echo json_encode($result);
    }

}
