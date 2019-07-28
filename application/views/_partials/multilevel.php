<?php $levels = $this->session->flashdata('multilevel');
var_dump($levels);
?>
<form action="<?php echo site_url('login?in=multi') ?>" method="POST">
	<div class="modal fade" id="levelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="levelModalLabel">Tampaknya anda memiliki level lebih dari satu</h5>
				</div>
				<div class="modal-body">
					<select class="form-control" name="level">
						<?php foreach($levels as $level): ?>
						<option value='[<?php echo '"'.$level->id.'","'.$level->userpass.'","'.$level->level.'"' ?>]'>
							<?php echo ucfirst($level->level) ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</div>
		</div>
	</div>
</form>
