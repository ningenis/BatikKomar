<?php $r = $DataTransaksi ?>

<div class="transaksi <?php if($r->status_pesanan == 'PINJAM') echo 'border-merah'?>">
	<div class="transaksiDalam">
		<table class="table table-striped table-bordered">
			<tr><td><strong>Nomor pesanan</strong></td><td><?php echo $r->nomor_pesanan ?></td></tr>
			<tr><td><strong>Tanggal pembelian</strong></td><td><?php echo $r->tanggal_order ?></td></tr>
			<tr><td><strong>Pelanggan</strong></td><td><?php echo $r->nama_pelanggan ?></td></tr>
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

			<?php foreach($DataOrderLine as $p) : 
				echo '<tr><td>' . $p->nama_produk .'</td>';
				echo '<td>' . $p->quantity ." pcs</td></tr>";			
			?>
			<?php endforeach ?>
		</table>

		<h4>Anda yakin kembalikan barang ini?</h4>
		<div class="btn-group">
			<a href="<?php echo base_url() ?>index.php/jual/KembalikanBarang/<?php echo $r->nomor_pesanan ?>" class="btn btn-danger">Ya, Kembalikan Barang</a>
		</div>
	</div>
	
</div>