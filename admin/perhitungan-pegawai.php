<?php
require_once('../includes/init.php');
$getPeriode = $_GET['id_periode'];
$verifPeriode = mysqli_query($koneksi, "SELECT * FROM periode WHERE id_periode = $getPeriode");
$periode = mysqli_fetch_assoc($verifPeriode);

if (!isset($getPeriode)) {
	header("Location: list-penilaian-pegawai.php");
}
$lp = mysqli_query($koneksi, "SELECT * FROM periode Where id_periode = '$getPeriode'");
$nama_periode = mysqli_fetch_assoc($lp);

$user_role = get_role();
if ($user_role == 'kadiv') {

	$page = "Penilaian_Pegawai";
	require_once('../template/header.php');

	// mysqli_query($koneksi, "TRUNCATE TABLE hasil_pelamar;");

	$indikator = array();
	$q1 = mysqli_query($koneksi, "SELECT * FROM indikator ORDER BY kode_indikator ASC");
	while ($idktr = mysqli_fetch_array($q1)) {
		$indikator[$idktr['id_indikator']]['id_indikator'] = $idktr['id_indikator'];
		$indikator[$idktr['id_indikator']]['kode_indikator'] = $idktr['kode_indikator'];
		$indikator[$idktr['id_indikator']]['nama_indikator'] = $idktr['nama_indikator'];
		$indikator[$idktr['id_indikator']]['type'] = $idktr['type'];
		$indikator[$idktr['id_indikator']]['bobot'] = $idktr['bobot'];
		$indikator[$idktr['id_indikator']]['ada_pilihan'] = $idktr['ada_pilihan'];
	}

	$pegawai = array();
	$q2 = mysqli_query($koneksi, "SELECT * FROM pegawai JOIN divisi ON pegawai.id_divisi = divisi.id_divisi INNER JOIN status ON pegawai.id_status = status.id_status WHERE pegawai.id_status = '$periode[id_status]'");
	while ($alt = mysqli_fetch_assoc($q2)) {
		$pegawai[$alt['id_pegawai']]['id_pegawai'] = $alt['id_pegawai'];
		$pegawai[$alt['id_pegawai']]['nama_pegawai'] = $alt['nama_pegawai'];
		$pegawai[$alt['id_pegawai']]['id_divisi'] = $alt['id_divisi'];
		$pegawai[$alt['id_pegawai']]['id_status'] = $alt['id_status'];
	}

	$q3 = mysqli_query($koneksi, "SELECT * FROM indikator");
	$total_indikator = mysqli_num_rows($q3);
?>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan <?= $periode['nama_periode']; ?></h1>
		<a href="daftar-nilai-pegawai.php?status=sukses" class="btn btn-success"> <i class="fa fa-file"></i> Kirim Nilai </a>
	</div>

	<div class="card shadow mb-4">
		<!-- /.card-header -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Matrix Keputusan (X)</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead class="bg-primary text-white">
						<tr align="center">
							<th width="5%" rowspan="2">No</th>
							<th rowspan="2">Nama Pegawai</th>
							<th colspan="<?= $total_indikator; ?>">indikator</th>
						</tr>
						<tr align="center">
							<?php foreach ($indikator as $key) : ?>
								<th><?= $key['kode_indikator'] ?></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($pegawai as $keys) : ?>
							<tr align="center">
								<td><?= $no; ?></td>
								<td align="left"><?= $keys['nama_pegawai'] ?></td>
								<?php foreach ($indikator as $key) : ?>
									<td>
										<?php
										if ($key['ada_pilihan'] == 1) {
											$q4 = mysqli_query($koneksi, "SELECT sub_kriteria.nilai FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_pelamar='$keys[id_pelamar]' AND penilaian.id_kriteria='$key[id_kriteria]'");
											$data = mysqli_fetch_array($q4);
											echo $data['nilai'];
										} else {
											$q4 = mysqli_query($koneksi, "SELECT nilai FROM penilaian_pegawai WHERE id_pegawai='$keys[id_pegawai]' AND id_indikator='$key[id_indikator]' AND id_periode='$periode[id_periode]'");
											$data = mysqli_fetch_array($q4);
											echo $data['nilai'];
										}
										?>
									</td>
								<?php endforeach ?>
							</tr>
						<?php
							$no++;
						endforeach
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card shadow mb-4">
		<!-- /.card-header -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Matriks Ternormalisasi (R)</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead class="bg-primary text-white">
						<tr align="center">
							<th width="5%" rowspan="2">No</th>
							<th>Nama Pegawai</th>
							<?php foreach ($indikator as $key) : ?>
								<th><?= $key['kode_indikator'] ?></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($pegawai as $keys) : ?>
							<tr align="center">
								<td><?= $no; ?></td>
								<td align="left"><?= $keys['nama_pegawai'] ?></td>
								<?php foreach ($indikator as $key) : ?>
									<td>
										<?php
										if ($key['ada_pilihan'] == 1) {
											$q4 = mysqli_query($koneksi, "SELECT sub_kriteria.nilai FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$keys[id_alternatif]' AND penilaian.id_kriteria='$key[id_kriteria]'");
											$dt1 = mysqli_fetch_array($q4);

											$q5 = mysqli_query($koneksi, "SELECT MAX(sub_kriteria.nilai) as max, MIN(sub_kriteria.nilai) as min, kriteria.type FROM penilaian JOIN sub_kriteria ON penilaian.nilai=sub_kriteria.id_sub_kriteria JOIN kriteria ON penilaian.id_kriteria=kriteria.id_kriteria WHERE penilaian.id_kriteria='$key[id_kriteria]'");
											$dt2 = mysqli_fetch_array($q5);
											if ($dt2['type'] == "Benefit") {
												echo $dt1['nilai'] / $dt2['max'];
											} else {
												echo $dt2['min'] / $dt1['nilai'];
											}
										} else {
											$q4 = mysqli_query($koneksi, "SELECT nilai FROM penilaian_pegawai WHERE id_pegawai='$keys[id_pegawai]' AND id_indikator='$key[id_indikator]'");
											$dt1 = mysqli_fetch_array($q4);

											$q5 = mysqli_query($koneksi, "SELECT MAX(penilaian_pegawai.nilai) as max, MIN(penilaian_pegawai.nilai) as min, indikator.type FROM penilaian_pegawai JOIN indikator ON penilaian_pegawai.id_indikator=indikator.id_indikator WHERE penilaian_pegawai.id_indikator='$key[id_indikator]'");
											$dt2 = mysqli_fetch_array($q5);
											if ($dt2['type'] == "Benefit") {
												echo $dt1['nilai'] / $dt2['max'];
											} else {
												echo $dt2['min'] / $dt1['nilai'];
											}
										}
										?>
									</td>
								<?php endforeach ?>
							</tr>
						<?php
							$no++;
						endforeach
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card shadow mb-4">
		<!-- /.card-header -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Bobot Preferensi</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead class="bg-primary text-white">
						<tr align="center">
							<?php foreach ($indikator as $key) : ?>
								<th><?= $key['kode_indikator'] ?> <!--(<?= $key['type'] ?>)--></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody>
						<tr align="center">
							<?php foreach ($indikator as $key) : ?>
								<td>
									<?php
									echo $key['bobot'];
									?>
								</td>
							<?php endforeach ?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card shadow mb-4">
		<!-- /.card-header -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Perhitungan Nilai V</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead class="bg-primary text-white">
						<tr align="center">
							<th width="5%" rowspan="2">No</th>
							<th>Nama Pegawai</th>
							<th>Perhitungan</th>
							<th>Nilai</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($pegawai as $keys) : ?>
							<tr align="center">
								<td><?= $no; ?></td>
								<td align="left"><?= $keys['nama_pegawai'] ?></td>
								<td>
									SUM
									<?php
									$nilai_v = 0;
									foreach ($indikator as $key) :
										$bobot = $key['bobot'];
										if ($key['ada_pilihan'] == 1) {
											$q4 = mysqli_query($koneksi, "SELECT sub_kriteria.nilai FROM penilaian JOIN sub_kriteria WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$keys[id_alternatif]' AND penilaian.id_kriteria='$key[id_kriteria]'");
											$dt1 = mysqli_fetch_array($q4);

											$q5 = mysqli_query($koneksi, "SELECT MAX(sub_kriteria.nilai) as max, MIN(sub_kriteria.nilai) as min, kriteria.type FROM penilaian JOIN sub_kriteria ON penilaian.nilai=sub_kriteria.id_sub_kriteria JOIN kriteria ON penilaian.id_kriteria=kriteria.id_kriteria WHERE penilaian.id_kriteria='$key[id_kriteria]'");
											$dt2 = mysqli_fetch_array($q5);
											if ($dt2['type'] == "Benefit") {
												$nilai_r = $dt1['nilai'] / $dt2['max'];
											} else {
												$nilai_r = $dt2['min'] / $dt1['nilai'];
											}
										} else {
											$q4 = mysqli_query($koneksi, "SELECT nilai FROM penilaian_pegawai WHERE id_pegawai='$keys[id_pegawai]' AND id_indikator='$key[id_indikator]' AND id_periode='$periode[id_periode]'");
											$dt1 = mysqli_fetch_array($q4);

											$q5 = mysqli_query($koneksi, "SELECT MAX(penilaian_pegawai.nilai) as max, MIN(penilaian_pegawai.nilai) as min, indikator.type FROM penilaian_pegawai JOIN indikator ON penilaian_pegawai.id_indikator=indikator.id_indikator WHERE penilaian_pegawai.id_indikator='$key[id_indikator]' AND id_periode='$periode[id_periode]'");
											$dt2 = mysqli_fetch_array($q5);
											if ($dt2['type'] == "Benefit") {
												$nilai_r = $dt1['nilai'] / $dt2['max'];
											} else {
												$nilai_r = $dt2['min'] / $dt1['nilai'];
											}
										}
										$nilai_penjumlahan = $bobot * $nilai_r;
										$nilai_v += $nilai_penjumlahan;
										echo "(" . $bobot . "x" . $nilai_r . ") ";
									endforeach ?>
								</td>
								<td>
									<?php
									$nilai_v = round($nilai_v, 2, PHP_ROUND_HALF_UP);
									echo $nilai_v;
									?>
								</td>
							</tr>
						<?php
							$result = mysqli_query($koneksi, "SELECT * FROM hasil_pegawai WHERE id_pegawai='$keys[id_pegawai]' AND id_periode = '$periode[id_periode]'");
							if (mysqli_fetch_assoc($result)) {
								mysqli_query($koneksi, "DELETE FROM hasil_pegawai WHERE id_pegawai='$keys[id_pegawai]' AND id_periode = '$periode[id_periode]'");
							}
							mysqli_query($koneksi, "INSERT INTO hasil_pegawai (id_hasil, id_pegawai, id_periode, nilai) VALUES (NULL, '$keys[id_pegawai]', '$periode[id_periode]', '$nilai_v')");
							$no++;
						endforeach;
						?>
					</tbody>
				</table>
			</div>

		<?php
		require_once('../template/footer.php');
	} else {
		header('Location: login.php');
	}
		?>