<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

// $id_pelamar = (isset($_GET['id'])) ? trim($_GET['id']) : '';
$id_lowongan = (isset($_GET['id'])) ? trim($_GET['id']) : '';
// $lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan");

$getDivisi = mysqli_query($koneksi, "SELECT * FROM divisi");
if (isset($_POST['submit'])) :

	$nama_lowongan = $_POST['nama_lowongan'];
	$kuota = $_POST['kuota'];
	$tgl_buka = $_POST['tgl_buka'];
	$tgl_tutup = $_POST['tgl_tutup'];
	$id_divisi = $_POST['id_divisi'];

	$buka = strtotime($tgl_buka);
	$tutup = strtotime($tgl_tutup);

	// Validasi
	if (!$nama_lowongan) {
		$errors[] = 'Nama Lowongan tidak boleh kosong';
	}
	if ($buka > $tutup) {
		$errors[] = 'Tanggal tutup tidak boleh lebih awal dari tanggal buka lowongan!';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :

		$update = mysqli_query($koneksi, "UPDATE lowongan SET nama_lowongan = '$nama_lowongan', kuota = '$kuota', tgl_buka = '$tgl_buka', tgl_tutup = '$tgl_tutup' WHERE id_lowongan = '$id_lowongan'");
		if ($update) {
			// header("Location:list-pelamar.php?status=sukses-edit&id_lowongan=" . $id_lowongan);
			redirect_to('list-lowongan.php?id_lowongan=' . $id_lowongan . '&status=sukses-edit');
		} else {
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
$page = "Lowongan";
require_once('../template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Lowongan</h1>

	<a href="list-lowongan.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
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

	<form action="edit-lowongan.php?id=<?php echo $id_lowongan; ?>" method="post">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Lowongan</h6>
			</div>
			<?php
			if (!$id_lowongan) {
			?>
				<div class="card-body">
					<div class="alert alert-danger">Data tidak ada</div>
				</div>
				<?php
			} else {
				$data = mysqli_query($koneksi, "SELECT * FROM lowongan INNER JOIN divisi ON lowongan.id_divisi=divisi.id_divisi WHERE id_lowongan='$id_lowongan'");
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
									<label class="font-weight-bold" for="nama_lowongan">Nama Lowongan</label>
									<input autocomplete="off" type="text" name="nama_lowongan" required value="<?php echo $d['nama_lowongan']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="kuota">Kuota</label>
									<input autocomplete="off" type="text" name="kuota" required value="<?php echo $d['kuota']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold">Divisi</label>
									<select name="id_divisi" id="" class="form-control">
										<option value="<?= $d['id_divisi'] ?>"><?= $d['nama_divisi']; ?></option>
										<?php foreach ($getDivisi as $key) : ?>
											<?php if ($key['id_divisi'] != 10 && $key['id_divisi'] != $d['id_divisi']) : ?>
												<option value="<?= $key['id_divisi']; ?>"><?= $key['nama_divisi']; ?></option>
											<?php else : ?>
												<option value="<?= $key['id_divisi']; ?>" hidden><?= $key['nama_divisi']; ?></option>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="tgl_buka">Tanggal Buka Lowongan</label>
									<input autocomplete="off" type="date" name="tgl_buka" required class="form-control" id="tgl_buka" value="<?= $d['tgl_buka']; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="tgl_tutup">Tanggal Tutup Lowongan</label>
									<input autocomplete="off" type="date" name="tgl_tutup" required class="form-control" id="tgl_tutup" value="<?= $d['tgl_tutup']; ?>" />
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