<h4>Ganti Password</h4>
<hr/>
<form method="post" action="<?php echo base_url() ?>index.php/jual/GantiPassword">
	<table class="table table-bordered">
		<tr><td>Password lama</td><td><input type="password" name="lama"/></td></tr>
		<tr><td>Password baru</td><td><input type="password" name="baru1"/></td></tr>
		<tr><td>Password baru (lagi)</td><td><input type="password" name="baru2"/></td></tr>
	</table>
	<button type="submit" class="btn btn-primary">Ganti Password</button>
</form>