# Usage
Run `docker-compose up -d` to start the application container locally

check if container state is up `docker-compose ps`


# Samenvatting:
## Tijdinschatting
* Gedachte:         4 dagen met gemak
* Werkelijkheid:    8 dagen met veel stress en een sterke leercurve
## Project
Hoe simpel de documentatie ook wordt gecreeerd. Tijdens de installatie via composer kwam ik een lokale php issue tegen. De lokale php had ik verwijderd en het project opgezet in mijn xampp folder die al php bevat. Sindsdien heb ik de installatie met succes kunnnen uitvoeren.

Voor de configuratie zijn een aantal installaties vooraf geinstalleerd zoals sass, bootstrap. De webpack script is aangepast om bestanden te compilen naar de public folder. Door te compilen zal de sass code geconverteerd worden naar css code en gepubliceerd worden aan de eindgebruiker/browser. Dit moet gebeuren, omdat de browser geen sass code begrijpt. Daarnaast wordt in het volgende script javascript bestanden bijelkaar gevoegd in 1 bestand `/all.js` en geplaatst in het `/public/all.js` folder .

```
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .scripts([
        'resources/js/ajaxService.js',
        'resources/js/autoCompletion.js'
    ], 'public/js/all.js')
```

Ik wou de onderdelen exact hetzelfde maken als die van het originele site. Dus koos ik ervoor om een autocomplete toe te passen als zoek veld. Hiervoor moest ik mijn onderzoekje doen en kwam ik al gauw tutorials tegen van hoe het geimplementeerd kan worden. Toen ik het ging implementeren kreeg ik er errors voor terug en na elke die ik oploste kwam er een ander voor terug :-D.

Sindsdien ben ik merendeels aan het googlen geweest en heb ik de laravel docs bij de hand. Hierdoor heb ik geleerd hoe ik data kan returnen naar mijn view vanuit de controller en hoe ik deze data kan encoden voor de javascript van de autocomplete. Na enige tijd te hebben verloren en veel te hebben gelezen kwam ik erachter dat ik voor het laatste het volgende moest gebruiken: `var stationsData = @json($stationsData);`. Hierdoor kon ik de data uit de controller in mijn autocomplete script gebruiken. 

Toen kwam de uitdaging voor mij om de gekozen data terug te krijgen in de controller en hieraan ben ik veel tijd aan kwijt geraakt en heb er zeker van geleerd. Want?
In eerste instantie kwam ik op het internet tegen dat het op de volgende manier kan:
`window.location.href`
Maar integendeel kreeg ik het niet werkend en ben ik verder gaan zoeken. Zo kwam ik op de Ajax Request oplossing terecht. Nadat ik die had geimplementeerd kreeg ik mijn view terug als xhr bestand en werd niet weergegeven in de browser. Dit kon ik niet oplossen en heb ik toen mijn vragen neergelegd bij de laracast community. Die hebben mij uitgelegd dat het komt omdat mijn AJAX request asynchroon werkt en dat het een response terug krijgt. Dat is niet wat ik nodig had, want ik wil vanuit mijn controller de view returnen met mijn opgehaalde api data.
```
const ajaxService = function(routeSearch, value, label){
    
    $.ajax({
       type:'GET',
       url:routeSearch,
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data:{value:value, label:label},
       success:function(data){
        console.log(data);
        $('#arrival-list').append(data)
       },
       error: function(response) {
        console.log(response);
       }
    });

}
```
Wat ik nodig heb is het opvragen van de route. Hiervoor had ik 1 line of code nodig:
`window.location.replace(routeSearch)`
Nadat ik hierover ingelicht was heb ik het werkend kunnen krijgen. Nu wordt vanuit de autocomplete functie direct de route aangeroepen zonder AJAX of iets dergelijks.

Aangezien ik dit nu werkend heb; een aantal dagen verder ben en totaal niet weet hoe lang het nog zal duren. Heb ik de styling maar uitgesloten. Nu ik de overzicht heb wil ik laravel eerst goed onder de knie krijgen. Want iedere keer dat ik code geschreven had vond ik in de docs een manier om het netter te doen.
Voorbeeld: hardcoded key en url voor de API calls. Geleerd hoe ik deze vastleg in de environment en de env in de config.


## Conclusie
Waarschijnlijk had ik mezelf overschat :-D of tenminste ik weet het zeker. Goede opdracht en heb er veel van mogen leren en ben er zeker nog niet klaar mee. Maar mocht ik het opnieuw moeten doen dan doe ik het binnen een dag. Zonder de Docker, want dat is iets dat ik mezelf nog moet aanleren. Voor Docker heb ik raad van een vriend gekregen doormiddel van een videocall. Waarbij hij mij heeft laten zien hoe een docker container gecreeerd kan worden.

Tot slot, weet ik in ieder geval wel wat ik heb gedaan en zijn mijn keuzes bewust gemaakt. Of het de beste manier is moet nog blijken wanneer ik er feedback op krijg. Alhoewel ik zelf ook weet dat het één en ander beter kan. 

Naast het coderen heb ik ook mijn best gedaan om te voldoen aan de dev principe DRY en de andere principes zie ik meer als toepasselijk wanneer er meer code is. De architectuur is naar mijn gevoel goed opgesteld waardoor er onderscheid wordt gemaakt tussen Model/Controllers/Services/Views/



