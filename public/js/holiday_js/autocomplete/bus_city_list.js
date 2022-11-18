$(function() {

		   //Bus source list 
    $("#bus_source").autocomplete({
	    source: siteUrl+"home/bus_source_autolist",
        minLength: 2,
        autoFocus: true
    });	
	 $("#bus_source1").autocomplete({
	    source: siteUrl+"home/bus_source_autolist",
        minLength: 2,
        autoFocus: true
    });	
	
    //Bus destination list
    $("#bus_destination").autocomplete({
        source: siteUrl+"home/bus_desti_list",
        minLength: 2,
        autoFocus: true
    });	
				
	   //Bus source list 
    $("#bus_source").autocomplete({
	    source: siteUrl+"b2b/bus_source_autolist",
        minLength: 2,
        autoFocus: true
    });	
	
    //Bus destination list
    $("#bus_destination").autocomplete({
        source: siteUrl+"b2b/bus_desti_list",
        minLength: 2,
        autoFocus: true
    });				

});