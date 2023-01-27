<?php
require_once('../includes/init.php');

$user_role = get_role();
if ($user_role == 'admin' || $user_role == 'kadiv') {

	$page = "Hasil_Pegawai";
	require_once('../template/header.php');
	$periode = $_GET['id_periode'];
	$glq = mysqli_query($koneksi, "SELECT * FROM periode WHERE id_periode='$periode'");
	$lq = mysqli_fetch_assoc($glq);
?>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>

		<a href="cetak_pegawai.php?id_periode=<?= $periode; ?>" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
	</div>

	<div class="card shadow mb-4">
		<!-- /.card-header -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Hasil Akhir Penilaian <?= $lq['nama_periode']; ?></h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead class="bg-primary text-white">
						<tr align="center">
							<th width="5%">Rank</th>
							<th>Nama Pelamar</th>
							<th>Divisi</th>
							<th>Nilai</th>
							<th>Keputusan</th>
					</thead>
					<tbody>
						<?php
						$no = 0;
						$query = mysqli_query($koneksi, "SELECT * FROM hasil_pegawai JOIN pegawai ON hasil_pegawai.id_pegawai=pegawai.id_pegawai JOIN divisi on pegawai.id_divisi = divisi.id_divisi WHERE hasil_pegawai.id_periode='$periode' ORDER BY hasil_pegawai.nilai DESC");
						while ($data = mysqli_fetch_assoc($query)) :
							if ($lq['id_status'] == 1) {
								if ($data['nilai'] >= 80) {
									$keputusan = "Kontrak diperpanjang";
								} else {
									$keputusan = "Kontrak tidak diperpanjang";
								}
							} else {
								if ($data['nilai'] < 85) {
									$keputusan = "Kenaikan gaji menyesuaikan inflasi";
								} elseif ($data['nilai'] <= 89) {
									$keputusan = "Kenaikan gaji 8%";
								} elseif ($data['nilai'] <= 94) {
									$keputusan = "Kenaikan gaji 10%";
								} else {
									$keputusan = "Kenaikan gaji 15%";
								}
							}
						?>
							<tr align="center">
								<td><?= $no; ?></td>
								<td align="left"><?= $data['nama_pegawai'] ?></td>
								<td><?= $data['nama_divisi'] ?></td>
								<td><?= $data['nilai'] ?></td>
								<td><?= $keputusan; ?></td>
							</tr>
						<?php
						endwhile;
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php
	require_once('../template/footer.php');
} else {
	header('Location: login.php');
}
?>