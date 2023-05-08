 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

	  <?php
	  
		$kode;
		if(isset($_GET['kode'])) {
			$kode  = $_GET['kode'];
		}
	  ?>

      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<!-- <h3>Data Barang</h3> -->
					
						<!-- Trigger the modal with a button -->

 						<!-- insert untuk menambahkan faktur nota barang masuk -->
						<!-- <button type="button" class="btn btn-warning btn-md pull-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus"></i> Insert Faktur</button> -->

						<!-- insert untuk memasukkan data baru -->
						<button type="button" style="margin-right :0.5pc;" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus"></i> Insert Data
						</button>

						<button type="button" style="margin-right :0.5pc;" class="btn btn-warning btn-md pull-right" data-toggle="modal" data-target="#myModalFaktur">
							<i class="fa fa-plus"></i> Insert Faktur
						</button>

						<a href="index.php?page=barang" style="margin-right :0.5pc;" 
							class="btn btn-success btn-md pull-right">
							<i class="fa fa-refresh"></i> Refresh Data
						</a>


						<br/> 
						<br>
						
						<!-- view barang -->	
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>

						<?php 
							$db = new database();
							$query = $db->tampil_data("SELECT kode_barang, stok FROM data_barang WHERE stok<=4");
							if($query) {
								$stok_tipis = count($query);
								if($stok_tipis > 0){
									echo "
									<div class='alert alert-warning'>
										<span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$stok_tipis</span> barang yang Stok tersisa sudah kurang dari 5 items. silahkan pesan lagi !!
										<span class='pull-right'><a href='index.php?page=barang&stok=yes'>Cek Barang <i class='fa fa-angle-double-right'></i></a></span>
									</div>
									";	
								}
							}
						?>


						<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Daftar Barang
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Supplier</th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>Harga Satuan</th>
                                                <th>Laba</th>
												<th>Harga Jual</th>
                                                <th>Aksi</th>
											</tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php 
												$db = new database();

												if(isset($_GET['stok'])) {
													$query = $db->tampil_data("SELECT * FROM data_barang WHERE stok<=4");
												} else {
													 $query = $db->tampil_data("SELECT * FROM data_barang");
												}

												if(!$query) {
													$kosong =  "<h1>Tidak ada data</h1>";
													
												} else {

												
                                                                                  		 
                                                $nomor = 1;                                             
                                                   foreach($query as $data_barang) {	
													$kode_barang = $data_barang['kode_barang'];
                                            ?>
                                                
                                                <tr>
                                                    <td><?= $nomor; ?></td>
                                                    <td><?= $data_barang['kode_barang']; ?></td>
                                                    <td><?= $data_barang['nama_supplier']; ?></td>
                                                    <td><?= $data_barang['nama_barang']; ?></td>
                                                    <td><?= number_format($data_barang['stok']); ?></td>
                                                    <td id="harga_satuan"><?= number_format($data_barang['harga_satuan']); ?></td>
                                                    <td><?= number_format($data_barang['laba']); ?></td>
													<td><?= number_format($data_barang['harga_jual']); ?></td>
                                                    <td>													
														<!-- jika stok menipis -->
														<?php if($data_barang['stok'] <= 4){?>
															<form method="POST" action="<?= base_url(). "/fungsi/edit-barang/edit.php?kode_barang=". $data_barang['kode_barang']. "&restok=yes"?>">														
																
																<input type="number" name="restok" class="form-control">
																<input type="hidden" name="kode_barang" value="<?= $data_barang['kode_barang'];?>" class="form-control">
																<button class="btn btn-primary btn-sm">
																	Restok</button>

																<a href="<?= base_url(). "/fungsi/hapus-barang/hapus.php?kode_barang=". $data_barang['kode_barang'];?>" 
																onclick="javascript:return confirm('Hapus Data barang ?');"
																class="btn btn-danger btn-sm">Hapus</a>

																<a href="<?= base_url(). "?page=edit&kode_barang=".$data_barang['kode_barang']. "&update=yes"?>" 
																	class="btn btn-warning btn-sm">Ubah</a> 
															</form>															
																
														<?php } else {
														?>	
															<a href="<?= base_url(). "?page=edit&kode_barang=". $data_barang['kode_barang']. "&update=yes"?>" class="btn btn-warning btn-sm">Ubah</a> | 
															<a href="<?= base_url(). "/fungsi/hapus-barang/hapus.php?kode_barang=". $data_barang['kode_barang'];?>" class="btn btn-danger btn-sm">Hapus</a> |
														
															<form action="<?= "?page=barang&kode=". $data_barang['kode_barang']?>" style="display:inline-block;" method="POST">
																<!-- sebagai link otomatis jika tombol ditukar -->
																<a id="tombol-tukar" data-toggle="modal" data-target="#myModalTukar"></a>

																<button type="submit" class="btn btn-dark btn-sm" >Tukar</button>
															</form>
															
																
														<?php
															}
														?>

                                                </tr>

                                            <?php 
                                                        $nomor++;
                                                    
                                                }	}

												if(!empty($kosong)) {
													echo $kosong;
												}
                                            ?>
                                                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

					
						<div class="clearfix" style="margin-top:7pc;"></div>
					<!-- end view barang -->
					<!-- tambah barang MODALS-->
						<!-- Modal -->
					
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content" style=" border-radius:0px;">
								<div class="modal-header" style="background:#285c64;color:#fff;">
									
									<h4 class="modal-title"> Tambah Barang</h4>
								</div>										
								<form action="<?= base_url(). "/fungsi/tambah-barang/tambah.php" ?>" method="POST" enctype="multipart/form-data">
									<div class="modal-body">
								
										<table class="table table-striped bordered">
											
										
											<tr>
												<td>kode_barang</td>
												<td><input type="text" required name="kode_barang"></td>
											</tr>
											<tr>
												<td>nama_supplier</td>
												<td>
												<select name="nama_supplier" class="form-control" required>
													
													<?php
														$db = new database();
														$query_suplier = $db->tampil_data("SELECT nama_supplier FROM suppliers");
														
														
														foreach($query_suplier as $nama_supplier) {
													?>
														
														<option><?= $nama_supplier['nama_supplier']?></option>
													<?php
														}
													?>
												</select>
												</td>
											</tr>
											<tr>
												<td>Nama Barang</td>
												<td><input type="text" placeholder="Nama Barang" required class="form-control" name="nama_barang" autocomplete="off"></td>
											</tr>
											<tr>
												<td>Stok</td>
												<td><input type="number" placeholder="Masukan stok" required class="form-control"  name="stok"></td>
											</tr>	
											<tr>
												<td>Harga_satuan</td>
												<td><input type="number" placeholder="Harga satuan" required class="form-control" name="harga_satuan"></td>
											</tr>
											<tr>
												<td>laba</td>
												<td><input type="number" placeholder="laba" required class="form-control"  name="laba"></td>
											</tr>
											<tr>
												<td>Tanggal Input</td>
												<td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
											<tr>
												<td>Tambahkan Faktur (foto)</td>
												<td><input type="file"  class="form-control" name="faktur_supplier"></td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>

							</div>
						</div>	
						
					</div>

					<!-- ketika insert faktur maka akan muncul -->

					<div id="myModalFaktur" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content" style=" border-radius:0px;">
								<div class="modal-header" style="background:#285c64;color:#fff;">
									
									<h4 class="modal-title"> Tambah Faktur Supplier</h4>
								</div>										
								<form action="<?= base_url(). "/fungsi/tambah-barang/tambah.php?faktur=yes" ?>" method="POST" enctype="multipart/form-data">
									<div class="modal-body">
								
										<table class="table table-striped bordered">
											
											<tr>
												<td>nama_supplier</td>
												<td>
												<select name="nama_supplier" class="form-control" required>
													
													<?php
														$db = new database();
														$query_suplier = $db->tampil_data("SELECT nama_supplier FROM suppliers");
														
														
														foreach($query_suplier as $nama_supplier) {
													?>
														
														<option><?= $nama_supplier['nama_supplier']?></option>
													<?php
														}
													?>
												</select>
												</td>
											</tr>
											<tr>
												<td>Tanggal Input</td>
												<td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
											<tr>
												<td>Tambahkan Faktur (foto)</td>
												<td><input type="file"  class="form-control" name="faktur_supplier"></td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
              	</div>

				<!-- ketika tombol tukar di klik -->
				<div id="myModalTukar" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content" style=" border-radius:0px;">
								<div class="modal-header" style="background:#285c64;color:#fff;">
									
									<h4 class="modal-title">Tukar Barang</h4>
								</div>				

								<form action="<?= base_url(). "/fungsi/tukar-barang/tukar.php?tukar=yes" ?>" method="POST">
									<div class="modal-body">
								
										<table class="table table-striped bordered">
											<input type="hidden" name="kode_barang" value="<?= $kode?>">
											
											<tr>
												<td>Catatan</td>
												<td>
													<textarea name="catatan"></textarea>
												</td>
											</tr>
											<tr>
												<td>Tanggal Input</td>
												<td><input type="text" required readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
						<div>
													
          	</section>							
      	</section>


          
<?php
	if(isset($_GET['kode'])) {
		echo "<script>var tukar = document.getElementById('tombol-tukar');tukar.click();</script>";
	}
?>

