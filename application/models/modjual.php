<?php

class Modjual extends CI_Model {
	function UbahPassword($id_karyawan, $HashPassword) {
		$this->db->query("UPDATE admin  
						  SET HashPassword = ? 
						  WHERE id_karyawan = ? ", array($HashPassword, $id_karyawan));
	}
	function GetDaftarBatik($atribut, $kunci) {
		if($atribut == 'NamaMotif') {
			return $this->db->query("SELECT * 
									 FROM motif_batik INNER JOIN motif_batik_tulis 
									 ON motif_batik.kode_motif = motif_batik_tulis.kode_motif 
									 WHERE motif_batik_tulis.nama_motif LIKE  '%$kunci%'
									 UNION
									 SELECT * 
									 FROM motif_batik INNER JOIN motif_batik_cap 
									 ON motif_batik.kode_motif = motif_batik_cap.kode_motif 
									 WHERE motif_batik_cap.nama_motif LIKE '%$kunci%' ")->result();
		} else if($atribut == 'NamaPembuat') {
			return $this->db->query("SELECT * 
									 FROM motif_batik INNER JOIN motif_batik_tulis 
									 ON motif_batik.kode_motif = motif_batik_tulis.kode_motif 
									 WHERE motif_batik.nama_pembuat LIKE  '%$kunci%'
									 UNION
									 SELECT * 
									 FROM motif_batik INNER JOIN motif_batik_cap 
									 ON motif_batik.kode_motif = motif_batik_cap.kode_motif 
									 WHERE motif_batik.nama_pembuat LIKE '%$kunci%' ")->result();
		}
	}
	function GetDataAdmin($id_karyawan) {
		return $this->db->query("SELECT * 
							     FROM admin 
							     WHERE id_karyawan = ? ", $id_karyawan)->row();
	}
	function SudahAdaUser($id_karyawan) {
		$count = $this->db->query("SELECT * 
								   FROM admin 
								   WHERE id_karyawan = ? ", $id_karyawan)->num_rows();
		return ($count > 0);
	}
	function JadikanUser($id_karyawan, $nama_karyawan, $hash_password) {
		$this->db->query("INSERT INTO admin 
						  (AdminNama, HashPassword, id_karyawan) 
						  VALUES 
						  (?, ?, ?) ", array($nama_karyawan, $hash_password, $id_karyawan));
	}
 	function GetDaftarKaryawan($kunci) {
		return $this->db->query("SELECT * 
								 FROM karyawan 
								 WHERE nama_karyawan LIKE '%$kunci%' ")->result();
	}
	function GetDaftarKlien($atribut, $kunci) {
		if($atribut == 'nama') {
			return $this->db->query("SELECT * 	
									 FROM pelanggan
									 WHERE nama_pelanggan LIKE '%$kunci%' ")->result();
		} else if($atribut == 'alamat') {
			return $this->db->query("SELECT * 
									 FROM pelanggan 
									 WHERE alamat_pelanggan LIKE '%$kunci%' ")->result();
		}
	}
	function DaftarTelepon($id_pelanggan) {
		return $this->db->query("SELECT * 
								 FROM telepon_pelanggan 
								 WHERE id_pelanggan = ? ", $id_pelanggan)->result();;
	}
	function InfoPelanggan($id_pelanggan) {
		return $this->db->query("SELECT * 
								 FROM pelanggan 
								 WHERE id_pelanggan = ?", $id_pelanggan)->row();;
	}
	function DaftarTransaksiPelanggan($id_pelanggan) {
		return $this->db->query("SELECT * 
								 FROM pesanan ps, karyawan k
								 WHERE ps.id_karyawan = k.id_karyawan
								 AND id_pelanggan = ? 
								 ORDER BY ps.tanggal_order DESC ", $id_pelanggan)->result();
	}
	function DaftarOrderLinePelanggan($id_pelanggan) {
		return $this->db->query("SELECT * 
								 FROM pesanan ps, order_batik o, produk p
								 WHERE ps.nomor_pesanan = o.nomor_pesanan 
								 AND o.id_produk = p.id_produk
								 AND ps.id_pelanggan = ? ", $id_pelanggan)->result();
	}
	function GetDataTransaksi($nomor_pesanan) {
		return $this->db->query("SELECT * 
								 FROM pesanan ps, pelanggan pg
								 WHERE nomor_pesanan = ? 
								 AND pg.id_pelanggan = ps.id_pelanggan ", $nomor_pesanan)->row();
	}
	function KembalikanBarang($nomor_pesanan) {
		$this->db->query("UPDATE pesanan
						  SET status_pesanan = 'KEMBALI' 
						  WHERE nomor_pesanan = ? ", $nomor_pesanan);
	}
	function GetOrderLine($nomor_pesanan) {
		return $this->db->query("SELECT * 
								 FROM order_batik o, produk p
								 WHERE nomor_pesanan = ? 
								 AND o.id_produk = p.id_produk ", $nomor_pesanan)->result();
	}
	function DaftarKlien() {
		return $this->db->query("SELECT *
						  		 FROM pelanggan")->result();
	}
	function DaftarProduk() {
		return $this->db->query("SELECT *
								 FROM produk ")->result();
	}
	function GetDaftarProduk($kunci) {
		return $this->db->query("SELECT *
								 FROM produk 
								 WHERE nama_produk LIKE '%$kunci%' ")->result();
	}
	function DaftarKategori() {
		return $this->db->query("SELECT DISTINCT *
								 FROM motif_batik_cap, motif_batik_tulis ")->result();
	}
	function DaftarKaryawan() {
		return $this->db->query("SELECT *
								 FROM karyawan ")->result();
	}
	function UbahKaryawan($id_karyawan, $nama_karyawan, $jabatan) {
		$this->db->query("UPDATE karyawan 
						  SET 
						  nama_karyawan = ?,
						  jabatan = ?
						  WHERE id_karyawan = ? ", array($nama_karyawan, $jabatan, $id_karyawan));
	}
	function GetDataKaryawan($id_karyawan) {
		return $this->db->query("SELECT *
								 FROM karyawan
								 WHERE id_karyawan = ?", array($id_karyawan))->row();
	}
	function HapusKaryawan ($id_karyawan) {
		$this->db->query("DELETE FROM karyawan 
						  WHERE id_karyawan = ? ", $id_karyawan);
	}
	function TambahKlien($nama_pelanggan, $alamat_pelanggan) {
		$this->db->query("INSERT INTO pelanggan 
						  (nama_pelanggan, alamat_pelanggan)  
						  VALUES 
						  (?, ?) ", 
						  array($nama_pelanggan, $alamat_pelanggan));
	}
	function TambahKaryawan($nama_karyawan, $jabatan) {
		$this->db->query("INSERT INTO karyawan 
						  (nama_karyawan, jabatan)  
						  VALUES 
						  (?, ?) ", 
						  array($nama_karyawan, $jabatan));
	}
	function TambahKategori($kode_motif, $nama_motif, $nama_pembuat, $tanggal_dibuat, $kategori) {
		$this->db->query("INSERT INTO motif_batik 
						  (kode_motif, nama_pembuat, tanggal_dibuat, kategori)	
						  VALUES (?, ?, ?, ?) ",
						  array($kode_motif, $nama_pembuat, $tanggal_dibuat, $kategori));
		if ($kategori == 'TULIS') {
			$this->db->query("INSERT INTO motif_batik_tulis
							  (kode_motif, nama_motif)
							   VALUES (?, ?) ",
							   array($kode_motif, $nama_motif));
		} else if ($kategori == 'CAP') {
			$this->db->query("INSERT INTO motif_batik_cap
							  (kode_motif, nama_motif)
							   VALUES (?, ?) ",
							   array($kode_motif, $nama_motif));
		}
	}
	function TambahProduk($kode_motif, $nama_produk, $harga_satuan) {
		$this->db->query("INSERT INTO produk 
						  (kode_motif, nama_produk, harga_satuan) 
						  VALUES 
						  (?, ?, ?) ", array($kode_motif, $nama_produk, $harga_satuan));
	}
	function InfoKlien($id_pelanggan) {
		return $this->db->query("SELECT *
								 FROM pelanggan 
								 WHERE id_pelanggan = ? ", $id_pelanggan)->row();
	}
	function UbahKlien($id_pelanggan, $nama_pelanggan, $alamat_pelanggan) {
		$this->db->query("UPDATE pelanggan 
						  SET 
						  nama_pelanggan = ?,
						  alamat_pelanggan = ?
						  WHERE id_pelanggan = ? ", array($nama_pelanggan, $alamat_pelanggan, $id_pelanggan));
	}
	function HapusKlien($id_pelanggan) {
		$this->db->query("DELETE FROM pelanggan 
						  WHERE id_pelanggan = ? ", $id_pelanggan);
	}
	function InfoKaryawan($id_karyawan) {
		return $this->db->query("SELECT *
								 FROM karyawan 
								 WHERE id_karyawan = ? ", $id_karyawan)->row();
	}
	/*
	function UbahKaryawan($id_karyawan, $nama_karyawan, $jabatan) {
		$this->db->query("UPDATE karyawan 
						  SET 
						  nama_karyawan = ?,
						  jabatan = ?
						  WHERE id_karyawan = ? ", array($nama_karyawan, $jabatan, $id_karyawan));
	}
	*/
	/*
	function HapusKaryawan($id_karyawan) {
		$this->db->query("DELETE FROM karyawan 
						  WHERE id_karyawan = ? ", $id_karyawan);
	}
	*/
	function InfoProduk($id_produk) {
		return $this->db->query("SELECT *
								 FROM produk 
								 WHERE id_produk = ? ", $id_produk)->row();
	}
	function UbahProduk($id_produk, $nama_produk, $harga_satuan) {
		$this->db->query("UPDATE produk 
						  SET 
						  nama_produk = ?,
						  harga_satuan = ?
						  WHERE id_produk = ? ", array($nama_produk, $harga_satuan, $id_produk));
	}
	function HapusProduk($id_produk) {
		$this->db->query("DELETE FROM produk 
						  WHERE id_produk = ? ", $id_produk);
	}
	function KasirTambahProduk($id_produk) {
		$data = $this->db->query("SELECT * 
								  FROM produk
								  WHERE id_produk = ? ", $id_produk);
		
		if ($data->num_rows == 1) {
			return $data->row();
		} else {
			return 'ProdukTidakKetemu';
		}
	}
	function CariProduk($dicari) {
		$dicari = $this->db->escape_like_str($dicari);
		
		$data = $this->db->query("SELECT * 
								  FROM produk 
								  WHERE nama_produk LIKE '%$dicari%' ");
		if($data->num_rows() > 0) {
			$hasil = array();
			$hasil['status'] = 'Ada';
			$hasil['daftarProduk'] = $data->result();
			$hasil['numRows'] = $data->num_rows();
			return $hasil;
		} else {
			return array('status' => 'TidakAda');
		}
	}
	/*
	function UbahProduk($id_produk, $kode_motif, $nama_produk, $harga_satuan) {
		$this->db->query("UPDATE produk 
						  SET 
						  kode_motif = ?,
						  nama_produk = ?,
						  harga_satuan = ?
						  WHERE id_produk = ? ", array($kode_motif, $nama_produk, $harga_satuan, $id_produk));
	}
	*/
	function GetDataProduk($id_produk) {
		return $this->db->query("SELECT *
								 FROM produk
								 WHERE id_produk = ?", array($id_produk))->row();
	}
	/*
	function HapusProduk($id_produk) {
		$this->db->query("DELETE FROM produk 
						  WHERE id_produk = ? ", $id_produk);
	}
	*/
	function CariKategori($KategoriID) {
		return $this->db->query("SELECT * FROM kategori 
								 WHERE KategoriID = ? ", $KategoriID)->row();
	}
	function HapusKategori($KategoriID) {
		$this->db->query("DELETE FROM kategori 
						  WHERE KategoriID = ? ", $KategoriID);
	}
	function ProsesTransaksi($id_pelanggan, $Total, $TipeTransaksi, $id_karyawan) {
		$this->db->query("INSERT INTO pesanan 
						  (id_pelanggan, id_karyawan, tanggal_order, status_pesanan) 
						  VALUES 
						  (?, ?, CURDATE(), ?) ", array($id_pelanggan, $id_karyawan, $TipeTransaksi));
		$TransaksiID = $this->db->insert_id();
		return $TransaksiID;
	}
	function TransaksiBarang($TransaksiID, $id_produk, $quantity) {
		$this->db->query("INSERT INTO order_batik 
			   			  (nomor_pesanan, id_produk, quantity) 
			   			  VALUES 
			   			  (?, ?, ?) ", array($TransaksiID, $id_produk, $quantity));
	}
	function DaftarTransaksi() {
		return $this->db->query("SELECT * 
								 FROM pesanan ps, pelanggan pl, karyawan k 
								 WHERE ps.id_pelanggan = pl.id_pelanggan 
								 AND ps.id_karyawan = k.id_karyawan 
								 ORDER BY nomor_pesanan DESC ")->result();
	}
	function DaftarOrderLine() {
		return $this->db->query("SELECT *
								 FROM order_batik
								 LEFT JOIN produk
								 ON order_batik.id_produk = produk.id_produk ")->result();
	}
	function DaftarBatik() {
		return $this->db->query("SELECT * 
								 FROM motif_batik INNER JOIN motif_batik_tulis 
								 ON motif_batik.kode_motif = motif_batik_tulis.kode_motif 
								 UNION
								 SELECT * 
								 FROM motif_batik INNER JOIN motif_batik_cap 
								 ON motif_batik.kode_motif = motif_batik_cap.kode_motif ")->result();
	}

	function TeleponPelanggan($id_pelanggan) {
		return $this->db->query("SELECT tp.*, p.nama_pelanggan
								 FROM telepon_pelanggan tp, pelanggan p
								 WHERE tp.id_pelanggan = ? 
								 AND tp.id_pelanggan = p.id_pelanggan ", $id_pelanggan)->result();
	}
	function UbahTeleponPelanggan($data) {
		$id_pelanggan = $data['id_pelanggan'];
		foreach($data['teleponLama'] as $index => $phone) {
			if ($data['teleponBaru'][$index] == '') {
				$this->db->query("DELETE FROM telepon_pelanggan 
							  WHERE no_telepon = ? 
							  AND id_pelanggan = ?", array($data['teleponLama'][$index], $id_pelanggan));
			} else {
				$this->db->query("UPDATE telepon_pelanggan 
								  SET no_telepon = ?
								  WHERE no_telepon = ? 
								  AND id_pelanggan = ?", array($data['teleponBaru'][$index], $phone, $id_pelanggan));
			}
		}
		if(isset($data['nomor_tambahan'])) {
			$this->db->query("INSERT INTO telepon_pelanggan
							  (id_pelanggan, no_telepon)
							  VALUES 
							  (?, ?) ", array($id_pelanggan, $data['nomor_tambahan']));
		}
	}
	function UbahMotif1($kode_motif, $nama_pembuat, $tanggal_dibuat) {
		$temp = $this->db->query("UPDATE motif_batik 
						  SET 
						  nama_pembuat = ?,
						  tanggal_dibuat = ?
						  WHERE kode_motif = ? ", array($nama_pembuat, $tanggal_dibuat, $kode_motif));
	}
	function UbahMotif2($kode_motif, $nama_motif) {
		$temp = $this->db->query("SELECT *
						  FROM motif_batik
						  WHERE kode_motif = ?", array($kode_motif))->row();
		if ($temp->kategori == "TULIS") {
			$this->db->query("UPDATE motif_batik, motif_batik_tulis
									 SET nama_motif = ?
							  		 WHERE motif_batik.kode_motif = motif_batik_tulis.kode_motif 
							  		 AND motif_batik.kode_motif = ?", array($nama_motif, $kode_motif));
		} else {
			$this->db->query("UPDATE motif_batik, motif_batik_cap
									 SET nama_motif = ?
							  		 WHERE motif_batik.kode_motif = motif_batik_cap.kode_motif 
							  		 AND motif_batik.kode_motif = ?", array($nama_motif, $kode_motif));
		}
	}
	function GetDataBatik($kode_motif) {
		$temp = $this->db->query("SELECT *
						  FROM motif_batik
						  WHERE kode_motif = ?", array($kode_motif))->row();
		if ($temp->kategori == "TULIS") {
			return $this->db->query("SELECT motif_batik.*, motif_batik_tulis.nama_motif
							  FROM motif_batik, motif_batik_tulis
							  WHERE motif_batik.kode_motif = motif_batik_tulis.kode_motif 
							  AND motif_batik.kode_motif = ?", array($kode_motif))->row();
		} else {
			return $this->db->query("SELECT motif_batik.*, motif_batik_cap.nama_motif
							  FROM motif_batik, motif_batik_cap
							  WHERE motif_batik.kode_motif = motif_batik_cap.kode_motif 
							  AND motif_batik.kode_motif = ?", array($kode_motif))->row();
		}
	}
	function HapusBatik($kode_motif){
		$temp = $this->db->query("SELECT *
						  FROM motif_batik
						  WHERE kode_motif = ?", array($kode_motif))->row();
		if ($temp->kategori == "TULIS") {
			$this->db->query("DELETE FROM motif_batik_tulis
							  WHERE motif_batik_tulis.kode_motif = ?", array($kode_motif));
			$this->db->query("DELETE FROM motif_batik
							  WHERE motif_batik.kode_motif = ?", array($kode_motif));
		} else {
			$this->db->query("DELETE FROM motif_batik_cap
							  WHERE motif_batik_cap.kode_motif = ?", array($kode_motif));
			$this->db->query("DELETE FROM motif_batik
							  WHERE motif_batik.kode_motif = ?", array($kode_motif));
		}
	}
	function UploadGambar($nama_file, $kode_motif){
		$this->db->query("UPDATE motif_batik
							SET nama_file = ?
							WHERE kode_motif = ?", array($nama_file, $kode_motif));
	}
	function CariTransaksi($bulan, $tahun) {
		return $this->db->query("SELECT * 
								 FROM pesanan 
								 LEFT JOIN pelanggan 
								 ON pesanan.id_pelanggan = pelanggan.id_pelanggan
								 WHERE tanggal_order LIKE '$tahun-$bulan-%'
								 ORDER BY nomor_pesanan DESC ")->result();
	}
	function GetTransaksiNota ($nomor_pesanan) {
		return $this->db->query("SELECT * 
								 FROM pesanan, order_batik, pelanggan, karyawan, produk 
								 WHERE pesanan.nomor_pesanan = order_batik.nomor_pesanan 
								 AND pesanan.id_karyawan = karyawan.id_karyawan
								 AND pesanan.id_pelanggan = pelanggan.id_pelanggan
								 AND order_batik.id_produk = produk.id_produk
								 AND pesanan.nomor_pesanan = ?",array($nomor_pesanan))->result();
	}
}