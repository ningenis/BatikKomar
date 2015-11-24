<h3>Cetak Barcode</h3>

<form method="post" action="<?php echo base_url() ?>index.php/jual/BarcodeCari">
	<div class="control-group">
		<label class="control-label">Nama Produk</label>
		<div class="input-append">
			<input type="text" name="dicari" class="input-xxlarge">
			<button class="btn btn-primary" type="submit">Cari</button>
		</div>
	</div>
</form>

<!-- daftar pencarian -->
<?php if(isset($adaDaftarCari)): ?>
<?php if($adaDaftarCari == 'Ya'): ?>
<table class="table table-bordered table-striped">
	<tr><th>NAMA</th><th>HARGA</th><th>QTY</th></tr>
	<?php foreach($daftarCari as $r): ?>
	<tr>
		<td><?php echo $r->nama_produk ?></td><td>Rp <?php echo number_format($r->harga_satuan, 0, '', '.') ?></td>
		<td>
			<form method="post" action="<?php echo base_url() ?>index.php/jual/BarcodeTambahkan">
				<input type="hidden" name="id" value="<?php echo $r->id_produk ?>">
				<input type="hidden" name="nama" value="<?php echo $r->nama_produk ?>">
				<input type="hidden" name="harga" value="<?php echo $r->harga_satuan ?>">
				<harga
				<div class="input-append">
					<input type="text" name="qty" class="input-mini" value="1">
					<button class="btn btn-primary" type="submit"><i class="icon-ok icon-white"></i></button>
				</div>
			</form>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php else: ?>
	<div class="alert alert-block alert-error">
		<h4>Tidak ada...</h4>
		<p>Produk yang anda cari tidak ada...</p>
	</div>
<?php endif; ?>
<?php endif; ?>

<table class="table table-bordered table-striped">
	<tr><th>KODE</th><th>NAMA</th><th>QTY CETAK</th></tr>
	<?php foreach($this->cart->contents() as $r): ?>
	<tr>
		<td><?php echo $r['id'] ?></td>
		<td><?php echo $r['name'] ?></td>
		<td><?php echo $r['qty'] ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-primary" href="<?php echo base_url() ?>index.php/jual/FormBarcodeSelesai">Selesai Transaksi</a>
		<a class="btn btn-warning" href="<?php echo base_url() ?>index.php/jual/FormBarcodeBatalkan">Batalkan</a>
	</div>
</div>

<!-- daftar yang akan dicetak -->