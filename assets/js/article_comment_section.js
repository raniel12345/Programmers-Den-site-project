//get_comment_on_this_article



$(".let_me_share_comment").on("click",function(){
	$(".login_message").html("Please Login");
});

$(document).ready(function(){
	get_comments_on_this_article(article_id);
});


function get_comments_on_this_article(id){
	$.post(
			base_url+"get_comment_on_this_article",
			{
				"article_id": id
			},
			function(comments){
				display(comments);
			}
		)
}

function get_user_on_dis_comment(id,user_flag ,div){
	var username = "";
	$.post(
		base_url+"get_username_on_this_comment",
		{
			"id":id,
			"user_flag":user_flag
		},
		function(data){
			$(div).html(data);

			$(".user_img").css("float","left");
			$(div).css("float","left");
		}
	);
}

function display(comments){
	var comments_to_display = "";
	var username_div_class = "";

	comments_to_display += "<hr/>";
	$.each(comments, function(i, item){
		comments_to_display += "<div class='panel panel-default'>";
			//Header
			comments_to_display += "<div class='panel-heading'>";
				comments_to_display += "<header>";
					comments_to_display += "<img class='user_img' src='"+base_url+"assets/img/icon/anonymous.png'/>";
					username_div_class = "username_"+item.user_flag+"_"+item.user_id;
					comments_to_display += "<div class='"+username_div_class+"'></div>";
					get_user_on_dis_comment(item.user_id, item.user_flag,"."+username_div_class);
				comments_to_display += "</header>";
				comments_to_display += "<div class='clear'></div>";
			comments_to_display += "</div>";
			// Body
			comments_to_display += "<div class='panel-body'>";
				comments_to_display += "<p class='comments'>";
					comments_to_display += item.comment;
				comments_to_display += "</p>";
			comments_to_display += "</div>";
			/*// Footer
			comments_to_display += "<div class='panel-footer'>";
				comments_to_display += "<button class='btn btn-warning reply_btn'>Reply</button>";
			comments_to_display += "</div>";*/
		comments_to_display += "</div>";
	});

	$(".article_comments").html(comments_to_display);	
}


$(".btn_share_comment").on("click",function(){
	var comment = $(".article_comment_box");
	if(comment != ""){
		if(comment.val().length > 5){
			$.post(
				base_url+"insert_article_comment",
				{
					"comment": comment.val(),
					"user_id": user_id,
					"article_id": article_id
				},
				function(comments){
					display(comments);
				}
			)
		}else{
			$(".comment_warning").html("Your comment atleast greater than 5");
		}
			
	}
	comment.val("");
});