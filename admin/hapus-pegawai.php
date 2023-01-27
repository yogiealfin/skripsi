<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$ada_error = false;
$result = '';

$id_pegawai = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if (!$id_pegawai) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'");
	$cek = mysqli_num_rows($query);

	if ($cek <= 0) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai = '$id_pegawai';");
		mysqli_query($koneksi, "DELETE FROM penilaian_pegawai WHERE id_pegawai = '$id_pegawai';");
		mysqli_query($koneksi, "DELETE FROM hasil_pegawai WHERE id_pegawai = '$id_pegawai';");
		redirect_to('daftar-pegawai.php?status=sukses-hapus');
	}
}
?>

<?php
$page = "Pegawai";
require_once('../template/header.php');
?>
	<?php if ($ada_error) : ?>
		<?php echo '<div class="alert alert-danger">' . $ada_error . '</div>'; ?>	
	<?php endif; ?>
<?php
require_once('../template/footer.php');
?>