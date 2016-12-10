$(document).ready(function(){

	if($(".about_us_n_contact_us").css('display') == 'block'){


		var request_about_us = $.ajax({
			type: 'POST',
			url: 'get_about_us'
		})

		request_about_us.done(function(about_us){
			display_about_us(about_us);
		});

		request_about_us.fail(function(){
			alert("error loading about us");
		});

	}

	function display_about_us(about_us){
		$(".about_us_content").html(about_us['content']);
	}

});