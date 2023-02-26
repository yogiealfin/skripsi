<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$page = "Pegawai";
require_once('../template/header.php');
$divisi = $_GET['id_divisi'];
$listDivisi = mysqli_query($koneksi, "SELECT * FROM divisi where id_divisi = $divisi");
$dataDivisi = mysqli_fetch_assoc($listDivisi);

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Pegawai</h1>
	<!-- <form action="tambah-pegawai.php" method="GET">
		<div class="form-row align-items-center">
			<div class="col-auto my-1">
				<input type="hidden" name="id_divisi" value="<?= $divisi; ?>">
			</div>
			<div class="col-auto my-1">
				<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pegawai</button>
			</div> -->
</div>

<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
$get_divisi = isset($_GET['id_divisi']) ? $_GET['id_divisi'] : '';
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
		<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Data Pegawai <?= $dataDivisi['nama_divisi']; ?></h6>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-primary text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Status</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$query = mysqli_query($koneksi, "SELECT * FROM pegawai INNER JOIN divisi ON pegawai.id_divisi = divisi.id_divisi INNER JOIN status ON pegawai.id_status = status.id_status WHERE pegawai.id_divisi = '$divisi'");
					while ($data = mysqli_fetch_assoc($query)) :
						$no++;
					?>
						<tr align="center">
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nip']; ?></td>
							<td align="left"><?php echo $data['nama_pegawai']; ?></td>
							<td><?= $data['status']; ?></td>
							<td>
								<div class="btn-group" role="group">
									<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="edit-pegawai.php?id=<?php echo $data['id_pegawai']; ?>&id_divisi=<?= $data['id_divisi'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
									<a data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="hapus-pegawai.php?id=<?php echo $data['id_pegawai']; ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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