<?php
  
    //query tabel keuangan
    $db = new database();

    $tgl_skrng = date("j F Y");
    //query keuangan berdasarkan tanggal hari ini dan bulan ini
    $query_keuangan_harian = $db->tampil_data("SELECT * FROM keuangan WHERE tanggal_input LIKE '%$tgl_skrng%'");

        //baris terakhir dari table keuangan

    if($query_keuangan_harian) {
         $baris_query = count($query_keuangan_harian);
            //lihat omset hari ini dan laba bulan ini
        $omset_harian = $query_keuangan_harian[$baris_query-1]["omset"];

    } else {
        $omset_harian = 0;
    }

    //query keuangan berdasarkan bulan ini saja
    $bulan_skrng = date("F");
    $query_keuangan_harian = $db->tampil_data("SELECT * FROM keuangan WHERE tanggal_input LIKE '%$bulan_skrng%'");
    if($query_keuangan_harian) {
        $baris_query = count($query_keuangan_harian);
    
        //lihat omset hari ini dan laba bulan ini
        $omset_bulanan = $query_keuangan_harian[$baris_query-1]["omset"];
        $laba_bulanan = $query_keuangan_harian[$baris_query-1]["laba"];   

   } else {
        $omset_bulanan = 0;
        $laba_bulanan = 0;
   }

   //query tabel best_seller
   $query_bestseller = $db->tampil_data("SELECT * FROM best_seller");
   
    if($query_bestseller) {
        $jumlah_bestseller = count($query_bestseller);
           //query tabel jumlah baris data barang
        $query_baris_barang = $db->tampil_data("SELECT * FROM data_barang");
        $jumlah_baris_databarang = count($query_baris_barang);
    } else {
        $jumlah_bestseller = 0;
        $query_baris_barang = 0;
        $jumlah_baris_databarang = 0;
    }


   


?>

<div class="container-fluid">
                        <!-- <h1 class="mt-4">Data Barang</h1> -->
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                        <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Omset Hari Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($omset_harian); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Omset Bulan Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($omset_bulanan);?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laba Bulan Ini
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp. <?= number_format($laba_bulanan); ?> </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            <?php   
                                                                if($laba_bulanan != 0 && $omset_bulanan !=0) {
                                                                    $persen_laba = (($laba_bulanan / $omset_bulanan) * (100/1));
                                                                }   else {
                                                                    $persen_laba = 0;
                                                                }                                         
                                                                
                                                            ?>        
                                                                                                               
                                                            style="width: <?= $persen_laba?>%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <span> <?= round($persen_laba);?>%</span> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                          
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            <a href="<?= base_url(). "?page=best-seller" ?>">Produk Paling Laku terjual</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $jumlah_bestseller ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                             <i class="glyphicon glyphicon-fire  fa-2x text-gray-300" ></i>
                                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="<?= base_url(). "?page=barang" ?>"> Data Barang</a></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?= $jumlah_baris_databarang ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                    </div>


                 