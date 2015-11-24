<h3>Tambah Karyawan</h3>
<form method="post" action="<?php echo base_url() ?>index.php/jual/TambahKaryawan">
	<div class="control-group">
		<label class="control-label">Nama Karyawan</label>
		<div class="controls">
			<input type="text" name="nama_karyawan" class="span5" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Jabatan</label>
		<div class="controls">
			<input type="text" name="jabatan" class="span5" required>
		</div>
	</div>
	<button class="btn btn-primary" type="submit">Tambahkan Karyawan Baru</button>
</form>