<h3>Tambah Klien</h3>
<form method="post" action="<?php echo base_url() ?>index.php/jual/TambahKlien">
	<div class="control-group">
		<label class="control-label">Nama Klien</label>
		<div class="controls">
			<input type="text" name="nama_pelanggan" class="span5" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Alamat</label>
		<div class="controls">
			<input type="text" name="alamat_pelanggan" class="span5" required>
		</div>
	</div>
	<button class="btn btn-primary" type="submit">Tambahkan Klien Baru</button>
</form>