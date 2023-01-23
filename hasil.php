<?php
require_once('includes/init.php');

$user_role = get_role();
if ($user_role == 'admin' || $user_role == 'user') {

	$page = "Hasil";
	require_once('template/header.php');
?>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>

		<a href="cetak.php" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
	</div>

	<div class="card shadow mb-4">
		<!-- /.card-header -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Hasil Akhir Perankingan</h6>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead class="bg-primary text-white">
						<tr align="center">
							<th width="15%">Rank</th>
							<th>Nama Pelamar</th>
							<th>Nilai (V)</th>
							<th>Keputusan</th>
					</thead>
					<tbody>
						<?php
						$no = 0;
						$query = mysqli_query($koneksi, "SELECT * FROM hasil_pelamar JOIN pelamar ON hasil_pelamar.id_pelamar=pelamar.id_pelamar ORDER BY hasil_pelamar.nilai DESC");
						while ($data = mysqli_fetch_array($query)) :
							$no++;
							$ambilKuota = mysqli_query($koneksi, "SELECT * FROM pelamar INNER JOIN lowongan on pelamar.id_lowongan = lowongan.id_lowongan");
							$kuota = mysqli_fetch_assoc($ambilKuota);
							if ($kuota['kuota'] >= $no) {
								$keputusan = "Diterima";
							} else {
								$keputusan = "Ditolak";
							}
						?>
							<tr align="center">
								<td><?= $no; ?></td>
								<td align="left"><?= $data['nama_pelamar'] ?></td>
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
	require_once('template/footer.php');
} else {
	header('Location: login.php');
}
?>