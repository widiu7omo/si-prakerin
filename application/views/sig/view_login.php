<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>
<main>
	<div class="container" style="margin-top: 33px;">
		<div class="row">
			<div class="col-lg-12">
				<div id="sign-in-dialog" class="zoom-anim-dialog">
					<form action="<?php echo base_url('sig/login');?>" method="POST">
						<div class="sign-in-wrapper">
							<div class="form-group">
								<label>Nama Pengguna</label>
								<input type="text" class="form-control" name="username" id="username" placeholder="Masukan Nama Pengguna">
								<i class="ti-user"></i>
							</div>
							<div class="form-group">
								<label>Kata Sandi</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Masukan Kata Sandi">
								<i class="ti-lock"></i>
							</div>
							<hr>
							<div class="text-center"><input type="submit" name="PLogin" value="Masuk" class="btn_1 full-width"></div>
						</div>
					</form>
					<!--form -->
				</div>
			</div>
			<!-- /col -->
		</div>
	</div>
	<!-- /container -->
</main>
<!--/main-->
