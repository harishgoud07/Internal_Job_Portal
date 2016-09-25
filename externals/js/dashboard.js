$(document).ready(function(){  
	$('#details').on('show.bs.collapse', function () {
		$('.toggle-icon').css({'transform' : 'rotate(180deg)'});
	});
	$('expiry_date_datepicker').datetimepicker();
	$('.chosen-select').chosen();
	$('#details').on('hide.bs.collapse', function () {
		$('.toggle-icon').css({'transform' : 'rotate(0deg)','transform-origin':'center center'});
	});
});