<?php
session_start();
include "../../assets/database.php";

$id_kasir = $_SESSION['kasir']['id_kasir'];

if(isset($_GET['hapus'])) {
    $kode_barang = $_GET['kode_barang'];
    $db = new database();

    $query = $db->query_data("DELETE FROM keranjang_jual WHERE kode_barang='".$kode_barang."' AND id_kasir='".$id_kasir."'");
    if($query) {
        header("location: ../../index.php?page=jual");
        exit;
    } else {
        echo "<script>alert('Hapus data gagal!');</script>";
    }

}

if(isset($_GET['reset'])) {
    $kode_barang = $_GET['kode_barang'];
    $db = new database();

    $query = $db->query_data("DELETE FROM keranjang_jual WHERE id_kasir='".$id_kasir."'");

    if($query) {
        header("location: ../../index.php?page=jual");
        exit;
    } else {
        echo "<script>alert('Reset keranjang gagal!');</script>";
    }
}

?>