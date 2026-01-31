<?php

session_start();
if(empty($_SESSION['user']) && empty($_SESSION['pass'])){
    echo "<script>window.location.replace('../index.php')</script>";
} 
//koneksi ke database
include '../assets/func.php';
$air=new kelas_air;
$koneksi=$air->koneksi();
$dt_user=$air->data_user($_SESSION['user']);
$usern=$dt_user[4];
$level=$dt_user[2];
$tip=$dt_user[3];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - DIMRA</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/air.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><img class="img-fluid rounded-circle" src="../assets/img/logokita.jpg" style="width:30px;height:30px;"/></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm" id="sidebarToggle" href="#!" style="position: absolute; left: 50px;"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">DIMRA - BANYU SUWEGER</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-shake text-primary"></i></div>
                                Beranda
                            </a>
                            <?php
                            if($level == "admin") {
                                ?>
                                <a class="nav-link" href="index.php?p=user">
                                <div class="sb-nav-link-icon"><i class="fas fa-users-gear fa-shake text-primary"></i></div>
                                Manajemen User
                            </a>
                            <a class="nav-link" href="index.php?p=tarif">
                                <div class="sb-nav-link-icon"><i class="fas fa-building-columns fa-shake text-primary"></i></div>
                                Manajemen Tarif
                            </a>
                                <a class="nav-link" href="index.php?p=catat_meter">
                                <div class="sb-nav-link-icon"><i class="fas fa-database fa-shake text-primary"></i></div>
                                Pemakaian & Pembayaran Warga
                            </a>
                            <?php
                            }
                            elseif($level == "bendahara"){
                                ?>
                                <a class="nav-link" href="index.php?p=tarif">
                                <div class="sb-nav-link-icon"><i class="fas fa-building-columns fa-shake text-primary"></i></div>
                                Manajemen Tarif
                            </a>
                                <a class="nav-link" href="index.php?p=catat_meter">
                                <div class="sb-nav-link-icon"><i class="fas fa-database fa-shake text-primary"></i></div>
                                Pemakaian & Pembayaran Warga
                            </a>
                                <?php
                            }
                            elseif($level == "petugas") {
                                ?>
                                <a class="nav-link" href="index.php?p=catat_meter">
                                <div class="sb-nav-link-icon"><i class="fas fa-pen-to-square fa-shake text-primary"></i></div>
                                Catat Meteran
                            </a>
                            <?php
                            }
                            elseif($level == "warga") {
                                ?>
                                <a class="nav-link" href="index.php?p=pemakaian_pribadi">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-transfer fa-shake text-primary"></i></div>
                                Pemakaian & Tagihan Pribadi
                            </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"><i class="fa-solid fa-user fa-beat-fade text-warning"></i> <?php echo "Logged in as : $dt_user[2]" ?></div>
                        <div class="small text-primary"><i class="fa-solid fa-address-card fa-flip text-primary"></i> <?php echo $dt_user[4].' ('.$dt_user[1].')'?></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <?php
                        // echo $_SERVER['REQUEST_URI'];
                        $e=explode("=",$_SERVER['REQUEST_URI']);
                        // echo "[0]: $e[0] --> [1]: $e[1]";
                        if(!empty($e[1])) {
                            if($e[1]=="user" || $e[1]=="user_edit&user") {
                                $h1="Manajemen User";
                                $li="Menu User";
                            }
                            elseif($e[1]=="tarif" || $e[1]=="tarif_edit&kd_tarif") {
                                $h1="Manajemen Tarif";
                                $li="Menu Tarif";
                            }
                            elseif($e[1]=="pemakaian_warga") {
                                $h1="Pemakaian Warga";
                                $li="Lihat data pemakaian warga";
                            }
                            elseif($e[1]=="datameter_warga") {
                                $h1="Datameter Warga";
                                $li="Ubah datameter warga";
                            }
                            elseif($e[1]=="catat_meter" || $e[1]=="meter_edit&no") {
                                $h1="Pencatatan Meteran";
                                $li="Catat meteran warga";
                            }
                            elseif($e[1]=="ubah_meter") {
                                $h1="Ubah Meteran 1 Bulan";
                                $li="Ubah meteran warga";
                            }
                            elseif($e[1]=="pemakaian_pribadi") {
                                $h1="Pemakaian & Tagihan Pribadi";
                                $li="Pemakaian & Tagihan $dt_user[4]";
                            }
                            elseif($e[1]=="tagihan_pribadi" || $e[1]=="bayar&no") {
                                $h1="Tagihan Pribadi";
                                $li="Tagihan $dt_user[4]";
                            }
                            
                        }
                        else {
                            $h1="Beranda";
                                $li="Halo $dt_user[4], Selamat Datang";
                        }

                        ?>
                        <h1 class="mt-4"><?php echo $h1 ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $li ?></li>
                        </ol>
                        <?php
                        // echo "sesi user: ".$_SESSION['user']," sesi pass: ".$_SESSION['pass'];

                        // session_destroy();
                        // echo "<BR> setelah session destroy: sesi user: ".$_SESSION['user']," sesi pass: ".$_SESSION['pass'];
                        ?>
                        <div class="row mb-3" id="pilih_waktu">
                            <div class="col-xl-3 col-md-12">
                                <label for="sel1" class="form-label">Pilih Waktu:</label>
                                <select class="form-select" id="sel1" name="pilih_waktu">
                                    <option value="">Bulan</option>
                                    <?php
                                    $lvl_login=$dt_user[2];
                                    $bulanskrg= date("n");
                                    for($i=1;$i<=12;$i++) {
                                        if($i<10) $i='0' . $i;
                                        if ($lvl_login=="warga") {
                                            echo "<option value=".date("Y")."-".$i.">".$air->bulan($i)." ".date("Y")."</option>";
                                        }
                                        else {
                                            if ($i==$bulanskrg) $sel="SELECTED";
                                            else $sel="";
                                            echo '<option value="'.date("Y").'-'.$i.'"'.$sel.'>'.$air->bulan($i).' '.date("Y").'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="summary">
                            <?php
                            $lvl_login=$dt_user[2];
                            if ($lvl_login=="admin" || $lvl_login=="petugas") {
                                echo "
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-primary text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>warga</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Pelanggan</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-warning text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>m<sup>3</sup></div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Pemakaian Air</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-success text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>warga</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Sudah Dicatat</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-danger text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>warga</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Belum Dicatat</div>
                                    </div>
                                </div>
                            </div> 
                            "; } else if ($lvl_login=="bendahara") {
                                echo "
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-primary text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>warga</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Pelanggan</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-warning text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>Rp</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Pemasukan</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-success text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>warga</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Sudah Lunas</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-danger text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h1></h1><div class='ms-2'>warga</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Belum Dibayar</div>
                                    </div>
                                </div>
                            </div>
                            ";} else {
                                echo "
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-primary text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h2></h2><div class='ms-2' id='wkt'></div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white' id='tes'>Waktu Pencatatan</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-warning text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h2></h2><div class='ms-2'>m<sup>3</sup></div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Pemakaian Air</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-success text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h2></h2><div class='ms-2'>Rp</div>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Tagihan</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-xl-3 col-md-6'>
                                <div class='card bg-danger text-white mb-4'>
                                    <div class='card-body d-flex justify-content-center'>
                                        <h2></h2>
                                    </div>
                                    <div class='card-footer d-flex align-items-center justify-content-center'>
                                        <div class='small text-white'>Status Tagihan</div>
                                    </div>
                                </div>
                            </div>
                            ";}
                            ?>
                        </div>
                        <div class="row" id="chart">
                            <?php
                            $lvl_login=$dt_user[2];
                            $yuser=$dt_user[4];
                            if ($lvl_login=="warga") {
                                $qw=mysqli_query($koneksi, "SELECT SUM(pemakaian) as makek ,SUM(tagihan) as bayar, (SELECT SUM(tagihan) FROM pemakaian WHERE STATUS='BLM LUNAS' AND username='$yuser') as utang FROM pemakaian WHERE username='$yuser'");
                                while($dw=mysqli_fetch_assoc($qw)) {
                                    $makai=$air->ribuan($dw['makek']);
                                    $tagih=$air->ribuan($dw['bayar']);
                                    $rbayar=$air->ribuan($dw['utang']);
                                echo "
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-bar me-1'></i>
                                        Total Pemakaian Air <b>$makai m<sup>3</sup></b>
                                    </div>
                                    <div class='card-body'><canvas id='myBarChart' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-area me-1'></i>
                                        Total Tagihan Air <b>Rp $tagih</b> | <tagname style='color:red;'>BLM LUNAS:<b style='color:red;'> Rp $rbayar</b>
                                    </div>
                                    <div class='card-body'><canvas id='myAreaChart' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            ";} }
                            else if ($lvl_login=="petugas") {
                                $qpet=mysqli_query($koneksi, "SELECT SUM(pemakaian) FROM pemakaian");
                                while($dpet=mysqli_fetch_row($qpet)) {
                                    $make=$air->ribuan($dpet[0]);
                                echo "
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-area me-1'></i>
                                        Total Pemakaian Air <b>$make m<sup>3</sup></b>
                                    </div>
                                    <div class='card-body'><canvas id='myAreaChart' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-pie me-1'></i>
                                        Jumlah Kos dan RT
                                    </div>
                                    <div class='card-body'><canvas id='myPieChart' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-bar me-1'></i>
                                        Jumlah Warga Tercatat
                                    </div>
                                    <div class='card-body'><canvas id='myBarChart1' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header' style='color:red;'>
                                        <i class='fas fa-chart-bar me-1'></i>
                                        Jumlah Warga Belum Tercatat
                                    </div>
                                    <div class='card-body'><canvas id='myBarChart2' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            ";} }
                            else {
                                $qab=mysqli_query($koneksi, "SELECT SUM(pemakaian) as makai, SUM(tagihan) as tagih, (SELECT SUM(tagihan) FROM pemakaian WHERE STATUS='LUNAS') as masuk FROM pemakaian");
                                while($dab=mysqli_fetch_assoc($qab)) {
                                    $makae=$air->ribuan($dab['makai']);
                                    $tagiha=$air->ribuan($dab['tagih']);
                                    $masuk=$air->ribuan($dab['masuk']);
                                echo "
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-area me-1'></i>
                                        Total Pemakaian Air <b>$makae m<sup>3</sup></b>
                                    </div>
                                    <div class='card-body'><canvas id='myAreaChart' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-pie me-1'></i>
                                        Jumlah Kos dan RT
                                    </div>
                                    <div class='card-body'><canvas id='myPieChart' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-area me-1'></i>
                                        Total Tagihan Air <b>Rp $tagiha</b>
                                    </div>
                                    <div class='card-body'><canvas id='myAreaChartb' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-area me-1'></i>
                                        Total Pemasukan <b>Rp $masuk</b>
                                    </div>
                                    <div class='card-body'><canvas id='myAreaChart3' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-bar me-1'></i>
                                        Jumlah Warga Tercatat
                                    </div>
                                    <div class='card-body'><canvas id='myBarChart1' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header' style='color:red;'>
                                        <i class='fas fa-chart-bar me-1'></i>
                                        Jumlah Warga Belum Tercatat
                                    </div>
                                    <div class='card-body'><canvas id='myBarChart2' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header'>
                                        <i class='fas fa-chart-bar me-1'></i>
                                        Jumlah Warga sudah LUNAS
                                    </div>
                                    <div class='card-body'><canvas id='myBarChartc' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            <div class='col-xl-6'>
                                <div class='card mb-4'>
                                    <div class='card-header' style='color:red;'>
                                        <i class='fas fa-chart-bar me-1'></i>
                                        Jumlah Warga Belum LUNAS
                                    </div>
                                    <div class='card-body'><canvas id='myBarChartd' width='100%' height='40'></canvas></div>
                                </div>
                            </div>
                            ";} }
                            ?>
                        </div>
                        <?php
                        if (isset($_POST['tombol'])) {
                            $t=$_POST['tombol'];
                            if ($t == "user_add") {
                                // echo "tes";
                                $user=$_POST['username'];
                                $pass=password_hash($_POST['pswd'], PASSWORD_DEFAULT);
                                $pass2=$_POST['pswd'];
                                $nama=$_POST['nama'];
                                $alamat=$_POST['alamat'];
                                $kota=$_POST['kota'];
                                $telepon=$_POST['telepon'];
                                $level=$_POST['level'];
                                $tipe=$_POST['tipe'];
                                $status=$_POST['status'];

                                // cek user
                                $qc=mysqli_query($koneksi,"SELECT username FROM user WHERE username='$user'");
                                $qj=mysqli_num_rows($qc);
                                // echo "hasil cek user : $qj";
                                // username tidak ada
                                if(empty($qj)) {
                                    mysqli_query($koneksi, "INSERT INTO user (username,password,nama,alamat,kota,telepon,level,tipe,status) VALUES ('$user','$pass',\"$nama\",'$alamat','$kota','$telepon','$level','$tipe','$status')");
                                    if (mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible' id='alert-user'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> Berhasil Dimasukkan.
                                            </div>";
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible' id='alert-user'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> GAGAL Dimasukkan.
                                            </div>";
                                    }
                                
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible' id='alert-user'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Username $user</strong> Sudah ada....
                                            </div>";
                                }
                            } else if($t == "user_edit") {
                                $user=$_POST['username'];
                                $pass=$_POST['pswd'];
                                $nama=$_POST['nama'];
                                $alamat=$_POST['alamat'];
                                $kota=$_POST['kota'];
                                $telepon=$_POST['telepon'];
                                $level=$_POST['level'];
                                $tipe=$_POST['tipe'];
                                $status=$_POST['status'];

                                // cek password di data user
                                $qcp=mysqli_query($koneksi, "SELECT password FROM user WHERE username='$user'");
                                $dcp=mysqli_fetch_row($qcp);
                                $pass_db=$dcp[0];

                                if($pass==$pass_db) {
                                    // tdk ada perubahan
                                    mysqli_query($koneksi,"UPDATE user SET nama=\"$nama\",alamat='$alamat',kota='$kota',telepon='$telepon',level='$level',tipe='$tipe',status='$status' WHERE username='$user'");
                                } else {
                                    // ada perubahan
                                    $pass2= password_hash($pass, PASSWORD_DEFAULT);
                                    mysqli_query($koneksi,"UPDATE user SET password='$pass2',nama=\"$nama\",alamat='$alamat',kota='$kota',telepon='$telepon',level='$level',tipe='$tipe',status='$status' WHERE username='$user'");
                                }

                                if (mysqli_affected_rows($koneksi)>0) {
                                    echo "<div class='alert alert-success alert-dismissible' id='alert-user'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil Diperbarui.
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-primary alert-dismissible' id='alert-user'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Tidak Ada Perubahan.
                                        </div>";
                                } 
                            } else if ($t == "user_hapus") {
                                // echo "tes";
                                $user=$_POST['user'];
                                mysqli_query($koneksi, "DELETE FROM user WHERE username='$user'");
                                mysqli_query($koneksi, "DELETE FROM pemakaian WHERE username='$user'");
                                if (mysqli_affected_rows($koneksi)>0) {
                                    echo "<div class='alert alert-success alert-dismissible'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil Dihapus.
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> GAGAL Dihapus.
                                        </div>";
                                }
                            } else if ($t == "tarif_add") {
                                // echo "tes";
                                $kd_tarif=$_POST['kd_tarif'];
                                $tipe=$_POST['tipe'];
                                $tarif=$_POST['tarif'];
                                $status=$_POST['status'];

                                $qc=mysqli_query($koneksi,"SELECT kd_tarif FROM tarif WHERE kd_tarif='$kd_tarif'");
                                $qj=mysqli_num_rows($qc);
                                // echo "hasil cek user : $qj";
                                // username tidak ada
                                if(empty($qj)) {
                                    mysqli_query($koneksi, "INSERT INTO tarif (kd_tarif,tarif,tipe,status) VALUES ('$kd_tarif','$tarif',\"$tipe\",'$status')");
                                    if (mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible' id='alert-tarif'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> Berhasil Dimasukkan.
                                            </div>";
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible' id='alert-tarif'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> GAGAL Dimasukkan.
                                            </div>";
                                    }
                                }
                                // echo "hasil cek user : $qj";
                                // us
                                    
                                
                            } else if($t == "tarif_edit") {
                                $kd_tarif=$_POST['kd_tarif'];
                                $tipe=$_POST['tipe'];
                                $tarif=$_POST['tarif'];
                                $status=$_POST['status'];

                                

                                
                                mysqli_query($koneksi,"UPDATE tarif SET tarif='$tarif',tipe='$tipe',status='$status' WHERE kd_tarif='$kd_tarif'");
                                

                                if (mysqli_affected_rows($koneksi)>0) {
                                    echo "<div class='alert alert-success alert-dismissible' id='alert-tarif'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil Diperbarui.
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-primary alert-dismissible' id='alert-tarif'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Tidak Ada Perubahan.
                                        </div>";
                                } 
                            } else if ($t == "tarif_hapus") {
                                $kd_tarif=$_POST['kd_tarif'];
                                mysqli_query($koneksi, "DELETE FROM tarif WHERE kd_tarif='$kd_tarif'");
                                if (mysqli_affected_rows($koneksi)>0) {
                                    echo "<div class='alert alert-success alert-dismissible'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil Dihapus.
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> GAGAL Dihapus.
                                        </div>";
                                }
                            } else if ($t == "meter_add") {
                                // echo "tes";
                                $username=$_POST['username'];
                                $meter_awal=$_POST['meter_awal'];
                                $meter_akhir=$_POST['meter_akhir'];
                                $kd_tarif=$air->user_to_kdtarif($username);
                                $tarif=$air->kdtarif_to_tarif($kd_tarif);
                                
                                // cek meter awal harus lebih kecil drpd meter akhir
                                $pemakaian=$meter_akhir-$meter_awal;
                                $tagihan=$tarif * $pemakaian;
                                if ($pemakaian < 0) {
                                    echo "<div class='alert alert-danger alert-dismissible' id='alert-meter'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Meter Akhir</strong> terlalu kecil.
                                            </div>";
                                } else {
                                    $lvl_login=$dt_user[2];
                                    if($lvl_login=="admin" || $lvl_login=="bendahara") {
                                        $status=$_POST['status'];
                                        mysqli_query($koneksi,"INSERT INTO pemakaian (username,meter_awal,meter_akhir,pemakaian,tanggal,waktu,kd_tarif,tagihan,status) VALUES ('$username','$meter_awal','$meter_akhir','$pemakaian',CURRENT_DATE(),CURRENT_TIME(),'$kd_tarif','$tagihan','$status')");
                                        if (mysqli_affected_rows($koneksi)>0) {
                                            echo "<div class='alert alert-success alert-dismissible' id='alert-meter'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> Berhasil Dimasukkan.
                                                </div>";
                                        } else {
                                            echo "<div class='alert alert-danger alert-dismissible' id='alert-meter'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> GAGAL Dimasukkan.
                                                </div>";
                                        }
                                    } else {
                                        mysqli_query($koneksi,"INSERT INTO pemakaian (username,meter_awal,meter_akhir,pemakaian,tanggal,waktu,kd_tarif,tagihan,status) VALUES ('$username','$meter_awal','$meter_akhir','$pemakaian',CURRENT_DATE(),CURRENT_TIME(),'$kd_tarif','$tagihan','BLM LUNAS')");
                                        if (mysqli_affected_rows($koneksi)>0) {
                                            echo "<div class='alert alert-success alert-dismissible' id='alert-meter'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> Berhasil Dimasukkan.
                                                </div>";
                                        } else {
                                            echo "<div class='alert alert-danger alert-dismissible' id='alert-meter'>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> GAGAL Dimasukkan.
                                                </div>";
                                        }
                                    }
                                }
                            } else if($t == "meter_edit") {
                                $no=$_POST['no'];
                                $meter_awal=$_POST['meter_awal'];
                                $meter_akhir=$_POST['meter_akhir'];
                                $qm=mysqli_query($koneksi,"SELECT tanggal,waktu FROM pemakaian WHERE no='$no'");
                                $mq=mysqli_fetch_assoc($qm);
                                $tanggal=$mq['tanggal'];
                                $waktu=$mq['waktu'];

                                $username=$air->no_to_user($no);
                                $kd_tarif=$air->user_to_kdtarif($username);
                                $tarif=$air->kdtarif_to_tarif($kd_tarif);
                                $pemakaian=$meter_akhir-$meter_awal;
                                $tagihan=$tarif * $pemakaian;
                                

                                $lvl_login=$dt_user[2];
                                    if($lvl_login=="admin" || $lvl_login=="bendahara") {
                                        $status=$_POST['status'];
                                        mysqli_query($koneksi,"UPDATE pemakaian SET meter_awal='$meter_awal',meter_akhir='$meter_akhir',pemakaian='$pemakaian',tanggal='$tanggal',waktu='$waktu',tagihan='$tagihan',status='$status' WHERE no='$no'");
                                        if (mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible' id='alert-meter'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil Diperbarui.
                                            </div>";
                                        } else {
                                        echo "<div class='alert alert-primary alert-dismissible' id='alert-meter'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Tidak Ada Perubahan.
                                            </div>";
                                        }
                                    } else {
                                        mysqli_query($koneksi,"UPDATE pemakaian SET meter_awal='$meter_awal',meter_akhir='$meter_akhir',pemakaian='$pemakaian',tanggal=CURRENT_DATE(),waktu=CURRENT_TIME(),tagihan='$tagihan',status='BLM LUNAS' WHERE no='$no'");
                                        if (mysqli_affected_rows($koneksi)>0) {
                                        echo "<div class='alert alert-success alert-dismissible' id='alert-meter'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil Diperbarui.
                                            </div>";
                                        } else {
                                        echo "<div class='alert alert-primary alert-dismissible' id='alert-meter'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Tidak Ada Perubahan.
                                            </div>";
                                        }
                                    } 
                            } else if ($t == "meter_hapus") {
                                $no=$_POST['no'];
                                mysqli_query($koneksi, "DELETE FROM pemakaian WHERE no='$no'");
                                if (mysqli_affected_rows($koneksi)>0) {
                                    echo "<div class='alert alert-success alert-dismissible'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil Dihapus.
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> GAGAL Dihapus.
                                        </div>";
                                }
                            } else if($t == "konfirmasi") {
                                $no = $_GET['no'];
                                
                                // Update status di tabel pemakaian
                                mysqli_query($koneksi, "UPDATE pemakaian SET status='LUNAS' WHERE no='$no'");
                                
                                
                                
                                
                                if(mysqli_affected_rows($koneksi) > 0) {
                                    echo "<div class='alert alert-success alert-dismissible'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Pembayaran</strong> Berhasil dikonfirmasi.
                                        </div>";
                                }
                            } else if ($t== "bayar") {
                                $no = $_GET['no'];
                                $mode = $_POST['mode'];
                                $bukti = $_POST['bukti'];

                                mysqli_query($koneksi, "UPDATE pemakaian SET status='LUNAS' WHERE no='$no'");
                                mysqli_query($koneksi, "INSERT INTO pembayaran (no, mode, bukti, tanggal) VALUES ('$no','$mode','$bukti',CURRENT_DATE())");
                                if (mysqli_affected_rows($koneksi)>0) {
                                    echo "<div class='alert alert-success alert-dismissible' id='alert-bayar'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Berhasil</strong> Dibayar.
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-primary alert-dismissible' id='alert-bayar'>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Gagal</strong> Dibayar.
                                        </div>";
                                }
                            }
                             } else if(isset($_GET['p'])){
                                $p=$_GET['p'];
                                    if($p == "user_edit") {
                                        $user=$_GET['user'];
                                        // echo "ngedit user:$user";
                                        $q= mysqli_query($koneksi,"SELECT password,nama,alamat,kota,telepon,level,tipe,status FROM user WHERE username='$user'");
                                        $d= mysqli_fetch_row($q);
                                        $pass=$d[0];
                                        $pass2=password_hash($pass, PASSWORD_DEFAULT);
                                        $nama=$d[1];
                                        $alamat=$d[2];
                                        $kota=$d[3];
                                        $telepon=$d[4];
                                        $level=$d[5];
                                        $tipe=$d[6];
                                        $status=$d[7];
                                } else if($p == "tarif") {
                                    $kd_tarif= "";
                                    $status="";
                                } else if($p == "tarif_edit") {
                                    $kd_tarif= $_GET['kd_tarif'];
                                    $q= mysqli_query($koneksi,"SELECT tarif,tipe,status FROM tarif WHERE kd_tarif='$kd_tarif'");
                                    $d= mysqli_fetch_row($q);
                                    $tipe= $d[1];
                                    $tarif=$d[0];
                                    $status=$d[2];
                                } else if($p == "meter_edit") {
                                    $no= $_GET['no'];
                                    $q= mysqli_query($koneksi,"SELECT username,meter_awal,meter_akhir,status FROM pemakaian WHERE no='$no'");
                                    $d= mysqli_fetch_row($q);
                                    $username= $d[0];
                                    $meter_awal=$d[1];
                                    $meter_akhir=$d[2];
                                    $status=$d[3];
                                } else if($p == "bayar") {
                                    $no= $_GET['no'];
                                    $q= mysqli_query($koneksi,"SELECT tagihan FROM pemakaian WHERE no='$no'");
                                    $d= mysqli_fetch_row($q);
                                    $tagihan=$d[0];

                                }
                            }
                        
                        ?>
                        <div class="card mb-4" id="user_add">
                            <div class="card-header">
                                <i class="fa-solid fa-user-plus ma-2"></i>
                                User
                            </div>
                            <div class="card-body">
                            <form method="post" class="needs-validation" id="user_form">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo $user ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pwd" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" value="<?php echo $pass ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama:</label>
                                    <input type="nama" class="form-control" id="nama" placeholder="Enter nama" name="nama" value="<?php echo $nama ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat">Alamat:</label>
                                    <textarea class="form-control" rows="5" id="alamat" name="alamat"><?php echo $alamat ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota:</label>
                                    <input type="kota" class="form-control" id="kota" placeholder="Enter kota" name="kota" value="<?php echo $kota ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon:</label>
                                    <input type="telepon" class="form-control" id="telepon" placeholder="Enter telepon" name="telepon" value="<?php echo $telepon ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level:</label>
                                    <select class="form-select" name="level" id="level">
                                        <option value="">Level</option>
                                        <?php
                                        $lv=array("admin","bendahara","petugas","warga");
                                        foreach ($lv as $lv2) {
                                            if ($level == $lv2) $sel = "SELECTED";
                                            else $sel="";
                                            echo "<option value=$lv2 $sel>".ucwords($lv2)."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Tipe:</label>
                                    <select class="form-select" name="tipe" id="tipe">
                                        <option value="">Tipe</option>
                                        <?php
                                        $t=array("RT","Kos");
                                        foreach ($t as $t2) {
                                            if ($tipe == $t2) $sel = "SELECTED";
                                            else $sel="";
                                            echo "<option value=$t2 $sel>".ucwords($t2)."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="">Status</option>
                                        <?php
                                        $a=array("AKTIF","NONAKTIF");
                                        foreach ($a as $a2) {
                                            if ($status == $a2) $sel = "SELECTED";
                                            else $sel="";
                                            echo "<option value='$a2' $sel>$a2</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="tombol" value="user_add">Simpan</button>
                            </form>
                            </div>
                        </div>
                        <div class="card mb-4" id="tarif_add">
                            <div class="card-header">
                                <i class="fa-solid fa-user-plus ma-2"></i>
                                Tarif
                            </div>
                            <div class="card-body">
                            <form method="post" class="needs-validation" id="tarif_form">
                                <div class="mb-3">
                                    <label for="kd_tarif" class="form-label">Kode Tarif:</label>
                                    <input type="text" class="form-control" id="kd_tarif" placeholder="Enter Kode Tarif" name="kd_tarif" value="<?php echo $kd_tarif ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Tipe Tarif:</label>
                                    <select class="form-select" name="tipe" id="tipe2">
                                        <option value="">Tipe Tarif</option>
                                        <?php
                                        $tp=array("RT","Kos");
                                        foreach ($tp as $tp2) {
                                            if ($tipe == $tp2) $sel = "SELECTED";
                                            else $sel="";
                                            echo "<option value=$tp2 $sel>".ucwords($tp2)."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tarif" class="form-label">Tarif:</label>
                                    <input type="number" class="form-control" id="tarif" placeholder="Enter Tarif" name="tarif" value="<?php echo $tarif ?? '' ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-select" name="status" id="status2">
                                        <option value="">Status</option>
                                        <?php
                                        $st = array("AKTIF", "NONAKTIF");
                                        foreach ($st as $st2) {
                                            if ($status == $st2) $sel = "SELECTED";
                                            else $sel="";
                                            echo "<option value=$st2 $sel>".ucwords($st2)."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mt-2">
                                <button type="submit" class="btn btn-primary" name="tombol" value="tarif_add">Simpan</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="card mb-4" id="meter_add">
                            <div class="card-header">
                                <i class="fa-solid fa-upload ma-2"></i>
                                Meter
                            </div>
                            <div class="card-body">
                            <form method="post" class="needs-validation" id="meter_form">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama Warga:</label>
                                    <select class="form-select" name="username" required>
                                        <option value="">Nama Warga</option>
                                        <?php
                                        $qw=mysqli_query($koneksi,"SELECT username, nama FROM user WHERE level='warga'");
                                        while($dw=mysqli_fetch_row($qw)) {
                                            if ($username == $dw[0]) $sel = "SELECTED";
                                            else $sel="";
                                            echo "<option value='$dw[0]' $sel>$dw[0]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="meter_awal" class="form-label">Meter Awal:</label>
                                    <input type="text" class="form-control" id="meter_awal" placeholder="Enter Meter Awal" name="meter_awal" value="<?php echo $meter_awal ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="meter_akhir" class="form-label">Meter Akhir:</label>
                                    <input type="text" class="form-control" id="meter_akhir" placeholder="Enter Meter Akhir" name="meter_akhir" value="<?php echo $meter_akhir ?>" required>
                                </div>
                                <?php
                                $lvl_login=$dt_user[2];
                                if($lvl_login=="admin" || $lvl_login=="bendahara") {
                                    ?>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status:</label>
                                        <select class="form-select" name="status" id="status3">
                                            <option value="">Status</option>
                                            <?php
                                            $ss=array("LUNAS","BLM LUNAS");
                                            foreach ($ss as $ss2) {
                                                if ($status == $ss2) $sel = "SELECTED";
                                                else $sel="";
                                                echo "<option value='$ss2' $sel>$ss2</option>";
                                            } 
                                            ?>
                                        </select>
                                    </div> 
                                <?php } else {
                                     echo"";
                                 }
                                ?>
                                
                                <div class="mt-2">
                                <button type="submit" class="btn btn-primary" name="tombol" value="meter_add">Simpan</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="card mb-4" id="bayar">
                            <div class="card-header">
                                <i class="fa-solid fa-rupiah-sign ma-2"></i>
                                Bayar
                            </div>
                            <div class="card-body">
                            <form method="post" class="needs-validation" id="bayar_form">
                                <div class="mb-3">
                                    <label for="tagihan" class="form-label">Jumlah Tagihan:</label>
                                    <input type="number" class="form-control" id="tagihan" name="display_tagihan" value="<?php echo $tagihan ?? '' ?>" disabled>
                                </div>
                                <div class="mb-3">
                                                <label class="form-label">Mode Pembayaran</label>
                                                <select class="form-select" name="mode" required>
                                                    <option value="">Pilih Metode</option>
                                                    <option value="Transfer Bank">Transfer Bank</option>
                                                    <option value="Tunai">Tunai</option>
                                                </select>
                                            </div>
                                <div class="mb-3">
                                            <label class="form-label">Bukti Pembayaran</label>
                                            <input type="file" class="form-control" name="bukti" accept="image/*" required>
                                </div>
                                <div class="mt-2">
                                <button type="submit" class="btn btn-primary" name="tombol" value="bayar">Bayar</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form method="post">
                                        <button type="submit" name="tombol" value="user_hapus" class="btn btn-danger" data-bs-dismiss="modal">Ya</button>
                                    </form>
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tidak</button>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-4" id="user_list">
                            <div class="card-header">
                                <i class="fas fa-solid fa-user-group ma-2"></i>
                                Data User
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Telepon</th>
                                            <th>Level</th>
                                            <th>Tipe</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        $q=mysqli_query($koneksi, "SELECT username,nama,alamat,kota,telepon,level,tipe,status FROM user ORDER BY level ASC");
                                        while($d=mysqli_fetch_row($q)) {
                                            $user=$d[0];
                                            $nama=$d[1];
                                            $alamat=$d[2];
                                            $kota=$d[3];
                                            $telepon=$d[4];
                                            $level=$d[5];
                                            $tipe=$d[6];
                                            $status=$d[7];
                                            
                                            echo "<tr>
                                                    <td>$user</td>
                                                    <td>$nama</td>
                                                    <td>$alamat</td>
                                                    <td>$kota</td>
                                                    <td>$telepon</td>
                                                    <td>$level</td>
                                                    <td>$tipe</td>
                                                    <td>$status</td>
                                                    <td>
                                                        <a href=index.php?p=user_edit&user=$user><button type=button class='btn btn-outline-success btn-sm'><i class='fa-solid fa-arrows-rotate'></i> Ubah</button></a><hr>
                                                        <button type=button class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' id='hapus_user' data-user=$user><i class='fa-solid fa-trash-can'></i> Hapus</button>
                                                    </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" id="tarif_list">
                            <div class="card-header">
                                <i class="fas fa-solid fa-money-bills ma-2"></i>
                                Data Tarif
                            </div>
                            <div class="card-body">
                                <table id="tarif_table">
                                    <thead>
                                        <tr>
                                            <th>Kode Tarif</th>
                                            <th>Tipe Tarif</th>
                                            <th>Tarif</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        $q=mysqli_query($koneksi, "SELECT kd_tarif,tarif,tipe,status FROM tarif ORDER BY kd_tarif ASC");
                                        while($d=mysqli_fetch_row($q)) {
                                            $kd_tarif=$d[0];
                                            $tipe=$d[2];
                                            $tarif=$d[1];
                                            $status=$d[3];
                                            
                                            echo "<tr>
                                                    <td>$kd_tarif</td>
                                                    <td>$tipe</td>
                                                    <td>$tarif</td>
                                                    <td>$status</td>
                                                    <td>
                                                        <a href=index.php?p=tarif_edit&kd_tarif=$kd_tarif><button type=button class='btn btn-outline-success btn-sm'><i class='fa-solid fa-arrows-rotate'></i> Ubah</button></a>
                                                        <button type=button class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-kd_tarif=$kd_tarif><i class='fa-solid fa-trash-can'></i> Hapus</button>
                                                    </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" id="meter_list">
                            <div class="card-header">
                                <i class="fas fa-solid fa-server ma-2"></i>
                                Data Meter
                            </div>
                            <div class="card-body">
                                <table id="meter_table">
                                    <thead>
                                        <?php
                                        $lvl_login=$dt_user[2];
                                            if($lvl_login=="petugas") {
                                                ?>  <tr>
                                                        <th>Nama Warga</th>
                                                        <th>Tipe</th>
                                                        <th>Tanggal & Waktu</th>
                                                        <th>Meter Awal</th>
                                                        <th>Meter Akhir</th>
                                                        <th>Pemakaian</th> 
                                                        <th></th>
                                                    </tr> <?php 
                                            } else {
                                                ?> <tr>
                                                        <th>Nama Warga</th>
                                                        <th>Tipe</th>
                                                        <th>Tanggal & Waktu</th>
                                                        <th>Meter Awal</th>
                                                        <th>Meter Akhir</th>
                                                        <th>Pemakaian</th> 
                                                        <th>Tagihan</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr><?php 
                                            }?>
                                        
                                    </thead>

                                    <tbody>
                                        <?php 
                                        $q=mysqli_query($koneksi, "SELECT no,username,meter_awal,meter_akhir,pemakaian,tanggal,waktu,tagihan,status FROM pemakaian ORDER BY tanggal DESC, username ASC");
                                        while($d=mysqli_fetch_row($q)) {
                                            $no=$d[0];
                                            $dt_user2=$air->data_user($d[1]); 
                                            $nama= $dt_user2[0];
                                            $meter_awal=$d[2];
                                            $meter_akhir=$d[3];
                                            $pemakaian=$d[4];
                                            $tanggal=$air->tanggal_balik($d[5]);
                                            $waktu=$d[6];
                                            $tipe=$dt_user2[3];
                                            $tagihan=$d[7];
                                            $status=$d[8];
                                            $lvl_login=$dt_user[2];
                                            
                                            $tgltabel=date_create($d[5]);
                                            $tglsekar=date_create();
                                            $diff=date_diff($tgltabel,$tglsekar);
                                            $selisih=$diff->days;

                                            echo "<tr>
                                                    <td>$nama</td>
                                                    <td>$tipe</td>
                                                    <td>$tanggal $waktu | $selisih hari</td>
                                                    <td>$meter_awal</td>
                                                    <td>$meter_akhir</td>
                                                    <td>$pemakaian</td>";
                                                    if($lvl_login=="admin" || $lvl_login=="bendahara") {
                                                        echo "<td>$tagihan</td>
                                                            <td><span class='" . ($status == "LUNAS" ? "badge bg-success" : "badge bg-danger") . " text-white small fw-bold'>$status</span></td>";
                                                    } else {
                                                        echo "";
                                                    }
                                                    
                                                    
                                                    if($lvl_login=="admin" || $lvl_login=="bendahara") {
                                                        echo "<td>
                                                            <a href=index.php?p=meter_edit&no=$no><button type=button class='btn btn-outline-success btn-sm'><i class='fa-solid fa-arrows-rotate'></i> Ubah</button></a><hr>
                                                            <button type=button class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-no=$no><i class='fa-solid fa-trash-can'></i> Hapus</button>
                                                            </td>";
                                                    } else {
                                                        if($selisih<=30) {
                                                            echo "<td>
                                                            <a href=index.php?p=meter_edit&no=$no><button type=button class='btn btn-outline-success btn-sm'><i class='fa-solid fa-arrows-rotate'></i> Ubah</button></a><hr>
                                                            <button type=button class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-no=$no><i class='fa-solid fa-trash-can'></i> Hapus</button>
                                                            </td>";
                                                        } else {
                                                            echo "<td></td>";
                                                        }
                                                    }
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" id="pribadi_list">
                            <div class="card-header">
                                <i class="fas fa-solid fa-database ma-2"></i>
                                Pemakaian Pribadi
                            </div>
                            <div class="card-body">
                                <table id="pribadi_table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal & Waktu</th>
                                            <th>Meter Awal</th>
                                            <th>Meter Akhir</th>
                                            <th>Pemakaian</th>
                                            <th>Tagihan</th>
                                            <th>Status</th>
                                            <th>Bayar</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        $q=mysqli_query($koneksi, "SELECT no,meter_awal,meter_akhir,pemakaian,tanggal,waktu,tagihan,status FROM pemakaian WHERE username='".$_SESSION['user']."' ORDER BY tanggal DESC");
                                        while($d=mysqli_fetch_row($q)) {
                                            $no=$d[0];
                                            $meter_awal=$d[1];
                                            $meter_akhir=$d[2];
                                            $pemakaian=$d[3];
                                            $tanggal=$air->tanggal_balik($d[4]);
                                            $waktu=$d[5];
                                            $tagihan=$d[6];
                                            $status=$d[7];
                                            

                                            echo "<tr>
                                                    <td>$tanggal ($waktu)</td>
                                                    <td>$meter_awal</td>
                                                    <td>$meter_akhir</td>
                                                    <td>$pemakaian</td>
                                                    <td>$tagihan</td>
                                                    <td><span class='" . ($status == "LUNAS" ? "badge bg-success" : "badge bg-danger") . " text-white small fw-bold'>$status</span></td>";
                                                    if($status=="LUNAS") {
                                                        echo "<td>
                                                            <button class='btn btn-sm btn-success' disabled>Sudah Dibayar</button>
                                                            </td>";
                                                    } else {
                                                        
                                                        echo "<td>
                                                            <a href=index.php?p=bayar&no=$no><button class='btn btn-sm btn-primary bayar-btn'>Bayar</button></a>
                                                            </td>";
                                                    }
                                                echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; DIMRA <?php echo date("Y")?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php 
        if ($lvl_login=="warga") {
            $query=mysqli_query($koneksi,"SELECT DATE_FORMAT(MAX(tanggal), '%m') as bulans, DATE_FORMAT(MAX(tanggal), '%Y') as tahuns FROM pemakaian WHERE username='$usern'");
            $data=mysqli_fetch_assoc($query);
            $tahunskrg=$data['tahuns'];
            $bulanskrg=$data['bulans'];
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="../assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="../assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script>var bulans = <?php echo json_encode($bulanskrg ?? ""); ?>;</script>
        <script>var tahuns = <?php echo json_encode($tahunskrg ?? ""); ?>;</script>
        <script>var lvl = <?php echo json_encode($lvl_login ?? ""); ?>;</script>
        <script>var user = <?php echo json_encode($usern ?? ""); ?>;</script>
    </body>
</html>
