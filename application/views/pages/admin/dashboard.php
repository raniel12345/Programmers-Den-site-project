	<?php 
		if(!$this->session->logged_in){
			redirect("admin");
		}
	?>
	<div class="full_feature_access">
		<div class="dashboard_content">
			<header>
				<div class="dashboard_header">
					<div class="container">
						<div class="row">
							<div class="dash_header">
								<h2 class='brand'>Programmers' Den</h2>
								<a href="<?php echo base_url('admin_logout'); ?>"><h2 class="logout">Logout</h2></a>
							</div>
							<div class="clear"></div>
							<div class="dash_body">
								<nav>
									<ul>
										<a href="#our_carousel_controller"><li id="carousel_click_me">CAROUSEL</li></a>
										<a href="#our_events_controller"><li id="events_click_me">EVENTS</li></a>
										<a href="#our_accounts_controller"><li id="accounts_click_me">ACCOUNTS</li></a>
										<a href="#our_article_controller"><li id="articles_click_me">ARTICLES</li></a>
										<a href="#"><li id="">TUTORIALS</li></a>
										<a href="#our_about_us_controller"><li id="about_us_click_me">ABOUT US</li></a>
										<a href="#our_messages_controller"><li id="messages_click_me">MESSEGES</li></a>
									</ul>
								</nav>
							</div>	
						</div>
					</div>
				</div>
			</header>

			<div class="space_top"></div>
			<!-- CAROUSEL CONTROLLER -->
			<div id="our_carousel_controller">
				<div class="container">
					<div class="row">
						<div class="page_carousel">
							<section>
								<div class="carousel">
									<div class="carousel_header">
										<h3>Carousel Controller</h3>
									</div>
									<div class="carousel_close">
										<a href="#">
								          <span class="glyphicon glyphicon-remove"></span>
								        </a>
									</div>
									<div class="clear"></div>
									<hr/>
									<div class="carousel_body">
										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
											<div class="carousel_form">

												<?php 
													$form_attr = array('class' => 'carouselForm');
													//add_new_carousel
													echo form_open_multipart('',$form_attr); 
												?>
													<div class="form-group">
														<input type="text" class="form-control" id="carousel_title" name="carousel_title" placeholder="Title" required />
													</div>
													<div class="form-group">
													<input type="text" class="form-control" id="carousel_description" name="carousel_description" placeholder="Small Description" required />
													</div>
													<div class="form-group">
														<span class="btn btn-default btn-file">
													        <input type="file" id="carousel_upload_img" name="carousel_upload_img" required />
													    </span>
														<!-- <input type="file" id="carousel_upload_img" name="carousel_upload_img" size='100' required> -->
													</div>
													<!-- <button id='add_this_carousel_btn' class="btn btn-warning btn-block">Save</button> -->
													<input type="submit" id="add_this_carousel_btn" name="add_this_carousel_btn" Value="Save" class="btn btn-warning btn-block">
												</form>

												<div class='carousel_error_message'>
													<!-- <p class="error">
														<?php 
															/*if( $this->session->flashdata('errors') ){
																echo $this->session->flashdata('errors');
															}*/
														?>
													</p> -->
												</div>
											</div>
										</div>

										<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
											<div class="my_carousel">
												<div class="imgs-my-carousel" id="carousel_images">
													<!-- <div class="carousel slide" id="myCarousel" data-ride="carousel"> -->
														<div id="carousel_images"></div>

														<!-- Left and Right controller -->
														<!-- <a href="#myCarousel" class="left carousel-control" role="button" data-slide="prev">
															<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
														</a>
														<a href="#myCarousel" class="right carousel-control" role="button" data-slide="next">
															<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
															<span class="sr-only">Next</span>
														</a> -->
														<?php
															/*$carousel_item_size = sizeof($carousel_item);
															
															if($carousel_item_size > 0){
																echo "<ol class='carousel-indicators carousel_indicators'>";
																	for($i=0; $i<$carousel_item_size; $i++){

																		if($carousel_item[$i]['is_activated'] === 'TRUE'){
																			echo "<li data-target='#myCarousel' data-slide-to='".$carousel_item[$i]['id']."'></li>";
																		}
																	}
																echo "</ol>";

																echo "<div class='carousel-inner carousel_inner_item' role='listbox'>";
																
																	for($i=0; $i<$carousel_item_size; $i++){
																		if($carousel_item[$i]['is_activated'] === 'TRUE'){
																			echo "<div class='item item-carousel'>";
																				$img_pro = array(
																					'src' => base_url('assets/img/upload_imgs/carousel/'.$carousel_item[$i]['img_name']),
																					'alt' => $carousel_item[$i]['title'],
																					'class' => 'img-responsive img-carousel'
																				);
																				echo img($img_pro);

																				echo "<div class='carousel-caption'>";
																					echo heading($carousel_item[$i]['title']);
																					echo "<p>".$carousel_item[$i]['description']."</p>";
																				echo "</div>";
																			echo "</div>";
																		}
																	}

																echo "</div>";

																	
															}*/
																
														?>

															
													<!-- </div> -->
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

											<div class="upload_pics_wrapper">
												<div class="upload_pics">
													<table class="table table-bordered" id="upload_table">
														<thead>
														    <tr>
														    	<th>No.</th>
														    	<th>Date</th>
																<th>File Name</th>
																<th>Title</th>
																<th>Description</th>
																<th>Edit</th>
																<th>Delete</th>
																<th>Active</th>
																<th>Deactivate</th>
														    </tr>
													    </thead>
														<tbody id="carousel_items">
															<?php
																/*$carousel_item_size = sizeof($carousel_item);

																for($i=0; $i<$carousel_item_size; $i++){
																	echo "<tr>";
																	echo "<td>".$carousel_item[$i]['id']."</td>";
																	echo "<td>".$carousel_item[$i]['date_uploaded']."</td>";
																	echo "<td>".$carousel_item[$i]['img_name']."</td>";
																	echo "<td>".$carousel_item[$i]['title']."</td>";
																	echo "<td>".$carousel_item[$i]['description']."</td>";

																	echo form_open();
																	echo "<td><button class='btn btn-warning'>Edit</button></td>";
																	echo form_close();

																	echo form_open('delete_this_carousel/'.$carousel_item[$i]['id']);
																	echo "<td><input type='submit' name='delete_carousel' class='btn btn-warning' value='Delete'>";
																	echo form_close();

																	
																	if($carousel_item[$i]['is_activated'] === 'TRUE'){
																		echo "<td>".$carousel_item[$i]['is_activated']."</td>";
																	}else{
																		echo form_open('activate_this_carousel/'.$carousel_item[$i]['id']);
																		echo "<td><input type='submit' name='activate_carousel' class='btn btn-warning' value='Activate'>";
																		echo form_close();
																	}
																	

																	if($carousel_item[$i]['is_activated'] === 'FALSE'){
																		echo "<td>".$carousel_item[$i]['is_activated']."</td>";
																	}else{
																		echo form_open('deactivate_this_carousel/'.$carousel_item[$i]['id']);
																		echo "<td><input type='submit' name='deactivate_carousel' class='btn btn-warning' value='Deactivate'>";
																		echo form_close();
																	}
																	
																	echo "</tr>";
																}*/
															?>
														</tbody>
													</table>
												</div>
											</div>
												
										</div>
									</div>
								</div>
							</section>
						</div>

						<!-- Go Top button -->
						<div class="go_top">
							<button type="button" class="btn btn-default btn-sm go_top_btn">
					          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
					        </button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- EVENTS CONTROLLER -->
			<div id="our_events_controller">
				<div class="container myEvents">
					<div class="row">
						<div class="page_events_controller">
							<section>
								<div class="events">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="events_header">
											<h3>Events Controller</h3>
										</div>
										<div class="event_close">
											<a href="#">
									          <span class="glyphicon glyphicon-remove"></span>
									        </a>
										</div>
										<div class="clear"></div>
										<hr/>
									</div>
								
									<div class="event_body">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="event_form">
											<?php
												$attr = array('class'=>'event_image_form');
												echo form_open_multipart('',$attr); 
											?>
												<div class="form-group">
													<input type="text" class="form-control" id="event_title" name="event_title" placeholder="Event Title" required />
												</div>

												<div class="form-group">
													<?php echo display_tinymce('event_description'); ?>
												</div>

												<div class="form-group">
												    <span class="btn btn-default btn-file">
												        Thumbnail<input type="file" id="event_img" required />
												    </span>
													<!-- <input type="file" name="event_img" id="event_img" /> -->
												</div>

												<div class="event_error_message"></div>

												<input type="submit" name="add_this_event_btn" Value="Save" class="add_event_btn btn btn-warning btn-block">
											<?php echo form_close(); ?>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<hr/>
											<div class="upload_pics_wrapper">
												<div class="upload_pics">
													<table class="table table-bordered" id="upload_table">
														<thead>
														    <tr>
														    	<th>ID</th>
														    	<th>Date</th>
																<th>Event Title</th>
																<th>Thumnail</th>
																<th>Preview</th>
																<th>Edit</th>
																<th>Delete</th>
														    </tr>
													    </thead>
														<tbody id="event_items">
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>

						<!-- Go Top button -->
						<div class="go_top">
							<button type="button" class="btn btn-default btn-sm go_top_btn">
					          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
					        </button>
						</div>
					</div>
				</div>
			</div>

			<!-- Accounts Controller -->
			<div id="our_accounts_controller">
				<div class="container myAccounts">
					<div class="row">
						<div class="page_accounts_controller">
							<section>
								<div class="accounts">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="accounts_header">
											<h3>Accounts Controller</h3>
										</div>
										<div class="accounts_close">
											<a href="#">
									          <span class="glyphicon glyphicon-remove"></span>
									        </a>
										</div>
										<div class="clear"></div>
										<hr/>
									</div>
									<div class="accounts_body">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<h4>Visit Summary</h4>
											<table class="table table-bordered" id="upload_table">
												<thead>
												   	<tr>
												    	<th>Max No of Visit/Day</th>
												    	<th>No of Visit/Week</th>
												    	<th>No of Visit/Month</th>
												    	<th>Total of No of visit</th>
												    </tr>
											    </thead>
												<tbody>
													<tr>
														<td>30</td>
														<td>120</td>
														<td>450</td>
														<td>2342</td>
													</tr>
												</tbody>
											</table>
											<hr/>

											<h4>Accounts Summary</h4>
											<table class="table table-bordered" id="upload_table">
												<thead>
												   	<tr>
												    	<th>No of Students</th>
												    	<th>No of Accounts</th>
												    	<th>No of Students no account</th>
												    	<th>No of Students has an account</th>
												    </tr>
											    </thead>
												<tbody>
													<tr>
														<td>3000</td>
														<td>500</td>
														<td>2500</td>
														<td>500</td>
													</tr>
												</tbody>
											</table>
											<hr/>
											<div class="upload_pics_wrapper">
												<div class="upload_pics">
													<h4>Accounts</h4>
													<table class="table table-bordered" id="upload_table">
														<thead>
														    <tr>
														    	<th>ID</th>
														    	<th>Student No.</th>
																<th>Username</th>
																<th>Full Name</th>
																<th>Department</th>
																<th>Date-Time created</th>
																<th>Profile Pic. Filename</th>
																<th>Last visit</th>
																<th>No of visit</th>
																<th>Visited Page</th>
																<th>Delete</th>
														    </tr>
													    </thead>
														<tbody>
															<tr>
																<td>1</td>
																<td>2012101218</td>
																<td>Tyler</td>
																<td>Raniel Gomez Garcia</td>
																<td>BSCS</td>
																<td>9/26/2016-1:32am</td>
																<td>pogi_ako.jpg</td>
																<td>9/26/2016-3:00am</td>
																<td>100</td>
																<td>1,2,3,4,5,6</td>
																<td><button class="btn btn-warning">Delete</button></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>

						<!-- Go Top button -->
						<div class="go_top">
							<button type="button" class="btn btn-default btn-sm go_top_btn">
					          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
					        </button>
						</div>
					</div>
				</div>
			</div>

			<!-- Article Controller -->
			<div id="our_article_controller">
				<div class="container myArticles">
					<div class="row">
						<div class="page_articles_controller">
							<section>
								<div class="articles">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="articles_header">
											<h3>Articles Controller</h3>
										</div>
										<div class="articles_close">
											<a href="#">
									          <span class="glyphicon glyphicon-remove"></span>
									        </a>
										</div>
										<div class="clear"></div>
										<hr/>
									</div>
									<div class="articles_body">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

												<label>Add Article Category</label>
												<div class="form-group">
													<input type="text" class="form-control" id="new_category" name="new_category" placeholder="New Category">
												</div>
												<div class="form-group">
													<button class="btn btn-warning add_new_category">Add new Category</button>
												</div>
												<div class="articles_categories">
													<div class="categories_wrapper">
														<div class="categories">
															<label for="upload_table">Categories</label>
															<table class="table table-bordered" id="upload_table">
																<thead>
																    <tr>
																    	<th>ID</th>
																    	<th>Categories</th>
																    	<th>Edit</th>
																    	<th>Delete</th>
																    </tr>
															    </thead>
																<tbody class="categories_items"></tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="categories_select_add_subcat">Add Subcategory</label>
													<!-- Displaying all categories here -->
												    <select class="form-control categories_select_add_subcat"></select>
												</div>
												<div class="form-group">
													<input type="text" class="form-control new_subcategory" name="new_subcategory" placeholder="New Sub-Category">
												</div>
												<div class="form-group">
													<button class="btn btn-warning add_new_subcategory">Add new Subcategory</button>
												</div>

												<div class="articles_subcategories">
													<div class="subcategories_wrapper">
														<div class="subcategories">
															<label for="upload_table">Subcategories</label>
															<table class="table table-bordered" id="upload_table">
																<thead>
																    <tr>
																    	<th>ID</th>
																    	<th>Category ID</th>
																    	<th>Subcategories</th>
																    	<th>Edit</th>
																    	<th>Delete</th>
																    </tr>
															    </thead>
																<tbody class="subcategories_items"></tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="clear"></div>
											<div class="article_form">
												<hr/>
												<?php
													$attrb = array('class'=>'new_article_form');
													echo form_open_multipart('',$attrb); 
												?>
													<div class="form-group">
														<label for="categories_select">Categories</label>
														<!-- Displaying all categories here -->
													    <select class="form-control categories_select" required></select>
													</div>
													<div class="form-group">
														<label for="subcategories_select">Subcategories</label>
														<!-- Displaying all subcategories here -->
													    <select class="form-control subcategories_select" required></select>
													</div>

													<div class="form-group">
														<input type="text" class="form-control article_title" name="article_title" placeholder="Article Title" required />
													</div>

													<div class="form-group">
														<?php echo display_tinymce('article_content'); ?>
														<!-- <textarea id="myTextarea" name="evet_description"></textarea> -->
													</div>

													<div class="form-group">
														<span class="btn btn-default btn-file">
													        Thumbnail<input type="file" class="article_upload_img" required />
													    </span>
													</div>
													<input type="submit" name="add_this_article_btn" Value="Save" class="add_article_btn btn btn-warning btn-block">
												</form>
											</div>
											<div class="articles_upload">
												<div class="upload_pics_wrapper">
													<div class="upload_pics">
														<hr/>
														<label for="upload_table">Article uploaded</label>
														<table class="table table-bordered" id="upload_table">
															<thead>
															    <tr>
															    	<th>ID</th>
															    	<th>Category</th>
															    	<th>Subcategory</th>
															    	<th>Title</th>
															    	<th>Author</th>
															    	<th>Time-Date</th>
															    	<th>View</th>
															    	<th>Activate</th>
															    	<th>Deactivate</th>
															    	<th>Delete</th>
															    </tr>
														    </thead>
															<tbody class="all_articles"></tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>

						<!-- Go Top button -->
						<div class="go_top">
							<button type="button" class="btn btn-default btn-sm go_top_btn">
					          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
					        </button>
						</div>
					</div>
				</div>
			</div>

			<!-- Tutorial -->


			<!-- About Us -->
			<div id="our_about_us_controller">
				<div class="container myAboutUs">
					<div class="row">
						<div class="page_about_us_controller">
							<section>
								<div class="about_us">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="about_us_header">
											<h3>About us Controller</h3>
										</div>
										<div class="about_us_close">
											<a href="#">
									          <span class="glyphicon glyphicon-remove"></span>
									        </a>
										</div>
										<div class="clear"></div>
										<hr/>
									</div>
									<div class="about_us_body">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="about_us_form">
												<div class="form-group">
													<?php echo display_tinymce('about_us_content'); ?>
												</div>
												<button class="btn btn-warning btn-block add_this_aboutus_btn">Save</button>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<label for="upload_table">Article uploaded</label>
											<div class="about_us_table" id="upload_table">
												<div class="about_us_wrapper">
													<div class="about_content">
														
														<table class="table table-bordered" >
															<thead>
															    <tr>
															    	<th>ID</th>
															    	<th>Content</th>
															    	<th>Activate</th>
															    	<th>Delete</th>
															    </tr>
														    </thead>
															<tbody class="all_about_us"></tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</section>
						</div>

						<!-- Go Top button -->
						<div class="go_top">
							<button type="button" class="btn btn-default btn-sm go_top_btn">
					          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
					        </button>
						</div>
					</div>
				</div>
			</div>


			<!-- Messages -->
			<div id="our_messages_controller">
				<div class="container myMessages">
					<div class="row">
						<div class="page_messages_controller">
							<section>
								<div class="messages">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="messages_header">
											<h3>Messages Controller</h3>
										</div>
										<div class="messages_close">
											<a href="#">
									          <span class="glyphicon glyphicon-remove"></span>
									        </a>
										</div>
										<div class="clear"></div>
										<hr/>
									</div>
									<div class="messages_body">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="upload_pics_wrapper">
												<div class="messages_list">
													<label for="upload_table">Messages (Sort by Date and Time)</label>
													<table class="table table-bordered" id="upload_table">
														<thead>
														    <tr>
														    	<th>ID</th>
														    	<th>Time/Date</th>
														    	<th>Name</th>
														    	<th>Email</th>
														    	<th>Phone No.</th>
														    	<th>Message</th>
														    	<th>View Message</th>
														    	<th>Delete Message</th>
															</tr>
													    </thead>
														<tbody>
															<tr>
																<td>1</td>
																<td>Sept. 28 2016</td>
																<td>Raniel Garcia</td>
																<td>ranielgarcia2596@gmail.com</td>
																<td>09304631283</td>
																<td>This is sample Message.....</td>
																<td><button class="btn btn-warning">View</button></td>
																<td><button class="btn btn-warning">Delete</button></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<!-- Go Top button -->
						<div class="go_top">
							<button type="button" class="btn btn-default btn-sm go_top_btn">
					          <span class="glyphicon glyphicon-chevron-up"></span> Go Back
					        </button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
	</div>
	<div class="warning"><p>Please Don't use smaller device to view this page to get full features</p></div>
	<div class="gotoTop">
		<a href="#top" class="goTop"><p>Go Top</p></a>
	</div>

	<!-- Delete Message dialog -->
	<div id="deleteMsg_crsl" title="Delete">
    	Delete this item?
    </div>




    <!-- Warning for input fields -->
    <div id="warningInputFld" title="5 characters in length">
    	All input field must be at least 5 characters in length.
    </div>

    <!-- Edit Dialog Form -->
    <div id="editForm" title="Edit this item?">
    	<form>
    		<div class="form-group">
				<input type="text" class="form-control" id="carousel_title_edit" name="carousel_title_edit" placeholder="Title" required />
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="carousel_description_edit" name="carousel_title_edit" placeholder="Small Description" required />
			</div>
    	</form>
    </div>
	<!-- Error for carousel -->
	<div class="carousel_error" title="Carousel Errors">
    	<p class="cError"></p>
    </div>

    <!-- Error message for event -->
    <div class="event_error" title="Event Errors">
    	<p class="eError"></p>
    </div>

    <!-- Delete dialog for event -->
    <div id="deleteMsg_event" title="Delete">
    	Delete this item?
    </div>

    <div class="edit_or_update_event" title="Edit event">
    	Edit this event?
    </div>

    <div class="deleteMsg_article" title="Delete Article">
    	Delete this Article?
    </div>

    <div class="deleteMsg_category" title="Delete Category">
    	Are you sure, you wan't to delete this category?
    </div>

    <div class="deleteMsg_subcategory" title="Delete Category">
    	Are you sure, you wan't to delete this subcategory?
    </div>
	<!-- Edit Dialog Form for Categories-->
    <div class="editForm_cat" title="Edit this item?">
    	<form>
    		<div class="form-group">
				<input type="text" class="form-control category_edit" placeholder="Category" />
			</div>
    	</form>
    </div>
    <!-- Edit Dialog Form for Subcategories-->
    <div class="editForm_subcat" title="Edit this item?">
    	<form>
    		<div class="form-group">
				<input type="text" class="form-control subcategory_edit" placeholder="Subcategory" />
			</div>
    	</form>
    </div>
    <!-- Article error message -->
    <div class="article_error" title="Article Errors"></div>

    <!-- About Us error message -->
    <div class="about_us_error" Title="About Us errors"></div>

    <div class="deleteMsg_about_us" title="Delete Item about us">
    	Delete this one content?
    </div>

	<!-- Global variable to use the base_url on other javascript files -->
	<script type="text/javascript"> var base_url = "<?php echo base_url(); ?>"; </script>
	<script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/tinymce_init.js'); ?>"></script>

	
	<script type="text/javascript" src="<?php echo base_url('assets/js/carousel_controller.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/event_controller.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/article_controller.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/about_us_controller.js') ?>"></script>