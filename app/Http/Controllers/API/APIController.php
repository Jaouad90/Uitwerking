<?php
  
namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    private $apiKey = "5c53c4e5fec54dca88e189587ce7f095";
    private  $url = "https://gateway.apiportal.ns.nl/reisinformatie-api/api/v2/";

    function __construct()
    {

    }

    function fetch($endpoint)
    {
        $response = Http::retry(3, 100)->timeout(10)->withHeaders([
            'Ocp-Apim-Subscription-Key' => $this->apiKey
        ])->get($this->url.$endpoint, [
            
        ]);

        $response->throw();

        // $response->successful(); === true ?  : ;

        return $response;
    }

    function getArrivalsOfStationAPI()
    {
        $endpoint = "arrivals";

        return $this->fetch($endpoint);
    }

    function getAllStationsAPI()
    {
        $endpoint = "stations";

        return $this->fetch($endpoint)['payload'];
    }
}