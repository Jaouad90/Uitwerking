<?php
  
namespace App\Http\Controllers;

use App\Services\APIService;
use Illuminate\Http\Request;
use App\Models\StationModel;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    private $apiService;


    function __construct(APIService $apiService)
    {
        $this->apiService = $apiService;
    }

    function index()
    {
        // If the data isnt in memory then retrieve allStations data from api
        $stationsJSON = Cache::remember('allStations', 10, function () {
            $stationsJSON = $this->apiService->getAllStationsAPI();
            return $stationsJSON;
        });

        return view('welcome', ['stationsData' => $stationsJSON]);
    }

    // Getting initiated by a Ajax Request from js to 
    function searchArrivalsOfStation(Request $request)
    {
        $data = $request->all();
        $arrivalsJSON = $this->apiService->getArrivalsOfStationAPI($data['value']);
        // Caching for the autocomplete, but i dont think that this is the right way!
        $stationsJSON = Cache::get('allStations');

        // Return stationsData and arrivalsOfStationData to view
        return view('arrivalsOfStation', ['arrivalsOfStationData' => $arrivalsJSON,'stationsData' => $stationsJSON]);
    }

}