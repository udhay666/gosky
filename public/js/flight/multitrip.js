$(document).ready(function(){$("#addMore").click(function(){if($counter=$("#citygroup").val(),$counter>=5)return $("#addMore").hide(),!1;var e=$(document.createElement("div")).attr("class","form-row");e.html('<div class="col-md-6 col-lg-3 form-group" style="margin-left:4px"><input type="text" value="" name="fromCity[]"  class="form-control text-truncate" placeholder="Origin" autocomplete="off" onclick="this.select();"><span class="icon-inside" style="margin-top:-10px"><i class="fas fa-map-marker-alt"></i></span></div><div class="col-md-6 col-lg-3 form-group" style="margin-left:4px"><input type="text" value="" name="toCity[]"  class="form-control pl-4 text-truncate" placeholder="Destination" autocomplete="off" onclick="this.select();"><span class="icon-inside" style="margin-top:-10px"><i class="fas fa-map-marker-alt"></i></span></div><div class="col-md-6 col-lg-3 form-group" style="margin-left:4px"><input type="text" class="form-control dp calendar" placeholder="Departure Date" name="departDate[]" autocomplete= "off" data-date-format="dd/mm/yyyy" required /><a href="javascript:void(0);" id="removeCity" class="removeCity"><b>Remove</b></a></div>'),e.appendTo("#dynamic_field"),$counter++,$("#citygroup").val($counter),$("input[name='fromCity'],input[name='toCity'],input[name='fromCity[]'],input[name='toCity[]']").autocomplete({source:siteUrl+"/home/airport_autolist",minLength:2,autoFocus:!0});var t=$(".dp").daterangepicker({minDate:0,maxDate:"+12M",numberOfMonths:2,dateFormat:"dd-mm-yy",singleDatePicker:!0,onRender:function(e){return e.valueOf()<now.valueOf()?"disabled":""}}).on("changeDate",function(e){t.hide()}).data("daterangepicker")}),$("#").change(function(){var e,t,a=$(this).val(),o=$("#Childs_M").val(),n=$("#Infants_M").val();for($("#Childs_M").children().remove(),$("#Infants_M").children().remove(),e=0;e<=a;e++)t=$("<option/>",{value:e,text:e}),n==e&&t.attr("selected","selected"),$("#Infants_M").append(t);for(e=0;e<10-a;e++)t=$("<option/>",{value:e,text:e}),o==e&&t.attr("selected","selected"),$("#Childs_M").append(t)})}),$(document).on("click",".removeCity",function(){$counter=$("#citygroup").val(),$(this).parent().parent().remove(),$counter<=6&&($counter-=1,$("#addMore").show()),$("#citygroup").val($counter)});