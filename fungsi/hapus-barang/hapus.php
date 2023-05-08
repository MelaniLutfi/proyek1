<?php
session_start();
include "../../assets/database.php";

if(isset($_GET['kode_barang'])) {

    $kode_barang = $_GET['kode_barang'];
    $db = new database();


    $query_barang = $db->query_data("DELETE FROM data_barang WHERE kode_barang='".$kode_barang."'");

    if($query_barang) {
        if($query_barang) {
            header("location: ../../index.php?page=barang&remove=yes");
        }
    }
    


}

?>