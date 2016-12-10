$(".search_article_input").keyup(function(){
	//console.log($(".search_article_input").val());
	if($(".search_article_input").val() != ''){
		search_this_article($(".search_article_input").val(), display_search_results_datalist);
	}
	
});

$(".search_frm").on("submit",function(e){
	e.preventDefault();

	if($(".search_article_input").val() != ''){
		search_this_article($(".search_article_input").val(), display_search_results);
	}

});

function display_search_results(data){
	var display_results = "";

	var article_search_results = $(".article_search_results");

	$.each(data, function(i, item){
		display_results += "<p class='search_results_header' id='"+item.id+"/"+item.slug+"'>"+item.title+"</p>";
		var limit_text = content_len_limit();
		var article_content = get_article_content(item.content, limit_text);

		display_results += "<p class='search_results_description'>"+article_content+"</p>";
	});

	article_search_results.html(display_results);

	$(".search_results_header").on("click",function(){
		window.location = base_url + "articles/" + $(this).attr('id');
	});

}

function get_article_content(content, limit){
	$(".article_search_content_hidden").html(content);
	var article_content_hidden = $(".article_search_content_hidden").text();
	var article_content_len = article_content_hidden.length;
	var article_content = "";
	for(var j=0; j<article_content_len; j++){
		if( j == limit )
			break
		article_content += article_content_hidden[j];
	}

	return article_content;
}

function content_len_limit(){
	var content_len_list = [100, 120, 130, 150, 170, 200];
	var content_len_list_len = content_len_list.length;
	var i = Math.floor((Math.random() * content_len_list_len) + 1);

	var limit = content_len_list[i];
	if(limit == undefined){
		limit = 100;
	}

	return limit;
}


function display_search_results_datalist(data){
	var display_results = "";
	var data_list = $(".search_results");

	$.each(data, function(i, item){
		display_results += "<option value='"+item.title+"' class='article_data_list'>"+item.title+"</option>";
	});

	data_list.html(display_results);
}

$($(".search_results").on("click",function(){
		//$(".search_frm").submit();
		alert($(this).val());
}));


function search_this_article(input, callBackFunc){
	$.post(
		base_url+"/search_article",
		{
			"search_input": input
		},
		function(data){
			callBackFunc(data);
		}
	);
}