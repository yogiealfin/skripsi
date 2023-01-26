<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$ada_error = false;
$result = '';

$id_indikator = (isset($_GET['id'])) ? trim($_GET['id']) : '';

if (!$id_indikator) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = mysqli_query($koneksi, "SELECT * FROM indikator WHERE id_indikator = '$id_indikator'");
	$cek = mysqli_num_rows($query);

	if ($cek <= 0) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		mysqli_query($koneksi, "DELETE FROM indikator WHERE id_indikator = '$id_indikator';");
		redirect_to('list-indikator.php?status=sukses-hapus');
	}
}
?>

<?php
$page = "Indikator";
require_once('../template/header.php');
?>
	<?php if ($ada_error) : ?>
		<?php echo '<div class="alert alert-danger">' . $ada_error . '</div>'; ?>	
	<?php endif; ?>
<?php
require_once('../template/footer.php');
?>
