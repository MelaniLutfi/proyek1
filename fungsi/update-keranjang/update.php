<?php
    include "../../assets/database.php";

    if(isset($_POST['submit'])) {

        $kode_barang = $_POST['kode_barang'];
        $jumlah = $_POST['jumlah'];
        $harga_satuan = $_POST['harga_satuan'];
        $total = $harga_satuan * $jumlah;


        $db = new database();
        $query_stok = $db->get_data("SELECT stok FROM data_barang WHERE kode_barang='".$kode_barang."'");
        $stok_barang = $query_stok['stok'];
        if($stok_barang != 0 && ($stok_barang-$jumlah) >= 0) {
            $query_barang = $db->query_data("UPDATE keranjang_jual SET jumlah='".$jumlah."', total='".$total."'  WHERE kode_barang='".$kode_barang."'");

            if($query_barang) {
                header("location: ../../index.php?page=jual");
            }
        } else {
            echo "<script>alert('Stok barang tidak ada! stok tersisa $stok_barang pcs')</script>";
        }

        echo "<script>document.location='../..//index.php?page=jual'</script>";
    

    
    }

?>
