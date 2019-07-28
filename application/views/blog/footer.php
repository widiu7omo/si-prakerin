<!--	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul id="additional_links">
						<li><strong><a href="#">Politeknik Negeri Tanah Laut</a></strong></li>
						<li><strong><?= '@'.date('Y').' Sistem Informasi Prakerin'?></strong></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
<footer>
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-6">
					<ul id="footer-selector">
						<li>
							<div class="styled-select" id="lang-selector">
								<select>
									<option value="Indonesia" selected>Indonesia</option>
								</select>
							</div>
						</li>
						<li><img src="img/cards_all.svg" alt=""></li>
					</ul>
				</div>
				<div class="col-lg-6">
					<ul id="additional_links">
						<li><span>© <?= date('Y')?> Sistem Informasi Prakerin</span></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>-->
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->

	<?php if($komponen == 'home'){ ?>
	<!-- COMMON SCRIPTS -->
  <script src="<?= base_url()?>assets/frontend/js/common_scripts.js"></script>
	<script src="<?= base_url()?>assets/frontend/js/functions.js"></script>
	<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
	<script src="<?= base_url()?>assets/frontend/media/lightgallery-all.min.js"></script>
	<script src="<?= base_url()?>assets/frontend/media/jquery.mousewheel.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#lightgallery').lightGallery();
    });
  	</script>
	<?php }?>
	<script src="<?= base_url()?>assets/frontend/jquery.twbsPagination.js"></script>
	<script type='text/javascript'>
		pageSize = 6;
		pagesCount = $(".count_tampil").length;
		var totalPages = Math.ceil(pagesCount / pageSize)

		$('.pagination').twbsPagination({
			totalPages: totalPages,
			visiblePages: 5,
			onPageClick: function (event, page) {
				var startIndex = (pageSize*(page-1))
				var endIndex = startIndex + pageSize
				$('.count_tampil').hide().filter(function(){
					var idx = $(this).index();
					return idx>=startIndex && idx<endIndex;
				}).show()
			}
		});
	</script>
</body>
</html>