<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$ada_error = false;
$result = '';

$id_pelamar = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if (!$id_pelamar) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = mysqli_query($koneksi, "SELECT * FROM pelamar WHERE id_pelamar = '$id_pelamar'");
	$cek = mysqli_num_rows($query);

	if ($cek <= 0) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		mysqli_query($koneksi, "DELETE FROM pelamar WHERE id_pelamar = '$id_pelamar';");
		mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_pelamar = '$id_pelamar';");
		mysqli_query($koneksi, "DELETE FROM hasil_pelamar WHERE id_pelamar = '$id_pelamar';");
		redirect_to('daftar-pelamar.php?status=sukses-hapus');
	}
}
?>

<?php
$page = "Alternatif";
require_once('../template/header.php');
?>
	<?php if ($ada_error) : ?>
		<?php echo '<div class="alert alert-danger">' . $ada_error . '</div>'; ?>	
	<?php endif; ?>
<?php
require_once('../template/footer.php');
?>