<?php
    include "../../../assets/database.php";
    include "../../../assets/functionAll.php";

    $db = new database();
	$hasil1 = $db->tampil_data("SELECT * FROM data_barang WHERE kode_barang LIKE '%".$_POST['cari']."%'");
    if(!$hasil1) {
        exit;
    }
?>


         
<div class="panel-heading">
    <h4><i class="fa fa-list"></i> Hasil Pencarian</h4>
    </div>

    <div class="panel-body">
    <?php 

        if($hasil1) {
    ?>
         <table class="table table-stripped" width="100%" id="example2">
                <tr>
                     <th>Kode Barang</th>
                    <th>Nama Barang</th>	
                    <th>Stok</th>							
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
    <?php
            foreach($hasil1 as $hasil){?>	
                <tr>
                    <td><?= $hasil['kode_barang'];?></td>
                    <td><?= $hasil['nama_barang'];?></td>
                    <td><?= $hasil['stok'];?></td>
                    <td><?= $hasil['harga_jual'];?></td>
                    <td>

                        <a href="<?= base_url(). "/fungsi/tambah-keranjang/tambah.php?kode_barang=" . $hasil['kode_barang'];?>"
                        class="btn btn-success">
                        <span class="fa fa-shopping-cart"></span></a>
                    </td>

                </tr>
    <?php }}?>

    </table>
</div>
      
   