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

<a href="<?php echo base_url() ?>index.php/jual/FormTambahKategori" role="button" class="btn btn-primary" data-toggle="modal" >Tambah Motif Batik</a>

<div id="pencarian">
	<div id="pencarian-dalam">
		<form action="<?php echo base_url() ?>index.php/jual/DaftarBatik" method="post">
			<input type="hidden" name="pencarian" value="ya"/>
			<select name="atribut" class="input-large">
				<option value="NamaMotif">Nama Motif</option>
				<option value="NamaPembuat">Nama Pembuat</option>
			</select>
			<input type="text" name="kunci" placeholder="kata kunci" required />
			<br/>
			<button type="submit" class="btn btn-primary">Cari</button>
		</form>
	</div>
</div>

<table class="table table-bordered table-striped">
	<tr><th>KODE MOTIF</th><th>NAMA MOTIF</th><th>NAMA PEMBUAT</th><th>TANGGAL DIBUAT</th><th> </th></tr>
<?php 
foreach($DaftarBatik as $r) {
		echo "<tr><td>$r->kode_motif</td><td>$r->nama_motif</td><td>$r->nama_pembuat</td><td>$r->tanggal_dibuat</td><td>" .
			 '<div class="btn-group">
			 	 <a href="' . base_url() . 'index.php/jual/FormUbahMotif/' . $r->kode_motif . '" class="btn"><i class="icon-user"></i></a>
				 <a href="' . base_url() . 'index.php/jual/FormPanelGambar/' . $r->kode_motif . '" class="btn">Gambar</i></a>
			  </div>' .
			 "</td></tr>";
	}
	?>
</table>