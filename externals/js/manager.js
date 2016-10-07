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
		var eid = $(this).data('applied-id');
		console.log('eid'+eid);
		var self=$(this);
		$.ajax({
			type: "POST",
			url: '/manager/downloadcv',
			data:{'eid':eid}, 
			success: function(data)
			{
				
			}
		});
	});

 $(document).on('change','#project_id',function(){
	var project_id = $(this).val();
		console.log('project_id'+project_id);
		var self=$(this);
		$.ajax({
			type: "POST",
			url: '/manager/getpostsofproject',
			data:{'project_id':project_id}, 
			success: function(data)
			{
				alert(data);
			}
		});
		});

	$(document).on('change','#post_id',function(){
		var post_id = $(this).val();
		var project_id = $('#project_id').val();
		console.log('project_id'+project_id);
		var self=$(this);
		if(project_id !='' && post_id !='' ){
			$.ajax({
			type: "POST",
			url: '/manager/getappliedpostsdata',
			data:{'project_id':project_id,'post_id':post_id}, 
			success: function(data)
			{
				alert(data);
			}
		});
		}
		
	});


});
