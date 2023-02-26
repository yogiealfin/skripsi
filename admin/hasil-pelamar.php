<?php
require_once('../includes/init.php');

$user_role = get_role();
if ($user_role == 'admin' || $user_role == 'user') {

	$page = "Hasil_Pelamar";
	require_once('../template/header.php');
	$lowongan = $_GET['id_lowongan'];
	$glq = mysqli_query($koneksi, "SELECT * FROM lowongan WHERE id_lowongan='$lowongan'");
	$lq = mysqli_fetch_assoc($glq);
?>

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Hasil Akhir</h1>

		<a href="cetak.php?id_lowongan=<?= $lowongan; ?>" target="_blank" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak Data </a>
	</div>

	<div class="card shadow mb-4">
		<!-- /.card-header -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Hasil Akhir Perankingan <?= $lq['nama_lowongan']; ?></h6>
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
							<th>Aksi</th>
					</thead>
					<tbody>
						<?php
						$no = 0;
						$query = mysqli_query($koneksi, "SELECT * FROM hasil_pelamar JOIN pelamar ON hasil_pelamar.id_pelamar=pelamar.id_pelamar JOIN lowongan ON pelamar.id_lowongan = lowongan.id_lowongan WHERE hasil_pelamar.id_lowongan='$lowongan' ORDER BY hasil_pelamar.nilai DESC");
						while ($data = mysqli_fetch_array($query)) :
							$no++;
							$ambilKuota = mysqli_query($koneksi, "SELECT * FROM pelamar INNER JOIN lowongan on pelamar.id_lowongan = lowongan.id_lowongan WHERE pelamar.id_lowongan = '$lowongan'");
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
								<?php if ($keputusan == "Diterima") : ?>
									<td class="text-success font-weight-bold"><?= $keputusan; ?></td>
								<?php else : ?>
									<td class="text-danger font-weight-bold"><?= $keputusan ?></td>
								<?php endif; ?>
								<?php if ($keputusan == 'Diterima') : ?>
									<td>
										<form action="tambah-pegawai.php" method="GET">
											<input type="hidden" name="id_divisi" value="<?= $data['id_divisi']; ?>">
											<input type="hidden" name="id_pelamar" value="<?= $data['id_pelamar'] ?>">
											<?php
											$q = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE nama_pegawai='$data[nama_pelamar]'");
											$cek_tombol = mysqli_num_rows($q);
											?>
											<?php if ($cek_tombol == 0) : ?>
												<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Pelamar</button>
											<?php else : ?>
												<div class="btn btn-success btn-sm"><i class="fa fa-check"></i> Data sudah ditambah</div>
											<?php endif; ?>
										</form>
									</td>
								<?php else : ?>
									<td>

									</td>
								<?php endif; ?>
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