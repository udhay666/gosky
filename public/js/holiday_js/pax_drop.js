$(".guest-plus").click(function() {
    // updateValue(this, 1);
    var input = $(this).parent().parent().find("input");
    var input2 = $(this).parent().parent().find("input").val();
    var max = $(this).parent().parent().find("input").attr('max');
    var newValue = parseInt(input.val(), 10) + 1;
    input.val(Math.min(newValue, max));
    updateTotal(this, 1, max, input2);
});
$(".guest-minus").click(function() {
    // updateValue(this, -1);
    var input = $(this).parent().parent().find("input");
    var input2 = $(this).parent().parent().find("input").val();
    var min = $(this).parent().parent().find("input").attr('min');
    var newValue = parseInt(input.val(), 10) - 1;
    input.val(Math.max(newValue, min));
    updateTotal(this, -1, min, input2);
});

function updateTotal(obj, newValue, minmax, objinput) {
	var tot_pax = $(obj).parents().find("#noOfPassengers").val();
    // var input = $(obj).parent().parent().find("input").val();
    // alert(b);
    // alert(input);
    var tot = parseInt(tot_pax, 10) + parseInt(newValue, 10);
    if(objinput == minmax){
        return false;
    } else {
        $('#noOfPassengers').val(tot);
    }
}

$(".quont-plus").click(function() {
    var input = $(this).parent().parent().find("input");
    var max = $(this).parent().parent().find("input").attr('max');
    var newValue = parseInt(input.val(), 10) + 1;
    input.val(Math.min(newValue, max));
});
$(".quont-minus").click(function() {
    var input = $(this).parent().parent().find("input");
    var min = $(this).parent().parent().find("input").attr('min');
    var newValue = parseInt(input.val(), 10) - 1;
    input.val(Math.max(newValue, min));
});

$(".room-plus").click(function() {
    var input = $(this).parent().parent().find("#input_rooms");
    var input2 = $(this).parent().parent().find("#input_rooms").val();
    var input3 = parseInt(input2, 10) + 1;
    var max = $(this).parent().parent().find("input").attr('max');
    var newValue = parseInt(input.val(), 10) + 1;
    input.val(Math.min(newValue, max));
    updateRoom(this, 1, max, input2, 'show', input3, 0, 1);
});
$(".room-minus").click(function() {
    var input = $(this).parent().parent().find("#input_rooms");
    var input2 = $(this).parent().parent().find("#input_rooms").val();
    var min = $(this).parent().parent().find("input").attr('min');
    var newValue = parseInt(input.val(), 10) - 1;
    var count = input.val();
    var adults = $('#adults-q'+count).val();
    var childs = $('#childs-q'+count).val();
    input.val(Math.max(newValue, min));
    // alert(input2);
    var total_pax = parseInt(adults, 10)+parseInt(childs, 10);
    $('#adults-q'+count).val(1);
    $('#childs-q'+count).val(0);
    $('.room'+count).find('.childages').hide();
    $('.room'+count).find('.childages').find('input').val(0);
    updateRoom(this, 0, min, input2, 'hide', input2, total_pax, -1);
});

function updateRoom(obj, e, minmax, objinput, sh, objinput2, total_pax, roomup) {
    // alert(objinput2);
    var tot_pax = $(obj).parents().find("#noOfPassengers").val();
    var newValue = parseInt(objinput, 10) + parseInt(roomup, 10);
    var tot = parseInt(tot_pax, 10) + parseInt(e, 10) - parseInt(total_pax, 10);
    if(objinput == minmax){
        return false;
    } else {
        $('#total_rooms').text(newValue);
        $('#noOfPassengers').val(tot);
        $('#room'+objinput2)[sh]();
    }
}

$(".guest-plus.childs").click(function() {
    var input2 = $(this).parent().parent().find("input").val();
    updateAge(this, 'show', input2);
});
$(".guest-minus.childs").click(function() {
    var input = $(this).parent().parent().find("input").val();
    var input2 = parseInt(input, 10) + 1;
    updateAge(this, 'hide', input2);
});

function updateAge(obj, sh, objinput2) {
    $(obj).parent().parent().parent().parent().parent().parent().find('#childAge'+objinput2)[sh]();
}
// function updateValue(obj, delta) {
//     var input = $(obj).parent().parent().find("input");
//     var min = $(obj).parent().parent().find("input").attr('min');
//     var max = $(obj).parent().parent().find("input").attr('max');
//     var newValue = parseInt(input.val(), 10) + delta;
//     input.val(Math.max(newValue, min));
//     // $('#noOfPassengers').val(tot);
// }
$('.done2').on('click', function(){
    $(this).parent().parent().parent().parent().parent('.dropdown-search').css('display', 'none');
});