$(function() {

   $(document).on('click','.approve-login-request',function(){
       var url = '/loginrequests/acceptrequest';
       var request_id = $(this).data('request-id');
       console.log('h'+request_id);
       $.ajax({
			type: "POST",
			url: url,
			data:{'request_id':request_id}, // serializes the form's elements.
			success: function(data)
			{
				$('.login-requests-container').html('').html(data);
			}
		});
   });

   $(document).on('click','.delete-login-request',function(){
       alert();
       var url = '/loginrequests/deleteloginrequest';
       var request_id = $(this).data('request-id');
       console.log('d'+request_id);
       $.ajax({
			type: "POST",
			url: url,
			data:{'request_id':request_id}, // serializes the form's elements.
			success: function(data)
			{
				$('.login-requests-container').html('').html(data);
			}
		});
   });

});
