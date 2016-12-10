$(document).ready(function(){

	$(".contact_us_frm_error").css("color","red");

	$(".contact_us_frm").on("submit",function(e){
		e.preventDefault();

		var sender_name = $(".sender_name").val();
		var sender_email = $(".sender_email").val();
		var sender_phone_no = $(".sender_phone_no").val();
		var subject = $(".subject").val();
		var message = $(".message").val();

		if(is_empty(sender_phone_no) && is_empty(sender_email) && is_empty(subject) && is_empty(message)){
			$(".contact_us_frm_error").html("All input field is required!");
		}else{

			if(is_name_length_is_valid(sender_name.length)){
				if(isNaN(sender_phone_no)){
					$(".contact_us_frm_error").html("Phone number is invalid!");
				}else{
					var data = {
						'sender_name':sender_name,
						'sender_email':sender_email,
						'sender_phone_no':sender_phone_no,
						'subject':subject,
						'message':message
					}

					send_message(data);
				}
					
			}else{
				$(".contact_us_frm_error").html("Your name is too long!");
			}
				
		}
	});

	function is_empty(input){
		if( input == '' )
			return true;
		else
			return false;
	}

	function is_name_length_is_valid(input_len){
		if(input_len > 30)
			return false;
		else
			return true;
	}

	function send_message(data){
		$.post(
			'contact_us_send_message',
			data,
			function(data){
				alert(data);
			});
	}

});