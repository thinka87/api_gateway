<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use InvoiceProvidersHelper;
use App\Helpers\HttpClientHelper;

class ServiceDiscoveryController extends Controller
{
    
    public function callToService(Request $request){
        
        $provider= $request->provider;
        $invoice_id = $request->invoice_id;
        
        $providers=config('invoiceprovides.providers'); //get registered provider list
        
        //Validate service providers 
        if(InvoiceProvidersHelper::isValidProvider($request->provider, $providers)===false){            
            return response()->json(["error" => "service provider not found"],400);
        }
        
        $vars = array('$invoice_id' => $invoice_id);
        
        $provider_service_urls = config('invoiceprovides.providers_service_url'); 
        $provider_service_url_template = $provider_service_urls[$provider];
        $provider_service_url=  strtr($provider_service_url_template["service_url"], $vars); //replace parameteres
        
        $params= array();
        $params["url"]= "https://qa-app.capcito.com/api/v3/work-sample/invoices/fortsocks/9f587e13-682e-4d91-867f-fd3aec3b70b";
        $params["request_timeout"]= $provider_service_url_template["request_timeout"];
        $params["connection_timeout"]= $provider_service_url_template["connection_timeout"];
        
        $response= HttpClientHelper::get($params);
        return response()->json($response->json(),$response->status()); 
    }
}
