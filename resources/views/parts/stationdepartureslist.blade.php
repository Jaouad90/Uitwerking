@if(!empty($stationDeparturesData))
<div id="project-tab-container">
    <div id="tabs" class="project-tab">
        <div class="container">
            <div class="row center">
                <div class="col-md-6">
                    <nav>
                        <div class="nav nav-tabs nav-fill col-sm-6" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-train-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Trein</a>
                            <a class="nav-item nav-link" id="nav-metro-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Metro</a>
                            <a class="nav-item nav-link" id="nav-bustram-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Bus + Tram</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-train-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tijd</th>
                                        <th>Richting</th>
                                        <th>Spoor</th>
                                        <th>Reisdetails</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stationDeparturesData['departures'] as $stationDeparture)
                                    <tr>
                                        @if(!empty($stationDeparture['plannedDateTime']))
                                        <td>{{date("H:i",strtotime($stationDeparture['plannedDateTime']))}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        @if(!empty($stationDeparture['direction']))
                                        <td>{{$stationDeparture['direction']}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        @if(!empty($stationDeparture['plannedTrack']))
                                        <td>{{$stationDeparture['plannedTrack']}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        @if(!empty($stationDeparture['product']['shortCategoryName']))
                                        <td>{{$stationDeparture['product']['shortCategoryName']}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-metro-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tijd</th>
                                        <th>Richting</th>
                                        <th>Perron</th>
                                        <th>Reisdetails</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>test</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-bustram-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tijd</th>
                                        <th>Richting</th>
                                        <th>Perron</th>
                                        <th>Reisdetails</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>test</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif