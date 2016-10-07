$(function() {

	$(document).on('click','.apply_job_post',function(){
		if(confirm('Do you really want to apply for this JOB ?')){
			var post_id = $(this).data('post-id');
			var applied_post_id = $(this).data('post-id');
			console.log('applied_post_id '+post_id);
			$.ajax({
				type: "POST",
				url: '/posts/applyjobpost',
				data:{'applied_post_id':applied_post_id}, // serializes the form's elements.
				success: function(data)
				{//$('#add_posts').serialize()
					$('.jobs-list-container').html('').html(data);
				}
			});
		}
	});

	$(document).on('click','.withdraw_post',function(){
		if(confirm('Do you really want to withdraw for JOB ?')){
			var post_id = $(this).data('post-id');
			var applied_job_id= $(this).data('post-id');
			console.log('applied_post_id '+post_id);
			$.ajax({
				type: "POST",
				url: '/posts/withdrawjob',
				data:{'applied_job_id':applied_job_id}, // serializes the form's elements.
				success: function(data)
				{//$('#add_posts').serialize()
					$('.main-container').html('').html(data);
				}
			});
		}
	});
});
