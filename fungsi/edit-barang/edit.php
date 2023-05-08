<?php
 
//  <!--sidebar end-->
      
//       <!-- **********************************************************************************************************************************************************
//       MAIN CONTENT
//       *********************************************************************************************************************************************************** -->
//       <!--main content start-->     

	$kode_barang = $_GET['kode_barang'];


    if(isset($_POST['kode_barang'])) {
       
        if(isset($_GET['restok'])) {

            include "../../assets/database.php";
            $db = new database();

            $query_data = $db->get_data("SELECT stok FROM data_barang WHERE kode_barang='".$kode_barang."'");
            $stok = $query_data['stok'];

            $stok += $_POST['restok'];
            $query = $db->query_data("UPDATE data_barang SET stok='".$stok."' WHERE kode_barang='".$kode_barang."'");

            if($query) {
                header("Location: ../../index.php?page=barang");
                exit;
            } else {
                echo "<script>alert('Gagal restok!'); document.location='../../index.php?page=barang'</script>";        
                exit;
            }

        } else {
        
            $kode_barang = $_POST['kode_barang'];
            $nama_supplier = $_POST['nama_supplier'];
            $nama_barang = $_POST['nama_barang'];
            $stok = $_POST['stok'];
            $harga_satuan = $_POST['harga_satuan'];
            $laba = $_POST['laba'];
            $harga_jual = $harga_satuan + $laba;

            

            $db = new database();
            $query = $db->query_data("UPDATE data_barang SET  kode_barang='".$kode_barang."', nama_supplier='".$nama_supplier."', nama_barang='".$nama_barang."',
            stok='".$stok."', harga_satuan='".$harga_satuan."', laba='".$laba."', harga_jual='".$harga_jual."' WHERE kode_barang='".$kode_barang."'");

            if($query) {
                $_GET['success'] = 'yes';
            
            } else {
                echo "<script>alert('Update data gagal!')</script>";
            }
        }

    }

?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<a href="index.php?page=barang"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3>Details Barang</h3>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>

                        <!-- table data -->
						<table class="table table-striped">
							<form action="" method="POST">

                                <?php
                                    $db = new database();
                                    $hasil = $db->get_data("SELECT * FROM data_barang WHERE kode_barang='".$kode_barang."'");
                               
                                ?>

                                        <tr>
                                            <td>Kode Barang</td>
                                            <td><input type="text" name="kode_barang" readonly="readonly" class="form-control" value="<?=$hasil['kode_barang'];?>" name="id"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Supplier</td>
                                            <td>
                                            <select name="nama_supplier" class="form-control">
                                                <option value="<?=$hasil['nama_supplier'];?>"><?=$hasil['nama_supplier'];?></option>     
                                                <?php 
                                                     $sup = $db->tampil_data("SELECT nama_supplier FROM suppliers"); 

                                                     foreach($sup as $isi){ ?>

                                                        <option><?=$isi['nama_supplier'];?></option>

                                                <?php }?>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td><input type="text" class="form-control" value="<?=$hasil['nama_barang'];?>" name="nama_barang"></td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td><input type="number" class="form-control" value="<?=$hasil['stok'];?>" name="stok"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Satuan</td>
                                            <td><input type="number" class="form-control" value="<?=$hasil['harga_satuan'];?>" name="harga_satuan"></td>
                                        </tr>                    
                                        <tr>
                                            <td>laba</td>
                                            <td><input type="number" class="form-control" value="<?=$hasil['laba'];?>" name="laba"></td>
                                        </tr>
                                    <tr>
                                        <td></td>
                                        <td><button name="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
                                    </tr>
							</form>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
				  </div>
              </div>
          </section>
      </section>
