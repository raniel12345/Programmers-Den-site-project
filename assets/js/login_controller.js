$(document).ready(function(){

	$(".admin_login_frm").on("submit",function(e){

		e.preventDefault();

		var username = $(".username").val();
		var password = $(".password").val();

		alert(password);

		if(username != '' && password != ''){
			login(username, password);
		}
	});

	$(".login_btn").on('click',function(){
		var username = $(".username").val();
		var password = $(".password").val();

		if(username != '' && password != ''){
			login(username, password);
		}
	});

	function login(username, password){
		$.post(
			'admin_login',
			{
				'username': username,
				'password': password
			},
			function(data){
				if(data.has_error){
					$(".error").html(data.error);
				}else{
					if(data.logged_in){
						window.location.replace("admin_dashboard");
					}else{
						$(".error").html(data);
					}
					
				}
				
			}
		);
	}

});