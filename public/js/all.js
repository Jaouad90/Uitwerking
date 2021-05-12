const ajaxService = function(routeSearch, value, label){
    
    $.ajax({
       type:'GET',
       url:routeSearch,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data:{value:value, label:label},
       success:function(data){
        console.log(data);
        
       },
       error: function(response) {
        console.log(response);
       }
    });

}
//AUTOCOMPLETION FOR SEARCHFIELD
const DEFAULTS = {
    treshold: 2,
    maximumItems: 5,
    highlightTyped: true,
    highlightClass: 'text-primary',
  };
  
  class Autocomplete {
    constructor(field, options) {
      this.field = field;
      this.options = Object.assign({}, DEFAULTS, options);
      this.dropdown = null;
  
      field.parentNode.classList.add('dropdown');
      field.setAttribute('data-toggle', 'dropdown');
      field.classList.add('dropdown-toggle');
  
      const dropdown = ce(`<div class="dropdown-menu" ></div>`);
      if (this.options.dropdownClass)
        dropdown.classList.add(this.options.dropdownClass);
  
      insertAfter(dropdown, field);
  
      this.dropdown = new bootstrap.Dropdown(field, this.options.dropdownOptions)
  
      field.addEventListener('click', (e) => {
        if (this.createItems() === 0) {
          e.stopPropagation();
          this.dropdown.hide();
        }
      });
  
      field.addEventListener('input', () => {
        if (this.options.onInput)
          this.options.onInput(this.field.value);
        this.renderIfNeeded();
      });
  
      field.addEventListener('keydown', (e) => {
        if (e.keyCode === 27) {
          this.dropdown.hide();
          return;
        }
        if (e.keyCode === 40) {
          this.dropdown._menu.children[0]?.focus();
          return;
        }
      });
    }
  
    setData(data) {
      this.options.data = data;
      this.renderIfNeeded();
    }
  
    renderIfNeeded() {
      if (this.createItems() > 0)
        this.dropdown.show();
      else
        this.field.click();
    }
  
    createItem(lookup, item) {
      let label;
      if (this.options.highlightTyped) {
        const idx = item.label.toLowerCase().indexOf(lookup.toLowerCase());
        const className = Array.isArray(this.options.highlightClass) ? this.options.highlightClass.join(' ')
          : (typeof this.options.highlightClass == 'string' ? this.options.highlightClass : '')
        label = item.label.substring(0, idx)
          + `<span class="${className}">${item.label.substring(idx, idx + lookup.length)}</span>`
          + item.label.substring(idx + lookup.length, item.label.length);
      } else
        label = item.label;
      return ce(`<button type="button" class="dropdown-item" data-value="${item.value}">${label}</button>`);
    }
  
    createItems() {
      const lookup = this.field.value;
      if (lookup.length < this.options.treshold) {
        this.dropdown.hide();
        return 0;
      }
  
      const items = this.field.nextSibling;
      items.innerHTML = '';
  
      let count = 0;
      for (let i = 0; i < this.options.data.length; i++) {
        const {label, value} = this.options.data[i];
        const item = {label, value};
        if (item.label.toLowerCase().indexOf(lookup.toLowerCase()) >= 0) {
          items.appendChild(this.createItem(lookup, item));
          if (this.options.maximumItems > 0 && ++count >= this.options.maximumItems)
            break;
        }
      }
  
      this.field.nextSibling.querySelectorAll('.dropdown-item').forEach((item) => {
        item.addEventListener('click', (e) => {
          let dataValue = e.target.getAttribute('data-value');
          this.field.value = e.target.innerText;
          if (this.options.onSelectItem)
            this.options.onSelectItem({
              value: e.target.dataset.value,
              label: e.target.innerText,
            });
          this.dropdown.hide();
        })
      });
  
      return items.childNodes.length;
    }
  }
  
  /**
   * @param html
   * @returns {Node}
   */
  function ce(html) {
    let div = document.createElement('div');
    div.innerHTML = html;
    return div.firstChild;
  }
  
  /**
   * @param elem
   * @param refElem
   * @returns {*}
   */
  function insertAfter(elem, refElem) {
    return refElem.parentNode.insertBefore(elem, refElem.nextSibling)
  }

  const ac = new Autocomplete(document.getElementById('autoCompletionInput'), {
    data: [{label: "I'm a label", value: 42}],
    maximumItems: 10,
    treshold: 1,
    highlightTyped: true,
    highlightClass: 'text-primary',
    onSelectItem: ({label, value}) => {
      var routeSearch = "/search/:id";
      routeSearch = routeSearch.replace(':id', value);

      window.location.replace(routeSearch+"/"+label)
    }
  });

  function setData4AutoCompletion() {
    jsonDataStations = stationsData.map(function(station) {
      return trainStationJson = {"label":station.namen.lang, "value":station.UICCode} ;
    });

    return jsonDataStations;
  }

ac.setData(setData4AutoCompletion());

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