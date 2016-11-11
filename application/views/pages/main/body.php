<!-- 	<header id="top">
		<div class="header">
			<div class="container">
				<div class="page_header">
					<a href="#"><h1>Programmers' Den</h1></a>
					<span>College Of Computer Studies | </span>
					<span>Tarlac State University</span>
				</div>
				<div class="page_search">
					<input type="text" class="" name="search_query" placeholder="Search">
					<button type="submit" id="btnSearch" class="btn-warning">Search</button>
				</div>
				<div class="clear"></div>
				<div class="page_nav">
					<nav>
						<ul>
							<a href="#our_events"><li>EVENTS</li></a>
							<a href="#our_articles"><li>ARTICLES</li></a>
							<a href="#our_tutorials"><li>TUTORIALS</li></a>
							<a href="#about_us_contact_our_admin"><li>ABOUT US</li></a>
							<a href="#about_us_contact_our_admin"><li>CONTACT US</li></a>
							<a href="#our_login"><li class='login'>LOG-IN</li></a>
							<a href="#our_sign_up"><li class='sign-up'>SIGN-UP</li></a>
						</ul>
						<div class="handle">Menu</div>
					</nav>
				</div>
			</div>
		</div>
	</header> -->

	<section>
		<!-- Slider -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="imgs-my-carousel">
						<div class="carousel slide" id="myCarousel" data-ride="carousel">
							
							<?php
								$carousel_item_size = sizeof($carousel_item);

								if($carousel_item_size > 0){
									echo "<ol class='carousel-indicators'>";
										echo "<li data-target='#myCarousel' data-slide-to='".$carousel_item[0]['id']."' class='active'></li>";
										for($i=1; $i<$carousel_item_size; $i++){
											if($carousel_item[$i]['is_activated'] === 'TRUE'){
												echo "<li data-target='#myCarousel' data-slide-to='".$carousel_item[$i]['id']."'></li>";
											}
										}
									echo "</ol>";

									echo "<div class='carousel-inner' role='listbox'>";
											echo "<div class='item active'>";
												if($carousel_item[0]['is_activated'] === 'TRUE'){
													echo "<img src='".base_url('assets/img/upload_imgs/carousel/'.$carousel_item[0]['img_name'])."' alt='".$carousel_item[0]['title']."' class='img-responsive img-carousel'>";
													echo "<div class='carousel-caption'>";
														echo "<h3>".$carousel_item[0]['title']."</h3>";
														echo "<p>".$carousel_item[0]['description']."</p>";
													echo "</div>";
												}
											echo "</div>";

											for($i=1; $i<$carousel_item_size; $i++){
												if($carousel_item[$i]['is_activated'] === 'TRUE'){
													echo "<div class='item'>";
														echo "<img src='".base_url('assets/img/upload_imgs/carousel/'.$carousel_item[$i]['img_name'])."' alt='".$carousel_item[$i]['title']."' class='img-responsive img-carousel'>";
														echo "<div class='carousel-caption'>";
															echo "<h3>".$carousel_item[$i]['title']."</h3>";
															echo "<p>".$carousel_item[$i]['description']."</p>";
														echo "</div>";
													echo "</div>";
												}
											}

									echo "</div>";

																
								}
															
							?>

							<!-- Left and Right controller -->
							<a href="#myCarousel" class="left carousel-control" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a href="#myCarousel" class="right carousel-control" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div id="our_login">
		<div class="page_login">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="login">
							<div class="login_header">
								<h3>Login</h3>
							</div>
							<div class="login_body">
								<form class="user_login_frm">
									<div class="form-group">
								      <input type="text" class="form-control user_id" id="stdNum" name="student_number" placeholder="Student Number" required />
								    </div>

								    <div class="form-group">
								      <input type="password" class="form-control user_password" id="stdPswd" name="student_password" placeholder="Password" required />
								    </div>

								    <input type="submit" name="send_this_message" Value="Login" class="btn btn-warning btn-block user_login_btn">
								</form>
								<div class="login_error"></div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<a href="#">
				          <span class="glyphicon glyphicon-remove close_login"></span>
				        </a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="our_sign_up">
		<div class="page_sign_up">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="sign_up">
							<div class="sign_up_header">
								<h3>Sign Up</h3>
							</div>
							<div class="sign_up_body">
								<form>
									<div class="form-group">
								      <input type="text" class="form-control" id="stdNum" name="student_number" placeholder="Student Number" required />
								    </div>

								    <div class="form-group">
								      <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name" required />
								    </div>

								    <div class="form-group">
								      <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name" required />
								    </div>

								    <div class="form-group">
								      <input type="password" class="form-control" id="pswd" name="password" placeholder="Password" required />
								    </div>

								    <div class="form-group">
								      <input type="password" class="form-control" id="confmPswd" name="confirm_password" placeholder="Confirm Password" required />
								    </div>

								    <input type="submit" name="sign_up" Value="Sign Up" class="btn btn-warning btn-block">
								</form>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<a href="#">
				          <span class="glyphicon glyphicon-remove"></span>
				        </a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"></div>
				</div>
			</div>
			
		</div>
	</div>

	<!-- Events -->
	<section id='our_events'>
		<div class="page_events">
			<div class="container">
				<div class="row">
					<div class="events">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<header>
								<div class="events-header">
									<h3>Events</h3>
								</div>
							</header>
							<hr/>
						</div>

						
						<!-- Event panels -->
						<div class="events_items_panels"></div>

						<!-- Spinner -->
						<div class="spinner">
							<img src="<?php echo base_url('assets/img/icon/ellipsis.gif'); ?>">
						</div>

						<!-- Hidden button trigger modal -->
						<input type="hidden" class="read_this_event" data-toggle="modal" data-target="#event_modal"/>

						<!-- Event Modal -->
						<div class="modal fade" id="event_modal" tabindex="-1" role="dialog" aria-labelledby="event_modal_title" aria-hedden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="event_modal_title">Modal Title</h4>
									</div>
									<div class="modal-body">
										<div class="event_img_modal"></div>
										<hr/>
										<div class="event_content_modal"></div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<header>
								<div class="events-footer">
									<div class="more">More...</div>
									<div class="less">Less</div>
								</div>
							</header>
						</div>
					</div><!-- end events -->
				</div><!-- end row -->
			</div><!-- end container -->

			<!-- Go Top button -->
			<div class="go_top">
				<button type="button" class="btn btn-default btn-sm go_top_btn">
		          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
		        </button>
			</div>
		</div>
	</section>
	<!-- End Events -->

	<!-- Articles -->
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
								<div class="page_article_header">
									<h3>New Articles</h3>
								</div>
								<div class="articles"><!-- whole -->
									<div class="row">
										<div class="new_articles">

											<div class="hidden_new_content"></div>
										</div>

										<div class="recent_articles">
											<div class="first"></div>
											<div class="second"></div>
											<div class="hidden_recent_content"></div>
										</div>
									</div><!-- end row -->
								</div>
							</div>
						</div>
						<!-- Related Articles -->
						<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
							<div class="page_related_article">
								<div class="page_related_article_header">
									<h3>Recent Post</h3>
								</div>
								<div class="related_articles">
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 related_art">
											<div class="row">
												<div class="recent_side_articles">
													<div class="first"></div>
													<div class="second"></div>
													<div class="hidden_recent_side_content"></div>
												</div>
											</div>
										</div>

										<!-- Old Post articles -->
										<div class="old_post_articles">
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<div class="old_aritlces"></div>
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

			<!-- Hidden button trigger modal -->
