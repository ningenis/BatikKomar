<h2>Tambah Produk</h2>
<form method="post" action="<?php echo base_url() ?>index.php/jual/TambahProduk">
	<div class="control-group">
		<label class="control-label">Kode Motif</label>
		<?php echo form_dropdown('kode_motif', $DaftarBatik, '', 'class="chosen input-block-level"') ?>
	</div>
	<div class="control-group">
		<label class="control-label">Nama Produk</label>
		<div class="controls">
			<input type="text" name="nama_produk" class="span5" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Harga Satuan</label>
		<div class="controls">
			<input type="text" name="harga_satuan" class="span5" required>
		</div>
	</div>
	<button class="btn btn-primary" type="submit">Tambahkan Produk Baru</button>
</form>