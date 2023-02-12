<?php

function redirect_to($url = '')
{
	header('Location: ' . $url);
	exit();
}

function cek_login($role = array())
{

	if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && isset($_SESSION['divisi']) && in_array($_SESSION['role'], $role)) {
		// do nothing
	} else {
		redirect_to("login.php");
	}
}

function get_role()
{

	if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
		if ($_SESSION['role'] == '1') {
			return 'admin';
		} else {
			return 'kadiv';
		}
	} else {
		return false;
	}
}

function tambahPelamar($data)
{
	global $koneksi;

	$nama = htmlspecialchars(isset($_POST['nama'])) ? trim($_POST['nama']) : '';
	$email = htmlspecialchars(isset($_POST['email'])) ? trim($_POST['email']) : '';
	$no_telp = htmlspecialchars(isset($_POST['no_telp'])) ? trim($_POST['no_telp']) : '';
	$no_ktp = htmlspecialchars(isset($_POST['no_ktp'])) ? trim($_POST['no_ktp']) : '';
	$tgl_lahir = (isset($_POST['tgl_lahir'])) ? trim($_POST['tgl_lahir']) : '';
	$pendidikan = (isset($_POST['pendidikan'])) ? trim($_POST['pendidikan']) : '';
	$id_lowongan = (isset($_POST['id_lowongan']) ? trim($_POST['id_lowongan']) : '');
	$dokumen = upload();
	if (!$dokumen) {
		return false;
	}

	$simpan = mysqli_query($koneksi, "INSERT INTO pelamar (id_pelamar, nama_pelamar, no_ktp, no_telp, email, tgl_lahir, pendidikan, dokumen, id_lowongan) VALUES (NULL, '$nama', '$no_ktp', '$no_telp', '$email', '$tgl_lahir', '$pendidikan', '$dokumen', $id_lowongan)");
	if ($simpan) {
		Header('Location:lowongan.php?status=sukses-baru');
	}
}

function upload()
{
	$id_lowongan = (isset($_POST['id_lowongan']) ? trim($_POST['id_lowongan']) : '');
	$namaFile = $_FILES['dokumen']['name'];
	$ukuranFile = $_FILES['dokumen']['size'];
	$error = $_FILES['dokumen']['error'];
	$tmpName = $_FILES['dokumen']['tmp_name'];

	// cek ekstensi file
	$ekstensiDokumenValid = ['pdf'];
	$ekstensiDokumen = explode('.', $namaFile);
	$ekstensiDokumen = strtolower(end($ekstensiDokumen));
	if (!in_array($ekstensiDokumen, $ekstensiDokumenValid)) {
		header('Location:pendaftaran.php?id_lowongan=' . $id_lowongan . '&status=1');
		return false;
	}

	// cek ukuran files
	if ($ukuranFile > 2000000) {
		header('Location:pendaftaran.php?id_lowongan=' . $id_lowongan . '&status=2');
		return false;
	}

	// Lolos semua tahap pengecekkan
	// rename nama file agar tidak menimpa
	$uniqNumber = uniqid();
	$rename = "CV" . date('Ymd') . $uniqNumber;
	$namaFileBaru = $rename . '.' . $ekstensiDokumen;

	move_uploaded_file($tmpName, '../pelamar/dokumen/' . $namaFileBaru);

	return $namaFileBaru;
}
