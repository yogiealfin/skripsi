<?php
require_once('../includes/init.php');
$lowongan = $_GET['id_lowongan'];
$gln = mysqli_query($koneksi, "SELECT * FROM lowongan");
$ln = mysqli_fetch_assoc($gln);

$user_role = get_role();
if ($user_role == 'admin' || $user_role == 'user') {
?>

	<html>

	<head>
		<title>Sistem Pendukung Keputusan Metode WP</title>
	</head>

	<body onload="window.print();">

		<div style="width:100%;margin:0 auto;text-align:center;">
			<h4>Hasil Akhir Penerimaan Pegawai Baru <?= $ln['nama_lowongan']; ?></h4>
			<br />
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead>
					<tr align="center">
						<th width="15%">Rank</th>
						<th>Nama Pelamar</th>
						<th>Nilai</th>
						<th>Keputusan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$query = mysqli_query($koneksi, "SELECT * FROM hasil_pelamar JOIN pelamar ON hasil_pelamar.id_pelamar=pelamar.id_pelamar WHERE hasil_pelamar.id_lowongan='$lowongan' ORDER BY hasil_pelamar.nilai DESC");
					while ($data = mysqli_fetch_array($query)) {
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
					}
					?>
				</tbody>
			</table>
		</div>

	</body>

	</html>

<?php
} else {
	header('Location: login.php');
}
?>