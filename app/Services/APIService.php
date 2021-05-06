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
        $stationID == null ? $stationID = "" : $stationID = "uicCode=" . $stationID;
        $maxJourneys == null ? $maxJourneys = "" : $maxJourneys = "maxJourneys=" . $maxJourneys;
        $originUicCode == null ? $originUicCode = "" : $originUicCode = "originUicCode=" . $originUicCode;
        $destinationUicCode == null ? $destinationUicCode = "" : $destinationUicCode = "destinationUicCode=" . $destinationUicCode;
        $endpoint !== "trips?" ? $mustQueryTripData = "" : "";

        $response = Http::retry(3, 100)->timeout(10)->withHeaders([
            'Ocp-Apim-Subscription-Key' => config('services.nsapi.key')
        ])->get(config('services.nsapi.url') . $endpoint . $stationID . $maxJourneys . $originUicCode . $destinationUicCode . $mustQueryTripData);

        $response->throw();
        if ($endpoint === "trips?") {
            dd($response);
        }

        return $response;
    }

    function getDeparturesOfStationAPI($stationID)
    {
        $endpoint = "departures?";
        $maxJourneys = "10";

        return $this->fetch($endpoint, $stationID, null, null, null, null)['payload'];
    }

    function getAllStationsAPI()
    {
        $endpoint = "stations";

        return $this->fetch($endpoint, null, null, null, null, null)['payload'];
    }

    function getTripDataAPI($originUicCode, $destinationUicCode)
    {

        // quickfix burt not the right solution
        $mustQueryTripData = "&originWalk=false&originBike=false&originCar=false&destinationWalk=false&destinationBike=false&destinationCar=false&shorterChange=false&travelAssistance=false&searchForAccessibleTrip=false&localTrainsOnly=false&excludeHighSpeedTrains=false&excludeTrainsWithReservationRequired=false&yearCard=false&discount=NO_DISCOUNT&travelClass=2&polylines=false&passing=false&travelRequestType=DEFAULT";

        $endpoint = "trips?";

        print($originUicCode . $destinationUicCode);

        return $this->fetch($endpoint, null, null, $originUicCode, $destinationUicCode, $mustQueryTripData)['payload'];
    }
}
