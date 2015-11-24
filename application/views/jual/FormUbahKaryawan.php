<h2>Info Karyawan</h2>

<form method="post" action="<?php echo base_url() ?>index.php/jual/UbahKaryawan/<?php echo $DataKaryawan->id_karyawan ?>">
	<div>
		<label>Nama Karyawan</label>
		<div>
			<input type="text" name="nama_karyawan" class="span5" value="<?php echo $DataKaryawan->nama_karyawan ?>" required>
		</div>
	</div>
	<div>
		<label>Jabatan</label>
		<div>
			<input type="text" name="jabatan" class="span5" value="<?php echo $DataKaryawan->jabatan ?>" required>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ubah Info</button>
</form>