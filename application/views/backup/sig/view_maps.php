<main id="ts-main" style="margin-top: 114px;">
	<section id="search-form">
		<div class="container">
			<form id="form-search" class="ts-form" action="<?php echo site_url('sig/maps/perusahaan_search');?>" method="GET">
				<section class="ts-box p-0">
          <div class="form-row px-4 py-3">
						<div class="col-sm-12 col-md-12">
							<div class="form-group my-2">
								<input type="text" class="form-control" id="keyword" name="keyword" placeholder="Cari Perusahaan">
							</div>
            </div>
					</div>
				</section>
			</form>
		</div>
	</section>
	<section id="page-title">
		<div class="container">
			<div id="mapid" style="height: 500px;" class="ts-title">
			</div>
		</div>
	</section>
</main>
