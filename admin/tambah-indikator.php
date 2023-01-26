<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

if (isset($_POST['submit'])) :
	$kode_kriteria = $_POST['kode_indikator'];
	$nama = $_POST['nama_indikator'];
	$type = $_POST['type'];
	$bobot = $_POST['bobot'];
	$ada_pilihan = $_POST['ada_pilihan'];

	if (!$kode_kriteria) {
		$errors[] = 'Kode kriteria tidak boleh kosong';
	}
	// Validasi Nama Kriteria
	if (!$nama) {
		$errors[] = 'Nama kriteria tidak boleh kosong';
	}
	// Validasi Tipe
	if (!$type) {
		$errors[] = 'Type kriteria tidak boleh kosong';
	}
	// Validasi Bobot
	if (!$bobot) {
		$errors[] = 'Bobot kriteria tidak boleh kosong';
	}

	$query = "SELECT SUM(bobot) AS total_bobot FROM  indikator";
	$sum = mysqli_query($koneksi, $query);
	$total_bobot = mysqli_fetch_assoc($sum);
	if (empty($errors) && $total_bobot['total_bobot'] + $bobot <= 100) {

		$simpan = mysqli_query($koneksi, "INSERT INTO indikator (id_indikator, kode_indikator, nama_indikator, type, bobot, ada_pilihan) VALUES (NULL, '$kode_kriteria', '$nama', '$type', '$bobot', '$ada_pilihan')");
		if ($simpan) {
			redirect_to('list-indikator.php?status=sukses-baru');
		} else {
			$errors[] = 'Data gagal disimpan';
		}
	} else {
		$errors[] = 'Total bobot indikator melebihi 100';
	}

endif;
?>

<?php
$page = "Indikator";
require_once('../template/header.php');
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Indikator</h1>

	<a href="list-indikator.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
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

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-plus"></i> Tambah Data Indikator</h6>
	</div>

	<form action="tambah-indikator.php" method="post">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="font-weight-bold">Kode Indikator</label>
					<input autocomplete="off" type="text" name="kode_indikator" required class="form-control" />
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Nama Indikator</label>
					<input autocomplete="off" type="text" name="nama_indikator" required class="form-control" />
				</div>

				<div class="form-group col-md-6" hidden>
					<label class="font-weight-bold">Type Kriteria</label>
					<select name="type" class="form-control" required>
						<option value="">--Pilih--</option>
						<option value="Benefit" selected>Benefit</option>
						<option value="Cost">Cost</option>
					</select>
				</div>

				<div class="form-group col-md-6">
					<label class="font-weight-bold">Bobot Indikator</label>
					<input autocomplete="off" type="number" name="bobot" required step="1" class="form-control" />
				</div>

				<div class="form-group col-md-6" hidden>
					<label class="font-weight-bold">Cara Penilaian</label>
					<select name="ada_pilihan" class="form-control" required>
						<option value="">--Pilih--</option>
						<option value="0" selected>Input Langsung</option>
						<option value="1">Pilihan Sub Kriteria</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer text-right">
			<button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
		</div>
	</form>
</div>


<?php
require_once('../template/footer.php');
?>