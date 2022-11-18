var hotelsListingMap, HotelsList, fullView = 0;
function changeView(divid, that, view) {
    if ($(that).hasClass('active')) {
        return false;
    }
    fullView = view;
    $("#hotel-grid-view, #hotel-map-view").fadeOut('slow');
    $("#grid-view, #map-view").removeClass('active');
    $(divid).fadeIn('slow');
    $(that).addClass('active');
    if (fullView == 1) {
        $("#sort-box").prop("disabled", true);
        $("#hotel-content").removeClass("container").addClass("container-fluid");
        refinement(0);
    } else {
        refinement(1);
        $("#sort-box").prop("disabled", false);
        $("img").unveil(100);
        $("#hotel-content").removeClass("container-fluid").addClass("container");
    }
}





// Detect pagination click

$(document).on("click", '#pagination a', function (e) {
    e.preventDefault();
    var page = $(this).attr('data-ci-pagination-page');
    if (page !== undefined && !isNaN(page)) {
        refinement(page);
    }

//    loadPagination(page_no);
});
//function loadPagination($page) {
//    alert($page);
//}
//--------------- Filters -----------------------------
$(function () {
    $('#slide-submenu').on('click', function () {
        $('#filters-block').fadeOut('slide', function () {
            $('.mini-submenu-container').fadeIn();
            $("#hotel-listing-block").removeClass('col-sm-9 col-md-9').addClass('col-sm-11 col-md-11');
            $('.swap-tiles li.active').click();
        });
    });
    $('.mini-submenu-container').on('click', function () {
        $('#filters-block').toggle('slide');
        $('.mini-submenu-container').hide();
        $("#hotel-listing-block").removeClass('col-sm-11 col-md-11').addClass('col-sm-9 col-md-9')
        $('.swap-tiles li.active').click();
    });
});

function intialize_filters(aggregates) {
    //Range Slider
    $(function () {
        var minVal = parseInt($("#min-price").val());
        var maxVal = parseInt($("#max-price").val());
        $("#price-range").slider({
            range: true,
            min: minVal,
            max: maxVal,
            values: [minVal, maxVal],
            slide: function (event, ui) {
                $("#min-price-txt").text(ui.values[ 0 ]);
                $("#max-price-txt").text(ui.values[ 1 ]);
                $("#min-price").val(ui.values[ 0 ]);
                $("#max-price").val(ui.values[ 1 ]);
            },
            stop: function () {
                refinement();
            }
        });
        $("#min-price-txt").text($("#price-range").slider("values", 0));
        $("#max-price-txt").text($("#price-range").slider("values", 1));
    });
    //Hotel Autocomplete
    var hotel_list = aggregates.autocomplete;
    $("input#hname").autocomplete({
        source: hotel_list,
        select: function (event, ui) {
            $(this).val(ui.item.value);
            $("#hid").val(ui.item.id);
            return false;
        },
        change: function (event, ui) {
            if (!ui.item) {
                $(this).val("");
                $("#hid").val("");
            }
            refinement();
        }
    });
//    $('#hname').keyup(function (e) {
//        if (e.keyCode == 13)
//        {
//            $("#hid").val('');
//            refinement();
//        }
//    });
    //Trigger Filter on any change
    $(".refinement").change(function () {
        refinement();
    });
    //uncheck checkboxes from section and show all
    $(".show-all").on('click', function () {
        $(this).closest("section").find('input:checkbox').prop('checked', false);
        refinement();
    });


}

