$(document).ready(function(){


	$(".faculty_login_frm").on("submit",function(e){

		e.preventDefault();

		var faculty_num = $(".faculty_num").val();
		var password = $(".password").val();


		if(faculty_num != '' && password != ''){
			faculty_login(faculty_num, password);
		}
	});

	/*$(".faculty_login_btn").on('click',function(){
		var username = $(".username").val();
		var password = $(".password").val();

		if(username != '' && password != ''){
			alert(username +' = '+ password);
			login(username, password);
		}
	});
*/
	function faculty_login(faculty_num, password){

		var request = $.ajax({
				url: base_url+'faculty_login',
				type: "POST",
				data: {
					'faculty_num': faculty_num,
					'password':password
				}
		});

		request.done(function(data){
			if(data.has_error){
				$(".error").html(data.error);
			}else{
				if(data.logged_in){
					window.location.replace(base_url+"faculty_dashboard");
				}else{
					$(".error").html(data);
				}
			}
		})

		request.fail(function(data){
			console.log(data);
		})

		/*$.post(
			base_url+'faculty_login',
			{
				'faculty_num': faculty_num,
				'password': password
			},
			function(data){

				if(data.has_error){
					$(".error").html(data.error);
				}else{
					if(data.logged_in){
						window.location = base_url+"faculty_dashboard";
					}else{
						$(".error").html(data);
					}
				}
			}
		);*/
	}

});