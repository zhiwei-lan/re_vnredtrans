$(function(){
	if($('#notice-board').length>0&&$('#notice-board thead tr td').length>1){
		var theadTotal = $('#notice-board thead tr td').length;
		for(var i=1;i<=theadTotal;i++){
			var thisClassName = $('#notice-board thead tr td').eq(i-1).attr('class');
			$('#notice-board tbody tr td:nth-child('+i+')').addClass(thisClassName);
		}
	}
});