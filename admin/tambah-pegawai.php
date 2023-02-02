<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$today = date('Y-m-d');
$errors = array();
$sukses = false;
$id_div = (isset($_GET['id_divisi']) ? $_GET['id_divisi'] : '');

$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
$nip = (isset($_POST['nip'])) ? trim($_POST['nip']) : '';
$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$no_telp = (isset($_POST['no_telp'])) ? trim($_POST['no_telp']) : '';
$tgl_bergabung = (isset($_POST['tgl_bergabung'])) ? trim($_POST['tgl_bergabung']) : '';
$id_status = (isset($_POST['id_status'])) ? trim($_POST['id_status']) : '';
$id_divisi = (isset($_POST['id_divisi']) ? trim($_POST['id_divisi']) : '');
// $getStatus = mysqli_query($koneksi, "SELECT * FROM status");
// $status = mysqli_fetch_assoc($getStatus);
$getDivisi = mysqli_query($koneksi, "SELECT * FROM divisi");
$divisi = $_GET['id_divisi'];

if (isset($_POST['submit'])) :

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
	if (!$no_telp) {
		$errors[] = 'Nomor telepon tidak boleh kosong';
	}
	if (!$tgl_bergabung) {
		$errors[] = 'Tanggal bergabung tidak boleh kosong';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if (empty($errors)) :
		$simpan = mysqli_query($koneksi, "INSERT INTO pegawai (id_pegawai, nip, nama_pegawai, no_telp, email, tgl_bergabung, id_status, id_divisi) VALUES (NULL, '$nip', '$nama', '$no_telp', '$email', '$tgl_bergabung', '$id_status', '$id_divisi')");
		if ($simpan) {
			Header('Location:list-pegawai.php?status=sukses-baru&id_divisi=' . $divisi);
		} else {
			$errors[] = 'Data gagal disimpan';
		}
	endif;

endif;

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
	<div class="alert alert-danger">
		<?php foreach ($errors as $error) : ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<form action="" method="post">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-plus"></i> Tambah Data Pegawai</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">Nama</label>
					<input autocomplete="off" type="text" name="nama" required class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold">NIP</label>
					<input autocomplete="off" type="text" name="nip" pattern="[0-9]+" minlength="8" maxlength="8" required class="form-control" />
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
					<label class="font-weight-bold" for="email">Email</label>
					<input autocomplete="off" type="email" name="email" required class="form-control" id="email" />
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="font-weight-bold" for="tgl_bergabung">Tanggal Bergabung</label>
					<input autocomplete="off" type="date" name="tgl_bergabung" required class="form-control" id="tgl_bergabung" value="<?= $today; ?>" />
				</div>
			</div>
			<input type="hidden" name="id_status" value="1">
			<input type="hidden" name="id_divisi" value="<?= $id_div; ?>">
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