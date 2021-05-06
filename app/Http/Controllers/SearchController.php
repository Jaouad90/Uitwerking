<?php

namespace App\Http\Controllers;

use App\Services\APIService;
use Illuminate\Http\Request;
use App\Models\StationModel;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    private $apiService;
    private $stationsJSON;

    /**
     * @inheritDoc
     * 
     * @param APIService $apiService The API Service
     */
    function __construct(APIService $apiService)
    {
        $this->apiService   = $apiService;
        $this->stationsJSON = Cache::remember('allStations', 10, function () {
            $stationsJSON = $this->apiService->getAllStationsAPI();
            return $stationsJSON;
        });
    }

    /**
     * @inheritDoc
     */
    function index()
    {
        return view('homepage', ['stationsData' => $this->stationsJSON]);
    }

    /**
     * Retrieves the departures of the given station ID
     * 
     * @param int     $id      The station ID
     * 
     * @return view
     */
    function searchDeparturesOfStation($id)
    {
        Cache::put('chosenStationID', $id);
        $departuresJSON = $this->apiService->getDeparturesOfStationAPI($id);

        return view('homepage', ['stationDeparturesData' => $departuresJSON, 'stationsData' => $this->stationsJSON]);
    }

    /**
     * Retrieves the trip between 2 chosen station based on the station id's
     * 
     * @param Request    $request      The Request class
     * 
     * @return view
     */
    function searchTrip(Request $request)
    {

        $destinationStation = "";
        $chosenStationID = Cache::get('chosenStationID');

        // ISSUE: de request parameter heeft geen spaties meer. 
        // Waardoor er geen vergelijking gemaakt worden om de id te vinden van het station

        foreach ($this->stationsJSON as $station) {

            foreach ($this->stationsJSON as $station) {
                $key = array_search($request['destinationStationName'], $station, false);
                if ($key !== false) {
                    $destinationStation = $station['UICCode'];
                    break;
                } else {
                    return response('De ID van de gekozen bestemming station is niet gevonden!!!');
                }
            }
        }

        $arrivalsJSON = $this->apiService->getTripDataAPI($chosenStationID, $destinationStation);
        dd($arrivalsJSON);

        return view('homepage', ['stationsData' => $this->stationsJSON]);
    }
}
