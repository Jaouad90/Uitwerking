var showTripAdvice = function (tripsData)
{
    
    console.log(tripsData);
    
    // Container visible because a choice has been made.
    // Reset all childs.
    var containerVisibility = elementFinder('.timeline');
    containerVisibility.style.visibility = 'visible';

/* Start of departure section */
    // Get departure elements.
    var departureTimeElem = elementFinder('.planned-departure-time');
    var departureTrackElem = elementFinder('.planned-departure-track');
    var departureStationElem = elementFinder('.planned-departure-station');
    departureTimeElem.innerText = "";
    departureTrackElem.innerText = "";
    departureStationElem.innerText = "";

    // Get time from datetime string
    var departureDateTime = tripData.origin.plannedDateTime;
    var startPosition = departureDateTime.search("T") +1;
    var endPosition = startPosition + 5;
    departureTime = departureDateTime.substring(""+startPosition, ""+endPosition);

    // Show results to the user
    departureTimeElem.innerText = departureTime;
    departureTrackElem.innerText = "Vertrek: Spoor "+tripData.origin.actualTrack;
    departureStationElem.innerText = "Station "+tripData.origin.name;
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
    var arrivalDateTime = tripData.destination.plannedDateTime;
    var startPosition = arrivalDateTime.search("T") +1;
    var endPosition = startPosition + 5;
    arrivalTime = arrivalDateTime.substring(""+startPosition, ""+endPosition);

    // Show results to the user
    arrivalTimeElem.innerText = arrivalTime;
    arrivalTrackElem.innerText = "Vertrek: Spoor "+tripData.destination.actualTrack;
    arrivalStationElem.innerText = "Station "+tripData.destination.name;
/* End of arrival section */
    
}

var elementFinder = function (selector) {

    return document.querySelector(selector);
};