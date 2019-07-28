<main id="ts-main" style="margin-top: 114px;">
	<section id="login-register">
		<div class="container">
			<div class="row">
				<div class="offset-md-2 col-md-8 offset-lg-3 col-lg-6">
					<ul class="nav nav-tabs" id="login-register-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" style="padding-left: 2px;">
								<h4><b>SILAHKAN LOGIN</B></h4>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active show" id="login" role="tabpanel" aria-labelledby="login-tab">
							<form class="ts-form" action="<?php echo base_url('sig/login/login_in');?>" method="POST">
								<div class="form-group">
									<input type="text" class="form-control" name="username" placeholder="Nama Pengguana">
								</div>
								<div class="input-group ts-has-password-toggle">
									<input type="password" class="form-control border-right-0" name="password" placeholder="Password">
									<div class="input-group-append">
										<a href="#" class="input-group-text bg-white border-left-0 ts-password-toggle">
											<i class="fa fa-eye-slash"></i>
										</a>
									</div>
								</div>
								<button type="submit" name="PLogin" class="btn btn-primary">Masuk</button>
						</form>
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
</main>
