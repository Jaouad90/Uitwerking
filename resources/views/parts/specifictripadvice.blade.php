@if(!empty($tripDataJSON))
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">

                <div class="time-choice-container">
                    <button class="left-button"><</button>
                    <button class="right-button">></button>
                        @foreach ($tripDataJSON['trips'] as $tripData)
                            @php 
                                $index = strval($loop->index);
                                $originPlannedDateTime = $tripData['legs'][$index]['origin']['plannedDateTime'];
                                $originPlannedDateTime = strtotime($tripData['legs'][$index]['origin']['plannedDateTime']);
                                $originPlannedDateTime = date("H:i", $originPlannedDateTime);
                                $destinationPlannedDateTime = date("H:i",strtotime($tripData['legs'][$index]['destination']['plannedDateTime']));
                            @endphp
                            @if ($loop->index==6)
                                @break;
                            @endif
                                <div class="button-container">
                                    <button class="button-trip-choice">
                                        <label>{{$originPlannedDateTime .' -> '. $destinationPlannedDateTime}}</label>
                                    </button>
                                </div>
                        @endforeach
                </div>

                <!-- <ul class="timeline">
                    <div class="tripadvice-departure">
                        <div class="time-position">{{date("H:i",strtotime($tripDataJSON['legs']['origin']['plannedDateTime']))}}</div>
                        <div>Vertrek: Spoor {{$tripDataJSON['legs']['origin']['actualTrack']}}</div>
                        <a target="_blank" href="{{ route('stationdespartureslist', ['id' => $tripDataJSON['legs']['origin']['uicCode'], 'name' => $tripDataJSON['legs']['origin']['name']]) }}">
                            Station {{$tripDataJSON['legs']['origin']['name']}}</a>
                    </div>
                    <div class="tripadvice-arrival">
                        <div class="time-position">{{date("H:i",strtotime($tripDataJSON['legs']['destination']['plannedDateTime']))}}</div>
                        <div>Vertrek: Spoor {{$tripDataJSON['legs']['destination']['actualTrack']}}</div>
                        <a target="_blank" href="{{ route('stationdespartureslist', ['id' => $tripDataJSON['legs']['destination']['uicCode'], 'name' => $tripDataJSON['legs']['destination']['name']]) }}">
                            Station {{$tripDataJSON['legs']['destination']['name']}}</a>
                    </div>
                </ul> -->
            </div>
        </div>
    </div>
@endif