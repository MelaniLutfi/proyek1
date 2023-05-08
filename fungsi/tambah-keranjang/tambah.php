<?php
session_start();
ini_set('date.timezone', 'Asia/Jakarta');
include "../../assets/database.php";




if(isset($_GET['kode_barang'])) {

    $kode_barang = $_GET['kode_barang'];
    $db = new database();

    $query_barang = $db->get_data("SELECT * FROM keranjang_jual WHERE kode_barang='".$kode_barang."'");
    if($query_barang) {
        echo "<script>alert('Barang sudah ada di keranjang!');
        document.location='../../index.php?page=jual'</script>";
    } else {
        $query_barang = $db->get_data("SELECT * FROM data_barang WHERE kode_barang='".$kode_barang."'");

        if($query_barang) {
            $nama_barang = $query_barang['nama_barang'];
            $stok_barang = $query_barang['stok'];
            $harga_satuan = $query_barang['harga_jual'];
            $jumlah = 1;
            $total = $harga_satuan;
            $id_kasir = $_SESSION['kasir']['id_kasir'];
            $tanggal_input =  date("j F Y, G:i");

            if($stok_barang != 0) {
                $query = $db->query_data("INSERT INTO keranjang_jual (id_penjualan, kode_barang, nama_barang,jumlah, harga_satuan ,total, id_kasir, tanggal_input) 
                        VALUES ('', '".$kode_barang."', '".$nama_barang."','".$jumlah."','".$harga_satuan."', '".$total."', '".$id_kasir."', '".$tanggal_input."')");
                
                if($query) {
                    header("location: ../../index.php?page=jual");
                }
            } else {
                echo "<script>alert('Stok barang tidak ada!')</script>";
            }

            echo "<script>document.location='../../index.php?page=jual'</script>";

        }
    }


}




?>
