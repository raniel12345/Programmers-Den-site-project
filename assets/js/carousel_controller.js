$(document).ready(function(){

	$(".carouselForm").on("submit",function(e){

		e.preventDefault();

		var carouselData = new FormData();

		var carousel_title = $("#carousel_title").val();
		var carousel_description = $("#carousel_description").val();
		var $carousel_img = $("#carousel_upload_img")[0].files[0];

		carouselData.append('carousel_title', carousel_title);
		carouselData.append('carousel_description', carousel_description);
		carouselData.append('carousel_upload_img', $carousel_img);


		$('.carousel_error').dialog({
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					$(this).dialog('close');
				}
			}
		})

		var request = $.ajax({
				url: "add_new_carousel",
				type: "POST",
				data: carouselData,
				contentType: false,
				cache: false,
				processData: false,
		});

		request.done(function(data){

			if(data.has_error){
				$('.carousel_error p.cError').html(data.error);
				$('.carousel_error').dialog("open");
				//$(".carousel_error_message").html(data.error);
			}else{
				display_carousel(data);
				$("#carousel_title").val("");
				$("#carousel_description").val("");
				$("#carousel_upload_img").css("color","green");
			}
		})

	});
	// Change the color of upload image field
	$("#carousel_upload_img").on("change",function(){
		$(this).css('color','black');
	})


	// Carousel Controller Start here
	if($('.page_carousel').css('display') == "block"){

		$(function(){
			var request_carousel_items = $.ajax({
				type: 'POST',
				url: 'admin/get_all_carousel'
			})

			request_carousel_items.done(function(carouselItems){
				display_carousel(carouselItems);
			})

			request_carousel_items.fail(function(){
				alert('error on loading carousel items');
			})
		});

	}

	function carousel_dialog_init(){
		$("#deleteMsg_crsl").dialog({
			autoOpen: false,
			resizable: false,
			modal: true,
			buttons:{
				YES: function(){
					var id = $("#deleteMsg_crsl").data('carousel_id');
					carousel_updater('delete_this_carousel',id);
					$(this).dialog('close');
				},
				NO: function(){
					$(this).dialog('close');
				}
			}
		});

		$('#warningInputFld').dialog({
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					$(this).dialog('close');
				}
			}
		})

		$('#editForm').dialog({
			autoOpen: false,
			modal: true,
			resizable: false,
			buttons:{
				Edit:function(){
					var carousle_id = $('#editForm').data('carousel_id');
					var $carousel_title = $('#carousel_title_edit').val();
					var $carousel_description = $('#carousel_description_edit').val();

					if(carousle_id != '' && $carousel_title != '' && $carousel_description != ''){
						if($carousel_title.length > 5 && $carousel_description.length > 5){
							$.post(
								'edit_this_carousel',
								{
									'id': carousle_id,
									'title': $carousel_title,
									'description': $carousel_description
								},

								function(data){
									display_carousel(data);
								}
							);
						}else{
							$('#warningInputFld').dialog('open');
						}
					}
					$(this).dialog('close');
				},
				Cancel:function(){
					$(this).dialog('close');
				}
			}

		})
	}

	function display_carousel(items){

		/* Displaying Carousel images on*/
		display_carousel_img(items);
		/* Displaying Carousel items in table*/
		display_carousel_table(items);
		

		// Initialize the dialog
		carousel_dialog_init();

		$('.edit_crsl_btn').on('click',function(){// Edit
			var id = $(this).attr('id');
			$('#editForm').data('carousel_id', id).dialog('open');
		});

		$('.delete_crsl_btn').on('click',function(){ // Delete
			var id = $(this).attr('id');
			$('#deleteMsg_crsl').data('carousel_id',id).dialog('open');
		});

		$('.activate_crls_btn').on('click',function(){ // Activate
			var carousle_id = $(this).attr('id');
			carousel_updater('activate_this_carousel', carousle_id);
		});

		$('.deactivate_crls_btn').on('click',function(){ // Deactivate
			var carousle_id = $(this).attr('id');
			carousel_updater('deactivate_this_carousel', carousle_id);
		});
	}
	function carousel_updater(function_name, id){
		/*
			parameter: 
				name of the function to use (delete, activate, deactive, edit)
				carousel id we need to update
		*/
		$.post(
			function_name,
			{'id': id},
			function(data){
				display_carousel(data);
			}
		);
	}

	function display_carousel_table(items){

		var $carousel_items = $('#carousel_items');

		var display_table = "";
		$.each(items, function(i, item){

			display_table += "<tr>";
			display_table += "<td>"+item.id+"</td>";
			display_table += "<td>"+item.date_uploaded+"</td>";
			display_table += "<td>"+item.img_name+"</td>";
			display_table += "<td>"+item.title+"</td>";
			display_table += "<td>"+item.description+"</td>";
			display_table += "<td><button class='btn btn-warning edit_crsl_btn' id='"+item.id+"'>Edit</button></td>";
			display_table += "<td><input type='submit' class='btn btn-warning delete_crsl_btn' id='"+item.id+"' value='Delete'></td>";
			
			if(item.is_activated == "TRUE"){
				display_table += "<td>TRUE</td>";
				display_table += "<td><button class='btn btn-warning deactivate_crls_btn' id='"+item.id+"'>Deactivate</button></td>";
			}else{
				display_table += "<td><button class='btn btn-warning activate_crls_btn' id='"+item.id+"'>Activate</button></td>";
				display_table += "<td>TRUE</td>";
			}

			display_table += "</tr>";

		})
			
		$carousel_items.html(display_table);


	}

	function display_carousel_img(items){

		// base_url is a global variable in dashboard.php
		var upload_img_url = base_url + "assets/img/upload_imgs/carousel/";

		// id on dashboard.php
		var $carousel_images = $('#carousel_images');

		var display_img = "";

		display_img += "<div class='carousel slide' id='myCarousel' data-ride='carousel'>";

			display_img += "<ol class='carousel-indicators carousel_indicators'>";
				$.each(items, function(i, item){
					if(item.is_activated == "TRUE")
						display_img += "<li data-target='#myCarousel' data-slide-to='"+item.id+"'></li>";
				});
			display_img += "</ol>";

			display_img += "<div class='carousel-inner carousel_inner_item' role='listbox'>";
				$.each(items, function(i, item){
					if(item.is_activated == "TRUE"){
						display_img += "<div class='item item-carousel'>";
							display_img += "<img src='"+upload_img_url+""+item.img_name+"' alt='"+item.title+"' class='img-responsive img-carousel' />";
							display_img += "<div class='carousel-caption'>";
								display_img += "<h3>"+item.title+"</h3>";
								display_img += "<p>"+item.description+"</p>";
							display_img += "</div>";
						display_img += "</div>";
					}
				});
			display_img += "</div>";

			// Left and Right controller
			display_img += "<a href='#myCarousel' class='left carousel-control' role='button' data-slide='prev'>";
				display_img += "<span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>";
				display_img += "<span class='sr-only'>Previous</span>";
			display_img += "</a>";

			display_img += "<a href='#myCarousel' class='right carousel-control' role='button' data-slide='next'>";
				display_img += "<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>";
				display_img += "<span class='sr-only'>Next</span>";
			display_img += "</a>";

		display_img += "</div>";
		

		$carousel_images.html(display_img);

		// we need to add active class on first item of the carousel to display properly and work properly
		$('ol.carousel_indicators li').first().addClass('active');
		$('div.carousel_inner_item div').first().addClass('active');	
	}


	// Carousel Controller End here
});
