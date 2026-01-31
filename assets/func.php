<?php
class kelas_air {
    function koneksi() {
        $koneksi = mysqli_connect("localhost", "user_air", "#Us3r_A1r_2025#", "air");
        return $koneksi;
    }

    function data_user($sesi_user) {
        $q=mysqli_query($this->koneksi(),"SELECT nama,kota,level,tipe,username FROM user WHERE username='$sesi_user'");
        $d=mysqli_fetch_row($q);
        return $d;
    }

    function user_to_kdtarif($username) {
        $q=mysqli_query($this->koneksi(),"SELECT tipe FROM user WHERE username='$username'");
        $d=mysqli_fetch_row($q);
        $tipe=$d[0];
        
        $kd_tarif=$this->tipe_to_kdtarif($tipe);
        return $kd_tarif;
    }

    function tipe_to_kdtarif($tipe) {
        $q=mysqli_query($this->koneksi(),"SELECT kd_tarif FROM tarif WHERE tipe='$tipe' AND status='AKTIF'");
        $d=mysqli_fetch_row($q);
        return $d[0];
    }

    function kdtarif_to_tarif($kd_tarif) {
        $q=mysqli_query($this->koneksi(),"SELECT tarif FROM tarif WHERE kd_tarif='$kd_tarif' AND status='AKTIF'");
        $d=mysqli_fetch_row($q);
        return $d[0];
    }

    function tanggal_balik($tanggal) {
        $e=explode("-", $tanggal);
        $tgl_baru= "$e[2]-$e[1]-$e[0]";
        return $tgl_baru;
    }

    function no_to_user($no) {
        $q=mysqli_query($this->koneksi(),"SELECT username FROM pemakaian WHERE no='$no'");
        $d=mysqli_fetch_row($q);
        return $d[0];
    }

    function bulan($no) {
        if ($no == 1) $bulan = "Januari";
        elseif ($no == 2) $bulan = "Februari";
        elseif ($no == 3) $bulan = "Maret";
        elseif ($no == 4) $bulan = "April";
        elseif ($no == 5) $bulan = "Mei";
        elseif ($no == 6) $bulan = "Juni";
        elseif ($no == 7) $bulan = "Juli";
        elseif ($no == 8) $bulan = "Agustus";
        elseif ($no == 9) $bulan = "September";
        elseif ($no == 10) $bulan = "Oktober";
        elseif ($no == 11) $bulan = "November";
        else $bulan = "Desember";

        return $bulan;
    }

    function ribuan($angka) {
        return number_format($angka, 0, ',', '.');
    }
}
?>