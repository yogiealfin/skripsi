<?php require_once('../includes/init.php'); ?>

<?php
$errors = array();
$lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />

	<title>Sistem Informasi Kepegawaian PT. CIpta Adhi Potensia</title>

	<!-- Custom fonts for this template-->
	<link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

	<!-- Custom styles for this template-->
	<link href="../assets/css/sb-admin-2.min.css" rel="stylesheet" />
	<link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-light">
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary pb-3 pt-3 font-weight-bold">
		<div class="container">
			<span class="navbar-brand text-white" style="font-weight: 900;"> <i class="fa fa-database mr-2 rotate-n-15"></i> Sistem Informasi Kepeawaian PT. Cipta Adhi Potensia</span>
		</div>
	</nav>

	<div class="container">
		<!-- Outer Row -->
		<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
			<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Daftar Lowongan</h1>
		</div> -->
		<?php
		$status = isset($_GET['status']) ? $_GET['status'] : '';
		$get_lowongan = isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : '';
		$msg = '';
		switch ($status):
			case 'sukses-baru':
				$msg = 'Pendaftaran berhasil dilakukan!';
				break;
		endswitch;

		if ($msg) :
			echo '<div class="alert alert-info mt-2">' . $msg . '</div>';
		endif;
		?>
		<div class="card shadow mb-4 mt-3">
			<!-- /.card-header -->
			<div class="card-header py-3">
				<h4 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Lowongan </h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead class="bg-primary text-white">
							<tr align="center">
								<th width="5%">No</th>
								<th>Lowongan</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody class="bg-white">
							<?php
							$no = 1;
							$query = mysqli_query($koneksi, "SELECT * FROM lowongan");
							while ($data = mysqli_fetch_assoc($query)) {
							?>
								<tr align="center">
									<td><?= $no ?></td>
									<td><?= $data['nama_lowongan']; ?></td>
									<td>
										<form action="pendaftaran.php" method="GET">
											<input type="hidden" name="id_lowongan" value="<?= $data['id_lowongan']; ?>">
											<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Daftar</a></button>
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
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="../assets/js/sb-admin-2.min.js"></script>
</body>

</html>