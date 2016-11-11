$(document).ready(function(){


	// Carousel Controller Start here
	if($('.page_carousel').css('display') == "block"){

		$(function(){
			var request_carousel_items = $.ajax({
				type: 'POST',
				url: 'get_all_carousel'
			})

			request_carousel_items.done(function(carouselItems){
				display_carousel(carouselItems);
			})

			request_carousel_items.fail(function(){
				alert('error on loading carousel items');
			})
		});

	}

	function display_carousel(items){

		/* Displaying Carousel images on*/
		display_carousel_img(items);
		/* Displaying Carousel items in table*/
		display_carousel_table(items);
		
		$('.delete_crsl_btn').on('click',function(){
			var carousle_id = $(this).attr('id');
			carousel_updater('delete_this_carousel',carousle_id);
		});

		$('.activate_crls_btn').on('click',function(){
			var carousle_id = $(this).attr('id');
			carousel_updater('activate_this_carousel', carousle_id);
		});

		$('.deactivate_crls_btn').on('click',function(){
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
			display_table += "<td><button class='btn btn-warning'>Edit</button></td>";
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


	/*// Showing Carousel Controller and adding margin on top
	$('a #carousel_click_me').on('click',function(){
		if($('.page_carousel').css('display') == "none"){
			//adding margin on top
			$('.space_top').removeClass('space_top').addClass('add_margin');
			// showing carousel controller
			$('.page_carousel').show('slow');
		}
	});

	// hidding Carousel Controller and removing margin on top
	$('.carousel_close a').on('click', function(){
		// hidding carousel
		$('.page_carousel').hide('slow');
		// removing margin on top
		$('.add_margin').removeClass('add_margin').addClass('space_top');
	});

	// Showing Event Controller
	$('a #events_click_me').on('click',function(){
		if($('.page_events_controller').css('display') == "none"){
			$('.page_events_controller').show('slow');
		}
	});

	// Hidding Event Controller
	$('.event_close a').on('click',function(){
		$('.page_events_controller').hide('slow');
	});

	// Showing Accounts Controller
	$('a #accounts_click_me').on('click',function(){
		$('.page_accounts_controller').show('slow');
	});

	// Hidding Accounts Controller
	$('.accounts_close a').on('click',function(){
		$('.page_accounts_controller').hide('slow');
	});

	// Showing Article Controller
	$('a #articles_click_me').on('click', function(){
		$('.page_articles_controller').show('slow');
	});

	// Hidding Article Controller
	$('.articles_close a').on('click', function(){
		$('.page_articles_controller').hide('slow');
	});

	// Showing Tutorial Controller
	// Hidding Tutorial Controller

	// Showing About Us Controller
	$('a #about_us_click_me').on('click', function(){
		$('.page_about_us_controller').show('slow');
	});

	// Hidding About Us Controller
	$('.about_us_close a').on('click', function(){
		$('.page_about_us_controller').hide('slow');
	});

	// Showing Messages Controller
	$('a #messages_click_me').on('click', function(){
		$('.page_messages_controller').show('slow');
	});

	$('.messages_close a').on('click', function(){
		$('.page_messages_controller').hide('slow');
	});*/

	// $('ol.carousel_indicators li').first().addClass('active');
	// $('div.carousel_inner_item div').first().addClass('active');
