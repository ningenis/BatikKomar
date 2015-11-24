<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jual extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('umum');
		$this->load->model('modjual');
		$this->load->library('resize');

		if ($this->session->userdata('IzinkanAksesJual') != 'NemesisMengizinkan') {
			redirect('gerbang/FormLogin');
		} else {

		}
	}
	function FormGantiPassword() {
		$this->load->tmpJual('FormGantiPassword');
	}
	function GantiPassword() {
		$lama = $this->input->post('lama');
		$baru1 = $this->input->post('baru1');
		$baru2 = $this->input->post('baru2');

		$id_karyawan = $this->session->userdata('id_karyawan');


		$DataAdmin = $this->modjual->GetDataAdmin($id_karyawan);

		if($DataAdmin->HashPassword == $this->umum->hashPassword($lama)) {
			if($baru1 == $baru2) {
				$this->modjual->UbahPassword($id_karyawan, $this->umum->hashPassword($baru1));
				$this->Sukses('Berhasil!', 'Ganti password berhasil! :D');
			} else {
				$this->PesanError('Password lama yang dimasukkan benar. Tapi password baru yang dimasukkan tidak sama!');
			}
		} else {
			$this->PesanError('Password lama yang dimasukkan salah!');
		}
	}
	function JadikanUser($id_karyawan) {
		if($this->modjual->SudahAdaUser($id_karyawan)) {
			$this->PesanError("Karyawan tersebut sudah jadi user!");
		} else {
			$info = $this->modjual->InfoKaryawan($id_karyawan);
			$this->modjual->JadikanUser($id_karyawan, $info->nama_karyawan, $this->umum->hashPassword('1234'));
			$this->Sukses('Sukses Menambah User', "User $info->nama_karyawan berhasil ditambahkan, dengan password 1234");
		}
	}
	function DaftarTransaksiPelanggan($id_pelanggan) {
		$data['InfoPelanggan'] = $this->modjual->InfoPelanggan($id_pelanggan);
		$data['DaftarTelepon'] = $this->modjual->TeleponPelanggan($id_pelanggan);
		$data['DaftarTransaksiPelanggan'] = $this->modjual->DaftarTransaksiPelanggan($id_pelanggan);
		$data['DaftarOrderLinePelanggan'] = $this->modjual->DaftarOrderLinePelanggan($id_pelanggan);
		$this->load->tmpJual('DaftarTransaksiPelanggan', $data);
	}
	function KonfirmasiKembalikanBarang($nomor_pesanan) {
		$data['DataTransaksi'] = $this->modjual->GetDataTransaksi($nomor_pesanan);
		$data['DataOrderLine'] = $this->modjual->GetOrderLine($nomor_pesanan);
		$this->load->tmpJual('KonfirmasiKembalikanBarang', $data);
	}
	function KembalikanBarang($nomor_pesanan) {
		$this->modjual->KembalikanBarang($nomor_pesanan);
		$this->Sukses('Sukses Kembalikan Barang', 'Sukses mengembalikan semua barang dengan kode transaksi ' . $nomor_pesanan);
	}
	function index() {
		$this->load->tmpJual('index');
	}
	function FormKasir() {
		if($this->session->userdata('FormKasir') == 'FormAktif') {
			$temp = $this->modjual->DaftarKlien();
			$data['DaftarKlien'] = array();
			foreach($temp as $r) {
				$data['DaftarKlien'][$r->id_pelanggan] = $r->nama_pelanggan . ' | ' . $r->alamat_pelanggan;
			}
			$this->load->tmpJual('FormKasir', $data);
		} else {
			$this->load->tmpJual('FormKasirMulai');
		}
	}
	function MulaiTransaksi() {
		$this->session->set_userdata(array('FormKasir' => 'FormAktif'));
		$this->session->set_userdata(array('FormBarcode' => 'TidakAktif'));
		$this->cart->destroy();
		redirect('jual/FormKasir');
	}
	function DaftarKlien() {
		
			if($this->input->post('pencarian') == 'ya') {
				$atribut = $this->input->post('atribut');
				$kunci = $this->input->post('kunci');
				$data['DaftarKlien'] = $this->modjual->GetDaftarKlien($atribut, $kunci);
			} else {
				$data['DaftarKlien'] = $this->modjual->DaftarKlien();
			}
		$this->load->tmpJual('DaftarKlien', $data);
	}
	function DaftarBatik() {
		if($this->input->post('pencarian') == 'ya') {
			$atribut = $this->input->post('atribut');
			$kunci = $this->input->post('kunci');
			$data['DaftarBatik'] = $this->modjual->GetDaftarBatik($atribut, $kunci);
		} else {
			$data['DaftarBatik'] = $this->modjual->DaftarBatik();
		}		
		$this->load->tmpJual('DaftarBatik', $data);
	}
	function DaftarProduk() {
		if($this->input->post('pencarian') == 'ya') {
			$kunci = $this->input->post('kunci');
			$data['DaftarProduk'] = $this->modjual->GetDaftarProduk($kunci);
		} else {
			$data['DaftarProduk'] = $this->modjual->DaftarProduk();
		}		
		$this->load->tmpJual('DaftarProduk', $data);
	}
	function DaftarKategori() {
		$data['DaftarKategori'] = $this->modjual->DaftarKategori();
		$this->load->tmpJual('DaftarKategori', $data);
	}
	function TambahKlien() {
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$alamat_pelanggan = $this->input->post('alamat_pelanggan');
		$this->modjual->TambahKlien($nama_pelanggan, $alamat_pelanggan);
		$this->Sukses('Sukses Menambah Klien', "Klien <strong>$nama_pelanggan</strong> dengan alamat $alamat_pelanggan berhasil ditambahkan!");
	}
	function TambahKaryawan() {
		$nama_karyawan = $this->input->post('nama_karyawan');
		$jabatan = $this->input->post('jabatan');
		$this->modjual->TambahKaryawan($nama_karyawan, $jabatan);
		$this->Sukses('Sukses Menambah Karyawan', "Karyawan <strong>$nama_karyawan</strong> dengan jabatan $jabatan berhasil ditambahkan!");
	}
	function DaftarKaryawan() {
		if($this->input->post('pencarian') == 'ya') {
			$kunci = $this->input->post('kunci');
			$data['DaftarKaryawan'] = $this->modjual->GetDaftarKaryawan($kunci);
		} else {
			$data['DaftarKaryawan'] = $this->modjual->DaftarKaryawan();
		}
		$this->load->tmpJual('DaftarKaryawan', $data);
	}
	private function Sukses($judul, $detil) {
		$data['judulSukses'] = $judul;
		$data['detilSukses'] = $detil;

		$this->load->tmpJual('Sukses', $data);
	}
	function TambahKategori() {
		$kode_motif = $this->input->post('kode_motif');
		$kategori = $this->input->post('kategori');
		$nama_motif = $this->input->post('nama_motif');
		$nama_pembuat = $this->input->post('nama_pembuat');
		$tanggal_dibuat = $this->input->post('tanggal_dibuat');
		$this->modjual->TambahKategori($kode_motif, $nama_motif, $nama_pembuat, $tanggal_dibuat, $kategori);
		$this->Sukses('Sukses Menambah Motif Batik', "Motif Batik <strong>$nama_motif</strong> berhasil ditambahkan!");
	}
	function TambahProduk() {
		$kode_motif = $this->input->post('kode_motif');
		$nama_produk = $this->input->post('nama_produk');
		$harga_satuan = $this->input->post('harga_satuan');
		$this->modjual->TambahProduk($kode_motif, $nama_produk, $harga_satuan);
		$this->Sukses('Sukses Menambah Kategori', "Produk <strong>$nama_produk</strong> berhasil ditambahkan!");
	}
	function FormUbahKlien($id_pelanggan) {
		$data['InfoKlien'] = $this->modjual->InfoKlien($id_pelanggan);
		$this->load->tmpJual('InfoKlien', $data);
	}
	function UbahKlien($KlienID) {
		$Nama = $this->input->post('nama_pelanggan');
		$Alamat = $this->input->post('alamat_pelanggan');

		$this->modjual->UbahKlien($KlienID, $Nama, $Alamat);
		$this->Sukses('Ubah Klien', "Mengubah informasi $Nama berhasil!");
	}
	function FormHapusKlien($id_pelanggan) {
		$data['InfoKlien'] = $this->modjual->InfoKlien($id_pelanggan);
		$this->load->tmpJual('HapusKlien', $data);
	}
	function HapusKlien($id_pelanggan) {
		$data['InfoKlien'] = $this->modjual->InfoKlien($id_pelanggan);
		$this->modjual->HapusKlien($id_pelanggan);
		$this->Sukses('Sukses Hapus Klien', 'Sukses menghapus klien dengan nama <code>' . $data['InfoKlien']->nama_pelanggan . '</code>');
	}
	function FormHapusKaryawan($id_karyawan) {
		$data['DataKaryawan'] = $this->modjual->GetDataKaryawan($id_karyawan);
		$this->load->tmpJual('HapusKaryawan', $data);
	}
	function HapusKaryawan($id_karyawan) {
		$data['DataKaryawan'] = $this->modjual->GetDataKaryawan($id_karyawan);
		$this->modjual->HapusKaryawan($id_karyawan);
		$this->Sukses('Sukses Hapus Karyawan', 'Sukses menghapus karyawan dengan nama <code>' . $data['DataKaryawan']->nama_karyawan . '</code>');
	}
	function FormHapusProduk($id_produk) {
		$data['DataProduk'] = $this->modjual->GetDataProduk($id_produk);
		$this->load->tmpJual('HapusProduk', $data);
	}
	function HapusProduk($id_produk) {
		$data['DataProduk'] = $this->modjual->GetDataProduk($id_produk);
		$this->modjual->HapusProduk($id_produk);
		$this->Sukses('Sukses Hapus Produk', 'Sukses menghapus produk dengan nama <code>' . $data['DataProduk']->nama_produk . '</code>');
	}
	function FormUbahKaryawan($id_karyawan) {
		$data['InfoKaryawan'] = $this->modjual->InfoKaryawan($id_karyawan);
		$this->load->tmpJual('InfoKaryawan', $data);
	}
	function UbahKaryawan($PelangganID) {
		$Nama = $this->input->post('nama_karyawan');
		$Jabatan = $this->input->post('jabatan');

		$this->modjual->UbahKaryawan($PelangganID, $Nama, $Jabatan);
		$this->Sukses('Ubah Karyawan', "Mengubah informasi $Nama berhasil!");
	}
	/*
	function FormHapusKaryawan($id_karyawan) {
		$data['InfoKaryawan'] = $this->modjual->InfoKaryawan($id_karyawan);
		$this->load->tmpJual('HapusKaryawan', $data);
	}
	*/
	/*
	function HapusKaryawan($id_karyawan) {
		$data['InfoKaryawan'] = $this->modjual->InfoKaryawan($id_karyawan);
		$this->modjual->HapusKaryawan($id_karyawan);
		$this->Sukses('Sukses Hapus Karyawan', 'Sukses menghapus karyawan dengan nama <code>' . $data['InfoKaryawan']->nama_karyawan . '</code>');
	}
	*/
	function FormUbahProduk($id_produk) {
		$data['InfoProduk'] = $this->modjual->InfoProduk($id_produk);
		$this->load->tmpJual('InfoProduk', $data);
	}
	function UbahProduk($ProdukID) {
		$Nama = $this->input->post('nama_produk');
		$Harga = $this->input->post('harga_satuan');

		$this->modjual->UbahProduk($ProdukID, $Nama, $Harga);
		$this->Sukses('Ubah Produk', "Mengubah informasi $Nama berhasil!");
	}
	/*
	function FormHapusProduk($id_produk) {
		$data['InfoProduk'] = $this->modjual->InfoProduk($id_produk);
		$this->load->tmpJual('HapusProduk', $data);
	}
	*/
	/*
	function HapusProduk($id_produk) {
		$data['InfoProduk'] = $this->modjual->InfoProduk($id_produk);
		$this->modjual->HapusProduk($id_produk);
		$this->Sukses('Sukses Hapus Produk', 'Sukses menghapus produk dengan nama <code>' . $data['InfoProduk']->nama_produk . '</code>');
	}
	*/
	function KasirTambahProduk() {
		$id_produk = $this->input->post('KodeProduk');
		$detil_produk = $this->modjual->KasirTambahProduk($id_produk);
		if($detil_produk == 'ProdukTidakKetemu') {
			// Kode Produknya Salah
			$data['PesanError'] = "Produk dengan kode <strong>$id_produk</strong> tidak ditemukan!";
			
			//$this->load->tmpJual('FormKasir', $data);
			redirect('jual/FormKasir');
		} else { 
			$DataBaru = array(
							'id' => $detil_produk->id_produk,
							'name' => $detil_produk->nama_produk,
							'qty' => '1',
							'price' => $detil_produk->harga_satuan
						);
			$this->cart->insert($DataBaru);

			redirect('jual/FormKasir');
			//$this->load->tmpJual('FormKasir');
		}
	}
	function FormKasirBatalkan() {
		$this->load->tmpJual('FormKasirBatalkan');
	}
	function KasirBatal() {
		$this->session->set_userdata(array('FormKasir' => 'TidakAktif'));
		$this->cart->destroy();
		redirect('jual/Beranda');
	}
	function Beranda() {
		$this->load->tmpJual('index');
	}
	function FormTambahKategori() {
		$this->load->tmpJual('FormTambahKategori');
	}
	function FormTambahProduk() {
		//$this->load->tmpJual('FormTambahProduk');
			$temp = $this->modjual->DaftarBatik();
			$data['DaftarBatik'] = array();
			foreach($temp as $r) {
				$data['DaftarBatik'][$r->kode_motif] = $r->kode_motif . ' | ' . $r->nama_motif;
			}
			$this->load->tmpJual('FormTambahProduk', $data);
	}
	function FormTambahKlien() {
		$this->load->tmpJual('FormTambahKlien');
	}
	function FormTambahKaryawan() {
		$this->load->tmpJual('FormTambahKaryawan');
	}
	function KasirDelete($RowID) {
		$UpdateData = array('rowid' => $RowID,
							 'price' => 0,
							 'qty' => 0);
		$this->cart->update($UpdateData);
		redirect('jual/FormKasir');
	}
	
	/* Barcode */
	function FormBarcodeMulai() {
		$this->load->tmpJual('FormBarcodeMulai');
	}
	function BarcodeMulai() {
		$this->session->set_userdata(array('FormBarcode' => 'Aktif'));
		$this->session->set_userdata(array('FormKasir' => 'TidakAktif'));
		$this->cart->destroy();
		redirect('jual/FormBarcode');
	}
	function FormBarcode() {
		if ($this->session->userdata('FormBarcode') !='Aktif') {
			redirect('jual/FormBarcodeMulai');
		}
		$this->load->tmpJual('FormBarcode');
	}
	function BarcodeCari() {
		$dicari = $this->input->post('dicari');
		
		if ($dicari != '') {
			$daftarCari = $this->modjual->CariProduk($dicari);
			if($daftarCari['status'] != 'TidakAda') {
				$data['adaDaftarCari'] = 'Ya';
				$data['daftarCari'] = $daftarCari['daftarProduk'];
				$data['numRows'] = $daftarCari['numRows'];
			} else {
				$data['adaDaftarCari'] = 'Tidak';
			}
			$this->load->tmpJual('FormBarcode', $data);
		} else {
			redirect('jual/FormBarcode');
		}
	}
	function BarcodeTambahkan() {
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$qty = $this->input->post('qty');
		$harga = $this->input->post('harga');
		
		$DataBaru = array(
						'id' => $id,
						'name' => $nama,
						'qty' => $qty,
						'price' => $harga
					);
		$this->cart->insert($DataBaru);
		redirect('jual/FormBarcode');
	}
	function BarcodeKurang() {
	}
	function FormBarcodeBatalkan() {
		$this->load->tmpJual('FormBarcodeBatalkan');
	}
	function BarcodeBatalkan() {
		$this->cart->destroy();
		$this->session->set_userdata(array('FormBarcode' => 'TidakAktif'));
		redirect('jual/FormBarcodeMulai');
	}
	function FormBarcodeSelesai() {
		$this->load->tmpJual('FormBarcodeSelesai');
	}
	function BarcodeDownload() {
		$this->load->library('fpdf');
		$this->fpdf->FPDF('P','cm','A4');
		$this->fpdf->AddPage();
		$this->fpdf->AddFont('free3of9','','free3of9.php');
		
		
		$banyaknya = $this->cart->total_items();
		
		$daftarBarcode = array();
		
		$urutan = 0;
		foreach($this->cart->contents() as $r) {
			for($k = 1; $k <= $r['qty']; $k++) {
				$urutan++;
				$daftarBarcode[$urutan] = array	(
													'id' => $r['id'],
													'name' => $r['name'],
													'qty' => $r['qty'],
													'price' => $r['price']
												);
			}
		}
		
		$baris = 0;
		for ( $i = 1; $i <= $banyaknya; $i += 4 )
		{
			$j = 1;
			$this->fpdf->SetFont('free3of9','',30);
			
			if(($banyaknya - $i) < 4) {
				if(( ($banyaknya - $i + 1) % 4) != 0) {
					$ujung = ($banyaknya - $i + 1) % 4;
				} else {
					$ujung = 4;
				}
			} else {
				$ujung = 4;
			}
			
			$baris++;
			if($baris % 14 == 0) {
				$this->fpdf->AddPage();
			}
			
			for ($j = 0; $j < $ujung; $j++ ) {
				$this->fpdf->Cell(0.5, 1, '', 'LT', 0, 'L');
				$this->fpdf->Cell(4, 1, '*'. $daftarBarcode[$i + $j]['id'] .'*','RT',0,'L');
			}
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Arial','',8);
			for ($j = 0; $j < $ujung; $j++ ) {
				$this->fpdf->Cell(0.5, 0.4, '', 'L', 0, 'L');
				$this->fpdf->Cell(4,0.4, $daftarBarcode[$i + $j]['name'],'R',0,'L');
			}
			$this->fpdf->Ln();
			for ($j = 0; $j < $ujung; $j++) {
				$this->fpdf->Cell(0.5, 0.4, '', 'LB', 0, 'L');
				$this->fpdf->Cell(1.3, 0.4, $daftarBarcode[$i + $j]['id'], 'BR', 0, 'L');
				$this->fpdf->Cell(2.7,0.4, 'Rp ' . number_format($daftarBarcode[$i + $j]['price'], 0, '', '.'),'BR',0,'L');
			}
			$this->fpdf->Ln();
		}
		$this->fpdf->Output();
	}
	function FormHapusKategori($KategoriID) {
		$dicari = $this->modjual->CariKategori($KategoriID);
		$data['KategoriID'] = $KategoriID;
		$data['Nama'] = $dicari->Nama;
		$this->load->tmpJual('FormHapusKategori', $data);
	}
	function HapusKategori() {
		$KategoriID = $this->input->post('KategoriID');
		$this->modjual->HapusKategori($KategoriID);
		redirect('jual/DaftarKategori');
	}

	function KonfirmasiTransaksi() {
		$id_pelanggan = $this->input->post('KlienID');
		$TipeTransaksi = $this->input->post('TipeTransaksi');

		$data = array();
		$data['DetilKlien'] = $this->modjual->InfoKlien($id_pelanggan);
		$data['KlienID'] = $id_pelanggan;
		$data['TipeTransaksi'] = $TipeTransaksi;

		$data['TotalHarga'] = 0;
		foreach($this->cart->contents() as $items) {
			$data['DaftarItem'][] = array(  'id' => $items['id'],
											'name' => $items['name'],
											'qty' => $items['qty'],
											'price' => $items['price']);
			$data['TotalHarga'] += $items['price'] * $items['qty'];
		}
		$this->load->tmpJual('KonfirmasiTransaksi', $data);
	}
	function TambahQty() {
		$rowid = $this->input->post('rowid');
		$qty = $this->input->post('Qty');
		$data = array('rowid' => $rowid,
					   'qty' => $qty);
		$this->cart->update($data);
		redirect('jual/FormKasir');
	}
	function ProsesTransaksi() {
		$KlienID = $this->input->post('KlienID');
		$TipeTransaksi = $this->input->post('TipeTransaksi');

		$TotalHarga = 0;
		foreach($this->cart->contents() as $items) {
			$data['DaftarItem'][] = array(  'id' => $items['id'],
											'name' => $items['name'],
											'qty' => $items['qty'],
											'price' => $items['price']);
			$TotalHarga += $items['price'] * $items['qty'];
		}

		$id_karyawan = $this->session->userdata('id_karyawan');

		$TransaksiID = $this->modjual->ProsesTransaksi($KlienID, $TotalHarga, $TipeTransaksi, $id_karyawan);

		foreach($data['DaftarItem'] as $index => $r) {
			$this->modjual->TransaksiBarang($TransaksiID, $r['id'], $r['qty'], $r['price'], $TipeTransaksi);
		}
		$this->DestroyKasir();
		redirect('jual/DaftarTransaksi');
	}
	private function DestroyKasir() {
		$this->session->set_userdata(array('FormKasir' => 'FormTidakAktif'));
		$this->cart->destroy();
	}

	function DaftarTransaksi() {
		if($this->input->post('pencarian') == 'ya') {
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$data['DaftarTransaksi'] = $this->modjual->CariTransaksi($bulan, $tahun);
			$data['DaftarOrderLine'] = $this->modjual->DaftarOrderLine();
		} else {
			$data['DaftarTransaksi'] = $this->modjual->DaftarTransaksi();
			$data['DaftarOrderLine'] = $this->modjual->DaftarOrderLine();
		}
		$this->load->tmpJual('DaftarTransaksi', $data);
	}
	function TeleponPelanggan($id_pelanggan) {
		$data['id_pelanggan'] = $id_pelanggan;
		$data['InfoPelanggan'] = $this->modjual->InfoPelanggan($id_pelanggan);
		$data['TeleponPelanggan'] = $this->modjual->TeleponPelanggan($id_pelanggan);
		$this->load->tmpJual('TeleponPelanggan', $data);
	}
	function UbahTeleponPelanggan() {
		$data['id_pelanggan'] = $this->input->post('id_pelanggan');
		$qtyPhone = (int) $this->input->post('qtyPhone');
		$data['teleponBaru'] = array();
		$data['teleponLama'] = array();
		for($i = 1; $i <= $qtyPhone; $i++) {
			$data['teleponBaru'][$i] = $this->input->post('telp_baru_' . $i);
			$data['teleponLama'][$i] = $this->input->post('telp_lama_' . $i);
		}
		if($this->input->post('telepon_baru') != '') {
			$data['nomor_tambahan'] = $this->input->post('telepon_baru');
		}
		$this->modjual->UbahTeleponPelanggan($data);
		$this->Sukses('Berhasil', 'Berhasil mengubah telepon pelanggan!');
	}
	function UbahMotif($kode_motif) {
		$nama_motif = $this->input->post('nama_motif');
		$nama_pembuat = $this->input->post('nama_pembuat');
		$tanggal_dibuat = $this->input->post('tanggal_dibuat');

		$this->modjual->UbahMotif1($kode_motif, $nama_pembuat, $tanggal_dibuat);
		$this->modjual->UbahMotif2($kode_motif, $nama_motif);
		$this->Sukses('Ubah Motif', "Mengubah informasi $nama_motif berhasil!");
	}
	function FormUbahMotif($kode_motif) {
		$data['DataBatik'] = $this->modjual->GetDataBatik($kode_motif);
		$this->load->tmpJual('FormUbahMotif', $data);
	}
	function FormHapusMotif($kode_motif) {
		$data['DataBatik'] = $this->modjual->HapusBatik($kode_motif);
		$this->load->tmpJual('HapusMotif', $data);
	}
	function HapusMotif($kode_motif) {
		$data['DataBatik'] = $this->modjual->GetDataBatik($kode_motif);
		$this->modjual->HapusBatik($kode_motif);
		$this->Sukses('Sukses Hapus Motif Batik', 'Sukses menghapus motif batik dengan nama <code>' . $data['DataBatik']->nama_motif . '</code>');
	}
	/*
	function UbahProduk($id_produk) {
		$kode_motif = $this->input->post('kode_motif');
		$nama_produk = $this->input->post('nama_produk');
		$harga_satuan = $this->input->post('harga_satuan');

		$this->modjual->UbahProduk($id_produk, $kode_motif, $nama_produk, $harga_satuan);
		$this->Sukses('Ubah Produk', "Mengubah informasi $nama_produk berhasil!");
	}
	*/
	/*
	function FormUbahProduk($id_produk) {
		$data['DataProduk'] = $this->modjual->GetDataProduk($id_produk);
		$this->load->tmpJual('FormUbahProduk', $data);
	}
	*/
	/*
	function UbahKaryawan($id_karyawan) {
		$nama_karyawan = $this->input->post('nama_karyawan');
		$jabatan = $this->input->post('jabatan');

		$this->modjual->UbahKaryawan($id_karyawan, $nama_karyawan, $jabatan);
		$this->Sukses('Ubah Karyawan', "Mengubah informasi $nama_karyawan berhasil!");
	}
	*/
	/*
	function FormUbahKaryawan($id_karyawan) {
		$data['DataKaryawan'] = $this->modjual->GetDataKaryawan($id_karyawan);
		$this->load->tmpJual('FormUbahKaryawan', $data);
	}
	*/
	function FormPanelGambar($kode_motif) {
		$data['PanelGambar'] = $this->modjual->GetDataBatik($kode_motif);
		$this->load->tmpJual('PanelGambar', $data);
	}
	function UploadGambar() {
		$temp = $this->input->post("kode_motif");
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$extension = end(explode(".", $_FILES["gambar"]["name"]));
		if ((($_FILES["gambar"]["type"] == "image/gif")
			|| ($_FILES["gambar"]["type"] == "image/jpeg")
			|| ($_FILES["gambar"]["type"] == "image/jpg")
			|| ($_FILES["gambar"]["type"] == "image/png"))
			&& ($_FILES["gambar"]["size"] < 10000000)
			&& in_array($extension, $allowedExts)) {
	  		if ($_FILES["gambar"]["error"] > 0) {
	    		$this->PesanError("File yang anda upload harus bertipe gif, jpeg, jpg, png");
	    	} else {
	    		$target_path = "gambar_motif_batik/";
	    		if(move_uploaded_file($_FILES['gambar']['tmp_name'], $target_path.$temp.'.'.$extension)) {
	    			//rename($target_path.$_FILES['gambar']['tmp_name'], $target_path.$temp.$extension);
	    			$masukan['nama_file'] = basename ($_FILES['gambar']['tmp_name']);
	    			$this->modjual->UploadGambar($temp.'.'.$extension, $temp);

	    			$this->resize->INISIALISASI($target_path . $temp . '.' . $extension);
		   			$this->resize->resizeImage(400, 400, 'auto');
					$this->resize->saveImage($target_path . $temp . '_400px.' . $extension, 100);

	    			redirect("jual/FormPanelGambar/$temp");
	   			} else {
	   				$this->resize->INISIALISASI($target_path . $temp . '.' . $extension);
		   			$this->resize->resizeImage(400, 400, 'auto');
					$this->resize->saveImage($target_path . $temp . '_400px.' . $extension, 100);
					
	   				redirect("jual/FormPanelGambar/$temp");
	   			}
	    	}

	  	} else {
	  		$this->PesanError("File yang anda upload harus bertipe gif, jpeg, jpg, png dan ukurannya harus di bawah 10 MB");
	  	}
	} 
	function PesanError ($temp) {
		$data['temp'] = $temp;
		$this->load->tmpJual('PesanError', $data);
	}
	function CetakNota($nomor_pesanan) {
		$this->load->library('fpdf');
		$this->fpdf->FPDF('P','cm','A4');
		$this->fpdf->AddPage();
		//$this->fpdf->AddFont('free3of9','','free3of9.php');
		$temp = $this->modjual->GetTransaksiNota($nomor_pesanan);
		$total_harga = 0;
		//$banyaknya = $this->cart->total_items();
		$cek = 0;
		$cek1 = 0;
		$cek2 = 0;
		$cek3 = 0;
		$cek4 = 0;
		$cek5 = 0;
		$cek6 = 0;
		$image = base_url().'img/logo_batik_komar.jpg';
		$this->fpdf->SetFont('Arial','',18);
		$this->fpdf->Cell(10, 1.2, $this->fpdf->Image($image,$this->fpdf->GetX(),$this->fpdf->GetY(),7), '', 0, 'C');
		$this->fpdf->Ln();
		$this->fpdf->Ln();
		$this->fpdf->SetFont('Arial','',12);
		foreach ($temp as $r) {	
			$cek6++;
			if ($cek6 == 1) {
				$this->fpdf->Cell(4, 0.65, 'Nomor Transaksi', '', 0, 'L');
				$this->fpdf->Cell(5, 0.65, ': '.$r->nomor_pesanan, '', 0, 'L');
			} else {}
		}
		$this->fpdf->Ln();
		foreach ($temp as $r) {	
			$cek++;
			if ($cek == 1) {
				$this->fpdf->Cell(4, 0.65, 'Tanggal Order', '', 0, 'L');
				$this->fpdf->Cell(5, 0.65, ': '.$r->tanggal_order, '', 0, 'L');
			} else {}
		}
		$this->fpdf->Ln();
		foreach ($temp as $r) {	
			$cek1++;
			if ($cek1 == 1) {
				$this->fpdf->Cell(4, 0.65, 'Kasir', '', 0, 'L');
				$this->fpdf->Cell(5, 0.65, ': '.$r->nama_karyawan, '', 0, 'L');
			} else {}
		}
		$this->fpdf->Ln();
		foreach ($temp as $r) {	
			$cek5++;
			if ($cek5 == 1) {
				$this->fpdf->Cell(4, 0.65, 'ID Pelanggan', '', 0, 'L');
				$this->fpdf->Cell(5, 0.65, ': '.$r->id_pelanggan, '', 0, 'L');
			} else {}
		}
		$this->fpdf->Ln();
		foreach ($temp as $r) {	
			$cek2++;
			if ($cek2 == 1) {
				$this->fpdf->Cell(4, 0.65, 'Nama Pelanggan', '', 0, 'L');
				$this->fpdf->Cell(5, 0.65, ': '.$r->nama_pelanggan, '', 0, 'L');
			} else {}
		}
		$this->fpdf->Ln();
		foreach ($temp as $r) {	
			$cek3++;
			if ($cek3 == 1) {
				$this->fpdf->Cell(4, 0.65, 'Tipe Transaksi', '', 0, 'L');
				$this->fpdf->Cell(5, 0.65, ': '.$r->status_pesanan, '', 0, 'L');
			} else {}
		}
		$this->fpdf->Ln();
		$this->fpdf->Ln();
		//$this->fpdf->Cell(5, 0.7, 'Produk', 'LRTB', 0, 'C');
		//$this->fpdf->Cell(1, 0.7, 'Qty', 'LRTB', 0, 'C');
		//$this->fpdf->Cell(3, 0.7, 'Harga Satuan', 'LRTB', 0, 'C');
		//$this->fpdf->Ln();
		foreach ($temp as $r) {
				$subtotal = 0;
				$this->fpdf->Cell(5, 0.7, $r->nama_produk, '', 0, 'C');
				$this->fpdf->Ln();
				$subtotal = $r->harga_satuan * $r->quantity;
				$total_harga += $subtotal;
				$this->fpdf->Cell(8, 0.7, $r->quantity.' x Rp '.number_format($r->harga_satuan, 0, '', '.'). ' = Rp '.number_format($subtotal, 0, '', '.'), '', 0, 'C');
				//$this->fpdf->Cell(4, 0.7, 'Rp '.number_format($r->harga_satuan, 0, '', '.'), '', 0, 'L');
				//$this->fpdf->Cell(3, 0.7, ' = Rp '.number_format($subtotal, 0, '', '.'), '', 0, 'R');
				$this->fpdf->Ln();
		}
		$this->fpdf->Ln();
		foreach ($temp as $r) {	
			$cek4++;
			if ($cek4 == 1) {
				$this->fpdf->SetFont('Arial','',14);
				$this->fpdf->Cell(8, 0.75, 'Total Harga', '', 0, 'R');
				$this->fpdf->Ln();
				$this->fpdf->SetFont('Arial','',18);
				$this->fpdf->Cell(8, 0.75, 'Rp '.number_format($total_harga, 0, '', '.'), '', 0, 'R');
			} else {}
		}
		$this->fpdf->Ln();
		$this->fpdf->Ln();
		$this->fpdf->SetFont('Arial','',11);
		$this->fpdf->Cell(8, 0.75, 'Terima kasih atas kunjungan Anda', '', 0, 'C');
		$image = base_url().'img/nemesis_nota.jpg';
		$this->fpdf->Ln();
		$this->fpdf->Cell(2.75, 0.75, '', '', 0, 'C');
		$this->fpdf->Cell(8, 1.2, $this->fpdf->Image($image,$this->fpdf->GetX(),$this->fpdf->GetY(),3), '', 0, 'C');
		$this->fpdf->Output();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */