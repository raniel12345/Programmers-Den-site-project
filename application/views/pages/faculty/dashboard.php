	<?php 
		if(!$this->session->faculty_logged_in && !$this->session->has_userdata('faculty_logged_in') ){
			redirect('faculty');
		}else{
			print_r($this->session->userdata());
		}
	?>

	<div class="faculty_dashboard">	
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 -col-lg-12">
					<div class="faculty_dash_header">
						<a href="<?php echo base_url('main'); ?>" target="_blank"><h2 class='brand'>Programmers' Den</h2></a>
						<h2 class="logout"><?php echo $this->session->faculty_username; ?> | <a href="<?php echo base_url('faculty/logout'); ?>">Logout</a></h2>
					</div>
					<div class="faculty_dash_body">
						
					</div>
				</div>
			</div>
		</div>
			
	</div>
	
	<div class="add_group_controller">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 -col-lg-12">
					<div class="add_group_header">
						<h3>Groups</h3>
					</div>
					<hr/>
				</div>
				<div class="col-xs-12 col-sm-7 col-md-7 -col-lg-7">
					<div class="add_group_body">
						<h3>Create new Group</h3>
						<p>Current Semester: <?php echo get_current_semester(); ?></p>
						<label for=".group_title">Group title</label>
						<div class="form-group">
							<input type="text" class="form-control" id="group_title" class="group_title" name="group_title" placeholder="e.g. FreeElect1_Multimedia_raniel" required />
						</div>
						<div class="add_group_msg"></div>
						<div class="form-group">
							<button class="btn btn-warning create_group_btn">Create</button>
						</div>
						<hr/>

						<label for=".semester">Choose Semester:</label>
						<!-- Display here all semesters -->
						<select class="form-control semester"></select>

						<h3>Current Semester Groups:</h3>
						<div class="group_table">
							<div class="groups_items">
								<table class="table table-bordered" id="groups">
									<thead>
										<tr>
											<th>ID</th>
											<th>title</th>
											<th>Date Created</th>
											<th>View</th>
											<th>Edit</th>
										</tr>
									</thead>
									<tbody class="group_items">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-5 col-md-5 -col-lg-5">
					<div class="view_group">
						<h3 class="view_group_title">Group title here</h3>
						<p class="sem_n_year">Semester and year</p>
						<p>Number of student connected to this group: <a href="#">100</a></p>
						<hr/>

						<label for="#chapter_title">Add chapter</label>
						<div class="form-group">
							<input type="text" class="form-control" id="chapter_title" name="chapter_title" placeholder="e.g Chapter 1 - Introduction" required />
						</div>
						<div class="add_chap_msg"></div>
						<div class="form-group">
							<button class="btn btn-warning add_chapter_btn">Add</button>
						</div>
						<hr/>
						<label for=".chapters_table">Chapters: </label>
						<div class="chapters_table">
							<div class="chapters">
								<div class="chap_msg"></div>
								<table class="table table-bordered" id="groups">
									<thead>
										<tr>
											<th>Title</th>
											<th>Get in</th>
										</tr>
									</thead>
									<tbody id="chapters_items">
										<tr>
											<td>Sample Chapter title</td>
											<td><button class='btn btn-warning'>Get in</button></td>
										</tr>
									</tbody>
								</table>
							</div>
								
						</div>
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

	<div class="goto_chap_controller">
		<a href="#chap_controller"><p>to_chap_con</p></a>
	</div>
	

	<div class="chapters_controller" id="chap_controller">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 -col-lg-12">
					<div class="chap_controller_header">
						<h3 class="chap_title">Chapter title here</h3>
					</div>
					<hr/>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 -col-lg-6">

					<label for="#chapter_title">Add Lecture</label>
					<div class="form-group">
						<span class="btn btn-default btn-file">
							<input type="file" id="upload_lectures" multiple required />
						</span>
					</div>
					<ul>
						<li>File one <a href="#">remove</a></li>
						<li>File two <a href="#">remove</a></li>
					</ul>

					<div class="form-group">
						<button class="btn btn-warning upload_lectures_btn">Upload</button>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 -col-lg-6">
					<div class="lectures_table">
						<div class="lectures">
							<table class="table table-bordered" id="groups">
								<thead>
									<tr>
										<th>File name</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody id="group_items">
									<tr>
										<td>Sample File name</td>
										<td><button class='btn btn-warning'>Delete</button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 -col-lg-12">
					<hr/>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 -col-lg-6">
					<h3>Comments</h3>
					<div class="lectures_comments">
						<div class="panel panel-default">
							<div class="panel-heading">
								<header>
									<img class="user_img" src="<?php echo base_url("assets/img/icon/anonymous.png"); ?>">
										Anonymous
								</header>
								</div>
								<div class="panel-body">
								<p class="comments">Sample Comment on this lecture :D</p>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<header>
									<img class="user_img" src="<?php echo base_url("assets/img/icon/anonymous.png"); ?>">
									Anonymous
								</header>
							</div>
							<div class="panel-body">
								<textarea class="lecture_comment_box"></textarea>
							</div>
							<div class="panel-footer">
								<button class="btn btn-warning lecture_comment_share">Share</button>
								<p class="lecture_comment_warning"></p>
							</div>
						</div>
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

	<div class="faculty_post_article_controller">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 -col-lg-12">
					<div class="post_article_header">
						<h3>Post an articles</h3>
					</div>
					<hr/>
					<div class="post_article_body">
						<label for="#article_title">Article Titler</label>
						<div class="form-group">
							<input type="text" class="form-control" id="article_title" name="article_title" placeholder="Title" required />
						</div>
						<?php echo display_tinymce('faculty_articles'); ?>

						<div class="form-group">
							<button class="btn btn-warning">Post</button>
						</div>

						<hr/>
					</div>
					<div class="post_article_footer">
						<div class="post_article_table">
							<div class="post_articles">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Title</th>
											<th>Content</th>
										</tr>
									</thead>
									<tbody id="group_items">
										<tr>
											<td>Sample article title</td>
											<td><p>asdfasdf asdfasdf asdf</p></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
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

	<div class="gotoTop">
		<a href="#top" class="goTop"><p>Go Top</p></a>
	</div>

	<script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/tinymce_init.js'); ?>"></script>

	<script type="text/javascript">
		var faculty_id = "<?php echo $this->session->faculty_id; ?>";
	</script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/create_group_controller.js'); ?>"></script>