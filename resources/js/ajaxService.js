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