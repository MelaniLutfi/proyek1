 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->


      <?php

$db = new database();


if(isset($_POST['submit'])) {

    $nama_supplier = $_POST['nama_supplier'];
    $nama_sales = $_POST['nama_sales'];
    $telepon = $_POST['telepon'];
    $alamat_supplier = $_POST['alamat_supplier'];

    $db = new database();
    $query = $db->query_data("INSERT INTO suppliers (id, nama_supplier, alamat_supplier, nama_sales, telepon)           
                        VALUES ('', '".$nama_supplier."', '".$alamat_supplier."', '".$nama_sales."', '".$telepon."')");

    if($query) {
        echo "<script>alert('Tambah data berhasil!')</script>"; 
        $_GET['success'] = 'yes';
    
    } else {
        echo "<script>alert('Tambah data gagal!')</script>";
    }

}


?>
  <section id="main-content">
      <section class="wrapper">            
                <div class="col-lg-12 main-chart">
                    <h3>Tambah Supplier Baru</h3>
                    <br>
                    <?php if(isset($_GET['success'])){?>
                    <div class="alert alert-success">
                        <p>Tambah Data Berhasil !</p>
                    </div>
                    <?php }?>
                    <table class="table table-stripped">
                        <thead>                          
                            <tr>
                                <td>Nama Supplier</td>
                                <td>Nama Sales</td>                               	
                                <td>Alamat Supplier</td>	
                                <td>Telepon</td>					
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="?page=tambah-sup" >		
                                <tr>
                                    <td><input class="form-control" name="nama_supplier" placeholder="nama Supplier"></td>
                                    <td><input class="form-control" name="alamat_supplier" placeholder="alamat Supplier"></td>                                                                  		
                                    <td><input class="form-control" name="nama_sales"  placeholder="mama Sales"></td>
                                    <td><input class="form-control" type="number" name="telepon"  placeholder="telepon"></td>
                                    <td><button name="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert</button></td>
                            </tr>
                            </form>
                        </tbody>
                    </table>
                <div class="clearfix" style="padding-top:41%;"></div>
            </div>
        </section>

  </section>

 
  

