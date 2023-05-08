<?php
    include "../../assets/database.php";


    $kode_barang = $_POST['kode_barang'];
  
    $db = new database();

    if(isset($_GET['tukar'])) {
        $query_databarang = $db->get_data("SELECT * FROM data_barang WHERE kode_barang='".$kode_barang."'");

        if($query_databarang) {
            $nama_barang = $query_databarang['nama_barang'];
            $nama_supplier = $query_databarang['nama_supplier'];
            $catatan = $_POST['catatan'];
            
        
            $query_tukarbarang = $db->query_data("INSERT INTO barang_rusak (id, kode_barang, nama_barang, catatan, nama_supplier)
                                VALUES ('', '".$kode_barang."', '".$nama_barang."', '".$catatan."', '".$nama_supplier."')");
            if($query_tukarbarang) {
                header("location: ../../index.php?page=barang");
            }
        }
    } else if(isset($_GET['hapus'])) {
            $kode_barang = $_GET['kode_barang'];
            $query_tukarbarang = $db->query_data("DELETE FROM barang_rusak WHERE kode_barang='".$kode_barang."'");
        if($query_tukarbarang) {
            header("location: ../../index.php?page=barang-rusak ");
        }
    }

    
    

  


?>