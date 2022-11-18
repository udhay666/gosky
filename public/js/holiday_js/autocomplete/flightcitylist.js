$(function() {

       //Bus source list 
       $("#source").autocomplete({
        source: siteUrl+"home/flight_source_autolist",
        minLength: 2,
        autoFocus: true,
        select: function( event, ui ) {
          $("#destination").focus();
        }
      }); 
       $("#destination").autocomplete({
        source: siteUrl+"home/flight_source_autolist",
        minLength: 2,
        autoFocus: true,
        select: function( event, ui ) {
          $("#dpf1").focus();
        }
      });     
     });