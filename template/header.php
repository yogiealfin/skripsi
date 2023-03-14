<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Informasi Kepegawaian PT. Cipta Adhi Potensia</title>

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-database"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT. CAP</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php if ($page == "Dashboard") {
                            echo "active";
                          } ?>">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <?php
      $user_role = get_role();
      if ($user_role == 'admin') {
      ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Data Pelamar
        </div>
        <li class="nav-item <?php if ($page == "Lowongan") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="list-lowongan.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Lowongan</span></a>
        </li>
        <li class="nav-item <?php if ($page == "Pelamar") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="daftar-pelamar.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelamar</span></a>
        </li>

        <li class="nav-item <?php if ($page == "Kriteria") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="list-kriteria.php">
            <i class="fas fa-fw fa-cube"></i>
            <span>Kriteria</span></a>
        </li>

        <li class="nav-item <?php if ($page == "Sub Kriteria") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="list-sub-kriteria.php">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Sub Kriteria</span></a>
        </li>

        <li class="nav-item <?php if ($page == "Penilaian_pelamar") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="daftar-nilai-pelamar.php">
            <i class="fas fa-fw fa-edit"></i>
            <span>Daftar Penilaian Pelamar</span></a>
        </li>

        <!-- <li class="nav-item <?php if ($page == "Perhitungan") {
                                    echo "active";
                                  } ?>">
          <a class="nav-link" href="perhitungan.php">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Data Perhitungan</span></a>
        </li> -->

        <li class="nav-item <?php if ($page == "Hasil_Pelamar") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="daftar-hasil-pelamar.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Daftar Hasil Akhir Pelamar</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Data Pegawai
        </div>
        <li class="nav-item <?php if ($page == "Divisi") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="divisi.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Divisi</span></a>
        </li>
        <li class="nav-item <?php if ($page == "Periode_Penilaian") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="list-periode-penilaian.php">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Periode Penilaian</span></a>
        </li>
        <li class="nav-item <?php if ($page == "Indikator") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="list-indikator.php">
            <i class="fas fa-fw fa-cube"></i>
            <span>Indikator Penilaian</span></a>
        </li>
        <li class="nav-item <?php if ($page == "Pegawai") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="daftar-pegawai.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Pegawai</span></a>
        </li>
        <li class="nav-item <?php if ($page == "Hasil_Pegawai") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="daftar-hasil-pegawai.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Hasil Akhir Pegawai</span></a>
        </li>
        <li class="nav-item <?php if ($page == "User") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="list-user.php">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Data User</span></a>
        </li>


        <!-- Divider
      <hr class="sidebar-divider"> -->

        <!-- Heading
      <div class="sidebar-heading">
        Master User
      </div>

	  
	  <li class="nav-item <?php if ($page == "User") {
                          echo "active";
                        } ?>">
        <a class="nav-link" href="list-user.php">
          <i class="fas fa-fw fa-users-cog"></i>
          <span>Data User</span></a>
      </li>	
	  
	  <li class="nav-item <?php if ($page == "Profile") {
                          echo "active";
                        } ?>">
        <a class="nav-link" href="list-profile.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Data Profile</span></a>
      </li>	 -->

      <?php
      } elseif ($user_role == 'kadiv') {
      ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Master Data
        </div>

        <li class="nav-item <?php if ($page == "Penilaian_Pegawai") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="daftar-nilai-pegawai.php">
            <i class="fas fa-fw fa-edit"></i>
            <span>Data Penilaian Pegawai</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Master User
        </div>

        <li class="nav-item <?php if ($page == "Profile") {
                              echo "active";
                            } ?>">
          <a class="nav-link" href="list-profile.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Profile</span></a>
        </li>

      <?php
      }
      ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn text-primary d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-uppercase mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php
                  echo $_SESSION['username'];
                  ?>
                </span>
                <img class="img-profile rounded-circle" src="../assets/img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../admin/list-profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="container-fluid">