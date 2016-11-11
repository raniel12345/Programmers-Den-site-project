$(document).ready(function(){

	// Initialize all dialog box
	$(function(){
		$('.event_error').dialog({
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					$(this).dialog('close');
				}
			}
		});

		$("#deleteMsg_event").dialog({
			autoOpen: false,
			resizable: false,
			modal: true,
			buttons:{
				YES: function(){
					var id = $("#deleteMsg_event").data("event_id");
					event_updater('delete_this_event',id);
					$(this).dialog('close');
				},
				NO: function(){
					$(this).dialog('close');
				}
			}
		});

		$(".edit_or_update_event").dialog({
			autoOpen: false,
			resizable: false,
			modal: true,
			buttons:{
				Yes: function(){
					var id = $(".edit_or_update_event").data('event_id');
					edit_event(id);// Edit the Event
					$(this).dialog('close');
				},
				Cancel: function(){
					$(this).dialog('close');
				}
			}
		})
	})

	// When page is loaded
	// Load all events in table
	if($(".page_events_controller").css('display') == "block"){

		$(function(){
			var request_event_items = $.ajax({
				type: 'POST',
				url: 'get_all_event'
			})

			request_event_items.done(function(eventItems){
				display_events_in_table(eventItems);
			})

			request_event_items.fail(function(){
				alert('error on loading event items');
			})
		});

	}

	function event_updater(function_name, id){
		$.post(
			function_name,
			{'id': id},
			function(data){
				display_events_in_table(data);
			}
		);
	}

	// Event form submit
	$(".event_image_form").on("submit",function(e){
		e.preventDefault();

		var eventData = new FormData();
		var $img = $("#event_img")[0].files[0]; // image file
		var title = $("#event_title").val();
		var content = tinymce.get('event_description').getContent(); // content

		if(title != '' || content != ''){

			eventData.append("event_img", $img); // image file
			eventData.append("title", title); // title
			eventData.append('content', content); // content

			var request = $.ajax({
				url: "add_new_event",
				type: "POST",
				data: eventData,
				contentType: false,
				cache: false,
				processData: false,
			})

			request.done(function(data){

				if(data.has_error){

					$(".event_error p.eError").html(data.error);
					$('.event_error').dialog("open");

				}else{
					$("#event_title").val("");
					$("#event_img").css("color","green");
					$("#event_img").val(null);
					tinymce.get('event_description').setContent("");
					display_events_in_table(data);
				}
			});
		}
	});
	// file input field when change
	$("#event_img").on("change",function(){
		$(this).css("color","black");
	});

	// Function for displaying events in table
	function display_events_in_table(items){
		var event_items = $('#event_items');

		var display_table = "";

		$.each(items, function(i, item){
			display_table += "<tr>";
			display_table += "<td>"+item.id+"</td>";
			display_table += "<td>"+item.date_uploaded+"</td>";
			display_table += "<td>"+item.title+"</td>";

			if(item.img_name == 'none' || item.img_name == '--'){
				display_table += "<td>No</td>";
			}else{
				display_table += "<td>"+item.img_name+"</td>";
			}

			display_table += "<td><button class='btn btn-warning view_event_btn' id='"+item.id+"'>View</button></td>";
			display_table += "<td><button class='btn btn-warning edit_event_btn' id='"+item.id+"'>Edit</button></td>";
			display_table += "<td><button class='btn btn-warning delete_event_btn' id='"+item.id+"'>Delete</button></td>";
			display_table += "</tr>";
		});

		event_items.html(display_table);

		$(".view_event_btn").on("click",function(){
			alert('Under construction :) :D View!');
		});

		$(".edit_event_btn").on("click",function(){
			//alert("Under construction :) :D edit!");
			var id = $(this).attr('id');
			$(".edit_or_update_event").data('event_id',id).dialog("open");
		});

		$(".delete_event_btn").on("click",function(){
			//alert("under construction :) :D Delete!");
			var id = $(this).attr('id');
			$("#deleteMsg_event").data("event_id",id).dialog("open");
		});
	}

	// Edit event of update event

	function edit_event(id){

		$.post(
			"get_this_event",
			{'id': id},
			function(data){
				get_value_event_to_edit(data);
			}
		);
	}

	function get_value_event_to_edit(data){
		$("#event_title").val(data.title);
		tinymce.get('event_description').setContent(data.description);
	}
});