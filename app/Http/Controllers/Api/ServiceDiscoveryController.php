<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InvoiceProvidersHelper;
use App\Helpers\HttpClientHelper;

class ServiceDiscoveryController extends Controller
{
    
    public function callToService(Request $request){
        
        $provider= strtolower($request->provider); //provider
        $invoice_id = $request->invoice_id; //invoice id
        
        $providers= \Config::get('invoiceprovides.providers'); //get registered provider list
           
        //Validate service providers 
        if(InvoiceProvidersHelper::isValidProvider($request->provider, $providers)===false){            
            return response()->json(["error" => "service provider not found"],400);
        }
       
        $provider_service_url = config('invoiceprovides.providers_service_url'); //get providers service urls
        $provider_service_url_config = $provider_service_url[$provider]; //get request provider settings

        
        $params= array();
        $params["url"]= $provider_service_url_config["service_url"]."/".$provider."/".$invoice_id; //call to invoice micro service
        $params["request_timeout"]= $provider_service_url_config["request_timeout"]; //get time out value
        $params["connection_timeout"]= $provider_service_url_config["connection_timeout"]; // get conncetion time out
        
        $response= HttpClientHelper::get($params); // call http client
        return response()->json($response->json(),$response->status()); //return response
    }
}
