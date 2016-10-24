$(function() {
	$(document).on('change','#project_id',function(){
		var url = '/index/getmanagers';
		var project_id = $(this).val();
		console.log('d'+project_id);
		var currentObj = $(this);
		if(project_id){
			$.ajax({
				type: "POST",
				url: url,
				data:{'project_id':project_id}, // serializes the form's elements.
				success: function(data)
				{
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
});