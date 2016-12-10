var global_group_id = 0;
var global_chapt_id = 0;

$(document).ready(function(){

	on_clicking_create_btn();

	// displaying all semester options
	get_all_semesters();

	// When choosing/Displaying groups in table
	// pass the function for getting all groups per sem and per faculty
	on_choosing_semester(get_all_groups_on_this_sem);


	add_chapter_on_this_group();

	// Trigger the hidden link on page to go back to top
	$('.go_top_btn').on('click',function(){
		$('.gotoTop a p').trigger('click');
	});

	// Animating the scrolling go to top
	$('.goTop').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 1200);
		return false;
	});



});

function on_clicking_create_btn(){
	$(".create_group_btn").on('click',function(){

		var group_title = $("#group_title").val();

		if(group_title != ""){
			create_new_group(group_title);
		}
	});
}

function create_new_group(group_title){
	$.post(
		"add_new_group",
		{
			"group_title":group_title,
			"faculty_id":faculty_id
		},
		function(data){
			if(data.has_error == "TRUE"){
				$(".add_group_msg").html("<p>"+data.error+"</p>");
			}else{
				$(".add_group_msg").html(data);
				$("#group_title").val("");
				$(".semester").val("");
			}
		}

	);
}

function remove_scs_err_msg_on_creating_new_group(){
	$(".group_title").on("keyup",function(){
		$(".add_group_msg").html("");
	})
}

function get_all_semesters(){
	var request = $.ajax({

			url: "get_all_semesters",
			type: "POST",
	});

	request.done(function(data){
		display_semesters(data);
	});

}
// Displaying semester on (Choose Semester:)
function display_semesters(data){

	var semesters_options = "<option></option>";

	$.each(data,function(i, semester_item){
		semesters_options += "<option id='"+semester_item['id']+"'>"+semester_item['semester_n_year']+"</option>";
	})

	$(".semester").html(semesters_options);
}

function on_choosing_semester(get_all_groups){

	$(".semester").on("change",function(){
		var semester_id = $(this).children(":selected").attr("id");
		if(semester_id != undefined){
			get_all_groups(semester_id, faculty_id);
		}
	});
}

function get_all_groups_on_this_sem(semester_id,faculty_id){
	$.post(
			"get_all_groups_on_this_sem_n_fac",
			{
				"semester_id": semester_id,
				"faculty_id":faculty_id
			},
			function(data){
				display_all_groups_on_table(data);
			}
		);
}

function display_all_groups_on_table(groups){

	var display_groups = "";

	$.each(groups, function(i, item){
		display_groups += "<tr>";
		display_groups += "<td>"+item.id+"</td>";
		display_groups += "<td>"+item.title+"</td>";
		display_groups += "<td>"+item.date_created+"</td>";
		display_groups += "<td><button class='btn btn-warning view_this_group' id='"+item.id+"'>View</button></td>";
		display_groups += "<td><button class='btn btn-warning edit_this_group' id='"+item.id+"'>Edit</button></td>";
		display_groups += "</tr>";
	});

	$(".group_items").html(display_groups);

	// When View button is click
	// When viewing the group
	$(".view_this_group").on("click",function(){

		$("#chapter_title").val("");
		$(".add_chap_msg").html("");


		var group_id = $(this).attr('id');

		// Viewing group
		activate_this_group(group_id);
		// when viewing on group then display all chapters on this group
		get_all_chapters_in_this_group(group_id);

		// Global variable for group id
		global_group_id = group_id;


		/*$('.gotoTop a p').trigger('click');*/
		
		$(".view_group_title").css("color","#ffa500");
		setInterval(function(){ $(".view_group_title").css("color","#333333"); }, 4000);
	});

	$(".edit_this_group").on("click",function(){
		alert("Sorry, this button is under development");
	});
}


function activate_this_group(group_id){

	$.post(
		"get_this_group",
		{
			"group_id":group_id
		},
		function(data){
			display_this_group(data);
		}
	);
}

function display_this_group(group){

	$(".view_group_title").html(group.title);
	//alert(data.id); // make it global variable

	//get_semester_of_this_group
	display_semester_on_this_group(group.semester_id);

	
}

function display_semester_on_this_group(sem_id){
	$.post(
		"get_semester_of_this_group",
		{
			"sem_id":sem_id
		},
		function(sem_n_year){
			$(".sem_n_year").html(sem_n_year);
		}
	);
}

function add_chapter_on_this_group(){
	$(".add_chapter_btn").on("click",function(){
		//alert(global_group_id);

		var chapter_title = $("#chapter_title").val();

		if(chapter_title != ''){
			if(global_group_id != 0){
				$.post(
					"add_new_chapter_on_this_group",
					{
						"chapter_title": chapter_title,
						"group_id":global_group_id
					},
					function(data){
						if(data.has_error){
							$(".add_chap_msg").html(data.error);
						}else{
							$(".add_chap_msg").html(data);
						}
					}
				);
			}else{
				$(".add_chap_msg").html("No Group selected");
			}
		}else{
			$(".add_chap_msg").html("Invalid chapter title");
		}

		get_all_chapters_in_this_group(global_group_id);
				
	});
}

function get_all_chapters_in_this_group(group_id){

	$.post(
		"get_all_chapters_on_this_group",
		{
			"group_id":group_id
		},
		function(data){

			if(data.has_error){
				$(".chap_msg").html(data.error);
			}else{
				display_all_chapters_on_this_group_on_table(data);
			}
		}
	);
}

function display_all_chapters_on_this_group_on_table(chapters){

	//$chapters_items = $("#chapters_items");
	display_chapters = "";

	$.each(chapters, function(i,chapter){
		display_chapters += "<tr>";
		display_chapters += "<td>"+chapter.chapter_title+"</td>";
		display_chapters += "<td><button class='btn btn-warning chap_get_in_btn' id='"+chapter.id+"'>Get in</button></td>";
		display_chapters += "</tr>";
	});

	$("#chapters_items").html(display_chapters);

	$(".chap_get_in_btn").on("click",function(){
		var chap_id = $(this).attr("id");

		// navigate the upload files controller
		$(".goto_chap_controller a p").trigger("click");
		//alert(chap_id);
		get_this_chapter(chap_id);
	});
}

function get_this_chapter(chap_id){
	
	$.post(
		"get_this_chapter",
		{
			"chap_id":chap_id,
			"group_id":global_group_id
		},
		function(data){
			$(".chap_title").html(data.chapter_title);
			global_chapt_id = data.id;
		}
	);
}


function upload_lectures(chap_id){
	$(".upload_lectures_btn").on("click",function(){
		var upload_lectures_input = $("#upload_lectures")[0];

		var lectures_upload_data = new FormData();

		var up_lectures_len = upload_lectures_input.files.length;
		
		for(var i=0; i < up_lectures_len; i++){
			lectures_upload_data.append("upload_lectures",upload_lectures_input.files[i]);
		}
		lectures_upload_data.append("chap_id",chap_id);
	});
}