$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

	$('#tab-button-login').click(function(event){
		if(!$('#tab-button-login').hasClass('active')) {
			$('#tab-button-register').removeClass('active');
			$('#tab-button-login').addClass('active');
		}
	});
	$('#tab-button-register').click(function(event){
		if(!$('#tab-button-register').hasClass('active')) {
			$('#tab-button-login').removeClass('active');
			$('#tab-button-register').addClass('active');
		}
	});

	$('#user_role').on("change",function() {
		$role_value = $(this).val();
		alert($role_value);
		if($role_value != 'E'){
 			$('#manager_id').attr('disabled', 'disabled');
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
					$.each(json, function (key, data) {
    						console.log(key)
    					$.each(data, function (index, data) {
        				console.log('index', data)
    					})
					})
				  jQuery.each(data,function(i,value){
					  jQuery.each(value,function(key,details){
					  options = options + '<option values = "'+value[i].eid+'"> '+value[i].name+'</option>';	  
					  });
				  });
				 $('#manager_id').html('').html(options);
					 }
					
    			}
    		});
		   }
           
   });
$('#manager_id').attr('disabled', 'disabled');
});
