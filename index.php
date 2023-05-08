<?php
session_start();

ini_set('date.timezone', 'Asia/Jakarta');
include "assets/database.php";
include "assets/tgl_indo.php";
include "assets/functionAll.php";

    //cek session kasir
    if(!empty($_SESSION['kasir']) || !empty($_SESSION['admin'])){
        //tidak melakukan fungsi apa apa lanjut saja
    }else{
        echo '<script>window.location="login.php";</script>';
        exit;
    }

    //biar ga error
    if(!isset($_GET['page'])) {
        $_GET['page'] = '';
    } 

    if(isset($_GET['cari'])) {
        $_GET['page'] = "jual";
    }




    // //query nota, kuangan, data_barang
    //     $db = new database();
    
    //     //masukkan data nota kedalam ke uangan
    //     $query_nota = $db->tampil_data("SELECT * FROM nota");

    //     $tgl_skrng = date("j F Y");
    //     $query_nota = $db->tampil_data("SELECT * FROM nota WHERE tanggal_input LIKE '%$tgl_skrng%' ");
    //     print_r($query_nota);
    //     exit;
       

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <!-- icon -->
                <link rel = "icon" href = 
                    "assets/img/toko-samati-icon.png" 
                type = "image/x-icon">

       <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
       
       
         <link href="assets/css/style-custom.css" rel="stylesheet">
        
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous"></script> -->
        
        
        <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script> -->

        <!-- tammbahan -->
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="assets/datatables/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>


        <!-- ajax online -->
        
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                

        

        
    </head>
    <body class="sb-nav-fixed">

    <!-- ini navigasi untuk header nya -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Toko Samawati</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" style="margin-left:20px;" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search -->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" /> -->
                    <!-- <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div> -->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="margin-right:2px;" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="?page=kasir">Settings</a>
                        <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>

        
    <!-- ini navigasi untuk sidebarnya -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu Utama</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard                                                                                                                                                                                                                                   
                            </a>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="false" aria-controls="collapseMaster">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Master
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseMaster" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <!-- <a class="nav-link collapsed" href="data-pelanggan.php" >
                                       Data Pelanggan
                                        
                                    </a> -->
                                    
                                    <a class="nav-link collapsed" href="<?= base_url(). "?page=barang" ?>" >
                                      Data Barang
                                      
                                    </a>

                                    <!-- <a class="nav-link collapsed" href="kategori-barang.php" >
                                       Kategori Barang
                                       
                                    </a> -->
                                    <a class="nav-link collapsed" href="<?= base_url(). "?page=kasir" ?>" >
                                       Petugas Kasir
                                       
                                    </a>

                                  
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="false" aria-controls="collapseTransaksi">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseTransaksi" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="<?= base_url(). "?page=jual" ?>" >
                                      Penjualan
                                        
                                    </a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLaporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Laporan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseLaporan" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="<?= base_url(). "?page=laporan" ?>" >
                                     Laporan Penjualan
                                        
                                    </a>

                                    <a class="nav-link collapsed" href="<?= base_url(). "?page=barang-rusak" ?>" >
                                    Barang Rusak       
                                    </a>
                                </nav>
                            </div>
                            

                            <div class="sb-sidenav-menu-heading">Suppliers</div>
                            <a class="nav-link collapsed" href="<?= base_url(). "?page=suppliers" ?>" >
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Suppliers

                            </a>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pengaturan  
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <!-- <a class="nav-link collapsed" href="tambah-barang.php" >
                                        Tambah Barang Masuk
                                        
                                    </a>
                                    
                                    <a class="nav-link collapsed" href="#" >
                                       Pemesanan Ke Supplier
                                      
                                    </a>

                                    <a class="nav-link collapsed" href="#" >
                                       Tukar Barang Rusak
                                       
                                    </a> -->

                                    <a class="nav-link collapsed" href="<?= base_url(). "?page=pengaturan" ?>" >
                                      Pengaturan Toko  
                                    </a>
                                  
                                </nav>
                            </div>
                           
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                        if(!empty($_SESSION['kasir'])) {
                            echo $_SESSION['kasir']['nama_kasir'] . " (kasir)";
                        } else if(!empty($_SESSION['admin'])) {
                           echo $_SESSION['admin']['nama_admin'] . " (admin)";
                        }
                           
                        ?>
                    </div>
                </nav>
            </div>


        <!-- ini bagian konten nya -->
            <div id="layoutSidenav_content">
                <main>
                

                    <!-- ini berisi mengenai konten tergantung dari php nya include file yang mana -->
                    <?php
                    switch($_GET['page']) {
                        default :
                            include "dashboard.php";
                        break;
                        case 'barang':
                            include "admin/module/barang/index.php";
                        break;
                        case 'jual':
                            include "admin/module/jual/index.php";
                        break;
                        case 'edit':
                            include "fungsi/edit-barang/edit.php";
                        break;
                        case 'suppliers':
                            include "admin/module/suppliers/index.php";
                        break;
                        case 'kasir':
                            include "admin/module/kasir/index.php";
                        break;
                        case 'laporan':
                            include "admin/module/laporan/index.php";
                        break;
                        case 'pengaturan':
                            include "admin/module/pengaturan/index.php";
                        break;
                        case 'best-seller':
                            include "admin/module/best-seller/index.php";
                        break;
                        case 'barang-rusak':
                            include "admin/module/barang-rusak/index.php";
                        break;
                        case 'edit-sup':
                            include "fungsi/edit-supplier/edit.php";
                        break;
                        case 'tambah-sup':
                            include "fungsi/tambah-sup/tambah.php";
                        break;
                          
                          
                    }
                    ?>

                        
                   
                </main>


            <!-- ini bagian konten untuk footernya -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Toko Samawati 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
        <script src="js/scripts.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --> -->
        <!-- <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
        
        <script src="assets/demo/datatables-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> 
    </body>
</html>
