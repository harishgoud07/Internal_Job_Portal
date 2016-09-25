$(function(){  
	$('#details').on('show.bs.collapse', function () {
		$('.toggle-icon').css({'transform' : 'rotate(180deg)'});
	});
	$('.post-job-date-control').datetimepicker();
	$('#key_skills').chosen();
	$('#details').on('hide.bs.collapse', function () {
		$('.toggle-icon').css({'transform' : 'rotate(0deg)','transform-origin':'center center'});
	});
});