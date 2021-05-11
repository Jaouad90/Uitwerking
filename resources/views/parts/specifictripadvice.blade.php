@if(!empty($tripDataJSON))
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">

                <div class="time-choice-container">
                    <button class="left-button"><</button>
                    <button class="right-button">></button>
                        @foreach ($tripDataJSON['trips'] as $tripData)
                            @php 
                            foreach ($tripData['legs'] as $tripLegsData)
                            {
                                $index = strval($loop->index);
                                $originPlannedDateTime = date("H:i",strtotime($tripLegsData['origin']['plannedDateTime']));
                                $destinationPlannedDateTime = date("H:i",strtotime($tripLegsData['destination']['plannedDateTime']));
                            }
                            @endphp
                                <div class="button-container">
                                    <button class="button-trip-choice btn btn-primary" onclick="showTripAdvice($tripLegsData)" type="button">
                                    {{$originPlannedDateTime .' -> '. $destinationPlannedDateTime}}
                                    </button>
                                </div>
                        @endforeach
                </div>

                
                <ul class="timeline" style="visibility: hidden;">
                    <div class="tripadvice-departure">
                        <div class="time-position planned-departure-time"></div>
                        <div class="planned-departure-track">Vertrek: Spoor </div>
                        <a class="planned-departure-station" target="_blank" href="">
                            Station </a>
                    </div>
                    <div class="tripadvice-arrival">
                        <div class="time-position planned-arrival-time"></div>
                        <div class="planned-arrival-track">Vertrek: Spoor </div>
                        <a class="planned-departure-station" target="_blank" href="">
                            Station </a>
                    </div>
                </ul>

            </div>
        </div>
    </div>
@endif



