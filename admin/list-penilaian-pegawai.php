<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(2)); ?>

<?php
$page = "Penilaian_Pegawai";
require_once('../template/header.php');

$getPeriode = $_GET['id_periode'];
$verifPeriode = mysqli_query($koneksi, "SELECT * FROM periode WHERE id_periode = $getPeriode");
$periode = mysqli_fetch_assoc($verifPeriode);


if (isset($_POST['tambah'])) :
	$id_pegawai = $_POST['id_pegawai'];
	$id_indikator = $_POST['id_indikator'];
	$id_periode = $_POST['id_periode'];
	$nilai = $_POST['nilai'];
	// $ambil_id_lowongan = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = $id_pegawai");
	// $result = mysqli_fetch_assoc($ambil_id_lowongan);
	// $id_lowongan = $result['id_lowongan'];
	// $id_lowongan = $_POST['id_lowongan'];

	if (!$id_indikator) {
		$errors[] = 'ID indikator tidak boleh kosong';
	}
	if (!$id_pegawai) {
		$errors[] = 'ID pegawai kriteria tidak boleh kosong';
	}
	if (!$nilai) {
		$errors[] = 'Nilai indikator tidak boleh kosong';
	}

	if (empty($errors)) :
		$i = 0;
		foreach ($nilai as $key) {
			$simpan = mysqli_query($koneksi, "INSERT INTO penilaian_pegawai (id_penilaian, id_pegawai, id_indikator, id_periode, nilai) VALUES (NULL, '$id_pegawai', '$id_indikator[$i]', '$id_periode', '$key')");
			$i++;
		}
		if ($simpan) {
			$sts[] = 'Data berhasil disimpan';
		} else {
			$sts[] = 'Data gagal disimpan';
		}
	endif;
endif;

if (isset($_POST['edit'])) :
	$id_pegawai = $_POST['id_pegawai'];
	$id_indikator = $_POST['id_indikator'];
	$nilai = $_POST['nilai'];
	$id_periode = $_POST['id_periode'];

	if (!$id_indikator) {
		$errors[] = 'ID indikator tidak boleh kosong';
	}
	if (!$id_pegawai) {
		$errors[] = 'ID Pegawai kriteria tidak boleh kosong';
	}
	if (!$nilai) {
		$errors[] = 'Nilai kriteria tidak boleh kosong';
	}
	// if (!$id_lowongan) {
	// 	$errors[] = 'Lowongan tidak boleh kosong';
	// }

	if (empty($errors)) :
		$i = 0;
		mysqli_query($koneksi, "DELETE FROM penilaian_pegawai WHERE id_pegawai = '$id_pegawai';");
		foreach ($nilai as $key) {
			$simpan = mysqli_query($koneksi, "INSERT INTO penilaian_pegawai (id_penilaian, id_pegawai, id_indikator, nilai, id_periode) VALUES (NULL, '$id_pegawai', '$id_indikator[$i]', '$key', $id_periode)");
			$i++;
		}
		if ($simpan) {
			$sts[] = 'Data berhasil diupdate';
		} else {
			$sts[] = 'Data gagal diupdate';
		}
	endif;
endif;

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian Pegawai</h1>
	<form action="perhitungan-pegawai.php" method="GET">
		<div class="form-row align-items-center">
			<div class="col-auto my-1">
				<input type="hidden" name="id_periode" value="<?= $getPeriode; ?>">
			</div>
			<div class="col-auto my-1">
				<button type="submit" class="btn btn-success"><i class="fa fa-calculator"></i> Hitung</button>
			</div>
			<!-- <a href="perhitungan.php" class="btn btn-success"> <i class="fa fa-calculator"></i> Hitung </a> -->
		</div>
	</form>
</div>

<?php if (!empty($sts)) : ?>
	<div class="alert alert-info">
		<?php foreach ($sts as $st) : ?>
			<?php echo $st; ?>
		<?php endforeach; ?>
	</div>
