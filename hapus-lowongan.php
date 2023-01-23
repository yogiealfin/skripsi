<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$ada_error = false;
$result = '';

$id_lowongan = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if (!$id_lowongan) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = mysqli_query($koneksi, "SELECT * FROM lowongan WHERE id_lowongan = '$id_lowongan'");
	$cek = mysqli_num_rows($query);

	if ($cek <= 0) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		mysqli_query($koneksi, "DELETE FROM pelamar WHERE id_lowongan = '$id_lowongan';");
		mysqli_query($koneksi, "DELETE FROM lowongan WHERE id_lowongan = '$id_lowongan';");
		// mysqli_query($koneksi, "DELETE FROM hasil_pelamar WHERE id_pelamar = '$id_pelamar';");
		redirect_to('list-lowongan.php?status=sukses-hapus');
	}
}
?>

<?php
$page = "Alternatif";
require_once('template/header.php');
?>
	<?php if ($ada_error) : ?>
		<?php echo '<div class="alert alert-danger">' . $ada_error . '</div>'; ?>	
	<?php endif; ?>
<?php
require_once('template/footer.php');
?>