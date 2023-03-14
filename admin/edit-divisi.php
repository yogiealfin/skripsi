<?php require_once('../includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

// $id_pelamar = (isset($_GET['id'])) ? trim($_GET['id']) : '';
$id_divisi = (isset($_GET['id'])) ? trim($_GET['id']) : '';
// $lowongan = mysqli_query($koneksi, "SELECT * FROM lowongan");

$getDivisi = mysqli_query($koneksi, "SELECT * FROM divisi");
if (isset($_POST['submit'])) :
    $nama_divisi = $_POST['nama_divisi'];
    $kapasitas = $_POST['kapasitas'];
    $kode = $_POST['kode'];

    // Validasi
    if (!$nama_divisi) {
        $errors[] = 'Nama Lowongan tidak boleh kosong';
    }
    if (!$kapasitas) {
        $errors[] = 'Kapasitas tidak boleh kosong';
    }
    if (!$kode) {
        $errors[] = 'Kode tidak boleh kosong';
    }

    // Jika lolos validasi lakukan hal di bawah ini
    if (empty($errors)) :

        $update = mysqli_query($koneksi, "UPDATE divisi SET nama_divisi = '$nama_divisi', kapasitas = '$kapasitas', kode='$kode' WHERE id_divisi = '$id_divisi'");
        if ($update) {
            // header("Location:list-pelamar.php?status=sukses-edit&id_lowongan=" . $id_lowongan);
            redirect_to('divisi.php?status=sukses-edit');
        } else {
            $errors[] = 'Data gagal diupdate';
        }
    endif;

endif;
?>

<?php
$page = "Divisi";
require_once('../template/header.php');
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Data Divisi</h1>

    <a href="divisi.php" class="btn btn-secondary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
        <span class="text">Kembali</span>
    </a>
</div>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-info">
        <?php foreach ($errors as $error) : ?>
            <?php echo $error; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if ($sukses) : ?>
    <div class="alert alert-success">
        Data berhasil disimpan
    </div>
<?php elseif ($ada_error) : ?>
    <div class="alert alert-info">
        <?php echo $ada_error; ?>
    </div>
<?php else : ?>

    <form action="edit-divisi.php?id=<?php echo $id_divisi; ?>" method="post">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-edit"></i> Edit Data Divisi</h6>
            </div>
            <?php
            if (!$id_divisi) {
            ?>
                <div class="card-body">
                    <div class="alert alert-danger">Data tidak ada</div>
                </div>
                <?php
            } else {
                $data = mysqli_query($koneksi, "SELECT * FROM divisi WHERE id_divisi='$id_divisi'");
                $cek = mysqli_num_rows($data);
                if ($cek <= 0) {
                ?>
                    <div class="card-body">
                        <div class="alert alert-danger">Data tidak ada</div>
                    </div>
                    <?php
                } else {
                    while ($d = mysqli_fetch_assoc($data)) {
                    ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold" for="nama_divisi">Nama Divisi</label>
                                    <input autocomplete="off" type="text" name="nama_divisi" required value="<?php echo $d['nama_divisi']; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold" for="kapasitas">Kapasitas</label>
                                    <input autocomplete="off" type="number" name="kapasitas" required value="<?php echo $d['kapasitas']; ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold" for="kode">Kode</label>
                                    <input autocomplete="off" type="text" name="kode" required value="<?php echo $d['kode']; ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button name="submit" value="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                            <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </form>

<?php
endif;
require_once('../template/footer.php');
?>