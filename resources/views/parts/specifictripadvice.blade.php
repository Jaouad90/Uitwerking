@if(!empty($tripDataJSON))
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div class="time-choice-container">
                <button class="left-button"><</button>
                <button class="right-button">></button>
                @foreach ($tripDataJSON['trips'] as $tripData)
                    @foreach ($tripData['legs'] as $tripLegsData)
                    {
                        $index = strval($loop->index);
                        $originActualDateTime = date("H:i",strtotime($tripLegsData['origin']['plannedDateTime']));
                        $destinationActualDateTime = date("H:i",strtotime($tripLegsData['destination']['plannedDateTime']));
                    }
                    <script>
                        var tripsData = @json($tripDataJSON);
                        console.log(tripsData);
                    </script>

                    <div class="button-container">
                        <button class="button-trip-choice btn btn-primary" onclick="showTripAdvice(tripsData)" type="button">
                            {{$originActualDateTime .' -> '. $destinationActualDateTime}}
                        </button>
                    </div>
                @endforeach
            </div>


            <ul class="timeline" style="visibility: hidden;">
                <div class="tripadvice-departure">
                    <li>
                        <div class="time-position planned-departure-time"></div>
                        <div class="planned-departure-track">Vertrek: Spoor </div>
                        <a class="planned-departure-station" target="_blank" href="">Station </a>
                    </li>
                </div>
                <div class="tripadvice-arrival">
                    <li>
                        <div class="time-position planned-arrival-time"></div>
                        <div class="planned-arrival-track">Vertrek: Spoor </div>
                        <a class="planned-arrival-station" target="_blank" href="">Station </a>
                    </li>
                </div>
            </ul>

        </div>
    </div>
</div>
@endif