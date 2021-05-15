var showTripAdvice = function (tripsData, index)
{
    
    // console.log(tripsData);
    
    // Container visible because a choice has been made.
    // ClickedButtonID is needed to find the right trip to show.
    var containerVisibility = elementFinder('.timeline');
    var buttonElem = elementsFinder('.button-trip-choice');
    containerVisibility.style.visibility = 'visible';
    var clickedButtonID = buttonElem[index].dataset.index;

    var trip = "";
    tripsData.forEach(element => {
        if(element['idx'] == clickedButtonID)
        {
            trip = element['legs'][0];
        }
    });

/* Start of departure section */
    // Get departure elements.
    var departureTimeElem = elementFinder('.planned-departure-time');
    var departureTrackElem = elementFinder('.planned-departure-track');
    var departureStationElem = elementFinder('.planned-departure-station');
    departureTimeElem.innerText = "";
    departureTrackElem.innerText = "";
    departureStationElem.innerText = "";

    // Get time from datetime string
    var departureDateTime = trip.origin.plannedDateTime;
    var startPosition = departureDateTime.search("T") +1;
    var endPosition = startPosition + 5;
    departureTime = departureDateTime.substring(""+startPosition, ""+endPosition);

    // Show results to the user
    departureTimeElem.innerText = departureTime;
    departureTrackElem.innerText = "Vertrek: Spoor "+trip.origin.actualTrack;
    departureStationElem.innerText = "Station "+trip.origin.name;
/* End of departure section */

/* Start of stops section */

/* End of stops section */

/* Start of arrival section */
    // Get arrival elements.
    var arrivalTimeElem = elementFinder('.planned-arrival-time');
    var arrivalTrackElem = elementFinder('.planned-arrival-track');
    var arrivalStationElem = elementFinder('.planned-arrival-station');
    arrivalTimeElem.innerText = "";
    arrivalTrackElem.innerText = "";
    arrivalStationElem.innerText = "";

    // Get time from datetime string
    var arrivalDateTime = trip.destination.plannedDateTime;
    var startPosition = arrivalDateTime.search("T") +1;
    var endPosition = startPosition + 5;
    arrivalTime = arrivalDateTime.substring(""+startPosition, ""+endPosition);

    // Show results to the user
    arrivalTimeElem.innerText = arrivalTime;
    arrivalTrackElem.innerText = "Vertrek: Spoor "+trip.destination.actualTrack;
    arrivalStationElem.innerText = "Station "+trip.destination.name;
/* End of arrival section */
    
}

var elementFinder = function (selector) {

    return document.querySelector(selector);
};

var elementsFinder = function (selector) {

    return document.querySelectorAll(selector);
};