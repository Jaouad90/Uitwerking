<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Station;
use App\Http\Controllers\API\APIController;
use Illuminate\Support\Facades\Storage;
use App\Models\StationModel;

class SearchController extends Controller
{

    private $stationModel;
    private $apiController;


    function __construct(StationModel $stationModel, APIController $apiController)
    {
        $this->stationModel = $stationModel;
        $this->apiController = $apiController;
    }

    function index()
    {

        $result = $this->apiController->getAllStationsAPI();
        $this->stationModel->setAllStations($result);

        $stationCollection = $this->stationModel->getAllStations();

        return view('welcome', ['response' => $stationCollection]);
    }

    function saveStationModels($result)
    {

        foreach($result as $station)
        {
            // echo $station['UICCode'];
            // echo $station['namen']['lang'];

            $this->stationModel->setStationModel($station['UICCode'], $station['namen']['lang']);

            $this->stationModel->setAllStations($this->stationModel);
        }

        // $date = date('Y/m/d H:i:s');
        // Storage::disk('resources')->put('TrainStations'.$date.'.json', json_encode($result));
    }
  

    function autocomplete(Request $request)
    {
        $data = Station::select("name")
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);
    }
}