<!-- 			<input type="hidden" class="read_this_article" data-toggle="modal" data-target=".article_modal"/>

			<div class="modal fade article_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="article_modal_title">Modal Title</h4>
						</div>

						<div class="modal-body">
							<div class="article_img_modal"></div>
							<hr/>
							<div class="article_content_modal"></div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div> -->

			<!-- Go Top button -->
			<div class="go_top">
				<button type="button" class="btn btn-default btn-sm go_top_btn">
		          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
		        </button>
			</div>
		</div><!-- page_post_article -->
	</section>
	<!--End Articles -->

	<section id="our_tutorials">
		<div class="page_tutorials">
			<article>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="page_tutorials_header">
								<h3>Tutorials</h3>
							</div>
							<hr/>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
									<h4 class="tutorial_category">Web Development</h4>
									<div class="tutorial_sub_category">
										<a href=""><p>HTML</p></a>
										<a href=""><p>CSS</p></a>
										<a href=""><p>JavaScript</p></a>
										<a href=""><p>PHP</p></a>
										<a href=""><p>ASP.Net</p></a>
										<a href=""><p>MySQL</p></a>
									</div>
										
								</div>
								<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
									<h4 class="tutorial_category">Web Development</h4>
									<div class="tutorial_sub_category">
										<a href=""><p>HTML</p></a>
										<a href=""><p>CSS</p></a>
										<a href=""><p>JavaScript</p></a>
										<a href=""><p>PHP</p></a>
										<a href=""><p>ASP.Net</p></a>
										<a href=""><p>MySQL</p></a>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
									<h4 class="tutorial_category">Web Development</h4>
									<div class="tutorial_sub_category">
										<a href=""><p>HTML</p></a>
										<a href=""><p>CSS</p></a>
										<a href=""><p>JavaScript</p></a>
										<a href=""><p>PHP</p></a>
										<a href=""><p>ASP.Net</p></a>
										<a href=""><p>MySQL</p></a>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
									<h4 class="tutorial_category">Web Development</h4>
									<div class="tutorial_sub_category">
										<a href=""><p>HTML</p></a>
										<a href=""><p>CSS</p></a>
										<a href=""><p>JavaScript</p></a>
										<a href=""><p>PHP</p></a>
										<a href=""><p>ASP.Net</p></a>
										<a href=""><p>MySQL</p></a>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</article>
			<!-- Go Top button -->
			<div class="go_top">
				<button type="button" class="btn btn-default btn-sm go_top_btn">
		          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
		        </button>
			</div>
		</div>
	</section>

	<section id="about_us_contact_our_admin">
		<div class="about_us_n_contact_us">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 -col-lg-6">
						<div class="about_us_header">
							<h3>About Us</h3>
						</div>
						<div class="clear"></div>
						<div class="about_us">
							<p class="about_us_content"></p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 -col-lg-6">
						<div class="contact_us_header">
							<h3>Contact Us</h3>
						</div>
						<div class="contact_us">
							<form class="contact_us_frm">
								<div class="form-group">
							      <input type="text" class="form-control sender_name" name="sender_name" placeholder="Name" required />
							    </div>
							    <div class="form-group">
							      <input type="email" class="form-control sender_email" name="sender_email" placeholder="Email" required />
							    </div>
							    <div class="form-group">
							      <input type="text" class="form-control sender_phone_no" name="sender_phone_no" placeholder="Phone Number" />
							    </div>
							    <div class="form-group">
							      <input type="text" class="form-control subject" name="subject" placeholder="Subject" />
							    </div>
							    <div class="form-group">
								  <textarea class="form-control message" rows="5" placeholder="Message"></textarea>
								</div>
								<input type="submit" name="send_this_message" Value="Send" class="btn btn-warning btn-block">
							</form>
							<p class="contact_us_frm_error"></p>
						</div>
					</div>
				</div>
			</div>
			<!-- Go Top button -->
			<div class="go_top">
				<button type="button" class="btn btn-default btn-sm go_top_btn">
		          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
		        </button>
			</div>
		</div>
	</section>
	<div class="gotoTop">
		<a href="#top" class="goTop"><p>Go Top</p></a>
	</div>

	<script type="text/javascript" src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	<!-- Global variable to use the base_url on other javascript files -->
	<script type="text/javascript"> var base_url = "<?php echo base_url(); ?>"; </script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/login_section.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/event_section.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/articles_section.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/about_us_section.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/contact_us_section.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/article_search_section.js'); ?>"></script>