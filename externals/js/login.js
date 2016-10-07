$(function() {

	$('#tab-button-login').click(function(event){
		if(!$('#tab-button-login').hasClass('active')) {
			$('#tab-button-register').removeClass('active');
			$('#tab-button-login').addClass('active');
		} else {
			$('#username').focus();
		}
	});
	$('#tab-button-register').click(function(event){
		if(!$('#tab-button-register').hasClass('active')) {
			$('#tab-button-login').removeClass('active');
			$('#tab-button-register').addClass('active');
		}else {
			$('#full_name').focus();
		}
	});

	$('#emp_ref').focusout(function(event){
		var url='index/isemployeerefexists';
		var emp_ref = $('#emp_ref').val();
		if(emp_ref.trim().length > 0) {
			$.ajax({
				type: "POST",
				url: url,
				data:{'emp_ref':emp_ref}, // serializes the form's elements.
				success: function(data)
				{
					var data = jQuery.parseJSON(data);
					if(data['exists'] == true) {
						alert('Employee reference already exists!');
						$('#emp_ref').focus();
					}
				}
			});
		}
	});

	$('#employee_registration_form').submit(function(event){
		var password = $('#password').val();
		var confirm_password = $('#confirm_password').val();
		if (password != confirm_password){
			alert('Passwords doesn\'t match');
			return false
		}
		return true;
	});

	$('#user_role').on("change",function() {
		$role_value = $(this).val();
		if($role_value != 'E'){
			$('#manager_id').attr('disabled', 'disabled');
		} else {
			$('#project_id').val('');
		}
	});

	$(document).on('change','#project_id',function(){

		var url = '/index/getmanagers';
		var project_id = $(this).val();
		console.log('d'+project_id);
		var currentObj = $(this);
		var role_value = $(user_role).val();
		if(role_value =='E'){
			$.ajax({
				type: "POST",
				url: url,
				data:{'project_id':project_id}, // serializes the form's elements.
				success: function(data)
				{
					$('#manager_id').removeAttr('disabled');
					var data = jQuery.parseJSON(data);
					if(data != null){
						var options = '<option value ="">Select</option>';
						jQuery.each(data,function(index,value){
							options = options + '<option value = "'+value.eid+'">'+value.name+'</option>';	  
						});
						$('#manager_id').html('').html(options);
					}

				}
			});
		}

	});
	$('#manager_id').attr('disabled', 'disabled');
	
	$('#key_skills').chosen();
});
