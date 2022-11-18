$(document).ready(function () {
  "use strict";
  //Adults Dropdown
    $('.quont-minus').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val()) - 1;
            var count2 = parseInt($input.val());
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            // alert(count);
            count = count < 1 ? min : count;
            var total_rooms = $('#rooms-q').val();
            // alert(total_rooms);
            var adults,adults2,adults3,adults4,childs,childs2,childs3,childs4,infants,infants2,infants3,infants4,tot,tot1,tot2,tot3,tot4;
            if(total_rooms == 1) {
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                infants = $('#infants-q').val();
                tot1 = parseInt(adults)+parseInt(childs)+parseInt(infants);
                if(count == min) {
                    if(min == 1){                  
                        if(parseInt(adults) > min){
                            var tot = parseInt(tot1) - parseInt(count);
                            // alert('A1');
                        } else {
                            var tot = tot1;
                            // alert('A2');
                        }
                    } else {
                        if(parseInt(childs) || parseInt(infants) > min){
                            var tot = parseInt(tot1) - parseInt(count2);
                            // alert('B1');
                        } else {
                            var tot = parseInt(tot1) - parseInt(count);
                            // alert('B2');
                        }  
                    }
                    
                } else {
                    var tot = parseInt(tot1) - 1;
                    // alert('C');
                }
            } else if(total_rooms == 2){
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                infants = $('#infants-q').val();
                adults2 = $('#adults-q2').val();
                childs2 = $('#childs-q2').val();
                infants2 = $('#infants-q2').val();
                tot2 = parseInt(adults)+parseInt(childs)+parseInt(adults2)+parseInt(childs2)+parseInt(infants)+parseInt(infants2);
                if(count == min) {
                    if(min == 1){                  
                        if(parseInt(adults2) > min){
                            var tot = parseInt(tot2) - parseInt(count);
                        } else {
                            var tot = tot2;
                        }
                    } else {
                        if(parseInt(childs2) || parseInt(infants2) > min){
                            var tot = parseInt(tot2) - parseInt(count2);
                        } else {
                            var tot = parseInt(tot2) - parseInt(count);
                        }  
                    }
                    
                } else {
                    var tot = parseInt(tot2) - 1;
                }
            } else if(total_rooms == 3){
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                infants = $('#infants-q').val();
                adults2 = $('#adults-q2').val();
                childs2 = $('#childs-q2').val();
                infants2 = $('#infants-q2').val();
                adults3 = $('#adults-q3').val();
                childs3 = $('#childs-q3').val();
                infants3 = $('#infants-q3').val();
                tot3 = parseInt(adults)+parseInt(childs)+parseInt(adults2)+parseInt(childs2)+parseInt(adults3)+parseInt(childs3)+parseInt(infants)+parseInt(infants2)+parseInt(infants3);
                if(count == min) {
                    if(min == 1){                  
                        if(parseInt(adults3) > min){
                            var tot = parseInt(tot3) - parseInt(count);
                        } else {
                            var tot = tot3;
                        }
                    } else {
                        if(parseInt(childs3) || parseInt(infants3) > min){
                            var tot = parseInt(tot3) - parseInt(count2);
                        } else {
                            var tot = parseInt(tot3) - parseInt(count);
                        }  
                    }
                    
                } else {
                    var tot = parseInt(tot3) - 1;
                }
            } else if(total_rooms == 4){
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                infants = $('#infants-q').val();
                adults2 = $('#adults-q2').val();
                childs2 = $('#childs-q2').val();
                infants2 = $('#infants-q2').val();
                adults3 = $('#adults-q3').val();
                childs3 = $('#childs-q3').val();
                infants3 = $('#infants-q3').val();
                adults4 = $('#adults-q4').val();
                childs4 = $('#childs-q4').val();
                infants4 = $('#infants-q4').val();
                tot4 = parseInt(adults)+parseInt(childs)+parseInt(adults2)+parseInt(childs2)+parseInt(adults3)+parseInt(childs3)+parseInt(adults4)+parseInt(childs4)+parseInt(infants)+parseInt(infants2)+parseInt(infants3)+parseInt(infants4);
                if(count == min) {
                    if(min == 1){                  
                        if(parseInt(adults4) > min){
                            var tot = parseInt(tot4) - parseInt(count);
                        } else {
                            var tot = tot4;
                        }
                    } else {
                        if(parseInt(childs4) || parseInt(infants4) > min){
                            var tot = parseInt(tot4) - parseInt(count2);
                        } else {
                            var tot = parseInt(tot4) - parseInt(count);
                        }  
                    }
                    
                } else {
                    var tot = parseInt(tot4) - 1;
                }
            }
            
            // alert(min);
            // alert(count);
            // if(count > max) {
            //     alert('No more guests of this type allowed');
            //     return false;    
            // }
            
            // alert(tot);
            $input.val(count);
            $('#noOfPassengers').val(tot);
            $input.change();
            return false;
        });
    });
    $('.quont-plus').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val()) + 1;
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');

            var adults,adults2,adults3,adults4,childs,childs2,childs3,childs4,infants,infants2,infants3,infants4,tot,total_rooms;

            total_rooms = $('#rooms-q').val();
            
            if(total_rooms == 1) {
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                infants = $('#infants-q').val();
                tot = parseInt(adults)+parseInt(childs)+parseInt(infants)+1;
            } else if(total_rooms == 2){
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                adults2 = $('#adults-q2').val();
                childs2 = $('#childs-q2').val();
                infants = $('#infants-q').val();
                infants2 = $('#infants-q2').val();
                tot = parseInt(adults)+parseInt(childs)+parseInt(adults2)+parseInt(childs2)+parseInt(infants)+parseInt(infants2)+1;
            } else if(total_rooms == 3){
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                adults2 = $('#adults-q2').val();
                childs2 = $('#childs-q2').val();
                adults3 = $('#adults-q3').val();
                childs3 = $('#childs-q3').val();
                infants = $('#infants-q').val();
                infants2 = $('#infants-q2').val();
                infants3 = $('#infants-q3').val();
                tot = parseInt(adults)+parseInt(childs)+parseInt(adults2)+parseInt(childs2)+parseInt(adults3)+parseInt(childs3)+parseInt(infants)+parseInt(infants2)+parseInt(infants3)+1;
            } else if(total_rooms == 4){
                adults = $('#adults-q').val();
                childs = $('#childs-q').val();
                adults2 = $('#adults-q2').val();
                childs2 = $('#childs-q2').val();
                adults3 = $('#adults-q3').val();
                childs3 = $('#childs-q3').val();
                adults4 = $('#adults-q4').val();
                childs4 = $('#childs-q4').val();
                infants = $('#infants-q').val();
                infants2 = $('#infants-q2').val();
                infants3 = $('#infants-q3').val();
                infants4 = $('#infants-q4').val();
                tot = parseInt(adults)+parseInt(childs)+parseInt(adults2)+parseInt(childs2)+parseInt(adults3)+parseInt(childs3)+parseInt(adults4)+parseInt(childs4)+parseInt(infants)+parseInt(infants2)+parseInt(infants3)+parseInt(infants4)+1;
            }
            // var tot = parseInt(adults)+parseInt(childs) + 1;
            // alert(tot);
            if(count > max) {
                alert('No more guests of this type allowed');
                return false;    
            }
            $input.val(parseInt($input.val()) + 1);
            // $('#total_pax').val(tot);
            $('#noOfPassengers').val(tot);
            $input.change();
            return false;
        });
    });

    $('.quont-minus2').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val()) - 1;
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            // alert(max);
            var adults,childs,infants,tot,tot_pax,total_pax;      
            count = count < min ? 1 : count;
            var count2 = parseInt(count)+1;
            $('#room'+count2).hide();
            var $input2 = $('#room'+count2).find('input')
            
            adults = $('#adults-q'+count2).val();
            childs = $('#childs-q'+count2).val();
            infants = $('#infants-q'+count2).val();
            tot = parseInt(adults)+parseInt(childs)+parseInt(infants);
            tot_pax = $('#noOfPassengers').val();
            total_pax = parseInt(tot_pax) - parseInt(tot);
            // alert(adults);
            $('#noOfPassengers').val(total_pax);
            $input2.val(0);
            // $('#room'+count2+' #childAge1').hide();
            // $('#room'+count2+' #childAge2').hide();
            // $('#room'+count2+' #childAge3').hide();
            $('#total_rooms').html(count);
            $input.val(count);
            $input.change();
            return false;
        });
    });
    $('.quont-plus2').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val())+1;
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            count = count > 4 ? max : count;
            // alert(count);
            $('#room'+count).show();
            $('#total_rooms').html(count);
            $input.val(count);
            $input.change();
            return false;
        });
    });

    $('.quont-minus.childs').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val())+1;
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            count = count < min ? 1 : count;
            // alert(count);
            $(this).parent().parent().parent().parent().parent().parent().find('#childAge'+count).hide();
            return false;
        });
    });
    $('.quont-plus.childs').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val());
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            count = count > 3 ? max : count;
            // alert(count);
            $(this).parent().parent().parent().parent().parent().parent().find('#childAge'+count).show();
            return false;
        });
    });

    $('.quont-minus3').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val()) - 1;
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            // alert(max);           
            count = count < min ? 0 : count;

            $input.val(count);
            $input.change();
            return false;
        });
    });
    $('.quont-plus3').each(function () {
        $(this).click(function () {
            var $input = $(this).parent().parent().find('input');
            var count = parseInt($input.val())+1;
            var min = $(this).parent().parent().find('input').attr('min');
            var max = $(this).parent().parent().find('input').attr('max');
            count = count > 11 ? max : count;
            // alert(count);
            // $('#room'+count).show();
            // $('#total_rooms').html(count);
            $input.val(count);
            $input.change();
            return false;
        });
    });

    $('.done2').on('click', function(){
        var adults,adults2,adults3,adults4,childs,childs2,childs3,childs4,infants,infants2,infants3,infants4,tot;
        var total_rooms = $('#rooms-q').val();
        if(total_rooms == 1) {
            adults = $('#adults-q').val();
            childs = $('#childs-q').val();
            childs = $('#childs-q').val();
            infants = $('#infants-q').val();
            tot = parseInt(adults)+parseInt(childs)+parseInt(infants);
        }else if(total_rooms == 2) {
            adults = $('#adults-q').val();
            childs = $('#childs-q').val();
            childs = $('#childs-q').val();
            infants = $('#infants-q').val();
            adults2 = $('#adults-q2').val();
            childs2 = $('#childs-q2').val();
            childs2 = $('#childs-q2').val();
            infants2 = $('#infants-q2').val();
            tot = parseInt(adults)+parseInt(childs)+parseInt(infants)+parseInt(adults2)+parseInt(childs2)+parseInt(infants2);
        }else if(total_rooms == 3) {
            adults = $('#adults-q').val();
            childs = $('#childs-q').val();
            childs = $('#childs-q').val();
            infants = $('#infants-q').val();
            adults2 = $('#adults-q2').val();
            childs2 = $('#childs-q2').val();
            childs2 = $('#childs-q2').val();
            infants2 = $('#infants-q2').val();
            adults3 = $('#adults-q3').val();
            childs3 = $('#childs-q3').val();
            childs3 = $('#childs-q3').val();
            infants3 = $('#infants-q3').val();
            tot = parseInt(adults)+parseInt(childs)+parseInt(infants)+parseInt(adults2)+parseInt(childs2)+parseInt(infants2)+parseInt(adults3)+parseInt(childs3)+parseInt(infants3);
        }else if(total_rooms == 4) {
            adults = $('#adults-q').val();
            childs = $('#childs-q').val();
            childs = $('#childs-q').val();
            infants = $('#infants-q').val();
            adults2 = $('#adults-q2').val();
            childs2 = $('#childs-q2').val();
            childs2 = $('#childs-q2').val();
            infants2 = $('#infants-q2').val();
            adults3 = $('#adults-q3').val();
            childs3 = $('#childs-q3').val();
            childs3 = $('#childs-q3').val();
            infants3 = $('#infants-q3').val();
            adults4 = $('#adults-q4').val();
            childs4 = $('#childs-q4').val();
            childs4 = $('#childs-q4').val();
            infants4 = $('#infants-q4').val();
            tot = parseInt(adults)+parseInt(childs)+parseInt(infants)+parseInt(adults2)+parseInt(childs2)+parseInt(infants2)+parseInt(adults3)+parseInt(childs3)+parseInt(infants3)+parseInt(adults4)+parseInt(childs4)+parseInt(infants4);
        }
        // alert(tot);
        $('#noOfPassengers').val(tot);
    });

    $('#noOfPassengers, .done2, .passenger-text, .rooms-text').on('click', function() {
        $('.adults-dropdown.dropdown-menu.select-passenger').toggleClass('hide');
    });

    $('.passengers, .passenger-text, .rooms-text').on('click', function (e) {
        $(this).parent().find('.adults-dropdown').stop(true, true).slideDown();
        return false;
    });
    $('.done2').on('click', function () {
        $('.adults-dropdown').stop(true, true).slideUp();
        return false;
    });

});