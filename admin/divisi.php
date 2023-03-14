<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$page = "Divisi";
require_once('../template/header.php');

$divisi = mysqli_query($koneksi, "SELECT * FROM divisi");
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Daftar Divisi</h1>
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
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-table"></i> Daftar Divisi </h6>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Divisi</th>
                        <th>Kapasitas</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM divisi");
                    while (($data = mysqli_fetch_assoc($query)) && $no <= 9) {
                    ?>
                        <tr align="center">
                            <td><?= $no ?></td>
                            <td><?= $data['nama_divisi']; ?></td>
                            <td>
                                <div class="progress">
                                    <?php
                                    $jumlah = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_divisi = '$data[id_divisi]'");
                                    $total = mysqli_num_rows($jumlah);
                                    $kapasitas = $data['kapasitas'];
                                    $bar = $total / $kapasitas * 100;
                                    ?>
                                    <div class="progress-bar" role="progressbar" style="width: <?= $bar ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <?= $total . "/" . $kapasitas ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="edit-divisi.php?id=<?= $data['id_divisi'] ?>"><button class="btn btn-warning">Edit</button></a>
                                    <a href="tambah-lowongan.php?id=<?= $data['id_divisi'] ?>"><button class="btn btn-success">Buka</button></a>
                                </div>
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