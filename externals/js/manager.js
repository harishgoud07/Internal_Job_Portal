$(function() {

	$(document).on('click','.approve-emp-job-post',function(){
		var applied_id = $(this).data('applied-id');
		var post_id = $(this).val();
		var project_id = $('#project_id').val();
		console.log('applied_id'+applied_id);
		var self=$(this);
		$.ajax({
			type: "POST",
			url: '/manager/updateappliedjobstatus',
			data:{'applied_job_id':applied_id,'status':'A'}, 
			success: function(data)
			{
				if(post_id =='' || project_id =='') {
					$('#applied-job-posts-container').html('').html(data);
				} else {
					$('#post_id').trigger('change');
				}
			}
		});
	});

    $(document).on('click','.decline-emp-job-post',function(){
		var applied_id = $(this).data('applied-id');
		var post_id = $(this).val();
		var project_id = $('#project_id').val();
		console.log('applied_id'+applied_id);
		var self=$(this);
		$.ajax({
			type: "POST",
			url: '/manager/updateappliedjobstatus',
			data:{'applied_job_id':applied_id,'status':'R'}, 
			success: function(data)
			{
				if(post_id =='' || project_id =='') {
					$('#applied-job-posts-container').html('').html(data);
				} else {
					$('#post_id').trigger('change');
				}
			}
		});
	});

    $(document).on('click','.view-emp-cv',function(){
		var eid = $(this).data('applied-id');
		console.log('eid'+eid);
		var self=$(this);
		window.location='/manager/downloadcv?eid='+eid;
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
				var data = jQuery.parseJSON(data);
					if(data != null){
						var options = '<option value ="">Select Job</option>';
						jQuery.each(data,function(index,value){
							options = options + '<option value = "'+value.post_id+'">'+value.job_title+'</option>';	  
						});
						$('#post_id').html('').html(options);
					} 
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
				$('#applied-job-posts-container').html('').html(data);
			}
		});
		}
		
	});


});
