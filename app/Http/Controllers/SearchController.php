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
    function searchDeparturesOfStation($id, $name)
    {
        Cache::put('chosenStationID', $id);
        $departuresJSON = $this->apiService->getDeparturesOfStationAPI($id);

        return view('homepage', ['stationDeparturesData' => $departuresJSON, 'chosenStationName' => $name, 'stationsData' => $this->stationsJSON]);
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

        $destinationStationID = "";
        $chosenStationID = Cache::get('chosenStationID');
            foreach ($this->stationsJSON as $station) {
                if ($request['destinationStationName'] === $station['namen']['kort']) {
                    $destinationStationID = $station['UICCode'];
                    break;
                }
            }
            if($destinationStationID===""){
                return response('De ID van de gekozen bestemming station is niet gevonden!!!');
            }

        $tripDataJSON = $this->apiService->getTripDataAPI($chosenStationID, $destinationStationID);

        return view('homepage', ['tripDataJSON' => $tripDataJSON , 'stationsData' => $this->stationsJSON]);
    }
}
