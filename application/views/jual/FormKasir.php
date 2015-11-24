<form method="post" action="<?php echo base_url() ?>index.php/jual/KasirTambahProduk">
	<div class="input-append" style="margin-top:30px; margin-bottom:30px;">
		<input class="input-large" type="text" name="KodeProduk" autofocus="autofocus" id="KodeProduk" placeholder="Scan Barcode di Sini" required>
		<button class="btn btn-primary">Tambahkan</button>
	</div>
</form>

	<span style="text-align: right;"><h2>Total : Rp <?php echo number_format($this->cart->total(), 0, '', '.') ?></h2></span>

	<?php

	if (isset($PesanError)) {
		echo '<div class="alert alert-block">' . $PesanError . '</div>';
	}

	?>

	<table class="table table-bordered table-striped">
		<tr>
			<th>KODE</th><th>NAMA PRODUK</th><th>QTY</th><th>HARGA</th><th></th>
		</tr>
		<?php foreach($this->cart->contents() as $items): ?>
		<tr>
			<td><?php echo $items['id'] ?></td>
			<td><?php echo $items['name'] ?></td>
			<td>
				<form method="post" action="<?php echo base_url() ?>index.php/jual/TambaHQty">
					<input type="hidden" name="rowid" value="<?php echo $items['rowid'] ?>">
					<input type="text" class="input-mini" name="Qty" value="<?php echo $items['qty'] ?>">
				</form>
			</td>
			<td><?php echo number_format($items['price'], 0, '', '.') ?></td>
			<td><a href="<?php echo base_url() ?>index.php/jual/KasirDelete/<?php echo $items['rowid'] ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>
		</tr>
		<?php endforeach; ?>
	</table>

<form method="post" action="<?php echo base_url() ?>index.php/jual/KonfirmasiTransaksi">

<table class="table table-bordered">
	<tr>
		<td>Pembayaran</td>
		<td>
			<select name="TipeTransaksi" class="chosen">
				<option value="BAYAR">BAYAR</option>
				<option value="PINJAM">PINJAM</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Pelanggan</td>
		<td>
			<?php echo form_dropdown('KlienID', $DaftarKlien, '', 'class="chosen input-block-level"') ?>
		</td>
	</tr>
</table>

<div class="btn-toolbar">
	<div class="btn-group">
		<button class="btn btn-primary">Selesai Transaksi</button>
		<a class="btn btn-warning" href="<?php echo base_url() ?>index.php/jual/FormKasirBatalkan">Batalkan</a>
	</div>
</div>

</form>

<script type="javascript">
$(function() {
	$("#KodeProduk").focus();
});
</script>