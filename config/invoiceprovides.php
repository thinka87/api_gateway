<?php

if (env('APP_ENV') == 'local') {
    return [
        'providers' => array("vizma", "fortsocks"),
        'providers_service_url' => array(
            "vizma" => array('service_url' => 'http://127.0.0.1:8001/api/invoice', 'connection_timeout' => 60, 'request_timeout' => 60),
            "fortsocks" => array('service_url' => 'http://127.0.0.1:8002/api/invoice', 'connection_timeout' => 60, 'request_timeout' => 60),
        ),
    ];
}


if (env('APP_ENV') == 'staging') {

    return [
        'providers' => array("vizma", "fortsocks"),
        'providers_service_url' => array(
            "vizma" => array('service_url' => 'http://127.0.0.1:8001/api/invoice', 'connection_timeout' => 60, 'request_timeout' => 60),
            "fortsocks" => array('service_url' => 'http://127.0.0.1:8002/api/invoice', 'connection_timeout' => 60, 'request_timeout' => 60),
        ),
    ];
}
if (env('APP_ENV') == 'production') {
    return [
        'providers' => array("vizma", "fortsocks"),
        'providers_service_url' => array(
            "vizma" => array('service_url' => 'http://127.0.0.1:8001/api/invoice', 'connection_timeout' => 60, 'request_timeout' => 60),
            "fortsocks" => array('service_url' => 'http://127.0.0.1:8002/api/invoice', 'connection_timeout' => 60, 'request_timeout' => 60),
        ),
    ];
}