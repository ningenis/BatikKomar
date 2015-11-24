<h2>Info Karyawan</h2>

<form method="post" action="<?php echo base_url() ?>index.php/jual/UbahKaryawan/<?php echo $InfoKaryawan->id_karyawan ?>">
	<div>
		<label>Nama</label>
		<div>
			<input type="text" name="nama_karyawan" class="span5" value="<?php echo $InfoKaryawan->nama_karyawan ?>" required>
		</div>
	</div>
	<div>
		<label>Jabatan</label>
		<div>
			<input type="text" name="jabatan" class="span5" value="<?php echo $InfoKaryawan->jabatan ?>" required>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ubah Info</button>
</form>