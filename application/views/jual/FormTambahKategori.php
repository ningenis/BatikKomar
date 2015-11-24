<h2>Tambah Motif Batik</h2>
<form method="post" action="<?php echo base_url() ?>index.php/jual/TambahKategori">
	<div>
		<div class="control-group">
			<label class="control-label">Kode Motif</label>
			<div class="controls">
				<input type="text" name="kode_motif" class="span5">
			</div>
		<div class="control-group">
			<label class="control-label">Nama Motif</label>
			<div class="controls">
				<input type="text" name="nama_motif" class="span5">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Nama Pembuat</label>
			<div class="controls">
				<input type="text" name="nama_pembuat" class="span5">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Tanggal Dibuat (YYYY-MM-DD)</label>
			<div class="controls">
				<input type="text" name="tanggal_dibuat" class="span5">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Kategori</label>
			<select name="kategori" class="chosen">
					<option value="TULIS">TULIS</option>
					<option value="CAP">CAP</option>
				</select>
		</div>
		<button class="btn btn-primary" type="submit">Tambahkan Motif Batik Baru</button>
	</div>
</form>