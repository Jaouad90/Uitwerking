var showTripAdvice = function (tripData)
{
    // Container visible because a choice has been made.
    var containerVisibility = elementFinder('.timeline');
    containerVisibility.style.visibility = 'visible';

/* Start of departure section */
    // Get departure elements.
    var departureTimeElem = elementFinder('.planned-departure-time');
    var departureTrackElem = elementFinder('.planned-departure-track');
    var departureStationElem = elementFinder('.planned-departure-station');

    // Get time from datetime string
    var departureDateTime = tripData.origin.actualDateTime;
    var startPosition = departureDateTime.search("T") +1;
    var endPosition = startPosition + 5;
    departureTime = departureDateTime.substring(""+startPosition, ""+endPosition);

    // Show results to the user
    var content = document.createTextNode(departureTime);
    departureTimeElem.appendChild(content);
    content = document.createTextNode(tripData.origin.actualTrack);
    departureTrackElem.appendChild(content);
    content = document.createTextNode(tripData.origin.name);
    departureStationElem.appendChild(content);
/* End of departure section */

/* Start of arrival section */
    // Get arrival elements.
    var arrivalTimeElem = elementFinder('.planned-arrival-time');
    var arrivalTrackElem = elementFinder('.planned-arrival-track');
    var arrivalStationElem = elementFinder('.planned-arrival-station');

    // Get time from datetime string
    var arrivalDateTime = tripData.destination.actualDateTime;
    var startPosition = arrivalDateTime.search("T") +1;
    var endPosition = startPosition + 5;
    arrivalTime = arrivalDateTime.substring(""+startPosition, ""+endPosition);

    // Show results to the user
    var content = document.createTextNode(arrivalTime);
    arrivalTimeElem.appendChild(content);
    content = document.createTextNode(tripData.destination.actualTrack);
    arrivalTrackElem.appendChild(content);
    content = document.createTextNode(tripData.destination.name);
    arrivalStationElem.appendChild(content);
/* End of arrival section */
    


    console.log(tripData);
}

var elementFinder = function (selector) {

    return document.querySelector(selector);
};