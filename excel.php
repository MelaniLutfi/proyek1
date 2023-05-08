<?php 

    include "assets/database.php";

    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=data-laporan-".date('Y-m-d').".xls");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 


    //konek database dulu
    $db = new database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<!-- view barang -->	
    <!-- view barang -->	
    <div class="modal-view">
        <h3 style="text-align:center;"> 
                <?php if(!empty($_GET['cari'])){ ?>
                    Data Laporan Penjualan <?= $_GET['bln'];?> <?= $_GET['thn'];?>
                <?php }elseif(!empty($_GET['hari'])){?>
                    Data Laporan Penjualan <?= $_GET['tgl'];
                ?>
                <?php }else{?>
                    Data Laporan Penjualan <?= date('F');?> <?= date('Y');?>
                <?php }?>
        </h3>
        <table border="1" width="100%" cellpaddin g="3" cellspacing="4">
            <thead>
                <tr bgcolor="yellow">
                    <th> No</th>
                    <th> ID Barang</th>
                    <th> Nama Barang</th>
                    <th style="width:10%;"> Jumlah</th>
                    <th style="width:10%;"> Modal</th>
                    <th style="width:10%;"> Total</th>
                    <th> Kasir</th>
                    <th> Tanggal Input</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1; 
                    if(!empty($_GET['cari'])){
                        // $periode = $_GET['bln'].'-'.$_GET['thn'];
                        // $no=1; 
                        // $jumlah = 0;
                        // $bayar = 0;
                        // $hasil = $lihat -> periode_jual($periode);

                        $hari = $_GET['bln'] ." ".$_GET['thn'];
											
                        $tanggal = $hari;
                        
                        $hasil = $db->tampil_data("SELECT * FROM nota INNER JOIN data_barang ON nota.kode_barang=data_barang.kode_barang
                              INNER JOIN kasir ON nota.id_kasir=kasir.id_kasir WHERE tanggal_input LIKE '%$tanggal%'");
                        if(!$hasil)  {
                            $tampil_barang = "Tidak ada data!";
                        }
                    }elseif(!empty($_GET['hari'])){
                        // $hari = $_GET['tgl'];
                         $no=1; 
                        // $jumlah = 0;
                        // $bayar = 0;
                        // $hasil = $lihat -> hari_jual($hari);
                        $hari = $_GET['tgl'];
                        $tanggal = $hari;
                        
                        $hasil = $db->tampil_data("SELECT * FROM nota INNER JOIN data_barang ON nota.kode_barang=data_barang.kode_barang
                              INNER JOIN kasir ON nota.id_kasir=kasir.id_kasir WHERE tanggal_input LIKE '%$tanggal%'");
                        if(!$hasil)  {
                            $tampil_barang = "Tidak ada data!";
                        }
                        

                    }else{
                        // $hasil = $lihat -> jual();
                        $tanggal = date("j F Y");
											
                        $hasil = $db->tampil_data("SELECT * FROM nota INNER JOIN data_barang ON nota.kode_barang=data_barang.kode_barang
                                INNER JOIN kasir ON nota.id_kasir=kasir.id_kasir WHERE tanggal_input LIKE '%$tanggal%'");
                         if(!$hasil)  {
                            $tampil_barang = "Tidak ada data!";
                        }
                    }
                ?>
                <?php 
                    $bayar = 0;
                    $jumlah = 0;
                    $modal = 0;
                    if(!isset($tampil_barang)) {
                        foreach($hasil as $isi){ 
                            $bayar += $isi['total'];
                            $modal += $isi['harga_satuan'];
                            $jumlah += $isi['jumlah'];
                ?>
                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $isi['kode_barang'];?></td>
                    <td><?php echo $isi['nama_barang'];?></td>
                    <td><?php echo $isi['jumlah'];?> </td>
                    <td>Rp.<?php echo number_format($modal)?>,-</td>
                    <td>Rp.<?php echo number_format($isi['total']);?>,-</td>
                    <td><?php echo $isi['nama_kasir'];?></td>
                    <td><?php echo $isi['tanggal_input'];?></td>
                </tr>
                <?php $no++; }}?>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td><b>Total Terjual</b></td>
                    <td><b><?php echo $jumlah;?></b></td>
                    <td><b>Rp.<?php echo number_format($modal);?>,-</b></td>
                    <td><b>Rp.<?php echo number_format($bayar);?>,-</b></td>
                    <td><b>Keuntungan</b></td>
                    <td><b>
                        Rp.<?php echo number_format($bayar-$modal);?>,-</b></td>
                </tr>
            </tbody>
            <?php
                if(isset($tampil_barang)) {
                    echo "<h2>$tampil_barang</h2>";
                }
            ?>
        </table>
    </div>
</body>
</html>