<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(2)); ?>

<?php
$page = "Penilaian_Pegawai";
require_once('../template/header.php');

$periode = mysqli_query($koneksi, "SELECT * FROM periode");
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Daftar Penilaian Pegawai</h1>
</div>
<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
$msg = '';
if ($status == 'sukses') {
	$msg = 'Data Berhasil Dikirim';
}

if ($msg) :
	echo '<div class="alert alert-info">' . $msg . '</div>';
endif;
?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Penilaian Pegawai</h6>
	</div>


	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Periode</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					while ($data = mysqli_fetch_assoc($periode)) {
					?>
						<tr align="center">
							<td><?= $no ?></td>
							<td><?= $data['nama_periode']; ?></td>
							<td>
								<form action="list-penilaian-pegawai.php" method="GET">
									<!-- <input type="hidden" name="id_status" value="<?= $data['id_status']; ?>"> -->
									<input type="hidden" name="id_periode" value="<?= $data['id_periode']; ?>">
									<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-pen"></i> Nilai</a></button>
								</form>
							</td>
						</tr>
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