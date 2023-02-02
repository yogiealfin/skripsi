<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id_div = (isset($_GET['id_divisi']) ? $_GET['id_divisi'] : '');
$id_pegawai = (isset($_GET['id'])) ? trim($_GET['id']) : '';
$divisi = mysqli_query($koneksi, "SELECT * FROM divisi");
$status = mysqli_query($koneksi, "SELECT * FROM status");

if (isset($_POST['submit'])) :

	$nip = $_POST['nip'];
	$nama = $_POST['nama_pegawai'];
	$no_telp = $_POST['no_telp'];
	$email = $_POST['email'];
	$tgl_bergabung = $_POST['tgl_bergabung'];
	$id_status = $_POST['id_status'];
	$id_divisi = $_POST['id_divisi'];

	// Validasi
	if (!$nip) {
		$errors[] = 'NIP tidak boleh kosong';
	}
	if (!$nama) {
		$errors[] = 'Nama tidak boleh kosong';
	}
	if (!$email) {
		$errors[] = 'Email tidak boleh kosong';
	}
	if (!$tgl_bergabung) {
		$errors[] = 'Tanggal bergabung tidak boleh kosong';
	}
	if (!$id_status) {
		$errors[] = 'Status tidak boleh kosong';
	}
	if (!$id_divisi) {
		$errors[] = 'Divisi tidak boleh kosong';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :

		$update = mysqli_query($koneksi, "UPDATE pegawai SET nip= '$nip', nama_pegawai = '$nama', no_telp = '$no_telp', email = '$email', id_status = '$id_status', id_divisi = '$id_divisi' WHERE id_pegawai = '$id_pegawai'");
		if ($update) {
			// header("Location:list-pelamar.php?status=sukses-edit&id_lowongan=" . $id_lowongan);
			redirect_to('list-pegawai.php?id_divisi=' . $id_divisi . '&status=sukses-edit');
		} else {
			$errors[] = 'Data gagal diupdate';
		}
	endif;

endif;
?>

<?php
$page = "Pegawai";
require_once('../template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pegawai</h1>

	<a href="list-pegawai.php?id_divisi=<?= $id_div; ?>" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
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

	<form action="edit-pegawai.php?id=<?php echo $id_pegawai; ?>" method="post">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Pegawai</h6>
			</div>
			<?php
			if (!$id_pegawai) {
			?>
				<div class="card-body">
					<div class="alert alert-danger">Data tidak ada</div>
				</div>
				<?php
			} else {
				$data = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'");
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
									<label class="font-weight-bold" for="nama">NIP</label>
									<input autocomplete="off" type="text" name="nip" required value="<?php echo $d['nip']; ?>" class="form-control" readonly />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="nama">Nama</label>
									<input autocomplete="off" type="text" name="nama_pegawai" required value="<?php echo $d['nama_pegawai']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold" for="no_telp">No Telpon</label>
									<input autocomplete="off" type="text" name="no_telp" required pattern="[0-9]+" minlength="11" maxlength="13" value="<?php echo $d['no_telp']; ?>" class="form-control" />
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
									<label class="font-weight-bold" for="tgl_bergabung">Tanggal Bergabung</label>
									<input autocomplete="off" type="date" name="tgl_bergabung" required value="<?php echo $d['tgl_bergabung']; ?>" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold">Status</label>
									<select name="id_status" id="id_status" class="form-control">
										<?php while ($row = mysqli_fetch_assoc($status)) : ?>
											<option value="<?= $row['id_status']; ?>" <?php if ($row['id_status'] == $d['id_status']) {
																							echo "selected";
																						} ?>><?= $row['status']; ?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="font-weight-bold">Divisi</label>
									<select name="id_divisi" id="id_divisi" class="form-control">
										<?php while ($row = mysqli_fetch_assoc($divisi)) : ?>
											<option value="<?= $row['id_divisi']; ?>" <?php if ($row['id_divisi'] == $d['id_divisi']) {
																							echo "selected";
																						} ?>><?= $row['nama_divisi']; ?></option>
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
require_once('../template/footer.php');
?>