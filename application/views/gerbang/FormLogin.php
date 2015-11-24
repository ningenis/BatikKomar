<!DOCTYPE html>
<html>
<head>
	<title>NEMESIS</title>
	<link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>css//komar.css" rel="stylesheet" type="text/css"/>
	<style>
	body {
		margin-top: 30px;
	}
	div#kotak-login {
		width: 350px;
		position: relative;
		float: left;
	}
	#kotak-utama {
		width: 800px;
		margin: 0 auto;
	}
	#kotak-maskot {
		width: 450px;
		position: relative;
		float: left;
		height: 400px;
	}
	#putar {
		position: relative;
		top: 0px;
		animation: Putar 13s ease-in-out infinite;
		-webkit-animation: Putar 13s ease-in-out infinite;
	}
	#naomi {
		position: relative;
		top: -380px;
	}
	@keyframes Putar {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(180deg); }
	}
	@-webkit-keyframes Putar {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(180deg); }
	}
	#footer {
		margin-top: 13px;
		border-top: solid 1px #ccc;
	}
	#footer-dalam {
		margin: 5px;
	}
	</style>
</head>
<body>
	<div id="kotak-utama">
		<div id="kotak-maskot">
			<img src="<?php echo base_url() ?>img/putar.png" id="putar"/>
			<img src="<?php echo base_url() ?>img/naomi.png" id="naomi"/>
		</div>
		<div id="kotak-login">
			<form method="post" action="<?php echo base_url() ?>index.php/gerbang/Login">
				<div class="control-group">
					<label class="control-label">Nama pengguna</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="namaPengguna">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input type="password" class="input-xlarge" name="kataKunci">
					</div>
				</div>
				<button class="btn btn-primary input-xlarge" type="submit" style="margin-bottom: -19px;">Masuk</button>
			</form>
		</div>
		<div style="clear:both;"></div>
		<div id="footer">
			<div id="footer-dalam">
				Nemesis IT Solution &copy 2013 | Institut Teknologi Bandung
			</div>
		</div>
	</div>
</body>
</html>

<script src="<?php echo base_url() ?>js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js" type="text/javascript"></script>