$(document).ready(function(){
	// Global variables
	var limit_events_num = 4;// defaul value is 4 because the default limit in query is 4
	var number_event_items = 0;

	
	// Display the events items

	if($(".page_events").css('display') == 'block'){
		$(function(){
			var request_event_items = $.ajax({
				type: 'POST',
				url: 'display_all_events'
			})

			request_event_items.done(function(eventItems){
				display_event_item_panels(eventItems);
			})

			request_event_items.fail(function(){
				console.log('error on loading event items');
			})
		});
	}
		

	function display_event_item_panels(eventItems){
		var $events_items_panels = $(".events_items_panels");

		var display_events = "";
		var event_img_uri = "";


		$.each(eventItems, function(i, item){
			display_events += " <div class='col-xs-6 col-sm-6 col-md-3 col-lg-3'> ";
				display_events += " <article> ";
					display_events += " <div class='panel panel-default read_event' id='"+item.id+"'> ";
						display_events += " <div class='panel-heading'> ";
							display_events += " <header>"+item.title+"</header> ";
						display_events += " </div> ";
						display_events += "<div class='panel-body'>";
							event_img_uri = base_url+"assets/img/upload_imgs/event/"+item.img_name;
							display_events += "<img src='"+event_img_uri+"' class='event_pic img-thumbnail'>";
						display_events += "</div>";
					display_events += " </div> ";
				display_events += " </article> ";
			display_events += " </div> ";

		});

		$events_items_panels.html(display_events);

		$(".read_event").on("click",function(){
			var event_id = $(this).attr("id");
			display_event_content_modal(event_id);
		});
	}

	function display_event_content_modal(event_id){
		$.post(
			'display_this_event',
			{'id': event_id},
			function(data){
				$("#event_modal_title").html(data.title);
				var event_img_uri_modal = base_url+"assets/img/upload_imgs/event/"+data.img_name;
				$(".modal-body .event_img_modal").html("<img src='"+event_img_uri_modal+"' class='event_image_modal'>");
				$(".modal-body .event_content_modal").html(data.description);
				$(".read_this_event").click();
			}
		);
	}

	function get_number_of_events_items(){ // get the number of event items in database
		var request_number_events = $.ajax({
			type: 'POST',
			url: 'get_number_of_events'
		})

		request_number_events.done(function(number_event){
			number_event_items = number_event;
		})

		request_number_events.fail(function(){
			alert("Error getting number of events");
		})
	}
	if($(".page_events").css('display') == 'block')
		$(get_number_of_events_items());


	//$(".spinner").css("display","block");
	// When user want to view more event and click the more... text in event controller
	$(".more").on("click",function(){
		$(".spinner").css("display","block");
		limit_events_num += 4;
		setInterval(
			$(
				$.post(
					'display_all_events',
					{'limit_num': limit_events_num},
					function(eventItems){
						display_event_item_panels(eventItems);
						$(".spinner").css("display","none");
					}
				)
			),5000);
			
		if(limit_events_num == 8){
			$(".less").show();
		}

		if(limit_events_num > number_event_items){
			// Hide this button and show the less button
			$(this).hide();
			$(".less").show();
		}
	});
	// When user want to hide other event and click less text in event controller
	$(".less").on("click",function(){	
		limit_events_num = 4;

		$.post(
			'display_all_events',
			{'limit_num': limit_events_num},
			function(eventItems){
				display_event_item_panels(eventItems);
			}
		);

		$(this).hide();
		$(".more").show();
	});


});