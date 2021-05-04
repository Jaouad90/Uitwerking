<?php
  
namespace App\Services;

use Illuminate\Support\Facades\Http;

class APIService
{

    function __construct()
    {

    }

    private function fetch($endpoint, ?string $stationID)
    {
        $stationID==null ? $stationID = "" : $stationID = "uicCode=".$stationID;

        $response = Http::retry(3, 100)->timeout(10)->withHeaders([
            'Ocp-Apim-Subscription-Key' => config('services.nsapi.key')
        ])->get(config('services.nsapi.url').$endpoint.$stationID);

        $response->throw();

        return $response;
    }

    function getArrivalsOfStationAPI($stationID)
    {
        $endpoint = "arrivals?";

        return $this->fetch($endpoint, $stationID)['payload'];
    }

    function getAllStationsAPI()
    {
        $endpoint = "stations";

        return $this->fetch($endpoint, null)['payload'];
    }
}