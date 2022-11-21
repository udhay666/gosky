$(document).ready(function () {
  $("input[name='fromCity']").autocomplete({
    delay: 0,
    source: function (request, response) {
      //fetch data
      $.ajax({
        url: site_url+"home/airportList",
        type: "post",
        dataType: "json",
        data: {
          search: request.term,
        },
        success: function (data) {
          response(data);
        },
      });
    },
    select: function (event, ui) {
      $("input[name='fromCity']").val(ui.item.label);
      // $('#userid').val(ui.item.value);

      return false;
    },
  });
});

$(document).ready(function () {
  $("input[name='toCity']").autocomplete({
    delay: 0,
    source: function (request, response) {
      //fetch data
      $.ajax({
        url: site_url+"home/airportList",
        type: "post",
        dataType: "json",
        data: {
          search: request.term,
        },
        success: function (data) {
          response(data);
        },
      });
    },
    select: function (event, ui) {
      $("input[name='toCity']").val(ui.item.label);
      // $('#userid').val(ui.item.value);

      return false;
    },
  });
});

      $(document).ready(function () {

          $("input[name='cityName']").autocomplete({
              delay: 0,
              source: function(request,response){
                //fetch data
                $.ajax({
                    url: site_url+'home/hotelCityList',
                    type: 'post',
                    dataType: 'json',
                    data: {
                      search: request.term
                    },
                    success: function (data) {
                      response(data);
                    }
                  });
              },
              select: function(event, ui){
                  $("input[name='cityName']").val(ui.item.label);
                  $("input[name='cityid']").val(ui.item.id);
                //   $('#userid').val(ui.item.value);

                  return false;
              },
          });
      });
    