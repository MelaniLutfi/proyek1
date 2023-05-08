 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 

		$id = $_SESSION['kasir']['id_kasir'];

		$db = new database();

		$hasil = $db->get_data("SELECT * FROM login a INNER JOIN kasir ON a.id_kasir=kasir.id_kasir WHERE a.id_kasir='".$id."' OR kasir.id_kasir='".$id."'");

 		//cek update foto 
		if(isset($_GET['gambar']) && $_GET['gambar'] == 'edit'){

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
						//post foto lama
					$gambar2 = $_POST['gambar2'];
					//remove foto di direktori
					unlink('assets/img/kasir/'.$gambar2.'');
					//input foto
					$id = $_POST['id_kasir'];
					$gambar = $_FILES['gambar']['name'];
					$sql = $db->query_data("UPDATE kasir SET gambar='".$gambar."'  WHERE kasir.id_kasir='".$id."'");

					if($sql) {
						 echo '<script>window.location="index.php?page=kasir&success=edit-data"</script>';
					} else {
						echo "gagal";
					}
					
				}
			}
		}

		//cek update profile

		if(isset($_GET['profil']) && $_GET['profil'] == 'edit'){
			$id_kasir = htmlentities($_POST['id_kasir']);
			$nama_kasir = htmlentities($_POST['nama_kasir']);
			$alamat_kasir = htmlentities($_POST['alamat_kasir']);
			$telepon_kasir= htmlentities($_POST['telepon_kasir']);

			
		
			$sql = $db->query_data(" UPDATE kasir SET nama_kasir='".$nama_kasir."', alamat_kasir='".$alamat_kasir."', telepon_kasir='".$telepon_kasir."' WHERE id_kasir='".$id_kasir."'");

			if($sql) {
				
				echo '<script>window.location="index.php?page=kasir&success=edit-data"</script>';
			} else {
				echo "gagal";
			}

		}

		//cek update password baru

		if(isset($_GET['password']) && $_GET['password'] == 'ganti'){
			$id_kasir = htmlentities($_POST['id_kasir']);
			$username = htmlentities($_POST['username']);
			$password = htmlentities($_POST['password']);


			$sql = $db->query_data(" UPDATE login SET username='".$username."', password='".$password."' WHERE id_kasir='".$id_kasir."' ");
		
			if($sql) {
				
				echo '<script>window.location="index.php?page=kasir&success=edit-data"</script>';
			} else {
				echo "gagal";
			}

		}

		  
      ?>
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Profil Pengguna Aplikasi</h3>
						<br>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						
							<div class="col-sm-3">
								<div class="panel panel-primary">
									<div class="panel-heading">
									</div>
									<div class="panel-body">
										<center><img src="assets/img/kasir/<?= $hasil['gambar']?>"  alt="#" style="width:200px;border:4px solid #ddd;"></center>			
									</div>
									<div class="panel-footer">
										<form method="POST" action="?page=kasir&gambar=edit" enctype="multipart/form-data">
											<input type="file" accept="image/*" name="gambar">
											<input type="hidden"  name="gambar2" value="<?= $hasil['gambar'];?>">
											<input type="hidden"  name="id_kasir" value="<?= $hasil['id_kasir'];?>">
											<span class="pull-right">
												<button type="submit" class="btn btn-primary btn-sm" value="Tambah">
													
													<span class="glyphicon glyphicon-pencil"></span>
													Ganti Foto
												</button>
											</span>
										</form>
										<br/>
										<br/>
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4><i class="fa fa-user"></i>  Kelola Pengguna </h4>
									</div>
									<div class="panel-body">
										<div class="box-content">
											<form class="form-horizontal" method="POST" action="?page=kasir&profil=edit" enctype="multipart/form-data">
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="typeahead">Nama </label>
														<div class="input-group">
														  <div class="input-group-addon">
															<i class="fa fa-user"></i>
														  </div>
															<input type="text" class="form-control" style="border-radius:0px;" name="nama_kasir" data-items="4" value="<?= $hasil['nama_kasir']; ?>" required="required"/>
														</div>
													</div>
													<!-- <div class="control-group">
														<label class="control-label" for="typeahead">Email </label>
														<div class="input-group">
														  <div class="input-group-addon">
															<i class="fa fa-envelope-square"></i>
														  </div>
															<input type="email" class="form-control" style="border-radius:0px;" name="email" value="" required="required"/>
														</div>
													</div> -->
													<div class="control-group">
														<label class="control-label" for="typeahead">Telepon </label>
														<div class="input-group">
														  <div class="input-group-addon">
															<i class="fa fa-phone"></i>
														  </div>
															<input type="text" class="form-control" style="border-radius:0px;" name="telepon_kasir" value="<?= $hasil['telepon_kasir']; ?>" required="required"/>
														</div>
													</div>
													<!-- <div class="control-group">
														<label class="control-label" for="typeahead">NIK ( KTP ) </label>
														<div class="input-group">
														  <div class="input-group-addon">
															<i class="fa fa-user"></i>
														  </div>
															<input type="text" class="form-control" style="border-radius:0px;" name="nik" value="" required="required"/>
														</div>
													</div> -->
													<div class="control-group">
														<label class="control-label" for="typeahead">Alamat </label>
														<div class="controls">
															<textarea  name="alamat_kasir" rows="3" class="form-control" style="border-radius:0px;" required="required"><?= $hasil['alamat_kasir']; ?></textarea>
														</div>
													</div>
													<br>
													<div class="form-actions pull-right">
														<input type="hidden" name="id_kasir" value="<?= $hasil['id_kasir']; ?>">
														<button class="btn btn-primary" name="btn" value="Tambah" style="border-radius:0px;"><span class="glyphicon glyphicon-pencil"></span> Ubah Profil</button>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4><i class="fa fa-lock"></i>  Ganti Password</h4>
									</div>
									<div class="panel-body">
										<div class="box-content">
											 <form class="form-horizontal" method="POST" action="?page=kasir&password=ganti">
												
												<fieldset>
													<div class="control-group">
														<label class="control-label" for="typeahead">Username </label>
														<div class="input-group">
														  <div class="input-group-addon">
															<i class="fa fa-user"></i>
														  </div>
															<input type="text" class="form-control" style="border-radius:0px;" name="username" data-items="4" value="<?= $hasil['username'];?>"/>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="typeahead">Password Baru</label>
														<div class="input-group">
														  <div class="input-group-addon">
															<i class="fa fa-lock"></i>
														  </div>
															<input type="password" class="form-control" placeholder="Enter Your New Password" style="border-radius:0px;" id="password" name="password" data-items="4" value="" required="required"/>
														</div>
													</div>
													<br>
													<div class="pull-right">															
														<input type="hidden" class="form-control" style="border-radius:0px;" name="id_kasir" value="<?=$hasil['id_kasir'];?>" required="required"/>
														<button type="submit" class="btn btn-primary" value="Tambah" style="border-radius:0px;" name="proses"><span class="glyphicon glyphicon-pencil"></span> Ubah Password</button>
													</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix" style="padding-top:5%;"></div>
				  </div>
              </div>
          </section>
      </section>
	
