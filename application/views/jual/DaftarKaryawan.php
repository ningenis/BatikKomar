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

<a href="<?php echo base_url() ?>index.php/jual/FormTambahKaryawan" role="button" class="btn btn-primary" data-toggle="modal" >Tambah Karyawan</a>

<div id="pencarian">
	<div id="pencarian-dalam">
		<form action="<?php echo base_url() ?>index.php/jual/DaftarKaryawan" method="post">
			<input type="hidden" name="pencarian" value="ya"/>			
			<input type="text" name="kunci" placeholder="nama karyawan dicari" required />
			<br/>
			<button type="submit" class="btn btn-primary">Cari</button>
		</form>
	</div>
</div>

<table class="table table-bordered table-striped">
	<tr><th>KODE</th><th>NAMA</th><th>JABATAN</th><th></th></tr>
<?php
foreach($DaftarKaryawan as $r) {
	
	echo "<tr><td>$r->id_karyawan</td><td>$r->nama_karyawan</td><td>$r->jabatan</td><td>" .
		'<div class="btn-group">
			 <a href="' . base_url() . 'index.php/jual/FormUbahKaryawan/' . $r->id_karyawan . '" class="btn"><i class="icon-user"></i></a>
			 <a href="' . base_url() . 'index.php/jual/JadikanUser/' . $r->id_karyawan . '" class="btn">Jadikan User</a>
		</div>' .
		"</td></tr>";
}
?>
</table>
