$(document).ready(function() {

    $("#ContHelpDesk").hover(function() {
            $(this).animate({ left: "0px" }, 1);
        },
        function() {
            $(this).animate({ left: "-97px" }, 1);
        });



    $("#busid").attr("class", "active");
    var RedBusDName = $('#hRedBusDName').val();
    $('#destination').val(RedBusDName);
    $("#waitDiv").hide();
    $("#BlockDivOpacity").hide();

    $("#Origin").focus(function() {
        if ($.trim($(this).val()) == "Enter Origin") {
            $(this).val("");
            $("#hRedBusSID").val("");
        } else {
            $(this).select();
        }
    });
    $("#destination").focus(function () {
        if ($.trim($(this).val()) == "Enter Destination") {
            $(this).val("");
            $("#hRedBusDId").val("");
        } else {
            $(this).select();
        }
    });

    

    //#region Hide/Show Offer Price
    $("#toggleOffer").click(function(e) {
        e.preventDefault();
        $(".bus_offer_width,.bus_offer").slideToggle("slow");
        $(this).text(($(this).text() == "Show Offer") ? "Hide Offer" : "Show Offer");
    });


    $("#togglePrice").click(function(e) {
        e.preventDefault();
        $(".bus_offer_width,.bus_offer").toggle();
        $(".bus_publish_width,.bus_publish").toggle();
        $(this).text(($(this).text() == "Show Offer") ? "Show Publish" : "Show Offer");
    });

    //#endregion

    //#region Code for Sorting Starts from here

    //Caching BusResult Div for faster sorting 
    // var BusDiv = $("#BusResult div.bus_result_p");
    // var BusResult = $("#BusResult");
    // /* setup key attributes for sorting*/
    // $("#spnSort_Departure").data("sortKey", "[id^='Depart_']");
    // $("#spnSort_Arrival").data("sortKey", "[id^='Arrival_']");
    // $("#spnSort_Publish").data("sortKey", "[id^='Publish_']");
    // $("#spnSort_Offered").data("sortKey", "[id^='Offered_']");
    // $("#spnSort_Seat").data("sortKey", "[id^='Seat_']");
    // /* setup sortOrder default attributes */
    // var pubPriceSortOrder = "Asc";
    // var offerPriceSortOrder = "Asc";
    // var seatSortOrder = "Asc";
    // var departueSortOrder = "Asc";
    // var arrivalSortOrder = "Asc";

    // $('[id^="spnSort_"]').on("click",
    //     function(e) {
    //         e.preventDefault();
    //         $("#waitDiv").show();
    //         $("#BlockDivOpacity").show();
    //         $('[id^="spnSort_"]').removeClass("selected");
    //         //$('[id^="img_"]').removeClass("high");
    //         var spanId = $(this).attr("id");
    //         var sortType = spanId.replace(/spnSort_/, "");
    //         var imgObj = $("#" + spanId.replace("spnSort", "img"));
    //         imgObj.toggleClass("low", "high");
    //         //$('[id^="spnSort_"]').removeClass("selected");
    //         var sortOrder;
    //         if (sortType == "Publish") {
    //             $("#spnSort_Publish").addClass("selected");
    //             sortOrder = pubPriceSortOrder;
    //             if (pubPriceSortOrder == "Asc") {
    //                 pubPriceSortOrder = "Desc";
    //             } else {
    //                 pubPriceSortOrder = "Asc";
    //             }
    //         } else if (sortType == "Offered") {
    //             $("#spnSort_Offered").addClass("selected");
    //             sortOrder = offerPriceSortOrder;
    //             if (offerPriceSortOrder == "Asc") {
    //                 offerPriceSortOrder = "Desc";
    //             } else {
    //                 offerPriceSortOrder = "Asc";
    //             }
    //         } else if (sortType == "Seat") {
    //             $("#spnSort_Seat").addClass("selected");
    //             sortOrder = seatSortOrder;
    //             if (seatSortOrder == "Asc") {
    //                 seatSortOrder = "Desc";
    //             } else {
    //                 seatSortOrder = "Asc";
    //             }
    //         } else if (sortType == "Departure") {
    //             $("#spnSort_Departure").addClass("selected");
    //             sortOrder = departueSortOrder;
    //             if (departueSortOrder == "Asc") {
    //                 departueSortOrder = "Desc";
    //             } else {
    //                 departueSortOrder = "Asc";
    //             }
    //         } else {
    //             $("#spnSort_Arrival").addClass("selected");
    //             sortOrder = arrivalSortOrder;
    //             if (arrivalSortOrder == "Asc") {
    //                 arrivalSortOrder = "Desc";
    //             } else {
    //                 arrivalSortOrder = "Asc";

    //             }
    //         }
    //         sortUsingNestedText($(this).data("sortKey"), sortOrder);
    //         $("#waitDiv").hide();
    //         $("#BlockDivOpacity").hide();
    //     });



    $("#selectedBoardingPoint").change(function () {
        if ($("#errorMsgBoard").css('display') == 'inline') {
            $("#errorMsgBoard").hide();
        }
    });
    
    function Boardingpoints() {
        ShowBoardingPoints();

        var hIsSDetailExist = $("#hIsBusDetailExist").val();
        if (hIsSDetailExist != "true") {
            $("#popupBlock_Board").html($("#waitDiv").html());
            var sessionStampId = $("#SessionStampId").val();
            var routeID = $("#hRouteID").val();
            $.ajax({
                type: "POST",
                url: "/Bus/BusRouteDetail/BusDetailAjax",
                crossDomain: true,    
                data: { SessionStampId: sessionStampId, RouteID: routeID },
                success: ShowBoardDropPopup,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $(".fl_close").show();
                    $("#actionButton").show();
                }
            });
        }


    }

    function SeatLayout() {
       
        //var Index = $("#hRowCount").val();
        ShowSeat();
        var hIsSDetailExist = $("#hIsSDetailExist").val();
        if (hIsSDetailExist != "true") {
            $("#popupBlock_Seat").html($("#waitDiv").html());
            var sessionStampId = $("#SessionStampId").val();
            var routeID = $("#hRouteID").val();
            $.ajax({
                type: "POST",
                url: "/Bus/SeatLayout/SeatLayoutAjax",             
                crossDomain: true,
                data: { SessionStampId: sessionStampId, RouteID: routeID },
                success: ShowBookNowPopup,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $(".fl_close").show();
                    $("#actionButton").show();
                    //error message
                }
            });
        }
    }

    function ShowBookNowPopup(resp) {
        $("#popupBlock_Seat").html(resp);
        $(".fl_close").show();
        $("#actionButton").show();
    }

    function ShowBoardDropPopup(resp) {
        $("#popupBlock_Board").html(resp.split("|%#")[0]);
        $("#selectedBoardingPoint").html(resp.split("|%#")[1]);
        if (resp.split("|%#")[2] != null) {
            $("#selectedDroppingPoint").html(resp.split("|%#")[2]);
            $("#popupBlock_DPoints").show();   

        }
        $(".fl_close").show();
        $("#actionButton").show();
    }
    //#endregion  

});

