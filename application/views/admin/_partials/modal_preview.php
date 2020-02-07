<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Kelengkapan Berkas Mahasiswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<iframe id="preview-berkas" class="col-md-12 px-0" style="border-radius: 6px"
						height="500px"
						src="<?php echo base_url('/ViewerJS/#../file_upload/berkas/') ?>"
						frameborder="0"></iframe>
			</div>
			<div class="modal-footer">
				<button id="btn-ulang" type="button" class="btn btn-sm btn-warning text-white" data-dismiss="modal">
					Upload ulang
				</button>
				<a id="btn-terima" class="btn btn-sm btn-success text-white">Terima</a>
			</div>
		</div>
	</div>
</div>
