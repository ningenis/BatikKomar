<h4>Konfirmasi Transaksi</h4>
<hr/>

<table class="table table-bordered">
	<tr><td>Pelanggan</td><td><?php echo $DetilKlien->nama_pelanggan . ' (' . $DetilKlien->alamat_pelanggan .')' ?></td></tr>
	<tr><td>Tipe</td><td><?php echo $TipeTransaksi ?></td></tr>
	<tr><td>Total</td><td>Rp <?php echo number_format($TotalHarga, 0, '', '.') ?></td></tr>
</table>

<table class="table table-striped table-bordered">
	<tr><th>PRODUK</th><th>HARGA</th><th>QTY</th><th>SUBTOTAL</th></tr>
	<?php foreach($DaftarItem as $index => $data): ?>
	<tr>
		<td><?php echo $data['name'] ?></td>
		<td>Rp <?php echo number_format($data['price'], 0, '', '.') ?></td>
		<td><?php echo $data['qty'] ?></td>
		<td>Rp <?php echo number_format($data['price'] * $data['qty'], 0, '', '.') ?></td>
	</tr>
	<?php endforeach ?>
</table>

<form method="post" action="<?php echo base_url() ?>index.php/jual/ProsesTransaksi">
	<input type="hidden" name="TipeTransaksi" value="<?php echo $TipeTransaksi ?>">
	<input type="hidden" name="KlienID" value="<?php echo $KlienID ?>">
	<button type="submit" class="btn btn-block btn-large btn-danger">PROSES TRANSAKSI</button>
</form>