// $(document).ready(function(){
//     $("#autocomplete21").autocomplete({
//         source: [
//             "Apple",
//             "Bannana",
//             "Orange"
//         ],
//         select: function( event, selectedData ) {
//             console.log(selectedData);
//         }
//     });
// });




$(document).ready(function(){
var source = [
    { name: 'New York', code: 'JFK'},
    { name: 'Agra', code: 'AGR'},
    { name: 'Bangalore', code: 'BLR'},
    { name: 'Hyderabad', code: 'BPM'},
    { name: 'Rome', code: 'FCO'}
];
$( "#autocomplete21" ).autocomplete({
    source: function(request, response){
        var searchTerm = request.term.toLowerCase();
        var ret = [];
        $.each(source, function(i, airportItem){
            if (airportItem.code.toLowerCase().indexOf(searchTerm) !== -1 || airportItem.name.toLowerCase().indexOf(searchTerm) === 0)
                ret.push(airportItem.name + ' - ' + airportItem.code);
        });
       
        response(ret);
    }
});

});


$(document).ready(function(){
    var source = [
        { name: 'New York', code: 'JFK'},
        { name: 'Agra', code: 'AGR'},
        { name: 'Bangalore', code: 'BLR'},
        { name: 'Hyderabad', code: 'BPM'},
        { name: 'Rome', code: 'FCO'}
    ];
    $( "#autocomplete2" ).autocomplete({
        source: function(request, response){
            var searchTerm = request.term.toLowerCase();
            var ret = [];
            $.each(source, function(i, airportItem){
                if (airportItem.code.toLowerCase().indexOf(searchTerm) !== -1 || airportItem.name.toLowerCase().indexOf(searchTerm) === 0)
                    ret.push(airportItem.name + ' - ' + airportItem.code);
            });
           
            response(ret);
        }
    });
    
    });

   