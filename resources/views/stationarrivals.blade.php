<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styling -->
    <link href="{{  URL::asset('css/app.css') }}" rel="stylesheet" >
    <!-- Todo: Fix Webpack and remove this. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="antialiased">
    <script>
        @json($stationArrivalsData) ;  
    </script>
    @include('layout.topbar')

    <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill col-md-5" id="nav-tab" role="tablist" >
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
                                    @foreach ($stationArrivalsData['arrivals'] as $stationArrival)
                                        <tr>
                                            @if(!empty($stationArrival['plannedDateTime']))
                                            <td>{{date("H:i",strtotime($stationArrival['plannedDateTime']))}}</td>
                                            @else
                                            <td></td>
                                            @endif
                                            @if(!empty($stationArrival['origin']))
                                            <td>{{$stationArrival['origin']}}</td>
                                            @else
                                            <td></td>
                                            @endif
                                            @if(!empty($stationArrival['plannedTrack']))
                                            <td>{{$stationArrival['plannedTrack']}}</td>
                                            @else
                                            <td></td>
                                            @endif
                                            @if(!empty($stationArrival['product']['shortCategoryName']))
                                            <td>{{$stationArrival['product']['shortCategoryName']}}</td>
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
        </section>

        <!-- Todo: Fix Webpack and remove this. -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
        


</body>

</html>