var filter_xhr = null;
function refinement(page)
{
    if (page === undefined) {
        page = 1;
    }
    var data = getFilterData();
    filter_xhr = $.ajax({
        type: 'POST',
        async: true,
        dataType: 'json',
        data: data,
        url: myconfig.site_url + 'hotel/filterList/' + page,
        beforeSend: function () {
            //Ajax Call
            if (filter_xhr != null) {
                filter_xhr.abort();
            }
            $(".loading-content").fadeIn();
        },
        success: function (response) {
            renderActiveBlock(response);
            $(".loading-content").fadeOut();
        },
        complete: function () {
            
        }
    });
}
function getFilterData()
{
    var data = {req: request};
    //### Sorting
    data.orderBy = $("#sort-box").find(':selected').data('order');
    data.orderType = $("#sort-box").find(':selected').val();
    //############Filters
    //Keywords
    data.keywords = [];
    $("input:checkbox[name=hotel_theme]:checked").each(function () {
        data.keywords.push($(this).val());
    });
    //Boards
    data.boards = [];
    $("input:checkbox[name=hotel_board]:checked").each(function () {
        data.boards.push($(this).val());
    });
    //Payment Type
    data.payment_type = $("input[name='payment_type']:checked").val();
    //Accomodation Types
    data.acomd_type = [];
    $("input:checkbox[name=acomd_type]:checked").each(function () {
        data.acomd_type.push($(this).val());
    });
    //Star rating
    data.stars = [];
    $("input:checkbox[name=hotel_stars]:checked").each(function () {
        data.stars.push($(this).val());
    });
    //TA rating
    data.ta_rating = [];
    $("input:checkbox[name=hotel_ta_rating]:checked").each(function () {
        data.ta_rating.push($(this).val());
    });
    //Hotel Chains
    data.chain = [];
    $("input:checkbox[name=hotel_chain]:checked").each(function () {
        data.chain.push($(this).val());
    });
    //Hotel Ameneties
    data.hotel_ameneties = [];
    $("input:checkbox[name=hotel_ameneties]:checked").each(function () {
        data.hotel_ameneties.push($(this).val());
    });
    data.hzone = [];
    $("input:checkbox[name=hzone]:checked").each(function () {
        data.hzone.push($(this).val());
    });
    //Search By name
    data.hotel_id = $("#hid").val();
    data.hotel_name = $("#hname").val();
    //Price
    data.min_price = $("#min-price").val();
    data.max_price = $("#max-price").val();
    return data;
}
function renderActiveBlock(response)
{
    if (fullView === 1) {
        renderMapTemplate(response);
    } else {
        renderListTemplate(response);
    }
}
//Filter Data
function renderListTemplate(response) {

    if (typeof response.result !== 'undefined' && typeof response.result.hotels !== 'undefined' && response.result.hotels.length > 0) {
        var source = $("#hotel-list-block-tmpl").html();
        var template = Handlebars.compile(source);
        var htmlOutput = template({records: response.result.hotels, total: response.result.total});
        $("#hotel_result").html(htmlOutput);
        $('#total-search-hotels').text(response.result.total);

        $("#pagination").html(response.result.pagination);
        //Filters Update
        if (typeof response.result.aggregates !== 'undefined') {
            var template = Handlebars.compile($("#filters-block-tmpl").html());
            var htmlOutput = template(response.result.aggregates);
            $("#filters-block").html(htmlOutput);
            load_nanoscroll();
            intialize_filters(response.result.aggregates);
        }

        $("#sort-box").prop("disabled", false);
        $('.swap-tiles').show();
        $('#hotel-grid-view').show();
        $("img").unveil(100);
        loadToolTips();
    } else {
        $(".loader-placeholder").addClass('loader-stop');
        $("#hotel_result").html($("#no_results").html());
        $('#total-search-hotels').text(0);
        $("#sort-box").prop("disabled", true);
    }

    if (typeof response.reload !== 'undefined' && response.reload === 1) {
        $('#session_expire').modal({backdrop: 'static', keyboard: false, show: true});
    }

}
//Google Maps
var map_style = [{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"}]}, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 45}]}, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]}];
function renderMapTemplate(response)
{
    // Create a new StyledMapType object, passing it an array of styles,
    // and the name to be displayed on the map type control.
    hotelsListingMap = null;
    if (typeof response.result !== 'undefined' && typeof response.result.hotels !== 'undefined' && response.result.hotels.length > 0) {
        HotelsList = response.result.hotels;
        var styledMapType = new google.maps.StyledMapType(map_style, {name: 'Styled Map'});
        var myOptions = {
            center: new google.maps.LatLng(HotelsList[0].HotelInfo.Latitude, HotelsList[0].HotelInfo.Longitude),
            zoom: 13,
            streetViewControl: false,
            fullscreenControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        hotelsListingMap = new google.maps.Map(document.getElementById('hotels-map'), myOptions);
        hotelsListingMap.mapTypes.set('styled_map', styledMapType);
        hotelsListingMap.setMapTypeId('styled_map');
        //Set Map Markers
        HotelsList.forEach(function (hotel) {
            if (hotel.HotelInfo.Latitude && hotel.HotelInfo.Longitude) {
                centerMap = new google.maps.LatLng(hotel.HotelInfo.Latitude, hotel.HotelInfo.Longitude);
                var marker = new MarkerWithLabel({
                    position: centerMap,
                    map: hotelsListingMap,
                    labelContent: hotel.HotelPrice.Currency + " " + hotel.HotelPrice.MinPrice,
                    labelAnchor: new google.maps.Point(7, 30), //new google.maps.Point(3, 30),
                    labelClass: "mapmarker", // the CSS class for the label 
                    labelInBackground: false,
                    icon: "/public/assets/images/icons/transparent.png",
                });
                hotelsListingMap.setCenter(marker.getPosition());
                google.maps.event.addListener(marker, "click", function (event) {
                    renderMapPopup(hotel);
                });
            }
        });
        var center = hotelsListingMap.getCenter();
        google.maps.event.trigger(hotelsListingMap, "resize");
        hotelsListingMap.setCenter(center);
    } else {
        $(".loader-placeholder").addClass('loader-stop');
        $("#hotel_result").html($("#no_results").html());
        $('#total-search-hotels').text(0);
        $("#sort-box").prop("disabled", true);
    }

    if (typeof response.reload !== 'undefined' && response.reload === 1) {
        $('#session_expire').modal({backdrop: 'static', keyboard: false, show: true});
    }
}
//Render Map popup
function renderMapPopup(hotel)
{
    var source = $("#hotel-map-window").html();
    var template = Handlebars.compile(source);
    var content = template(hotel);
    $("#map-popwindow").html(content).show();
    loadToolTips();
}