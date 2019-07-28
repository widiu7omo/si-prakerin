<div class="sub_header_in">
	<div class="container">
		<h1><?= $form_nama?></h1>
	</div>
</div>

<main>
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-12">
				<div role="tablist" class="add_bottom_45 accordion_2">
					<div class="card">
						<div class="main_title_2">
							<p>
								<h3><?= $t_halaman->nama_halaman; ?></h3>
							</p>
							<span><em></em></span>
						</div>
						<div calss="justify-content-between">
							<div class="col-lg-12">
								<?= $t_halaman->konten_halaman; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
