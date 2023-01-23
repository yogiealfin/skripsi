<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$id_lowongan = (isset($_POST['id_lowongan']) ? trim($_POST['id_lowongan']) : '');
$nama_lowongan = (isset($_POST['nama_lowongan']) ? trim($_POST['nama_lowongan']) : '');
$kuota = (isset($_POST['kuota']) ? trim($_POST['kuota']) : '');


if (isset($_POST['submit'])) :

	// Validasi
	if (!$nama_lowongan) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	if (!$kuota) {
		$errors[] = 'Kuota tidak boleh kosong';
	}
	$result = mysqli_query($koneksi, "SELECT * FROM lowongan WHERE nama_lowongan = '$nama_lowongan'");
	if (mysqli_fetch_assoc($result)) {
		$errors[] = 'Lowongan Sudah ada!';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :
		$simpan = mysqli_query($koneksi, "INSERT INTO lowongan (id_lowongan, nama_lowongan, kuota) VALUES (NULL, '$nama_lowongan', $kuota)");
		if ($simpan) {
			redirect_to('list-lowongan.php?status=sukses-baru');
		} else {
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

$page = "Lowongan";
require_once('template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Lowongan</h1>

	<a href="list-lowongan.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<?php if (!empty($errors)) : ?>
	<div class="alert alert-danger">
		<?php foreach ($errors as $error) : ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<form action="" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-plus"></i> Tambah Data Lowongan</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama Lowongan</label>
					<input autocomplete="off" type="text" name="nama_lowongan" required class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Kuota</label>
					<input autocomplete="off" type="text" name="kuota" required class="form-control" />
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
		</div>
	</div>
</form>

<?php
require_once('template/footer.php');
?>