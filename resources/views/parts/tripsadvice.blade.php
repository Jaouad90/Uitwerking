@if(!empty($stationDeparturesData))
<div id="trip-advice-container">
    <div class="md-sm-4 trip-advice-container-bg">
        <h1>Reistijd vanaf <br>{{$chosenStationName}}</h1>
        @foreach ($stationDeparturesData['departures'] as $tripAdvice)
        @if ($loop->index===5)
        @break
        @endif
        <div class="row">
            <a href="{{ route('tripadvice', ['destinationStationName' => $tripAdvice['direction']]) }}" class="trip-advice-content">
                {{$tripAdvice['direction']}}
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif