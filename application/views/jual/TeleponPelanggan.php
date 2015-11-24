<h2>Nomor Telepon dari <?php echo $InfoPelanggan->nama_pelanggan ?></h2>

<form method="post" action="<?php echo base_url() ?>index.php/jual/UbahTeleponPelanggan">

<table class="table table-bordered">
<?php $itungan = 0; ?>
<?php foreach($TeleponPelanggan as $r): ?>
	<?php $itungan++ ?>
	<tr>
		<td>Telepon <?php echo $itungan ?></td>
		<td>
			<input type="hidden" name="telp_lama_<?php echo $itungan ?>" value="<?php echo $r->no_telepon ?>"/>
			<input type="text" name="telp_baru_<?php echo $itungan ?>" value="<?php echo $r->no_telepon ?>"/>
		</td>
	</tr>
<?php endforeach ?>
	<tr><td>Telepon Baru</td><td><input type="text" name="telepon_baru" /></td></tr>
</table>

<input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan ?>"/>
<input type="hidden" name="qtyPhone" value="<?php echo $itungan ?>"/>

<button class="btn btn-primary" type="submit">Simpan</button>