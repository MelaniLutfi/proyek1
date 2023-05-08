<?php
 
//  <!--sidebar end-->
      
//       <!-- **********************************************************************************************************************************************************
//       MAIN CONTENT
//       *********************************************************************************************************************************************************** -->
//       <!--main content start-->     

	// $kode_barang = $_GET['id'];


    if(isset($_GET['id'])) {
       
           $id = $_GET['id'];

            if(isset($_POST['submit'])){
            
                
                $nama_supplier = $_POST['nama_supplier'];
                $nama_sales = $_POST['nama_sales'];
                $telepon = $_POST['telepon'];
                $alamat_supplier = $_POST['alamat_supplier'];
            
                

                $db = new database();
                $query = $db->query_data("UPDATE suppliers SET  nama_supplier='".$nama_supplier."', nama_sales='".$nama_sales."',
                telepon='".$telepon."', alamat_supplier='".$alamat_supplier."' WHERE id='".$id."'");

                if($query) {
                    echo "<script>alert('Update data berhasil!')</script>";
                
                } else {
                    echo "<script>alert('Update data gagal!')</script>";
                }
            }

            if(isset($_GET['hapus'])) {
                $db = new database();
                $query_drop = $db->query_data("DELETE FROM suppliers WHERE id='".$id."'");
                if($query_drop) {
                    echo "<script>alert('Hapus data berhasil!');
                        document.location='index.php?page=suppliers'</script>";
                
                } else {
                    echo "<script>alert('Hapus data gagal!');
                    document.location='index.php?page=suppliers&name=$id'</script>";
                }
            }

    }

?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<a href="index.php?page=suppliers&name=<?=$id?>"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3>Details Profile</h3>
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
                                    $hasil = $db->get_data("SELECT * FROM suppliers WHERE id='".$id."'");
                               
                                ?>

                                        <tr>
                                            <td>Nama Supplier</td>
                                            <td><input type="text" name="nama_supplier"  class="form-control" value="<?=$hasil['nama_supplier'];?>" name="nama_supplier"></td>
               
                                        </tr>
                                        <tr>
                                            <td>Nama Sales</td>
                                            <td><input type="text" class="form-control" value="<?=$hasil['nama_sales'];?>" name="nama_sales"></td>
                                        </tr>
                                        <tr>
                                            <td>Telepon</td>
                                            <td><input type="text" class="form-control" value="<?=$hasil['telepon'];?>" name="telepon"></td>
                                        </tr>                    
                                        <tr>
                                            <td>Alamat Supplier</td>
                                            <td><input type="text" class="form-control" value="<?=$hasil['alamat_supplier'];?>" name="alamat_supplier"></td>
                                        </tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
                                    </tr>
							</form>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
				  </div>
              </div>
          </section>
      </section>
