	
	<section id="our_articles">
		<div class="page_post_article">
			<article>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<div class="article_head">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="article_title">
											<h3>Article Posts</h3>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="article_search">
											<form class="search_frm">
												<div class="form-group">
													<label for="article_search">
													    <input type="text" id="article_search" class="search_article_input" placeholder="Search" list="results">
													    <datalist id="results" class="search_results">
													    </datalist>
													</label>
												</div>
											</form>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="article_search_results">
										</div>
										<div class="article_search_content_hidden"></div>
									</div>
								</div>

								<div class="clear"></div>
							</div>
							<hr/>
						</div>

						<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
							<div class="page_articles">
								<?php if(sizeof($articles) >= 1): ?>
									<?php /*if($is_reading_flag):*/ ?>
										<div class="articles">
											<div class="row">

												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<header>
														<div class="article_header">
															<div class="page_article_header">
																<h3><?php echo $articles['title']; ?></h3>
															</div>

															<img src="<?php echo base_url('/assets/img/upload_imgs/article/'.$articles['image_name']); ?>" class='article_img_view' >
															<p>
																Published on <?php echo $articles['post_date']; ?>
																<br/>
																<?php echo $category['category']." > ".$sub_category['subcategory']; ?>
															</p>
														</div>
													</header>
													<p>
														<?php echo $articles['content']; ?>
													</p>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<!-- Displaying comments here -->
													<div class="article_comments"></div>

													<?php if($this->session->logged_in): ?>
														<div class="panel panel-default">
															<div class="panel-heading">
																<header>
																	<img class="user_img" src="<?php echo base_url("assets/img/icon/anonymous.png"); ?>">
																	<?php echo $this->session->username; ?>
																</header>
															</div>
															<div class="panel-body">
																<textarea class="article_comment_box"></textarea>
															</div>
															<div class="panel-footer">
																<button class="btn btn-warning btn_share_comment">Share</button>
																<p class="comment_warning"></p>
															</div>
														</div>
														<!-- Global variable for user_id -->
														<script type="text/javascript"> var user_id = <?php echo $this->session->user_id; ?> </script>
													<?php else: ?>
														<p class="let_me_share_comment">Comment: </p>
														<p class="login_message"></p>
													<?php endif; ?>
												</div>
											</div><!-- end row -->
										</div>
									<?php /*endif;*/ ?>
								<?php endif; ?>
								<!-- http://bootsnipp.com/snippets/featured/comment-box -->
							</div>
						</div>
						<!-- Related Articles -->
						<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
							<div class="page_related_article">
								<div class="page_related_article_header">
									<h3>Related Post</h3>
								</div>
								<div class="related_articles">
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 related_art">
											<div class="row">

												<?php
													$related_articles_len = sizeof($related_articles);
													$limit = 4;

													for($i=0; $i < $related_articles_len; $i++){

														if($articles['id'] == $related_articles[$i]['id']){
															$limit += 1;
															continue;
														}

														if($i == $limit)
															break;

														echo "<div class='col-xs-6 col-sm-12 col-md-12 col-lg-12' >";
															echo "<header>";
																echo "<div class='article_header'>";
																	echo "<img src='".base_url('/assets/img/upload_imgs/article/'.$related_articles[$i]['image_name'])."' class='article_img' id='".$related_articles[$i]['id']."/".$related_articles[$i]['slug']."'>";
																	echo "<p>Published on ".$related_articles[$i]['post_date']."</p>";
																	echo "<a href='#' class='article_link' id='".$related_articles[$i]['id']."/".$related_articles[$i]['slug']."'><h3>".$related_articles[$i]['title']."</h3></a>";
																echo "</div>";
															echo "</header>";
															echo "<p>";
																//echo $related_articles[$i]['content'];
															echo "</p>";
															echo "<hr class='arti_separator'>";
														echo "</div>";
													}
												?>
											</div>
										</div>

										<!-- Old Post articles -->
										<div class="old_post_articles">
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

														<?php
															$limit = 13;
															for($j=4; $j < $related_articles_len; $j++){

																if($articles['id'] == $related_articles[$j]['id']){
																	$limit += 1;
																	continue;
																}

																if($j == $limit)
																	break;

																echo "<a href='#' class='old_articles' id='".$related_articles[$j]['id']."/".$related_articles[$j]['slug']."'><p>".$related_articles[$j]['title']."</p></a>";
																echo "<p class='old_arti_date'>".$related_articles[$j]['post_date']."</p>";
																echo "<hr/>";
															}
														?>

													</div>
												</div>
											</div><!-- End Old Post articles -->	
										</div>
									</div>
								</div><!-- end related_articles -->
							</div><!-- end page_related_article -->
						</div>
					</div>
				</div>
			</article>
		</div><!-- page_post_article -->
	</section>
	<!--End Articles -->

	<!-- <script type="text/javascript"> var base_url = "<?php echo base_url(); ?>"; </script> -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/article_search_section.js'); ?>"></script>

	<script type="text/javascript">
		
		$(".article_img").on("click",function(){
			window.location = base_url + "articles/" + $(this).attr('id');
		});

		$(".article_link").on("click",function(){
			window.location = base_url + "articles/" + $(this).attr('id');
		});

		$(".old_articles").on("click",function(){
			window.location = base_url + "articles/" + $(this).attr('id');
		});
	</script>

	<script type="text/javascript"> var article_id = "<?php echo $articles['id']; ?>"; </script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/article_comment_section.js'); ?>"></script>