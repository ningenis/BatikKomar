<h3>Hapus Kategori</h3>
<p>Apa anda yakin ingin menghapus kategori <code><?php echo $Nama ?></code>
<form method="post" action="<?php echo base_url() ?>index.php/jual/HapusKategori">
	<input type="hidden" name="KategoriID" value="<?php echo $KategoriID ?>">
	<button type="submit" class="btn btn-danger btn-large btn-block">Hapus Kategori</button>
</form>