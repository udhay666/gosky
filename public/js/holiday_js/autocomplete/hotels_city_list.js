$(function() {
      
    //  World Wide Hotels City List 
      //$("#cityName").autocomplete({
      //  source: siteUrl+"/home/hotels_city_autolist_gta",
      //  minLength: 2,
      //  autoFocus: true
      //});
    ////        //        below for agent hotel city list
       // $("#cityNamea").autocomplete({ 
    //  source: siteUrl+"/b2b/hotels_city_autolist_gta",
      //  minLength: 2,
    //    autoFocus: true
    //  });
        
//           $("#cityName").autocomplete({
//         source: siteUrl+"/home/hotels_city_autolist_rx",
//         minLength: 2,
//         autoFocus: true
//       });
//        $("#cityNamea").autocomplete({ 
//      source: siteUrl+"/b2b/hotels_city_autolist_hp",
//        minLength: 2,
//        autoFocus: true
//      });
////    
//$("#cityName").autocomplete({
//       source: siteUrl+"/home/hotels_city_autolist_hp",
//        minLength: 2,
//        autoFocus: true
//    });
//  /**/ $("#cityName").autocomplete({
//       source: siteUrl+"/home/hotels_city_autolist_tr",
//       minLength: 2,
//       autoFocus: true
//  }); 
    // dotw city list 
//      $("#cityName").autocomplete({
//       source: siteUrl+"/home/hotels_city_autolist_dotw",
//       minLength: 2,
//       autoFocus: true
//   }); 
 
    //hotel name list
  /*  $("#hotelname").autocomplete({ 
        source: siteUrl+"/home/hotels_autolist_rx",
        minLength: 2,
        autoFocus: true
    });
    

    $("#cityName").autocomplete({ 
        source: siteUrl+"/home/hotels_autolist_rx",
        minLength: 2,
        autoFocus: true
    });
  $("#cityNamea").autocomplete({ 
        source: siteUrl+"/b2b/hotels_city_autolist_rx",
        minLength: 2,
        autoFocus: true
    });*/
       
    //ezeego
     $("#cityName").autocomplete({
       source: siteUrl+"home/hotels_city_list",
       minLength: 2,
       autoFocus: true
   });    
   
     $("#cityNameb").autocomplete({
       source: siteUrl+"b2b/hotels_city_list",
       minLength: 2,
       autoFocus: true
   });    
   

       $("#cityName_pick").autocomplete({
       source: siteUrl+"home/tran_city_list",
       minLength: 2,
       autoFocus: true
   });  
     $("#cityName_drop").autocomplete({
       source: siteUrl+"home/tran_city_list",
       minLength: 2,
       autoFocus: true
   });  

});