<?php
include 'func.php';
$air=new kelas_air;
$koneksi=$air->koneksi();
// header('Content-Type: application/json');

if(isset($_POST['p'])) {
    $p=$_POST['p'];

    if($p=="summary") {

        $bln=$_POST['t'];
        $user=$_POST['u'];
        $level=$_POST['l'];
        if ($level=="admin" || $level=="petugas") {
        $q1=mysqli_query($koneksi,"SELECT COUNT(username) as jml_pelanggan FROM user WHERE level='warga'");
        $d1=mysqli_fetch_assoc($q1);
        $data[]=array('jml_pelanggan'=>$d1['jml_pelanggan']);

        $q2=mysqli_query($koneksi,"SELECT SUM(pemakaian) as pmk_air FROM pemakaian WHERE tanggal LIKE '$bln%'");
        $d2=mysqli_fetch_assoc($q2);
        $data[]=array('pmk_air'=>$d2['pmk_air']);

        $q3=mysqli_query($koneksi,"SELECT COUNT(username) as jml_air FROM pemakaian WHERE tanggal LIKE '$bln%'");
        $d3=mysqli_fetch_assoc($q3);
        $data[]=array('jml_air'=>$d3['jml_air']);

        $q13=mysqli_query($koneksi, "SELECT COUNT(CASE WHEN tipe = 'kos' THEN 1 END) as tp, COUNT(username) as plg FROM user WHERE level='warga'");
        while($d13=mysqli_fetch_assoc($q13)) {
            $data[]=$d13['tp']; //kos
            $data[]=$d13['plg'] - $d13['tp']; //rt
        }
        if ($level=="petugas") {
            $q14=mysqli_query($koneksi, "SELECT MONTH(tanggal) as blan, COUNT(username) as tercatat, (SELECT COUNT(username) FROM user WHERE level='warga') - COUNT(username) as blm_tercatat, SUM(pemakaian) as makai FROM pemakaian GROUP BY blan ORDER BY blan ASC");
            while($d14=mysqli_fetch_assoc($q14)) {
                $data[]=$air->bulan($d14['blan']);
                $data[]=$d14['tercatat'];
                $data[]=$d14['blm_tercatat'];
                $data[]=$d14['makai'];
            }
        }
        else {
            $q15=mysqli_query($koneksi, "SELECT MONTH(tanggal) as blan, COUNT(username) as tercatat, (SELECT COUNT(username) FROM user WHERE level='warga') - COUNT(username) as blm_tercatat, (SELECT COUNT(username) FROM pemakaian p2 WHERE status='lunas' AND MONTH(p2.tanggal) = MONTH(p1.tanggal)) as lunas, (SELECT COUNT(username) FROM pemakaian p2 WHERE MONTH(p2.tanggal) = MONTH(p1.tanggal)) - (SELECT COUNT(username) FROM pemakaian p2 WHERE status='lunas' AND MONTH(p2.tanggal) = MONTH(p1.tanggal)) as blm_lunas, SUM(pemakaian) as makai, SUM(tagihan) as tagih, (SELECT SUM(tagihan) FROM pemakaian p2 WHERE status='LUNAS' AND MONTH(p2.tanggal) = MONTH(p1.tanggal)) as masuk FROM pemakaian p1 GROUP BY blan ORDER BY blan ASC");
            while($d15=mysqli_fetch_assoc($q15)) {
                $data[]=$air->bulan($d15['blan']);
                $data[]=$d15['tercatat'];
                $data[]=$d15['blm_tercatat'];
                $data[]=$d15['lunas'];
                $data[]=$d15['blm_lunas'];
                $data[]=$d15['makai'];
                $data[]=$d15['tagih'];
                $data[]=$d15['masuk'];
            }
        }
        

        } else if ($level=="bendahara") {
        $q11=mysqli_query($koneksi,"SELECT COUNT(username) as jml_pelangganb FROM user WHERE level='warga'");
        $d11=mysqli_fetch_assoc($q11);
        $data[]=array('jml_pelangganb'=>$d11['jml_pelangganb']);

        $q4=mysqli_query($koneksi, "SELECT SUM(tagihan) as jml_uang FROM pemakaian WHERE tanggal LIKE '$bln%' AND status='LUNAS'");
        $d4=mysqli_fetch_assoc($q4);
        $data[]=array('jml_uang'=>$d4['jml_uang']);

        $q5=mysqli_query($koneksi, "SELECT COUNT(status) as jml_lunas FROM pemakaian WHERE tanggal LIKE '$bln%' AND status='LUNAS'");
        $d5=mysqli_fetch_assoc($q5);
        $data[]=array('jml_lunas'=>$d5['jml_lunas']);

        $q16=mysqli_query($koneksi, "SELECT COUNT(CASE WHEN tipe = 'kos' THEN 1 END) as tp, COUNT(username) as plg FROM user WHERE level='warga'");
        while($d16=mysqli_fetch_assoc($q16)) {
            $data[]=$d16['tp']; //kos
            $data[]=$d16['plg'] - $d16['tp']; //rt
        }

        $q17=mysqli_query($koneksi, "SELECT MONTH(tanggal) as blan, COUNT(username) as tercatat, (SELECT COUNT(username) FROM user WHERE level='warga') - COUNT(username) as blm_tercatat, (SELECT COUNT(username) FROM pemakaian p2 WHERE status='lunas' AND MONTH(p2.tanggal) = MONTH(p1.tanggal)) as lunas, (SELECT COUNT(username) FROM user WHERE level='warga') - (SELECT COUNT(username) FROM pemakaian p2 WHERE status='lunas' AND MONTH(p2.tanggal) = MONTH(p1.tanggal)) as blm_lunas, SUM(pemakaian) as makai, SUM(tagihan) as tagih, (SELECT SUM(tagihan) FROM pemakaian p2 WHERE status='LUNAS' AND MONTH(p2.tanggal) = MONTH(p1.tanggal)) as masuk FROM pemakaian p1 GROUP BY blan ORDER BY blan ASC");
        while($d17=mysqli_fetch_assoc($q17)) {
            $data[]=$air->bulan($d17['blan']);
            $data[]=$d17['tercatat'];
            $data[]=$d17['blm_tercatat'];
            $data[]=$d17['lunas'];
            $data[]=$d17['blm_lunas'];
            $data[]=$d17['makai'];
            $data[]=$d17['tagih'];
            $data[]=$d17['masuk'];
        }

        } else {
        $q6=mysqli_query($koneksi, "SELECT SUM(pemakaian) as air_warga FROM pemakaian WHERE username='$user' AND tanggal LIKE '$bln%'");
        $d6=mysqli_fetch_assoc($q6); 
        $data[]=array('air_warga'=>$d6['air_warga']);
        

        $q7=mysqli_query($koneksi, "SELECT SUM(tagihan) as byr_warga FROM pemakaian WHERE username='$user' AND tanggal LIKE '$bln%'");
        $d7=mysqli_fetch_assoc($q7); 
        $data[]=array('byr_warga'=>$d7['byr_warga']);

        $q8=mysqli_query($koneksi, "SELECT status as stts_warga FROM pemakaian WHERE username='$user' AND tanggal LIKE '$bln%'");
        if ($d8=mysqli_fetch_assoc($q8)) { 
            $data[]=array('stts_warga'=>$d8['stts_warga']);
        } else {
            $data[]=array('stts_warga'=>"-");
        }

        $q9=mysqli_query($koneksi, "SELECT DAY(tanggal) as tgl FROM pemakaian WHERE username='$user' AND tanggal LIKE '$bln%'");
        if ($d9=mysqli_fetch_assoc($q9)) { 
            $data[]=array('tgl'=>$d9['tgl']);
        } else {
            $data[]=array('tgl'=>"-");
        }

        $q10=mysqli_query($koneksi, "SELECT waktu as wkt FROM pemakaian WHERE username='$user' AND tanggal LIKE '$bln%'");
        if ($d10=mysqli_fetch_assoc($q10)) { 
            $data[]=array('wkt'=>$d10['wkt']);
        } else {
            $data[]=array('wkt'=>"-");
        } 

        $q19=mysqli_query($koneksi, "SELECT tanggal as tgl_lengkap FROM pemakaian WHERE username='$user' AND tanggal LIKE '$bln%'");
        if ($d19=mysqli_fetch_assoc($q19)) { 
            $data[]=array('tgl_lengkap'=>$air->tanggal_balik($d19['tgl_lengkap']));
        } else {
            $data[]=array('tgl_lengkap'=>"-");
        }
        $q12=mysqli_query($koneksi, "SELECT MONTH(tanggal) as blan,pemakaian,tagihan FROM pemakaian WHERE username='$user' ORDER BY blan ASC");
        while($d12=mysqli_fetch_assoc($q12)) {
                $data[]=$air->bulan($d12['blan']);
                $data[]=$d12['pemakaian'];
                $data[]=$d12['tagihan'];
            }
    }

        echo json_encode($data);
    }
}

?>