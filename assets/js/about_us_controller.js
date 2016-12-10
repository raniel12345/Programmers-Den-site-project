$(document).ready(function(){

	$(function(){
		$('.about_us_error').dialog({
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					$(this).dialog('close');
				}
			}
		});

		$(".deleteMsg_about_us").dialog({
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){

					var about_us_id = $(this).data('about_us_id');

					$.post(
						'remove_this_about_us_item',
						{
							'about_us_id': about_us_id
						},

						function(data){
							if(data.has_error){
								$('.about_us_error').html(data.error);
								$('.about_us_error').dialog("open");
							}else{
								display_about_us_table(data);
							}
						}
					);
					//remove_this_about_us_item
					$(this).dialog('close');
				},
				Cancel: function(){
					$(this).dialog('close');
				}
			}
		});
	});

	if($(".page_about_us_controller").css("display") == "block"){

		$(function(){

			var request_about_us = $.ajax({
				type: 'POST',
				url: 'get_all_about_us_content'
			})

			request_about_us.done(function(about_us_contents){
				display_about_us_table(about_us_contents);
			})

			request_about_us.fail(function(){
				alert('error on loading about us items');
			})

		});
	}
	//

	function display_about_us_table(data){
		//

		var display_about_us = "";

		$.each(data,function(i,item){
			display_about_us += "<tr>";

			display_about_us += "<td>"+item.id+"</td>";

			var content = document.createElement("div");
			content.innerHTML = item.content;
			display_about_us += "<td>"+content.innerText+"</td>";

			if(item.is_activated == "TRUE"){
				display_about_us += "<td>TRUE</td>";
			}else{
				display_about_us += "<td><button class='btn btn-warning activate_about_us_btn' id='"+item.id+"'>Activate</button></td>";
			}
				
			display_about_us += "<td><button class='btn btn-warning delete_about_us_btn' id='"+item.id+"'>Delete</button></td>";
			display_about_us += "</tr>";
		});

		$(".all_about_us").html(display_about_us);

		$(".activate_about_us_btn").on("click",function(){// activating button
			var about_us_id_item = $(this).attr("id");
			$.post(
				'activate_this_about_us_item',
				{
					'about_us_id': about_us_id_item
				},

				function(data){
					if(data.has_error){
						$('.about_us_error').html(data.error);
						$('.about_us_error').dialog("open");
					}else{
						display_about_us_table(data);
					}
				}
			);
		});

		$(".delete_about_us_btn").on("click",function(){ // Deleting button
			var about_us_id_item = $(this).attr("id");
			
			$(".deleteMsg_about_us").data("about_us_id", about_us_id_item).dialog("open");
		});
	}

	$(".add_this_aboutus_btn").on("click",function(){
		var about_us = tinymce.get('about_us_content').getContent(); // content

		if(about_us != ''){

			$.post(
				'insert_new_about_us_content',
				{
					'content': about_us
				},

				function(data){
					if(data.has_error){
						$('.about_us_error').html(data.error);
						$('.about_us_error').dialog("open");
					}else{
						tinymce.get('about_us_content').setContent("");
						//alert(data);
						display_about_us_table(data);
					}
				}
			);
		}
	});
});