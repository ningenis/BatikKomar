		</div>
	</div>
</body>

<div id="ModalKonfirmasiLogout" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel">Konfirmasi Logout</h3>
	</div>
	<div class="modal-body">
		Apa Anda yakin ingin keluar dari Nemesis ?
	</div>
	<div class="modal-footer">
		<a href="<?php echo base_url() ?>index.php/gerbang/FormLogout" class="btn btn-danger">Ya Logout</a>
	</div>
</div>

</html>

<script>
$(document).ready(function() {
	$('.chosen').chosen();
});
</script>