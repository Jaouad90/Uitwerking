@if(!empty($stationDeparturesData))
<div id="trip-advice-container">
    <div class="md-sm-4 trip-advice-container-bg">
        <h1>Reistijd vanaf </h1>
        @foreach ($stationDeparturesData['departures'] as $tripAdvice)
        <div class="row">
            <a href="{{ route('tripadvice', ['destinationStationName' => $tripAdvice['direction']]) }}" class="trip-advice-content">
                {{$tripAdvice['direction']}}

            </div>
        </div>
        @endforeach
    </div>
</div>
@endif