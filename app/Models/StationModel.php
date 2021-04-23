<?php
  
namespace App\Models;
   
use Illuminate\Database\Eloquent\Model;
  
class StationModel extends Model
{
    private $UICCode;
    private $stationName;
    private $allStations;

    function setStationModel($UICCode, $stationName)
    {
        $this->UICCode = $UICCode;
        $this->stationName = $stationName;
    }
    function getStationModel()
    {
        return $this;
    }

    function getStationName()
    {
        return $this->stationName;
    }

    function getUICCode()
    {
        return $this->UICCode;
    }

    function setAllStations($stationModel)
    {
        foreach($stationModel as $station)
        {
            $this->setStationModel($station['UICCode'], $station['namen']['lang']);
            empty($station) ?  var_dump('append failed!') : $this->allStations[] = $this->getStationModel();
        }

        // $date = date('Y/m/d H:i:s');
        // Storage::disk('resources')->put('TrainStations'.$date.'.json', json_encode($result));

    }

    function getAllStations()
    {
        return $this->allStations;
    }
}