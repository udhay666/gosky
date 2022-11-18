$(document).ready(function() {

var searcharray = $('#searcharray').val();


    var l = api_array.length;

    $i = 0;
    search_availability($i);

    //these will basically execute at the same time:

    function search_availability($a) {
        // alert(api_array[$a]);
        /*for (var i = 0, l = api_array.length; i < l; i++) 
            {*/
        $.ajax({
            url: siteUrl + 'flights/flights_availabilty',
            data: 'callBackId=' + api_array[$a] + '&searcharray=' + searcharray,
            dataType: 'json',
            type: 'POST',
            success: function(data) {
                $('#sessionId').val(data.session_id);
               

            },
            error: function(data) {
                //load_search_results();
                console.log(data);
            }
        });
        /*}*/
    }

});