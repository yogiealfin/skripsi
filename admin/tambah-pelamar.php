<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;
$id_low = (isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : '');

$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$no_telp = (isset($_POST['no_telp'])) ? trim($_POST['no_telp']) : '';
$id_lowongan = (isset($_POST['id_lowongan']) ? trim($_POST['id_lowongan']) : '');
$lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan");
$getLowongan = $_GET['id_lowongan'];

if (isset($_POST['submit'])) :

	// Validasi
	if (!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	if (!$email) {
		$errors[] = 'Email tidak boleh kosong';
	}
	if (!$no_telp) {
		$errors[] = 'Nomor telepon tidak boleh kosong';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :
		$simpan = mysqli_query($koneksi, "INSERT INTO pelamar (id_pelamar, nama_pelamar, no_telp, email, id_lowongan) VALUES (NULL, '$nama', '$no_telp', '$email', $id_lowongan)");
		if ($simpan) {
			Header('Location:list-pelamar.php?id_lowongan=' . $id_low . '&status=sukses-baru');
		} else {
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

$page = "Pelamar";
require_once('../template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pelamar</h1>

	<a href="list-pelamar.php?id_lowongan=<?= $id_low; ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
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
			<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-plus"></i> Tambah Data Pelamar</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required value="<?php echo $nama; ?>" class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">No Telpon</label>
					<input autocomplete="off" type="tel" name="no_telp" pattern="[0-9]+" minlength="11" maxlength="13" required class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Email</label>
					<input autocomplete="off" type="email" name="email" required class="form-control" id="email" />
				</div>
			</div>
			<input type="hidden" name="id_lowongan" value="<?= $getLowongan; ?>">
		</div>
		<div class="card-footer text-right">
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
		</div>
	</div>
</form>

<?php
require_once('../template/footer.php');
?>