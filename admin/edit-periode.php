<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';
$getStatus = mysqli_query($koneksi, "SELECT * FROM status");

// $id_pelamar = (isset($_GET['id'])) ? trim($_GET['id']) : '';
$id_periode = (isset($_GET['id_periode'])) ? trim($_GET['id_periode']) : '';
// $lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan");

if (isset($_POST['submit'])) :

	$nama_periode = $_POST['nama_periode'];
	$id_status = $_POST['id_status'];

	// Validasi
	if (!$nama_periode) {
		$errors[] = 'Nama Lowongan tidak boleh kosong';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :

		$update = mysqli_query($koneksi, "UPDATE periode SET nama_periode = '$nama_periode', id_status = '$id_status' WHERE id_periode = '$id_periode'");
		if ($update) {
			// header("Location:list-pelamar.php?status=sukses-edit&id_lowongan=" . $id_lowongan);
			redirect_to('list-periode-penilaian.php?id_periode=' . $id_periode . '&status=sukses-edit');
		} else {
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
$page = "Periode_Penilaian";
require_once('../template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Periode Penilaian</h1>

	<a href="list-periode-penilaian.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
		<span class="text">Kembali</span>
	</a>
</div>

<?php if (!empty($errors)) : ?>
	<div class="alert alert-info">
		<?php foreach ($errors as $error) : ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if ($sukses) : ?>
	<div class="alert alert-success">
		Data berhasil disimpan
	</div>
<?php elseif ($ada_error) : ?>
	<div class="alert alert-info">
		<?php echo $ada_error; ?>
	</div>
<?php else : ?>

	<form action="edit-periode.php?id_periode=<?php echo $id_periode; ?>" method="post">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Periode Penilaian</h6>
			</div>
			<?php
			if (!$id_periode) {
			?>
				<div class="card-body">
					<div class="alert alert-danger">Data tidak ada</div>
				</div>
				<?php
			} else {
				$data = mysqli_query($koneksi, "SELECT * FROM periode WHERE id_periode='$id_periode'");
				$cek = mysqli_num_rows($data);
				if ($cek <= 0) {
				?>
					<div class="card-body">
						<div class="alert alert-danger">Data tidak ada</div>
					</div>
					<?php
				} else {
					while ($d = mysqli_fetch_assoc($data)) {
					?>
						<div class="card-body">
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="nama_periode">Nama Periode</label>
									<input autocomplete="off" type="text" name="nama_periode" required value="<?php echo $d['nama_periode']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="id_status">Status Pegawai Yang Dinilai</label>
									<select name="id_status" id="id_status" class="form-control">
										<option value="">--Pilih Status--</option>
										<?php foreach ($getStatus as $key) : ?>
											<option value="<?= $key['id_status'] ?>" selected><?= $key['status'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="card-footer text-right">
							<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
							<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
						</div>
			<?php
					}
				}
			}
			?>
		</div>
	</form>

<?php
endif;
require_once('../template/footer.php');
?>