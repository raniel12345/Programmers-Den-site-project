$(document).ready(function(){

	$(function(){

		var request_article_items = $.ajax({
			type: 'POST',
			url: 'all_articles'
		})

		request_article_items.done(function(articleItems){
			display_articles(articleItems);
		})

		request_article_items.fail(function(){
			alert('error on loading article items');
		})
	});


	function display_articles(articleItems){

		if( articleItems[0] != "undefined" )
			display_new_articles(articleItems[0]);// new article or the first article

		if( articleItems[1] != "undefined"){
			var first = $(".recent_articles .first");
			display_recent_articles(articleItems[1],first);
		}

		if( articleItems[2] != "undefined"){
			var second = $(".recent_articles .second");
			display_recent_articles(articleItems[2],second);
		}

		if( articleItems[3] != "undefined" ){
			var first = $(".recent_side_articles .first");
			display_recent_side_articles(articleItems[3], first);
		}

		if( articleItems[4] != "undefined" ){
			var second = $(".recent_side_articles .second");
			display_recent_side_articles(articleItems[4], second);
		}

		display_old_articles(articleItems);


		// when the user click the image of the article
		/*$('.article_img').on('click',function(){
			window.location = base_url + "articles/" + $(this).attr('id');
			//alert($(this).attr('id'));
		});

		$(".article_link").on("click",function(){
			window.location = base_url + "articles/" + $(this).attr('id');
			alert($(this).attr('id'));
		});*/

	}

	function display_new_articles(item){


		var display_new_article = "";
		var article_img_uri = "";
		// id, slug, title, content, image_name, post_data, sub_category_id, admin_id, is_activated 
	
		display_new_article += "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>";
			display_new_article += "<header>";
				display_new_article += "<div class='article_header'>";

					article_img_uri = base_url +"/assets/img/upload_imgs/article/"+item.image_name;
					display_new_article += "<img src='"+article_img_uri+"' class='article_img' id='"+item.id+"/"+item.slug+"'>";

					display_new_article += "<p>Published on "+item.post_date+"</p>";// post_date, and category and sub
					display_new_article += "<a href='articles/"+item.id+"/"+item.slug+"' id='"+item.id+"/"+item.slug+"' class='article_link'><h3>"+item.title+"</h3></a>";
				display_new_article += "</div>";
			display_new_article += "</header>";

			$(".hidden_new_content").html(item.content);
			var content_text = $(".hidden_new_content").text();
					
			var content_len = content_text.length;

			var content = "";
			for(var i=0; i<content_len; i++){
				if(i != 140)
					content += content_text[i];
				else
					break;
			}

			display_new_article += "<p>" + content + " .....</p>";
			display_new_article += "<hr/>";
		display_new_article += "</div>";

		$(".new_articles").html(display_new_article);

		
	}



	function display_recent_articles(item, div){
		
		var display_recent_article = "";
		var article_img_uri = "";
		// id, slug, title, content, image_name, post_data, sub_category_id, admin_id, is_activated 
	
		display_recent_article += "<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>";
			display_recent_article += "<header>";
				display_recent_article += "<div class='article_header'>";

					article_img_uri = base_url +"/assets/img/upload_imgs/article/"+item.image_name;
					display_recent_article += "<img src='"+article_img_uri+"' class='article_img' id='"+item.id+"/"+item.slug+"'>";

					display_recent_article += "<p>Published on "+item.post_date+"</p>";// post_date, and category and sub
					display_recent_article += "<a href='articles/"+item.id+"/"+item.slug+"' id='"+item.id+"/"+item.slug+"' class='article_link'><h3>"+item.title+"</h3></a>";
				display_recent_article += "</div>";
			display_recent_article += "</header>";

			$(".hidden_recent_content").html(item.content);
			var content_text = $(".hidden_recent_content").text();
					
			var content_len = content_text.length;

			var content = "";
			for(var i=0; i<content_len; i++){
				if(i != 140)
					content += content_text[i];
				else
					break;
			}

			display_recent_article += "<p>" + content + " .....</p>";
		display_recent_article += "</div>";

		div.html(display_recent_article);
	}


	function display_recent_side_articles(item, div){
		var display_recent_side_article = "";
		var article_img_uri = "";
		// id, slug, title, content, image_name, post_data, sub_category_id, admin_id, is_activated 
	
		display_recent_side_article += "<div class='col-xs-6 col-sm-12 col-md-12 col-lg-12'>";
			display_recent_side_article += "<header>";
				display_recent_side_article += "<div class='article_header'>";

					article_img_uri = base_url +"/assets/img/upload_imgs/article/"+item.image_name;
					display_recent_side_article += "<img src='"+article_img_uri+"' class='article_img' id='"+item.id+"/"+item.slug+"'>";

					display_recent_side_article += "<p>Published on "+item.post_date+"</p>";// post_date, and category and sub
					display_recent_side_article += "<a href='#' id='"+item.id+"/"+item.slug+"' class='article_link'><h3>"+item.title+"</h3></a>";
				display_recent_side_article += "</div>";
			display_recent_side_article += "</header>";

			$(".hidden_recent_side_content").html(item.content);
			var content_text = $(".hidden_recent_side_content").text();
					
			var content_len = content_text.length;

			var content = "";
			for(var i=0; i<content_len; i++){
				if(i != 140)
					content += content_text[i];
				else
					break;
			}

			display_recent_side_article += "<p>" + content + " .....</p>";
			display_recent_side_article += "<hr/>";
		display_recent_side_article += "</div>";

		div.html(display_recent_side_article);
	}

	function display_old_articles(items){


		var display_old_article = "";
		var items_len = items.length;
		
		for(var i=4; i<items_len; i++){
			display_old_article += "<p class='old_articles article_link' id='"+items[i].id+"/"+items[i].slug+"'>"+items[i].title+"</p>";
			display_old_article += "<p class='old_arti_date'>"+items[i].post_date+"</p>";
			display_old_article += "<hr/>";
		}
		$(".old_aritlces").html(display_old_article);

	}

});