<?php
endif;
?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data <?= $periode['nama_periode']; ?></h6>
	</div>


	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Pegawai</th>
						<th>Divisi</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$query = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN divisi ON pegawai.id_divisi = divisi.id_divisi INNER JOIN status ON pegawai.id_status = status.id_status WHERE pegawai.id_status = '$periode[id_status]' AND pegawai.id_divisi = '$_SESSION[divisi]'");
					while ($data = mysqli_fetch_assoc($query)) {
					?>
						<tr align="center">
							<td><?= $no ?></td>
							<td align="left"><?= $data['nama_pegawai'] ?></td>
							<?php
							$id_pegawai = $data['id_pegawai'];
							$q = mysqli_query($koneksi, "SELECT * FROM penilaian_pegawai WHERE id_pegawai='$id_pegawai' AND id_periode='$periode[id_periode]'");
							$cek_tombol = mysqli_num_rows($q);
							?>
							<td><?= $data['nama_divisi']; ?></td>
							<td>
								<?php if ($cek_tombol == 0) { ?>
									<a data-toggle="modal" href="#set<?= $data['id_pegawai'] ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Input</a>
								<?php } else { ?>
									<a data-toggle="modal" href="#edit<?= $data['id_pegawai'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
								<?php } ?>
							</td>
						</tr>

						<!-- Modal -->
						<div class="modal fade" id="set<?= $data['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Input Penilaian</h5>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<form action="" method="post">
										<div class="modal-body">
											<?php
											$q2 = mysqli_query($koneksi, "SELECT * FROM indikator ORDER BY kode_indikator ASC");
											while ($d = mysqli_fetch_array($q2)) {
											?>
												<input type="text" name="id_pegawai" value="<?= $data['id_pegawai'] ?>" hidden>
												<input type="text" name="id_indikator[]" value="<?= $d['id_indikator'] ?>" hidden>
												<input type="text" name="id_periode" value="<?= $periode['id_periode'] ?>" hidden>
												<div class="form-group">
													<label class="font-weight-bold">(<?= $d['kode_indikator'] ?>) <?= $d['nama_indikator'] ?></label>
													<?php
													if ($d['ada_pilihan'] == 1) {
													?>
														<select name="nilai[]" class="form-control" required>
															<option value="">--Pilih--</option>
															<?php
															$id_indikator = $d['id_indikator'];
															$q3 = mysqli_query($koneksi, "SELECT * FROM sub_kriteria WHERE id_kriteria = '$id_kriteria' ORDER BY nilai ASC");
															while ($d3 = mysqli_fetch_array($q3)) {
															?>
																<option value="<?= $d3['id_sub_kriteria'] ?>"><?= $d3['nama'] ?> </option>
															<?php } ?>
														</select>
													<?php
													} else {
													?>
														<input type="number" name="nilai[]" class="form-control" step="1" required autocomplete="off">
													<?php
													}
													?>
												</div>
											<?php } ?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" name="tambah" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="edit<?= $data['id_pegawai'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian</h5>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<form action="" method="post">
										<div class="modal-body">
											<?php
											$q2 = mysqli_query($koneksi, "SELECT * FROM indikator ORDER BY kode_indikator ASC");
											while ($d = mysqli_fetch_array($q2)) {
												$id_indikator = $d['id_indikator'];
												$id_pegawai = $data['id_pegawai'];
												$q4 = mysqli_query($koneksi, "SELECT * FROM penilaian_pegawai WHERE id_pegawai='$id_pegawai' AND id_indikator='$id_indikator'");
												$d4 = mysqli_fetch_assoc($q4);
											?>
												<input type="text" name="id_pegawai" value="<?= $data['id_pegawai'] ?>" hidden>
												<input type="text" name="id_indikator[]" value="<?= $d['id_indikator'] ?>" hidden>
												<input type="text" name="id_periode" value="<?= $periode['id_periode'] ?>" hidden>
												<div class="form-group">
													<label class="font-weight-bold">(<?= $d['kode_indikator'] ?>) <?= $d['nama_indikator'] ?></label>
													<?php
													if ($d['ada_pilihan'] == 1) {
													?>
														<select name="nilai[]" class="form-control" required>
															<option value="">--Pilih--</option>
															<?php
															$q3 = mysqli_query($koneksi, "SELECT * FROM sub_kriteria WHERE id_kriteria = '$id_kriteria' ORDER BY nilai ASC");
															while ($d3 = mysqli_fetch_array($q3)) {
															?>
																<option value="<?= $d3['id_sub_kriteria'] ?>" <?php if ($d3['id_sub_kriteria'] == $d4['nilai']) {
																													echo "selected";
																												} ?>><?= $d3['nama'] ?> </option>
															<?php } ?>
														</select>
													<?php
													} else {
													?>
														<input type="number" name="nilai[]" class="form-control" step="1" value="<?= $d4['nilai'] ?>" required autocomplete="off">
													<?php
													}
													?>
												</div>
											<?php } ?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" name="edit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('../template/footer.php');
?>