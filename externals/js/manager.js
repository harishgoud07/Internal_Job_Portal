$(function() {

	$(document).on('click','.approve-emp-job-post',function(){
		var applied_id = $(this).data('applied-id');
		console.log('applied_id'+applied_id);
		var self=$(this);
		$.ajax({
			type: "POST",
			url: '/manager/updateappliedjobstatus',
			data:{'applied_job_id':applied_id,'status':'A'}, 
			success: function(data)
			{
				$('#applied-job-posts-container').html('').html(data);
			}
		});
	});

    $(document).on('click','.decline-emp-job-post',function(){
		var applied_id = $(this).data('applied-id');
		console.log('applied_id'+applied_id);
		var self=$(this);
		$.ajax({
			type: "POST",
			url: '/manager/updateappliedjobstatus',
			data:{'applied_job_id':applied_id,'status':'R'}, 
			success: function(data)
			{
				$('#applied-job-posts-container').html('').html(data);
			}
		});
	});

    $(document).on('click','.view-emp-cv',function(){
		
	});


});
