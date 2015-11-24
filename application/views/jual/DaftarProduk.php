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

<a href="<?php echo base_url() ?>index.php/jual/FormTambahProduk" role="button" class="btn btn-primary" data-toggle="modal" >Tambah Produk</a>

<div id="pencarian">
	<div id="pencarian-dalam">
		<form action="<?php echo base_url() ?>index.php/jual/DaftarProduk" method="post">
			<input type="hidden" name="pencarian" value="ya"/>			
			<input type="text" name="kunci" placeholder="nama produk dicari" required />
			<br/>
			<button type="submit" class="btn btn-primary">Cari</button>
		</form>
	</div>
</div>

<table class="table table-bordered table-striped">
	<tr><th>ID PRODUK</th><th>KODE MOTIF</th><th>NAMA PRODUK</th><th>HARGA SATUAN</th><th></th></tr>
<?php
foreach($DaftarProduk as $r) {

	echo "<tr><td>$r->id_produk</td><td>$r->kode_motif</td><td>$r->nama_produk</td><td>" .number_format($r->harga_satuan,0,'','.') . "</td><td>".
		'<div class="btn-group">
			 <a href="' . base_url() . 'index.php/jual/FormUbahProduk/' . $r->id_produk . '" class="btn"><i class="icon-user"></i></a>
			 <!--<a href="' . base_url() . 'index.php/jual/FormHapusProduk/' . $r->id_produk . '" class="btn"><i class="icon-remove"></i></a>-->
		</div>' .
	"</td></tr>";
}
?>
</table>