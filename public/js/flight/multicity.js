$(function(){function e(){var e=new Date,t=new Date(e.getFullYear(),e.getMonth(),e.getDate(),0,0,0,0),a=n=i=l=d=checkinDP6="",n=(a=$("#dp1").datepicker({format:"dd/mm/yyyy",onRender:function(e){return e.valueOf()<t.valueOf()?"disabled":""}}).on("changeDate",function(e){newDate=new Date(e.date),newDate.setDate(newDate.getDate()+1),""==$("#dp2").val()&&null==$("#dp2").val()&&n.setValue(newDate),""!=n&&null!=n&&e.date.valueOf()>=n.date.valueOf()&&n.setValue(newDate),""!=i&&null!=i&&e.date.valueOf()>=i.date.valueOf()&&(newDate.setDate(newDate.getDate()+1),i.setValue(newDate)),""!=l&&null!=l&&e.date.valueOf()>=l.date.valueOf()&&(newDate.setDate(newDate.getDate()+1),l.setValue(newDate)),""!=d&&null!=d&&e.date.valueOf()>=d.date.valueOf()&&(newDate.setDate(newDate.getDate()+1),d.setValue(newDate)),a.hide(),$(".datepicker").hide()}).data("datepicker"),$("#dp2").datepicker({format:"dd/mm/yyyy",onRender:function(e){return e.valueOf()<=a.date.valueOf()?"disabled":""}}).on("changeDate",function(e){newDate2=new Date(e.date),newDate2.setDate(newDate2.getDate()+1),""==$("#dp3").val()&&null==$("#dp3").val()&&i.setValue(newDate2),""!=i&&null!=i&&e.date.valueOf()>=i.date.valueOf()&&i.setValue(newDate2),""!=l&&null!=l&&e.date.valueOf()>=l.date.valueOf()&&(newDate2.setDate(newDate2.getDate()+1),l.setValue(newDate2)),""!=d&&null!=d&&e.date.valueOf()>=d.date.valueOf()&&(newDate2.setDate(newDate2.getDate()+1),d.setValue(newDate2)),n.hide(),$(".datepicker").hide()}).data("datepicker")),i=$("#dp3").datepicker({format:"dd/mm/yyyy",onRender:function(e){return e.valueOf()<=n.date.valueOf()?"disabled":""}}).on("show",function(e){""==$(this).val()&&(newDates3=n.date,newDates3.setDate(newDates3.getDate()+1),i.setValue(newDates3))}).on("changeDate",function(e){newDate3=new Date(e.date),newDate3.setDate(newDate3.getDate()+1),""==$("#dp4").val()&&null==$("#dp4").val()&&l.setValue(newDate3),""!=l&&null!=l&&e.date.valueOf()>=l.date.valueOf()&&l.setValue(newDate3),""!=d&&null!=d&&e.date.valueOf()>=d.date.valueOf()&&(newDate3.setDate(newDate3.getDate()+1),d.setValue(newDate3)),i.hide(),$(".datepicker").hide()}).data("datepicker"),l=$("#dp4").datepicker({format:"dd/mm/yyyy",onRender:function(e){return e.valueOf()<=i.date.valueOf()?"disabled":""}}).on("show",function(e){""==$(this).val()&&(newDates4=i.date,newDates4.setDate(newDates4.getDate()+1),l.setValue(newDates4))}).on("changeDate",function(e){newDate4=new Date(e.date),newDate4.setDate(newDate4.getDate()+1),""==$("#dp5").val()&&null==$("#dp5").val()&&d.setValue(newDate4),""!=d&&null!=d&&e.date.valueOf()>=d.date.valueOf()&&d.setValue(newDate4),l.hide(),$(".datepicker").hide()}).data("datepicker"),d=$("#dp5").datepicker({format:"dd/mm/yyyy",onRender:function(e){return e.valueOf()<=l.date.valueOf()?"disabled":""}}).on("show",function(e){""==$(this).val()&&(newDates5=l.date,newDates5.setDate(newDates5.getDate()+1),d.setValue(newDates5))}).on("changeDate",function(e){d.hide(),$(".datepicker").hide()}).data("datepicker")}function t(){$.widget("custom.catcomplete",$.ui.autocomplete,{_create:function(){this._super(),this.widget().menu("option","items","> :not(.ui-autocomplete-category)")},_renderMenu:function(e,t){var a=this,n="";$.each(t,function(t,i){var l;i.category!=n&&(e.append("<li class='ui-autocomplete-category'>"+i.category+"</li>"),n=i.category),l=a._renderItemData(e,i),i.category&&l.attr("aria-label",i.category+" : "+i.label)})},_renderItemData:function(e,t){return this._renderItem(e,t).data("ui-autocomplete-item",t)},_renderItem:function(e,t){return $("<li class='d-flex autolist'></li>").data("item.autocomplete",t).append(function(e){var t="";return t+="<span class='p-2'><i class='mdi mdi-airplane'></i></span><span class='p-2'>"+e.label+"</span><span class='ml-auto p-2'>["+e.id+"]</span>"}(t)).appendTo(e)}}),$("input[name='fromCity[]'],input[name='toCity[]']").catcomplete({delay:0,source:siteUrl+"/home/airport_autolist",minLength:0,autoFocus:!0,scroll:!0,select:function(e,t){if(""==t.item.id)return $(this).val(""),!1;"toCity1"==e.target.id?$("#fromCity2").val(t.item.label):"toCity2"==e.target.id?$("#fromCity3").val(t.item.label):"toCity3"==e.target.id?$("#fromCity4").val(t.item.label):"toCity4"==e.target.id&&$("#fromCity5").val(t.item.label)},change:function(e,t){null!=t.item&&""!=t.item.id||$(this).val("")}}),$("body").on("focus","input[name='fromCity[]'],input[name='toCity[]']",function(){$(this).catcomplete("search","")})}t(),e(),$(".btn-number-multicity").on("click",function(a){a.preventDefault(),fieldName=$(this).attr("data-field"),type=$(this).attr("data-type");var n=$(this).parent().parent().find("input[name='"+fieldName+"']"),i=parseInt(n.val());isNaN(i)?n.val(0):"minus"==type?(i>n.attr("min")&&(!function(e,t){e.parents(".clone-section").find(".clonediv-m").each(function(){$(this).find("#clone-"+t).remove()})}($(this),i),n.val(parseInt(i)-1).change()),parseInt(n.val())==n.attr("min")&&$(this).attr("disabled",!0)):"plus"==type&&(i<n.attr("max")&&(!function(e,a){var n=parseInt(a)+1;e.parents(".clone-section").find(".clone-item > div").clone().clone().find("div").each(function(){$(this).parent().parent().attr("id","clone-"+a),$(this).parent().find("input.toCity").val(""),$(this).parent().find('input[name="departDate[]"]').val(""),$(this).parent().find("input").removeAttr("id"),$(this).parent().find("label").removeAttr("for"),$(this).parent().find("input.fromCity").attr("id","fromCity"+n),$(this).parent().find("input.fromCity").parent().find("label").attr("for","fromCity"+n),$(this).parent().find("input.toCity").attr("id","toCity"+n),$(this).parent().find("input.toCity").parent().find("label").attr("for","toCity"+n),$(this).parent().find("input[name='departDate[]']").attr("id","dp"+n),$(this).parent().find("input[name='departDate[]']").parent().find("label").attr("for","dp"+n)}).end().appendTo(".clonediv-m");t()}($(this),parseInt(i)+1),n.val(parseInt(i)+1).change(),e(),$("#fromCity3").val($("#toCity2").val()),$("#fromCity4").val($("#toCity3").val()),$("#fromCity5").val($("#toCity4").val())),parseInt(n.val())==n.attr("max")&&$(this).attr("disabled",!0))}),$("body").on("change",".input-number-multicity",function(e){minValue=parseInt($(this).attr("min")),maxValue=parseInt($(this).attr("max")),valueCurrent=parseInt($(this).val()),valueCurrent>=minValue&&$(this).parent().parent().find("[data-type='minus']").removeAttr("disabled"),valueCurrent<=maxValue&&$(this).parent().parent().find("[data-type='plus']").removeAttr("disabled")})});