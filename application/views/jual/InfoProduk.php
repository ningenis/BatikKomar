<h2>Info Produk</h2>

<form method="post" action="<?php echo base_url() ?>index.php/jual/UbahProduk/<?php echo $InfoProduk->id_produk ?>">
	<div>
		<label>Nama Produk</label>
		<div>
			<input type="text" name="nama_produk" class="span5" value="<?php echo $InfoProduk->nama_produk ?>" required>
		</div>
	</div>
	<div>
		<label>Harga Satuan</label>
		<div>
			<input type="text" name="harga_satuan" class="span5" value="<?php echo $InfoProduk->harga_satuan ?>" required>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Ubah Info</button>
</form>