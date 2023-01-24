<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$page = "Pelamar";
require_once('template/header.php');
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
			<div class="col-auto my-1">
				<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pelamar</button>
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
						<th>Lowongan</th>
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
							<td><?= $data['nama_lowongan']; ?></td>
							<td>
								<div class="btn-group" role="group">
									<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="edit-pelamar.php?id=<?php echo $data['id_pelamar']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
									<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-pelamar.php?id=<?php echo $data['id_pelamar']; ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
require_once('template/footer.php');
?>