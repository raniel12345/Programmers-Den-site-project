$(document).ready(function(){

	// Initialize all dialog box
	$(function(){
		$(".article_error").dialog({
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					$(this).dialog('close');
				}
			}
		});
		$(".deleteMsg_article").dialog({
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					var id = $(".deleteMsg_article").data('article_id');
					article_updater('delete_this_article_item', id);
					$(this).dialog('close');
				},
				Cancel:function(){
					$(this).dialog('close');
				}

			}
		});

		$(".deleteMsg_category").dialog({ // Category Delete Dialog
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					var id = $(".deleteMsg_category").data('category_id');
					category_updater('delete_this_category_item', id);
					$(this).dialog('close');
				},
				Cancel:function(){
					$(this).dialog('close');
				}

			}
		});

		$(".deleteMsg_subcategory").dialog({ // Subcategory Delete Dialog
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				OK:function(){
					var id = $(".deleteMsg_subcategory").data('sub_cat_id');
					subcategory_updater('delete_this_subcategory_item', id);
					$(this).dialog('close');
				},
				Cancel:function(){
					$(this).dialog('close');
				}

			}
		});
		//

		$(".editForm_cat").dialog({ // Edit Form for category
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				Edit:function(){
					var category_id = $('.editForm_cat').data('category_id');

					var category_edit = $(".category_edit").val();

					if(category_edit != '' && category_id != ''){
						$.post(
							"edit_this_category_item",
							{
								"cat_id": category_id,
								"cat_edit": category_edit
							},
							function(data){
								if(data.has_error){
									$(".article_error").html(data.error);
									$(".article_error").dialog("open");
								}else{
									display_categories_in_table(data);
									display_categories(data);
								}
							}
						);
					}
					$(this).dialog('close');
				},
				Cancel:function(){
					$(this).dialog('close');
				}

			}
		})

		$(".editForm_subcat").dialog({ // Edit Form for Subcategory
			autoOpen:false,
			resizable:false,
			modal: true,
			buttons:{
				Edit:function(){
					var subcategory_id = $('.editForm_subcat').data('subcategory_id');

					var subcategory_edit = $(".subcategory_edit").val();

					if(subcategory_edit != '' && subcategory_id != ''){
						$.post(
							"edit_this_subcategory_item",
							{
								"subcat_id": subcategory_id,
								"subcat_edit": subcategory_edit
							},
							function(data){
								if(data.has_error){
									$(".article_error").html(data.error);
									$(".article_error").dialog("open");
								}else{
									display_subcategories_in_table(data);
								}
							}
						);
					}
					$(this).dialog('close');
				},
				Cancel:function(){
					$(this).dialog('close');
				}

			}
		})
	})

	$(".add_new_category").on('click',function(){ // Adding new Category
		var new_category = $("#new_category").val();

		if(new_category != ''){

			$.post(
				"add_new_category",
				{'new_category': new_category},
				function(data){
					if(data.has_error){
						$(".article_error").html(data.error);
						$(".article_error").dialog("open");
					}else{
						$("#new_category").val("");
						display_categories(data);
						display_categories_in_table(data);
						//console.log(data);
					}
				}
			);
		}
	});

	if($(".page_articles_controller").css('display') == 'block'){

		// For displaying categories
		$(function(){
			var request = $.ajax({
				url: "get_all_categories",
				type: "POST"
			})

			request.done(function(data){
				display_categories(data);
				display_categories_in_table(data);
			});
		});

		// For displaying categories
		$(function(){
			var request = $.ajax({
				url: "get_all_subcategories_for_table",
				type: "POST"
			})

			request.done(function(data){
				display_subcategories_in_table(data);
			});
		});

		// For displaying articles
		$(function(){
			var request = $.ajax({
				url: "get_all_articles",
				type: "POST"
			})

			request.done(function(data){
				display_all_articles_in_table(data);
			});
		});
	}

	// Displaying Articles in Table
	function display_all_articles_in_table(data){

		var $all_articles = $(".all_articles");

		var display_all_articles = "";

		$.each(data, function(i, item){

			display_all_articles += "<tr>";
			display_all_articles += "<td>"+item.id+"</td>";
			display_all_articles += "<td>"+item[2]+"</td>";
			display_all_articles += "<td>"+item[1]+"</td>";
			display_all_articles += "<td>"+item.title+"</td>";
			display_all_articles += "<td>"+item[0]+"</td>";
			display_all_articles += "<td>"+item.post_date+"</td>";
			display_all_articles += "<td><button class='btn btn-warning view_article_btn' id='"+item.id+"'>View</button></td>";

			if(item.is_activated == 'TRUE'){
				display_all_articles += "<td>TRUE</td>";
				display_all_articles += "<td><button class='btn btn-warning deactivate_article_btn' id='"+item.id+"'>Deactivate</button></td>";
			}else{
				display_all_articles += "<td><button class='btn btn-warning activate_article_btn' id='"+item.id+"'>Activate</button></td>";
				display_all_articles += "<td>TRUE</td>";
			}
			display_all_articles += "<td><button class='btn btn-warning delete_article_btn' id='"+item.id+"'>Delete</button></td>";
			display_all_articles += "</tr>";
		});

		$all_articles.html(display_all_articles);

		$(".view_article_btn").on("click",function(){
			$article_id = $(this).attr("id");
			alert("Under Construction !! :-)");
		});

		$(".activate_article_btn").on("click",function(){ // Activate the article
			$article_id = $(this).attr("id");
			article_updater('activate_this_article_item', $article_id);
		});

		$(".deactivate_article_btn").on("click",function(){ // Deactivate the article
			$article_id = $(this).attr("id");
			article_updater('deactivate_this_article_item', $article_id);
		});

		$(".delete_article_btn").on("click",function(){ // Delete the article
			$article_id = $(this).attr("id");
			$('.deleteMsg_article').data('article_id', $article_id).dialog('open');
			
		});

	}
	// Function for deleting, activating, deactivating article
	function article_updater(function_name, id){
		$.post(
			function_name,
			{'id': id},
			function(data){
				if(data.has_error){
					$(".article_error").html(data.error);
					$(".article_error").dialog("open");
				}else{
					display_all_articles_in_table(data);
				}
			}
		);
	}

	// For displaying subcategories on select field
	$(".categories_select").on("change",function(){
		var category_id = $(this).children(":selected").attr("id");

		$.post(
			"get_all_subcategories",
			{'category_id': category_id},
			function(data){
				if(data.has_error){
					$(".article_error").html(data.error);
					$(".article_error").dialog("open");
				}else{
					display_subcategories(data);
				}
			}
		);
	});

	function display_categories_in_table(data){// Function for displaying category in table

		var display = "";

		$.each(data,function(i, item){
			display += "<tr>";
			display += "<td>"+item.id+"</td>";
			display += "<td>"+item.category+"</td>";
			display += "<td><button class='btn btn-warning edit_cat_btn' id='"+item.id+"'>Edit</button></td>";
			display += "<td><button class='btn btn-warning delete_cat_btn' id='"+item.id+"'>Delete</button></td>";
			display += "</tr>";
		});

		$(".categories_items").html(display);

		//delete_this_category_item

		$(".edit_cat_btn").on("click",function(){
			var category_id = $(this).attr("id");

			$(".editForm_cat").data("category_id", category_id).dialog("open");
		});

		$(".delete_cat_btn").on("click",function(){
			var category_id = $(this).attr("id");
			$(".deleteMsg_category").data("category_id", category_id).dialog("open");
		});
	}

	function category_updater(function_name, id){// Function for editing, deleting category
		var $cat_update_req = $.post(
			function_name,
			{'id': id},
			function(data){
				if(data.has_error){
					$(".article_error").html(data.error);
					$(".article_error").dialog("open");
				}else{
					display_categories_in_table(data);
					display_categories(data);
				}
			}
		);

		$cat_update_req.fail(function(error){
			console.log(error);
		});
	}

	function subcategory_updater(function_name, id){ // Function for deleting subcategory

		var $cat_update_req = $.post(
			function_name,
			{'id': id},
			function(data){
				if(data.has_error){
					$(".article_error").html(data.error);
					$(".article_error").dialog("open");
				}else{
					display_subcategories_in_table(data);
					display_subcategories(data);
				}
			}
		);

		$cat_update_req.fail(function(error){
			console.log(error);
		});
	}

	// functoin for displaying subcategories in table
	function display_subcategories_in_table(data){

		var display = "";

		$.each(data,function(i, item){
			display += "<tr>";
			display += "<td>"+item.id+"</td>";
			display += "<td>"+item.category_id+"</td>";
			display += "<td>"+item.subcategory+"</td>";
			display += "<td><button class='btn btn-warning edit_subcat_btn' id='"+item.id+"'>Edit</button></td>";
			display += "<td><button class='btn btn-warning delete_subcat_btn' id='"+item.id+"'>Delete</button></td>";
			display += "</tr>";
		});

		$(".subcategories_items").html(display);

		$(".edit_subcat_btn").on("click",function(){
			var sub_cat_id = $(this).attr("id");
			$(".editForm_subcat").data('subcategory_id', sub_cat_id).dialog("open");
		});

		$(".delete_subcat_btn").on("click",function(){
			var sub_cat_id = $(this).attr("id");
			$(".deleteMsg_subcategory").data("sub_cat_id", sub_cat_id).dialog("open");
		});
	}

	// function Displaying Categories in select field
	function display_categories(data){
		// To Add subcategory form
		var display = "<option></option>";

		$.each(data, function(i, item){
			display += "<option class='categories_on_subcat' id='"+item.id+"'>"+item.category+"</option>";
		});

		$('.categories_select_add_subcat').html(display);// At the new subcategory form
		$('.categories_select').html(display) // At the Article form
	}
	// function for displaying subcategories in select field
	function display_subcategories(data){
		var display = "<option></option>";

		$.each(data, function(i, item){
			display += "<option class='subcategory' id='"+item.id+"'>"+item.subcategory+"</option>";
		});

		$('.subcategories_select').html(display);
	}


	// Adding new Subcategories
	$(".add_new_subcategory").on("click",function(){
		// selected category id
		var category_id = $(".categories_select_add_subcat").children(":selected").attr("id");
		var new_subcategory = $(".new_subcategory").val();

		if(category_id != '' && ($.isNumeric(category_id)) && new_subcategory != ''){
			
			$.post(
				'add_new_subcategory',
				{
					'category_id': category_id,
					'new_subcategory': new_subcategory 
				},

				function(data){
					if(data.has_error){
						$(".article_error").html(data.error);
						$(".article_error").dialog("open");
					}else{
						$(".new_subcategory").val("");
						display_subcategories_in_table(data);
					}
				}
			);

		}else{
			$(".article_error").html("<p>Please Choose Category</p>");
			$(".article_error").dialog("open");
		}
	});

	// New Article Form
	$(".new_article_form").on("submit",function(e){

		e.preventDefault();

		var subcategory_id = $('.subcategories_select').children(":selected").attr('id');
		var article_title = $(".article_title").val();
		var article_content = tinymce.get('article_content').getContent(); // content
		var $article_img = $(".article_upload_img")[0].files[0];

		var articleData = new FormData();

		articleData.append("subcategory_id", subcategory_id);
		articleData.append("title", article_title);
		articleData.append("content", article_content);
		articleData.append("article_img", $article_img);


		var request = $.ajax({
				url: "add_new_article",
				type: "POST",
				data: articleData,
				contentType: false,
				cache: false,
				processData: false,
		});

		request.done(function(data){

			if(data.has_error){
				$('.article_error').html(data.error);
				$('.article_error').dialog("open");
			}else{

				$('categories_select').val("");
				$('.subcategories_select').val("");
				$(".article_title").val("");
				tinymce.get('article_content').setContent("");
				$(".article_upload_img").css('color', 'green');

				display_all_articles_in_table(data);
			}
		})

	});


});