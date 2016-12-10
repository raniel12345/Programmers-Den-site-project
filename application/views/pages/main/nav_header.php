	<header id="top">
		<div class="header">
			<div class="container">
				<div class="page_header">
					<a href="<?php echo base_url('main'); ?>"><h1>Programmers' Den</h1></a>
					<span>College Of Computer Studies | </span>
					<span>Tarlac State University</span>
				</div>
				<?php if($this->session->logged_in): ?>
					<div class="user_name">
						<h3><?php echo $this->session->std_num; ?> | <a href="<?php echo base_url('user_logout'); ?>">Logout</a></h3>
					</div>
				<?php endif; ?>
				<!-- <div class="page_search">
					<input type="text" class="" name="search_query" placeholder="Search">
					<button type="submit" id="btnSearch" class="btn-warning">Search</button>
				</div> -->
				<div class="clear"></div>
				<div class="page_nav">

					<!-- For Home page navbar -->
					<?php if($page_flag == 'home'):  ?>
						<nav>
							<ul>
								<a href="#our_events"><li>EVENTS</li></a>
								<a href="#our_articles"><li>ARTICLES</li></a>
								<a href="#our_tutorials"><li>TUTORIALS</li></a>
								<?php if(!$this->session->logged_in): ?>
									<a href="#about_us_contact_our_admin"><li>ABOUT US</li></a>
									<a href="#about_us_contact_our_admin"><li>CONTACT US</li></a>
									<a href="#our_login"><li class='login'>LOG-IN</li></a>
									<a href="#our_sign_up"><li class='sign-up'>SIGN-UP</li></a>
								<?php else: ?>
									<a href="#our_subject_section"><li class='groups'>GROUPS</li></a>
								<?php endif; ?>
							</ul>
							<div class="handle">Menu</div>
						</nav>
					<?php endif; ?>

					<?php if($page_flag == 'articles'):  ?>
						<nav>
							<ul>
								<a href="<?php echo base_url('#our_events'); ?>"><li>EVENTS</li></a>
								<a href="<?php echo base_url('#our_articles'); ?>"><li>ARTICLES</li></a>
								<a href="<?php echo base_url('#our_tutorials'); ?>"><li>TUTORIALS</li></a>
								
								<?php if(!$this->session->logged_in): ?>
									<a href="<?php echo base_url('#about_us_contact_our_admin'); ?>"><li>ABOUT US</li></a>
									<a href="<?php echo base_url('#about_us_contact_our_admin'); ?>"><li>CONTACT US</li></a>
									<a href="<?php echo base_url('#our_login'); ?>"><li class='login'>LOG-IN</li></a>
									<a href="<?php echo base_url('#our_sign_up'); ?>"><li class='sign-up'>SIGN-UP</li></a>
								<?php else: ?>
									<a href="<?php echo base_url('#our_subject_section'); ?>"><li>ABOUT US</li></a>
								<?php endif; ?>
							</ul>
							<div class="handle">Menu</div>
						</nav>
					<?php endif; ?>
						
				</div>
			</div>
		</div>
	</header>