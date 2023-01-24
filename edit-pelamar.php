<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id_pelamar = (isset($_GET['id'])) ? trim($_GET['id']) : '';
$lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan");

if (isset($_POST['submit'])) :

	$nama = $_POST['nama'];
	$no_telp = $_POST['no_telp'];
	$email = $_POST['email'];
	$id_lowongan = $_POST['id_lowongan'];

	// Validasi
	if (!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :

		$update = mysqli_query($koneksi, "UPDATE pelamar SET nama_pelamar = '$nama', no_telp = '$no_telp', email = '$email', id_lowongan = $id_lowongan WHERE id_pelamar = '$id_pelamar'");
		if ($update) {
			redirect_to('daftar-pelamar.php?status=sukses-edit');
		} else {
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
$page = "Pelamar";
require_once('template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pelamar</h1>

	<a href="list-pelamar.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
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

	<form action="edit-pelamar.php?id=<?php echo $id_pelamar; ?>" method="post">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data pelamar</h6>
			</div>
			<?php
			if (!$id_pelamar) {
			?>
				<div class="card-body">
					<div class="alert alert-danger">Data tidak ada</div>
				</div>
				<?php
			} else {
				$data = mysqli_query($koneksi, "SELECT * FROM pelamar WHERE id_pelamar='$id_pelamar'");
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
									<label class="font-weight-bold" for="nama">Nama</label>
									<input autocomplete="off" type="text" name="nama" required value="<?php echo $d['nama_pelamar']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="no_telp">No Telpon</label>
									<input autocomplete="off" type="text" name="no_telp" required value="<?php echo $d['no_telp']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="email">Email</label>
									<input autocomplete="off" type="text" name="email" required value="<?php echo $d['email']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold">Lowongan</label>
									<select name="id_lowongan" id="id_lowongan" class="form-control">
										<?php while ($row = mysqli_fetch_assoc($lowongan)) : ?>
											<option value="<?= $row['id_lowongan']; ?>" <?php if ($row['id_lowongan'] == $d['id_lowongan']) {
																							echo "selected";
																						} ?>><?= $row['nama_lowongan']; ?></option>
										<?php endwhile; ?>
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
require_once('template/footer.php');
?>