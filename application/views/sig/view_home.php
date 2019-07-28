<div class="sub_header_in">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-10">
				<h1><?= $form_nama?></h1>
			</div>
			<div class="col-lg-8 col-md-8 col-2">
				<form id="form_search" action="<?php echo site_url('sig/home');?>" method="POST">
				<a href="#0" class="search_mob btn_search_mobile"></a> <!-- /open search panel -->
				<div class="row no-gutters custom-search-input-2 inner">
					<div class="col-lg-12">
						<div class="form-group">
							<input class="form-control" id="title" name="title" type="text" placeholder="Cari Perusahaan ...">
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<!-- /row -->
		<div class="search_mob_wp">
		<form id="form_search" action="<?php echo site_url('sig/home');?>" method="POST">
			<div class="custom-search-input-2">
				<div class="form-group">
					<input class="form-control" id="title_mobile" name="title" style="height: 40px" type="text" placeholder="Cari Perusahaan ...">
				</div>
			</div>
		</form>
		</div>
		<!-- /search_mobile -->
	</div>
</div>

<main>
	<div class="clearfix" id="collapseMap">
		<div id="mapid" class="map"></div>
	</div>
</main>
<!--/main-->
