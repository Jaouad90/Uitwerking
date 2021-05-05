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
     * Retrieves the arrivals of the given station ID
     * 
     * @param Request $request The request object
     * @param int     $id      The station ID
     * 
     * @return view
     */
    function searchArrivalsOfStation(Request $request, int $id)
    {
        $arrivalsJSON = $this->apiService->getArrivalsOfStationAPI($id);

        // Return stationsData and arrivalsOfStationData to view
        return view('homepage', ['stationArrivalsData' => $arrivalsJSON, 'stationsData' => $this->stationsJSON]);
    }
}
