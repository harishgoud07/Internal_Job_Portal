$(function() {

	$(document).on('click','#save_post',function(){
		var url = "/posts/add"; // the script where you handle the form input.

		var project_id = $('#project_name').val();
		var job_title = $('#job_title').val();
		var no_of_vacancies = $('#no_of_vacancies').val();
		var salary = $('#salary').val();
		var job_description = $('#job_description').val();
		var key_skills = $('#key_skills').val();
		var expiry_date_datepicker = $('#expiry_date_datepicker').val();
		console.log('project_id'+project_id);
		console.log('job_title'+job_title);
		console.log('no_of_vacancies'+no_of_vacancies);
		console.log('salary'+salary);
		console.log('job_description'+job_description);
		console.log('key_skills'+key_skills);
		console.log('expiry_date_datepicker'+expiry_date_datepicker);
		$.ajax({
			type: "POST",
			url: url,
			data:{'project_id':project_id,'job_title':job_title,'no_of_vacancies':no_of_vacancies,'salary':salary,'job_description':job_description,'key_skills':key_skills,'expiry_date_datepicker':expiry_date_datepicker}, // serializes the form's elements.
			success: function(data)
			{//$('#add_posts').serialize()
				$('#add-new-job').modal('hide');
				$('.jobs-list-container').html('').html(data);

			}
		});

	});

	$(document).on('click','.approve-post',function(){
		var post_id = $(this).data('post-id');
		console.log('post_id'+post_id);
		var self=$(this);
		$.ajax({
			type: "POST",
			url: '/posts/approvepost',
			data:{'post_id':post_id}, // serializes the form's elements.
			success: function(data)
			{//$('#add_posts').serialize()
				var data = jQuery.parseJSON(data);
				if(data['status'] == 'success') {
					self.html('Job Approved');
					if (self.hasClass('btn-info')) {
						self.removeClass('btn-info');
						self.addClass('btn-success');
					}
				}
			}
		});

	});


	$(document).on('click','.update_posts',function(){
		var post_id = $(this).data('post-id');
		console.log('post_id'+post_id);
		$.ajax({
			type: "POST",
			url: '/posts/getpostdata',
			data:{'post_id':post_id}, // serializes the form's elements.
			success: function(data)
			{//$('#add_posts').serialize()
				var data = jQuery.parseJSON(data);
				console.log(data['job_skill_set']);
				$('#project_name').val(data['project_id']);
				$('#job_title').val(data['job_title']);
				$('#no_of_vacancies').val(data['no_of_vacancies']);
				$('#salary').val(data['salary']);
				$('#job_description').val(data['job_description']);
				$('.chosen-container-multi').val(data['job_skill_set']);
				$('#key_skills:contains(Base)').prop('selected','selected');

				$('#expiry_date_datepicker').val(data['date_of_creation']);
				$('.chosen-container-multi').trigger('chosen:updated');
				$('#save_post').data('post-id',data['post_id']);
				$('#save_post').prop('id','update_post');
				$('#add-new-job').modal('show');
			}
		});

	});


	$(document).on('click','.delete_post',function(){
		if(confirm('Do you really want to delete this post ?')){
			var post_id = $(this).data('post-id');
			var current_page = $(this).data('current-page');
			console.log('post_id'+post_id);
			$.ajax({
				type: "POST",
				url: '/posts/delete',
				data:{'post_id':post_id,'from':current_page}, // serializes the form's elements.
				success: function(data)
				{//$('#add_posts').serialize()
					$('.jobs-list-container').html('').html(data);
				}
			});
		}
	});

	$(document).on('click','#add-job-trigger',function(){

		$('#project_name').val('');
		$('#job_title').val('');
		$('#no_of_vacancies').val('');
		$('#salary').val('');
		$('#job_description').val('');
		$('#key_skills').val('');
		$('#expiry_date_datepicker').val('');
		$('#add-new-job').modal('show');
	});

	$(document).on('click','#update_post',function(){
		var url = "/posts/update"; // the script where you handle the form input.

		var project_id = $('#project_name').val();
		var job_title = $('#job_title').val();
		var no_of_vacancies = $('#no_of_vacancies').val();
		var salary = $('#salary').val();
		var job_description = $('#job_description').val();
		var key_skills = $('#key_skills').val();
		var expiry_date_datepicker = $('#expiry_date_datepicker').val();
		var post_id = $(this).data('post-id');
		console.log('project_id'+project_id);
		console.log('job_title'+job_title);
		console.log('no_of_vacancies'+no_of_vacancies);
		console.log('salary'+salary);
		console.log('job_description'+job_description);
		console.log('key_skills'+key_skills);
		console.log('expiry_date_datepicker'+expiry_date_datepicker);
		$.ajax({
			type: "POST",
			url: url,
			data:{'post_id':post_id,'project_id':project_id,'job_title':job_title,'no_of_vacancies':no_of_vacancies,'salary':salary,'job_description':job_description,'key_skills':key_skills,'expiry_date_datepicker':expiry_date_datepicker}, // serializes the form's elements.
			success: function(data)
			{//$('#add_posts').serialize()
				$('#add-new-job').modal('hide');
				$('.jobs-list-container').html('').html(data);

			}
		});

	});
});
