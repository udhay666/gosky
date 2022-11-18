$(function() {
	function formatF(item) {
	    var cell = '';   
	    cell += "<span class='p-2'><i class='mdi mdi-airplane'></i></span><span class='p-2'>" + item.label + "</span><span class='ml-auto p-2'>[" + item.id + "]</span>"
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

	$("input[name='fromCity'],input[name='toCity']").catcomplete({
	    delay: 0,
	    // source: availableTags,
	    source: siteUrl+"home/airport_autolist",
	    // source: siteUrl+"home/airport_autolist?exclude="+$("input[name='destination']").val(),
	    minLength: 0,
	    autoFocus: true,
	    scroll: true,
	    select: function( event, ui ) {
			if(ui.item.id == ''){
				$(this).val('');
				return false;
			}
			console.log(event);
			console.log(ui);
			// if(event.currentTarget.id == 'fromCity' || event.target.id == 'fromCity'){
			// 	$('#toCity').focus();
			// }
			// if(event.currentTarget.id == 'toCity' || event.target.id == 'toCity'){
			// 	$('#dpf1').focus();
			// }
	    },
	    change: function(event, ui) {
			if(ui.item == null || ui.item.id == '') {
				$(this).val('');
			}
	    }
	});

	$("body").on("focus","input[name='fromCity'],input[name='toCity']",function(){
	    // $(this).select();
	    $(this).catcomplete("search","");
	});
});
