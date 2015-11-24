<style>
#pencarian {
	border: solid 1px #ccc;
	margin: 13px 0px;
	background-image: url(<?php echo base_url() ?>img/topeng.jpg);
	background-repeat: no-repeat;
	background-position: right;
}
#pencarian-dalam {
	margin: 5px;
}
</style>

<a href="<?php echo base_url() ?>index.php/jual/FormTambahKlien" role="button" class="btn btn-primary" data-toggle="modal" >Tambah Pelanggan</a>

<div id="pencarian">
	<div id="pencarian-dalam">
		<form action="<?php echo base_url() ?>index.php/jual/DaftarKlien" method="post">
			<input type="hidden" name="pencarian" value="ya"/>
			<select name="atribut" class="input-small">
				<option value="nama">Nama</option>
				<option value="alamat">Alamat</option>
			</select>
			<input type="text" name="kunci" placeholder="kata kunci" required />
			<br/>
			<button type="submit" class="btn btn-primary">Cari</button>
		</form>
	</div>
</div>

<table class="table table-bordered table-striped">
	<tr><th>KODE</th><th>NAMA</th><th>ALAMAT</th><th></th></tr>
	<?php
	foreach($DaftarKlien as $r) {
		echo "<tr><td>$r->id_pelanggan</td><td>" . '<a href="' . base_url() . 'index.php/jual/DaftarTransaksiPelanggan/' . $r->id_pelanggan . '" class="btn btn-primary">' . $r->nama_pelanggan .'</a>'. "</td><td>$r->alamat_pelanggan</td><td>" .
			 '<div class="btn-group">
			 	 <a href="' . base_url() . 'index.php/jual/FormUbahKlien/' . $r->id_pelanggan . '" class="btn"><i class="icon-user"></i></a>
			 	 <a href="' . base_url() . 'index.php/jual/TeleponPelanggan/' . $r->id_pelanggan . '" class="btn">Phone</a>
			 	 <!--<a href="' . base_url() . 'index.php/jual/FormHapusKlien/' . $r->id_pelanggan . '" class="btn"><i class="icon-remove"></i></a>-->
			  </div>' .
			 "</td></tr>";
	}
	?>
</table>
