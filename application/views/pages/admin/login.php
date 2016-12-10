	<?php 
		if($this->session->logged_in && $this->session->has_userdata('logged_in') ){
			redirect('admin_dashboard');
		}
	?>

	<div class="login_page">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="login_form">
						<form method="post" class="admin_login_frm">
							<div class="form_title">
								<h2>Admin Login</h2>
							</div>
							<div class="form_body">
								<div class="form-group">
									<input type="text" name="username" class="username" placeholder="Username">
								</div>
								<div class="form-group">
									<input type="password" name="password" class="password" placeholder="Password">
								</div>
							</div>
							<div class="form_footer">
								<div class="form-group">
									<p class="error"></p>
								</div>
								<div class="form-group">
									<a href="#">Forget Password?</a>
								</div>
								<div class="form-group">
									<button class='btn btn-warning login_btn'>Login</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
			</div>
		</div>
	</div>



	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/admin_login_controller.js'); ?>"></script>
