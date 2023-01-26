<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$id_periode = (isset($_POST['id_periode']) ? trim($_POST['id_periode']) : '');
$nama_periode = (isset($_POST['nama_periode']) ? trim($_POST['nama_periode']) : '');
$id_status = (isset($_POST['id_status']) ? trim($_POST['id_status']) : '');

$getStatus = mysqli_query($koneksi, "SELECT * FROM status");
// $status = mysqli_fetch_assoc($getStatus);

if (isset($_POST['submit'])) :

	// Validasi
	if (!$nama_periode) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	if (!$id_status) {
		$errors[] = 'Status tidak boleh kosong';
	}
	$result = mysqli_query($koneksi, "SELECT * FROM periode WHERE nama_periode = '$nama_periode'");
	if (mysqli_fetch_assoc($result)) {
		$errors[] = 'Periode penilaian sudah ada!';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :
		$simpan = mysqli_query($koneksi, "INSERT INTO periode (id_periode, nama_periode, id_status) VALUES (NULL, '$nama_periode', $id_status)");
		if ($simpan) {
			redirect_to('list-periode-penilaian.php?status=sukses-baru');
		} else {
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

$page = "Periode_Penilaian";
require_once('../template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Periode Penilaian</h1>

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
			<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-plus"></i> Tambah Data Periode Penilaian</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama Periode Penilaian</label>
					<input autocomplete="off" type="text" name="nama_periode" required class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold" for="id_status">Status Pegawai</label>
					<select name="id_status" id="id_status" class="form-control">
						<option value="">---Pilih Status--</option>
						<?php foreach ($getStatus as $key) : ?>
							<option value="<?= $key['id_status'] ?>"><?= $key['status'] ?></option>
						<?php endforeach; ?>
					</select>
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
require_once('../template/footer.php');
?>