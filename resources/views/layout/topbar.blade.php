
<!-- Returns the JSON representation of $stationCollection and assign the JSON to js var -->
<script>
var stationsData = @json($stationsData) ;   
</script>

<section id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="search">
                    <div class="search-body">
                        <form>
                            <div class="form-group">
                                <input id="autoCompletionInput" class="form-control" placeholder="Zoek halte of station" autocomplete="off"  type="text">                                  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>