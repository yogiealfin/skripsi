<?php require_once('../includes/init.php'); ?>

<?php
$errors = array();
$sukses = false;
$id_low = (isset($_GET['id_lowongan']) ? $_GET['id_lowongan'] : '');

$nama = (isset($_POST['nama'])) ? trim($_POST['nama']) : '';
$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$no_telp = (isset($_POST['no_telp'])) ? trim($_POST['no_telp']) : '';
$no_ktp = (isset($_POST['no_ktp'])) ? trim($_POST['no_ktp']) : '';
$tgl_lahir = (isset($_POST['tgl_lahir'])) ? trim($_POST['tgl_lahir']) : '';
$pendidikan = (isset($_POST['pendidikan'])) ? trim($_POST['pendidikan']) : '';
$id_lowongan = (isset($_POST['id_lowongan']) ? trim($_POST['id_lowongan']) : '');
$lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan");
$getLowongan = $_GET['id_lowongan'];

if (isset($_POST['submit'])) :

    // Validasi
    if (!$nama) {
        $errors[] = 'Nama tidak boleh kosong';
    }
    if (!$no_ktp) {
        $errors[] = 'Nomor KTP tidak boleh kosong';
    }
    if (!$email) {
        $errors[] = 'Email tidak boleh kosong';
    }
    if (!$no_telp) {
        $errors[] = 'Nomor telepon tidak boleh kosong';
    }
    if (!$tgl_lahir) {
        $errors[] = 'Tanggal Lahir tidak boleh kosong';
    }
    if (!$pendidikan) {
        $errors[] = 'Pendidikan terakhir tidak boleh kosong';
    }

    // Jika lolos validasi lakukan hal di bawah ini
    if (empty($errors)) :
        $simpan = mysqli_query($koneksi, "INSERT INTO pelamar (id_pelamar, nama_pelamar, no_ktp, no_telp, email, tgl_lahir, pendidikan, id_lowongan) VALUES (NULL, '$nama', '$no_ktp', '$no_telp', '$email', '$tgl_lahir', '$pendidikan', $id_lowongan)");
        if ($simpan) {
            Header('Location:lowongan.php?status=sukses-baru');
        } else {
            $errors[] = 'Pendaftaran gagal!';
        }
    endif;

endif;
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
            <a class="navbar-brand text-white" style="font-weight: 900;" href="index.php"> <i class="fa fa-database mr-2 rotate-n-15"></i> Sistem Informasi Kepeawaian PT. Cipta Adhi Potensia</a>
        </div>
    </nav>

    <div class="container">
        <!-- Outer Row -->
        <!-- <h1 class="h3 mb-4 text-gray-800 mt-4"><i class="fas fa-fw fa-users"></i> Form Pendaftaran</h1> -->
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <?php echo $error; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-users"></i> Form Pendaftaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold">Nama</label>
                            <input autocomplete="off" type="text" name="nama" required value="<?php echo $nama; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold">No KTP</label>
                            <input autocomplete="off" type="text" name="no_ktp" pattern="[0-9]+" minlength="16" maxlength="16" required class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold">No Telpon</label>
                            <input autocomplete="off" type="tel" name="no_telp" pattern="[0-9]+" minlength="11" maxlength="13" required class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold">Email</label>
                            <input autocomplete="off" type="email" name="email" required class="form-control" id="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold" for="tgl_lahir">Tanggal Lahir</label>
                            <input autocomplete="off" type="date" name="tgl_lahir" required class="form-control" id="tgl_bergabung" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-bold">Pendidikan Terakhir</label>
                            <select name="pendidikan" id="pendidikan" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id_lowongan" value="<?= $getLowongan; ?>">
                </div>
                <div class="card-footer text-right">
                    <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Kirim</button>
                    <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
                </div>
            </div>
        </form>
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