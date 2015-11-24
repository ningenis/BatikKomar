<h2>Info Motif</h2>

<form method="post" action="<?php echo base_url() ?>index.php/jual/UbahMotif/<?php echo $DataBatik->kode_motif ?>">
	<div>
		<label>Nama Motif</label>
		<div>
			<input type="text" name="nama_motif" class="span5" value="<?php echo $DataBatik->nama_motif ?>" required>
		</div>
	</div>
	<div>
		<label>Nama Pembuat</label>
		<div>
			<input type="text" name="nama_pembuat" class="span5" value="<?php echo $DataBatik->nama_pembuat ?>" required>
		</div>
	</div>
	<div>
		<label>Tanggal Dibuat</label>
		<div>
			<input type="text" name="tanggal_dibuat" class="span5" value="<?php echo $DataBatik->tanggal_dibuat ?>" required>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ubah Info</button>
</form>