function ShowBoardingPoints() {
    var Index = $("#hRowCount").val();
    $('[id^="spnMenu_"]').removeClass("active");
    $("#spnMenu_Board").addClass("active");
    $('[id^="popupBlockOuter_"]').hide();
    $("#popupBlockOuter_Board").show();
    var dropObj = $("#Drop_" + Index);
    $("#popupBlock_Drop").html(dropObj.html());
}

function ShowSeat() {
    $('[id^="spnMenu_"]').removeClass("active");
    $("#spnMenu_Seat").addClass("active");
    $('[id^="popupBlockOuter_"]').hide();
    $("#popupBlockOuter_Seat").show();
}

//#region Bus seat selection

function AddRemoveSeat(curseats, seatno, totalprice, seatprice) {
    if ($("#errorMsgSeat").css('display') == 'inline') {
        $("#errorMsgSeat").hide();
    }
    var routeId = $("#route_id").val();
    
    if ($(routeId + "" + seatno)) {
        var classOfDiv = document.getElementById(routeId + "" + seatno).className;

        if (classOfDiv.indexOf("s") == 0) {
            remove_seat(curseats, seatno, totalprice, seatprice);
            document.getElementById(routeId + "" + seatno).className = classOfDiv.substring(1, classOfDiv.length);

        } else {
            if (add_seat(curseats, seatno, totalprice, seatprice)) {
                document.getElementById(routeId + "" + seatno).className = "s" + classOfDiv;

            }
        }
    }
}

function add_seat(curseats, seatno, totalprice, seatprice) {
    var curseats = $('#TBSelectedSeat').val();
    str = new String(curseats);
    var totalprice = $('#TBSelectedSeatPrice').val();
    $("#maxseat").hide();
    if (str.length > 0) {
        if (curseats.split(",").length >= $("#hseatcount").val()) {
            $("#maxseat").show();
            return false;
        }
        TBSelectedSeats.val(curseats + "," + seatno);

    } else {
        TBSelectedSeats.val(seatno);
    }
    TBSelectedSeatsPrice.val(parseFloat(totalprice) + parseFloat(seatprice));
    $("#selectedSeats").html(TBSelectedSeats.val());
    $("#totalAmount").html("Rs." + TBSelectedSeatsPrice.val());
    $("#selectedBoardingPoint").focus();
    return true;
}

function remove_seat(curseats, seatno, totalprice, seatprice) {
    var curseats = $('#TBSelectedSeat').val();
    str = new String(curseats);
    var totalprice = $('#TBSelectedSeatPrice').val();
    $("#maxseat").hide();
    i = str.indexOf($.trim(seatno));
    if (i >= 0) {
        inext = str.indexOf(",", i);
        if (inext == -1 && i == 0) {
            TBSelectedSeats.val("");

        } else if (i == 0) {
            TBSelectedSeats.val(str.substring(inext + 1));
        } else {
            if (inext == -1) {
                TBSelectedSeats.val(str.substring(0, i - 1));
            } else {
                TBSelectedSeats.val(str.substring(0, i - 1) + str.substring(inext));
            }
        }
    } else {
        TBSelectedSeats.val(curseats);
    }
    // $('#TBSelectedSeat').val(seatsd.join(','));
    TBSelectedSeatsPrice.val(parseFloat(totalprice) - parseFloat(seatprice));
    $("#selectedSeats").html(TBSelectedSeats.val());
    $("#totalAmount").html("Rs." + TBSelectedSeatsPrice.val());
    
}

// #endregion   