<?php
  
namespace App\Models;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
  
class StationModel extends Model
{
    private $UICCode;
    private $stationName;
    private $allStationsCollection;
    

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

    function setAllStations($stationsJSON)
    {
        $allStationsArray =  array();

        foreach($stationsJSON as $stationJSON)
        {
            $newStationObject = new StationModel;
            $newStationObject->setStationModel($stationJSON['UICCode'], $stationJSON['namen']['lang']);
            $allStationsArray[] = $newStationObject;
        }
        $this->allStationsCollection = $allStationsArray;

    }

    function getAllStations()
    {

        return $this->allStationsCollection;
    }
}