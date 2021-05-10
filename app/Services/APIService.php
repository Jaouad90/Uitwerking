<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class APIService
{

    function __construct()
    {
    }

    private function fetch($endpoint, ?string $stationID, ?string $maxJourneys, ?string $originUicCode, ?string $destinationUicCode, ?string $mustQueryTripData)
    {
        $queryParams = "";
        $stationID == null ? $stationID = "" : $stationID = "uicCode=" . $stationID;
        $maxJourneys == null ? $maxJourneys = "" : $maxJourneys = "&maxJourneys=" . $maxJourneys;
        $endpoint !== "v3/trips?" ? "" : $queryParams = "originUicCode=" . $originUicCode."&destinationUicCode=" . $destinationUicCode.$mustQueryTripData;

        // if($queryParams!=="" || null)
        // {dd($endpoint.$queryParams);}

        $response = Http::retry(3, 100)->timeout(10)->withHeaders([
            'Ocp-Apim-Subscription-Key' => config('services.nsapi.key')
        ])->get(config('services.nsapi.url') . $endpoint . $stationID . $maxJourneys . $queryParams);

        $response->throw();

        return $response->json();
    }

    function getDeparturesOfStationAPI($stationID)
    {
        $endpoint = "v2/departures?";
        $maxJourneys = "10";

        return $this->fetch($endpoint, $stationID, $maxJourneys, null, null, null)['payload'];
    }

    function getAllStationsAPI()
    {
        $endpoint = "v2/stations";

        return $this->fetch($endpoint, null, null, null, null, null)['payload'];
    }

    function getTripDataAPI($originUicCode, $destinationUicCode)
    {
        // quickfix burt not the right solution
        $mustQueryTripData = "&originWalk=false&originBike=false&originCar=false&destinationWalk=false&destinationBike=false&destinationCar=false&shorterChange=false&travelAssistance=false&searchForAccessibleTrip=false&localTrainsOnly=false&excludeHighSpeedTrains=false&excludeTrainsWithReservationRequired=false&yearCard=false&discount=NO_DISCOUNT&travelClass=2&polylines=false&passing=false&travelRequestType=DEFAULT";

        $endpoint = "v3/trips?";

        return $this->fetch($endpoint, null, null, $originUicCode, $destinationUicCode, $mustQueryTripData);
    }
}
