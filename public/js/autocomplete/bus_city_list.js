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
	//World Wide Airport List 
	$("input[name='Origin'],input[name='Destination']").autocomplete({
		source: siteUrl+"index.php/home/bus_autolist",
		minLength: 2,
		autoFocus: true
	});	
				

});