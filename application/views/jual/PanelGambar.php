<h2>Panel Gambar</h2>
<br> <h5>Motif Batik <?php echo "$PanelGambar->nama_motif"; ?></h5>
<br>
<?php if ($PanelGambar->nama_file != "") {
	$daftar = explode('.', $PanelGambar->nama_file);

	$nama_file = $daftar[0] . '_400px.' . $daftar[1];
	echo '<img src="' . base_url() . 'gambar_motif_batik/' . $nama_file . '">';
}
?>

<?php if($PanelGambar->nama_file != ""): ?>
	<a href="<?php echo base_url() ?>gambar_motif_batik/<?php echo $PanelGambar->nama_file ?>" target="__blank" class="btn btn-primary">Resolusi Tinggi</a>
<?php endif ?>

<form action="<?php echo base_url() ?>index.php/jual/UploadGambar" method="post" enctype="multipart/form-data">

	<input type="hidden" name="kode_motif" value="<?php echo "$PanelGambar->kode_motif"; ?>" >
	<label for="file">File Gambar :</label>
	<input type="file" name="gambar" id="file"><br>
	<input type="submit" name="submit" value="Upload Gambar" class="btn btn-primary">
</form>