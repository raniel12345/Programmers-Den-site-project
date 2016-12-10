$(document).ready(function(){

	$(".user_login_frm").on("submit",function(e){
		//e.preventDefault();

		var user_data = get_user_id_n_password();
		//alert(user_data);
		user_login(user_data);
	});
/*
	$(".user_login_btn").on("click",function(){
		var user_data = get_user_id_n_password();
		alert(user_data);
		user_login(user_data);
	});*/

});


function user_login(user_data){
	$.post(
		// I Initialize the base_url on Body.php
		base_url+"user_login",
		user_data,
		function(data){
			
			console.log(data);
			if(data.logged_in === TRUE){
				alert("success");
				window.location = base_url;
			}else{
				$(".login_error").html(data);
			}
		}
	);
}

function get_user_id_n_password(){
	var user_id = $(".user_id").val();
	var user_password = $(".user_password").val();

	if(user_id != '' || user_password != ''){
		var user_data = {
			'user_id': user_id,
			'user_password': user_password
		}

		return user_data;
	}
};