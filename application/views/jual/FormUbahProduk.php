<h2>Info Produk</h2>

<form method="post" action="<?php echo base_url() ?>index.php/jual/UbahProduk/<?php echo $DataProduk->id_produk ?>">
	<div>
		<label>Kode Motif</label>
		<div>
			<input type="text" name="kode_motif" class="span5" value="<?php echo $DataProduk->kode_motif ?>" required>
		</div>
	</div>
	<div>
		<label>Nama Produk</label>
		<div>
			<input type="text" name="nama_produk" class="span5" value="<?php echo $DataProduk->nama_produk ?>" required>
		</div>
	</div>
	<div>
		<label>Harga Satuan</label>
		<div>
			<input type="text" name="harga_satuan" class="span5" value="<?php echo $DataProduk->harga_satuan ?>" required>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ubah Info</button>
</form>