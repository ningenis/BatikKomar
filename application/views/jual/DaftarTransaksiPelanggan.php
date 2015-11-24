<style>
.transaksi {
	margin: 5px;
	box-shadow: 3px 3px 0px #ccc;
	border: solid 1px #ccc;
}
.transaksiDalam {
	padding: 7px 13px;
}
.border-merah {
	border: solid 1px #F92665;
	box-shadow: 3px 3px 0px #F92665;
}
</style>

<h3>Daftar Transaksi Pelanggan</h3>

<table class="table table-bordered">
	<tr><td><strong>Kode Pelanggan</strong></td><td><?php echo $InfoPelanggan->id_pelanggan ?></td></tr>
	<tr><td><strong>Nama</strong></td><td><?php echo $InfoPelanggan->nama_pelanggan ?></td></tr>
	<tr><td><strong>Alamat</strong></td><td><?php echo $InfoPelanggan->alamat_pelanggan ?></td></tr>
	<tr>
		<td>Telepon</td>
		<td>
			<ol>
				<?php foreach($DaftarTelepon as $r): ?>
					<li><?php echo $r->no_telepon ?></li>
				<?php endforeach ?>
			</ol>
		</td>
	</tr>
</table>

<?php foreach($DaftarTransaksiPelanggan as $r): ?>
	<div class="transaksi <?php if($r->status_pesanan == 'PINJAM') echo 'border-merah'?>">
		<div class="transaksiDalam">
			<a class="btn btn-danger" href="<?php echo base_url() ?>index.php/jual/CetakNota/<?php echo $r->nomor_pesanan ?>">Cetak Nota</a><br/><br/>
			<table class="table table-striped table-bordered">
				<tr><td><strong>Nomor pesanan</strong></td><td><?php echo $r->nomor_pesanan ?></td></tr>
				<tr><td><strong>Tanggal pembelian</strong></td><td><?php echo $r->tanggal_order ?></td></tr>
				<tr><td><strong>Pelanggan</strong></td><td><?php echo "($InfoPelanggan->id_pelanggan) $InfoPelanggan->nama_pelanggan" ?></a></td></tr>
				<tr><td><strong>Kasir</strong></td><td><?php echo $r->nama_karyawan ?></td></tr>
				<tr>
					<td><strong>Status</strong></td>
					<td>
						<?php if($r->status_pesanan == 'PINJAM'): ?>
							<span class="label label-important">PINJAM</span>
						<?php elseif($r->status_pesanan == 'BAYAR'): ?>
							<span class="label label-success">BAYAR</span>
						<?php else: ?>
							<span class="label label-warning">KEMBALI</span>
						<?php endif ?>
					</td>
				</tr>
			</table>

			<h4>Item yang dibeli:</h4>

			<table class="table table-bordered table-striped">
				<tr><th>Produk</th><th>Harga Satuan</th><th>Quantity</th><th>Subtotal</th></tr>
				<?php $TotalHarga = 0; ?>
				<?php foreach($DaftarOrderLinePelanggan as $p) : 
				
				if ($r->nomor_pesanan == $p->nomor_pesanan){
					$TotalHarga += (int) $p->harga_satuan;
					echo '<tr><td>' . "($p->id_produk) $p->nama_produk" .'</td>';
					echo '<td>Rp ' . number_format($p->harga_satuan, 0, '', '.') . '</td>';
					echo '<td>' . $p->quantity ." pcs</td>";
					echo '<td>Rp ' . number_format($p->harga_satuan * $p->quantity, 0, '', '.') . '</td></tr>';
					
				}?>
				<?php endforeach ?>
			</table>
			<h4>Total:</h4> <span style="font-size: 2em;">Rp <?php echo number_format($TotalHarga, 0, '', '.') ?></span>
			<br/><br/>
			<?php if($r->status_pesanan == 'PINJAM'): ?>
				<div class="btn-group">
					<a href="<?php echo base_url() ?>index.php/jual/KonfirmasiKembalikanBarang/<?php echo $r->nomor_pesanan ?>" class="btn btn-primary">Kembalikan barang</a>
				</div>
			<?php endif ?>
		</div>
		
	</div>
<?php endforeach ?>