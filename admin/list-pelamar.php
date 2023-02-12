<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$page = "Pelamar";
require_once('../template/header.php');
$lowongan = $_GET['id_lowongan'];
$glq = mysqli_query($koneksi, "SELECT * FROM lowongan where id_lowongan = $lowongan");
$lq = mysqli_fetch_assoc($glq);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pelamar</h1>
	<form action="tambah-pelamar.php" method="GET">
		<div class="form-row align-items-center">
			<div class="col-auto my-1">
				<input type="hidden" name="id_lowongan" value="<?= $lowongan; ?>">
			</div>
			<!-- <a href="perhitungan.php" class="btn btn-success"> <i class="fa fa-calculator"></i> Hitung </a> -->
		</div>
</div>

<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
$get_lowongan = isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : '';
$msg = '';
switch ($status):
	case 'sukses-baru':
		$msg = 'Data berhasil disimpan';
		break;
	case 'sukses-hapus':
		$msg = 'Data behasil dihapus';
		break;
	case 'sukses-edit':
		$msg = 'Data behasil diupdate';
		break;
endswitch;

if ($msg) :
	echo '<div class="alert alert-info">' . $msg . '</div>';
endif;
?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Pelamar <?= $lq['nama_lowongan']; ?></h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Nama</th>
						<th>No Telp</th>
						<th>Email</th>
						<th>Umur</th>
						<th>Pendidikan</th>
						<th>Dokumen</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$query = mysqli_query($koneksi, "SELECT * FROM pelamar INNER JOIN lowongan ON pelamar.id_lowongan = lowongan.id_lowongan WHERE pelamar.id_lowongan = '$lowongan'");
					while ($data = mysqli_fetch_assoc($query)) :
						$no++;
					?>
						<tr align="center">
							<td><?php echo $no; ?></td>
							<td align="left"><?php echo $data['nama_pelamar']; ?></td>
							<td><?= $data['no_telp']; ?></td>
							<td><?= $data['email']; ?></td>
							<?php
							$today = date('Y-m-d');
							$umur = date_diff(date_create($data['tgl_lahir']), date_create($today));
							?>
							<td><?= $umur->format('%y') ?></td>
							<td><?= $data['pendidikan']; ?></td>
							<td><a href="../pelamar/dokumen/<?= $data['dokumen']; ?>"><button class="btn btn-success btn-sm"><i class="fa fa-solid fa-file"></i> Dokumen</button></a></td>
							<td>
								<div class="btn-group" role="group">
									<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-pelamar.php?id=<?php echo $data['id_pelamar']; ?>&id_lowongan=<?= $data['id_lowongan'] ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php
require_once('../template/footer.php');
?>