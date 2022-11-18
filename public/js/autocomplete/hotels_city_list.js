$(function() {
	function formatF(item) {
	    var cell = '';   
	    cell += "<span class='p-2'><i class='mdi mdi-hotel'></i></span><span class='p-2'>" + item.label + "</span>"
	    return cell;
	}

	$.widget("custom.catcomplete", $.ui.autocomplete, {
	    _create: function() {
	        this._super();
	        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
	    },
	    _renderMenu: function( ul, items ) {
	        var that = this,
	        currentCategory = "";
	        $.each( items, function( index, item ) {
	            var li;
	            if ( item.category != currentCategory ) {
	                ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
	                currentCategory = item.category;
	            }
	            li = that._renderItemData( ul, item );
	            if ( item.category ) {
	                li.attr( "aria-label", item.category + " : " + item.label );
	            }
	        });
	    },
	    _renderItemData: function(ul,items){
	        return this._renderItem(ul,items).data("ui-autocomplete-item",items)
	    },
	    _renderItem: function( ul, item ) {
	        return $("<li class='d-flex autolist'></li>")
	        .data("item.autocomplete", item)
	        .append(formatF(item))
	        .appendTo(ul);
	    },
	});

	$("#destination2").catcomplete({
	    delay: 0,
	    // source: availableTags,
	    source: siteUrl+"home/hotels_city_list",   
	    minLength: 0,
	    autoFocus: true,
	    scroll: true,
	    select: function( event, ui ) {
	      if(ui.item.id == ''){
	        $(this).val('');
	        $('#hotelcityid').val('');
	        return false;
	      }else{
	      	$('#hotelcityid').val(ui.item.id);
	      }
	    },
	    change: function(event, ui) {
	      if(ui.item == null || ui.item.id == '') {
	        $(this).val('');
	        $('#hotelcityid').val('');
	      }else{
	      	$('#hotelcityid').val(ui.item.id);
	      }
	    }
	});

	$("body").on("focus","#destination2",function(){
	    // $(this).select();
	    $(this).catcomplete("search","");
	});

	$("#hotelName").autocomplete({
    source: siteUrl+"hotels/auto_hotel_name",
    minLength: 2,
    autoFocus: true,
    autoFill: true,
    select: function( event, ui ) {
        if(ui.item.id == ''){
          $(this).val('');
          filter();
          $('#clearIcon').hide();
          return false;
        } else{
          // alert("selected");
          $(this).val(ui.item.value);
          filter();
          $('#clearIcon').show();
        }
      },
      change: function(event, ui) {
        // filter();
        if(ui.item == null || ui.item.id == '') {
          $(this).val('');
        }
      }
  }).each(function() {
    $(this).data("ui-autocomplete")._renderItem = function (ul, item) {
      return $("<li class='d-flex autolist'></li>")
      .data("item.autocomplete", item)
      .append("<span class='p-2'><i class='mdi mdi-hotel'></i></span><span class='p-2'>" + item.label + "</span>")
      .appendTo(ul);
    };
  });


  $('#clearIcon').on('click', function(){
    $('#hotelName').val('');
    filter();
    $('#clearIcon').hide();
  });
});
