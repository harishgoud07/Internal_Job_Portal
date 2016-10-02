$(function(){  
	$('#details').on('show.bs.collapse', function () {
		$('.toggle-icon').css({'transform' : 'rotate(180deg)'});
	});
	$('.post-job-date-control').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
	});
	$('#key_skills').chosen();
	$('#details').on('hide.bs.collapse', function () {
		$('.toggle-icon').css({'transform' : 'rotate(0deg)','transform-origin':'center center'});
	});
});