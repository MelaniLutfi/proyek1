<?php

    if(empty($_SESSION['admin']) || !empty($_SESSION['kasir'])) {
        echo "<h1 class='text-center'>Informasi mengenai suppliers hanya bisa dilihat oleh admin!<h1>";
        exit;
    }

    $db = new database();
    $query_supplier = $db->tampil_data("SELECT * FROM suppliers");


?>

        <div class="container-fluid">
                <h1 class="mt-4">Suppliers</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Static Navigation</li>
                </ol>

            <div class="row">

                <!-- card suppliers -->
                <?php
                    $x = 0;
                    $warna_card = array('bg-warning', 'bg-primary', 'bg-success', 'bg-danger');
                    foreach($query_supplier as $namaSup) {
                ?>
                    <div class="col-xl-3 col-md-6">
                        <div class="card <?= $warna_card[$x]; ?> text-white mb-4">
                            <div class="card-body"><?= $namaSup['nama_supplier'];?></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="?page=suppliers&name=<?= $namaSup['id'] ?>">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                <?php
                    $x++;
                    if($x == 4) {
                        $x = 0;
                    }
                    }
                ?>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-light ?> text-dark mb-4">
                            <div class="card-body">Supplier Baru</div>
                            
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-dark stretched-link" href="?page=tambah-sup&tambah=yes">Tambah</a>
                                <div class="small text-dark"><i class="fa fa-plus"></i></div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

        <?php
            if(isset($_GET['name'])) {
            
            $id = $_GET['name'];

            //query tabel supplier
            $query_sup = $db->get_data("SELECT * FROM suppliers WHERE id='".$id."'");
            if($query_sup) {
                $id = $query_sup['id'];
                $nama_supplier = $query_sup['nama_supplier'];
                $nama_sales = $query_sup['nama_sales'];
                $telepon = $query_sup['telepon'];
                $alamat_supplier = $query_sup['alamat_supplier'];
            } 
            
        
        ?>

            
            <div class="container">
                <div class="main-body">
                
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="main-breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Profil Supplier</a></li>
                        </ol>
                    </nav>
                    <!-- /Breadcrumb -->
                
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                <h4><?= $nama_supplier?></h4>
                                <p class="text-secondary mb-1"><?= $alamat_supplier?></p>
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        </div>
                        <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Supplier</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                               <?= $nama_supplier ?>
                                </div>
                            </div>                        
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Nama Sales</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                               <?= $nama_sales ?>
                                </div>
                            </div>                        
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Telepon</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <?= $telepon ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Alamat Supplier</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <?= $alamat_supplier ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info " href="<?= base_url(). "?page=edit-sup&id=". $id. "&edit=yes"?>">Edit</a>
                                    <a class="btn btn-danger " href="<?= base_url(). "?page=edit-sup&id=". $id. "&hapus=yes"?>">Hapus Supplier</a>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                            
                            </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3">Faktur Nota</h6>
                                    <div class="card bg-dark text-white mb-4">
                                        <div class="card-body">Jumlah Faktur</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="<?= base_url(). "/admin/module/suppliers/faktur-galeri/index.php?name=".$id?>">View Details</a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="d-flex align-items-center mb-3">Tukar Barang Rusak</h6>
                                    <div class="card bg-dark text-white mb-4">
                                        <div class="card-body">Jumlah Barang Rusak</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="<?= base_url(). "?page=barang-rusak&name=".$nama_supplier?>">View Details</a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            </div>
                        </div>



                        </div>
                    </div>

                    </div>
                
        <?php
             }
        ?>
