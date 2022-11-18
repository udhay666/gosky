$(function() {

searchautolist(); //call autolist
function formatM(item) {
	var cell = '',
	cellicon = 'public/images/icons/aeroplane-search-home.svg';
	cell += "<span><i class='mdi mdi-airplane'></i></span><span>" + item.label + "</span><span class='ml-auto'>[" + item.id + "]</span>"
	return cell;
}

function searchautolist(){
	$("input[name='fromCity'],input[name='toCity']").autocomplete({
		source: siteUrl+"home/airport_autolist?exclude="+$("input[name='destination']").val(),
		minLength: 2,
		autoFocus: true,
		select: function( event, ui ) {
			if( ui.item.id == '' ) return false;
			// $("input[name='origin']").val(ui.item.id);
			// $( ".toCity" ).autocomplete( "option", "source", siteUrl+"home/airport_autolist?exclude="+$("input[name='origin']").val() );
		},
		change: function(event, ui) {
			if( ui.item == null || ui.item.id == '' ) $(this).val('');
		}
	}).each(function() {
		$(this).data("ui-autocomplete")._renderItem = function (ul, item) {
			return $("<li class='d-flex autolist'></li>")
			.data("item.autocomplete", item)
			.append(formatM(item))
			.appendTo(ul);
		};
	});
}

});