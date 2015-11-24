<h2>Info Klien</h2>

<form method="post" action="<?php echo base_url() ?>index.php/jual/UbahKlien/<?php echo $InfoKlien->id_pelanggan ?>">
	<div>
		<label>Nama</label>
		<div>
			<input type="text" name="nama_pelanggan" class="span5" value="<?php echo $InfoKlien->nama_pelanggan ?>" required>
		</div>
	</div>
	<div>
		<label>Alamat</label>
		<div>
			<input type="text" name="alamat_pelanggan" class="span5" value="<?php echo $InfoKlien->alamat_pelanggan ?>" required>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ubah Info</button>
</form>