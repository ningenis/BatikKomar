<!DOCTYPE html>
<html>
<head>
	<title>Penjualan</title>
	<link rel="shortcut icon" href="<?php echo base_url() ?>img/favicon.ico"/>
	<link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>css/chosen.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>css/komar.css" rel="stylesheet" type="text/css"/>
	<style>
	body {
		background: #fff;
		/*background: url('<?php echo base_url() ?>img/batik3.jpg');*/
	}
	#wadah {
		width: 100%;
		height: 100%;
	}
	#kotak-kiri {
		position: fixed;
		width: 250px;
		height: 100%;
		background: url('<?php echo base_url() ?>img/Wood.jpg');
		float: left;
		box-shadow: 0px 0px 5px #333;
	}
	#kotak-konten {
		float: left;	
		margin-top: 13px;
	}
	#kotak-kiri-dalam {
		padding: 13px;
	}
	#kotak-konten {
		left: 260px;
		position: absolute;
		width: 600px;
	}
	</style>
	<script src="<?php echo base_url() ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>js/chosen.jquery.min.js" type="text/javascript"></script>
</head>
<body>
	<div id="wadah">
		<div id="kotak-kiri">
			<div id="kotak-kiri-dalam">
				<img src="<?php echo base_url() ?>img/nemesis_new.png" style="margin-bottom: 20px;" />

				<a href="<?php echo base_url() ?>index.php/jual/FormKasir" class="btn btn-primary btn-block">TRANSAKSI</a>
				<a href="<?php echo base_url() ?>index.php/jual/DaftarTransaksi" class="btn btn-primary btn-block">DAFTAR TRANSAKSI</a>
				<a href="<?php echo base_url() ?>index.php/jual/DaftarBatik" class="btn btn-primary btn-block" style="margin-top: 23px;">MOTIF BATIK</a>
				<a href="<?php echo base_url() ?>index.php/jual/DaftarProduk" class="btn btn-primary btn-block">PRODUK</a>
				<a href="<?php echo base_url() ?>index.php/jual/FormBarcode" class="btn btn-primary btn-block">CETAK BARCODE</a>
				<a href="<?php echo base_url() ?>index.php/jual/DaftarKlien" class="btn btn-primary btn-block" style="margin-top: 23px;">PELANGGAN</a>
				<a href="<?php echo base_url() ?>index.php/jual/DaftarKaryawan" class="btn btn-primary btn-block">KARYAWAN</a>
				<a href="<?php echo base_url() ?>index.php/jual/FormGantiPassword" class="btn btn-danger" style="margin-top: 23px">Ganti Password</a>
				<a href="#ModalKonfirmasiLogout" role="button" class="btn btn-danger" data-toggle="modal" style="margin-top: 23px">Keluar</a>
			</div>	
		</div>
		<div id="kotak-konten">
