 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->


<?php

 	if(empty($_SESSION['admin']) || !empty($_SESSION['kasir'])) {
		echo "<h1 class='text-center'>Pengaturan toko hanya bisa dilakukan oleh admin!<h1>";
		exit;
	}

    $db = new database();

    

    if(isset($_POST['submit-toko'])) {
        $id_toko = $_POST['id_toko'];
        $nama_toko = $_POST['nama_toko'];
        $alamat_toko = $_POST['alamat_toko'];
        $telepon = $_POST['telepon'];
        $nama_pemilik = $_POST['nama_pemilik'];

        $query = $db->query_data("UPDATE toko SET nama_toko='".$nama_toko."', alamat_toko='".$alamat_toko."', telepon='".$telepon."', nama_pemilik='".$nama_pemilik."' WHERE id_toko='".$id_toko."'");
        if(!$query) {
            echo "<script> alert('Update data gagal!');</script>";
        } else {
            $_GET['success'] = 'yes';
        
        }
    }

    if(isset($_POST['submit-kasir'])) {
        $nama_kasir = $_POST['nama_kasir'];
        $alamat_kasir = $_POST['alamat_kasir'];
        $telepon_kasir = $_POST['telepon_kasir'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id_kasir = $_POST['id_kasir'];
        $foto_kasir = $_FILES['gambar']['name'];

        $query_kasir = $db->query_data("INSERT INTO kasir (id, nama_kasir, alamat_kasir, telepon_kasir, gambar, id_kasir)
                            VALUES ('', '".$nama_kasir."', '".$alamat_kasir."', '".$telepon_kasir."', '".$foto_kasir."', '".$id_kasir."')");
        $query_login = $db->query_data("INSERT INTO login (id_login, username, password, id_kasir)
                     VALUES ('', '".$username."', '".$password."', '".$id_kasir."')");

		if(!empty($foto_kasir)) {
			$id = htmlentities($_POST['id_kasir']);
			set_time_limit(0);
			$allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
			
			if ($_FILES['gambar']["error"] > 0) {
				$output['error']= "Error in File";
			} elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
				echo "You can only upload JPG, PNG and GIF file";
				echo "<font face='Verdana' size='2' ><BR><BR><BR>
						<a href='../../index.php?page=kasir'>Back to upform</a><BR>";
	
			}elseif (round($_FILES['gambar']["size"] / 1024) > 10000) { //4096
				echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
				echo "<font face='Verdana' size='2' ><BR><BR><BR>
						<a href='../../index.php?page=kasir'>Back to upform</a><BR>";
	
			}else{
				$target_path = 'assets/img/kasir/';
				$target_path = $target_path . basename( $_FILES['gambar']['name']); 
				if (file_exists("$target_path")){ 
					echo "<font face='Verdana' size='2' >Ini Terjadi Karena Telah Masuk Nama File Yang Sama,
					<br> Silahkan Rename File terlebih dahulu<br>";
	
				echo "<font face='Verdana' size='2' ><BR><BR><BR>
						<a href='../../index.php?page=kasir'>Back to upform</a><BR>";
	
					}elseif(move_uploaded_file($_FILES['gambar']['tmp_name'], $target_path)){
					
						$_GET['success-kasir'] = 'yes';
					
				}
			}
		}

        if(!$query_kasir && !$query_login) {
            echo "<script> alert('Tambah data gagal!');</script>";
        } else {
            $_GET['success-kasir'] = 'yes';
        }
    }

    $toko = $db->get_data("SELECT * FROM toko");

    


?>
      <section id="main-content">
          <section class="wrapper">

                <div class="row">
                    <div class="col-lg-12 main-chart">
						<h3>Pengaturan Toko</h3>
						<br>
						<?php if(isset($_GET['success']) && $_GET['success'] == 'yes'){?>
						<div class="alert alert-success">
							<p>Berhasil !</p>
						</div>
						<?php }?>
						<table class="table table-stripped">
							<thead>
								<tr>
									<td>Nama Toko</td>
									<td>Alamat Toko</td>
									<td>Kontak (Hp)</td>
									<td>Nama Pemilik Toko</td>
									<td>Aksi</td>
								</tr>
							</thead>
							<tbody>
								<form method="POST" action="?page=pengaturan">		
								<tr>
									<td>
                                        <input class="form-control" type="hidden" name="id_toko" value="<?= $toko['id_toko'];?>">
                                        <input class="form-control" name="nama_toko" value="<?= $toko['nama_toko'];?>" placeholder="Nama Toko">
                                    </td>
									<td><input class="form-control" name="alamat_toko" value="<?= $toko['alamat_toko'];?>" placeholder="Alamat Toko"></td>
									<td><input class="form-control" name="telepon" value="<?= $toko['telepon'];?>" placeholder="Kontak (Hp)"></td>
									<td><input class="form-control" name="nama_pemilik" value="<?= $toko['nama_pemilik'];?>" placeholder="Nama Pemilik Toko"></td>
									<td><button name="submit-toko" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Update Data</button></td>
								</tr>
								</form>
							</tbody>
						</table>
					<!-- <div class="clearfix" style="padding-top:41%;"></div> -->
                    <br>
                    <hr>
                    <div class="col-lg-12 main-chart">
						<h3>Tambah Kasir Baru</h3>
						<br>
						<?php if(isset($_GET['success-kasir'])){?>
						<div class="alert alert-success">
							<p>Ubah Data Berhasil !</p>
						</div>
						<?php }?>
						<table class="table table-stripped">
							<thead>                          
								<tr>
									<td>Nama Kasir</td>
									<td>Alamat Kasir</td>
									<td>Telepon</td>							
									<td>Username</td>
                                    <td>Password</td>
                                    <td>Id Kasir</td>
                                    <td>Foto Kasir</td>
                                    <td>Aksi</td>
								</tr>
							</thead>
							<tbody>
								<form method="post" action="?page=pengaturan" enctype="multipart/form-data">		
								<tr>
									<td><input class="form-control" required name="nama_kasir" placeholder="Nama Kasir"></td>
									<td><input class="form-control" required name="alamat_kasir" placeholder="Alamat Kasir"></td>
									<td><input class="form-control" required name="telepon_kasir"  type="number" placeholder="Kontak (Hp)"></td>                                   		
                                    <td><input class="form-control" required name="username"  placeholder="Username"></td>
									<td><input class="form-control" required name="password"  placeholder="Password"></td>
                                    <td><input class="form-control" required name="id_kasir"  type="number" placeholder="Id"></td>
                                    <td><input type="file" name="gambar"></td>
									<td><button name="submit-kasir" class="btn btn-primary"><i class="fa fa-plus"></i> Insert</button></td>
								</tr>
								</form>
							</tbody>
						</table>
					<div class="clearfix" style="padding-top:41%;"></div>
                </div>
            </section>

      </section>

     
      
	
