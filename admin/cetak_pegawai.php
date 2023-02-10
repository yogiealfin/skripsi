<?php
require_once('../includes/init.php');
$periode = $_GET['id_periode'];
$gln = mysqli_query($koneksi, "SELECT * FROM periode");
$ln = mysqli_fetch_assoc($gln);

$user_role = get_role();
if ($user_role == 'admin' || $user_role == 'kadiv') {
?>

	<html>

	<head>
		<title>Hasil Akhir Penilaian Pegawai</title>
	</head>

	<body onload="window.print();">

		<div style="width:100%;margin:0 auto;text-align:center;">
			<h4>Hasil Akhir Penilaian Pegawai <?= $ln['nama_periode']; ?></h4>
			<br />
			<table width="100%" cellspacing="0" cellpadding="5" border="1">
				<thead>
					<tr align="center">
						<th width="5%">Rank</th>
						<th>NIP</th>
						<th>Nama Pegawai</th>
						<th>Divisi</th>
						<th>Nilai</th>
						<th>Keputusan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$query = mysqli_query($koneksi, "SELECT * FROM hasil_pegawai JOIN pegawai ON hasil_pegawai.id_pegawai=pegawai.id_pegawai JOIN divisi ON pegawai.id_divisi=divisi.id_divisi WHERE hasil_pegawai.id_periode='$periode' ORDER BY hasil_pegawai.nilai DESC");
					while ($data = mysqli_fetch_array($query)) {
						if ($ln['id_status'] == 1) {
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
						$no++;
					?>
						<tr align="center">
							<td><?= $no; ?></td>
							<td><?= $data['nip'] ?></td>
							<td align="left"><?= $data['nama_pegawai'] ?></td>
							<td><?= $data['nama_divisi']; ?></td>
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