 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

      <?php
        $nama_sup = '';
      ?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">

						<!-- view barang -->	
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>

						<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tukar Barang </li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Daftar Barang
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <!-- jika print di klik -->
                                    <?php
                                        if(isset($_GET['print'])) {
                                            echo "<script>
                                            window.print();</script>";            
                                    ?>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Supplier</th>
                                                    <th>Nama Barang</th>
                                                    <th>Catatan</th>
                                            
                                                </tr>
                                            </thead>
                                        
                                            <tbody>
                                                <?php 
                                                    $db = new database();

                                                    if(!empty($_GET['name'])) {
                                                        $nama_sup = $_GET['name'];
                                                        $query = $db->tampil_data("SELECT * FROM barang_rusak WHERE nama_supplier='".$nama_sup."'");
                                                    } else {
                                                        $query = $db->tampil_data("SELECT * FROM barang_rusak");
                                                    }

                                                   
                                                    

                                                    $nomor = 1;      

                                                    if($query) {
                                                    foreach($query as $data_barang) {	
                                                ?>
                                                    
                                                    <tr>
                                                        <td><?= $nomor; ?></td>
                                                        <td><?= $data_barang['kode_barang']; ?></td>
                                                        <td><?= $data_barang['nama_supplier']; ?></td>
                                                        <td><?= $data_barang['nama_barang']; ?></td>
                                                        <td> <?= $data_barang['catatan']; ?></td>  
                                                    </tr>
                                                <?php 
                                                            $nomor++;                                              
                                                    }	}
                                                ?>
                                                                        
                                            </tbody>
                                        
                                        </table> 
                                    <?php } else {
                                    
                                    ?>
                                    
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Nama Supplier</th>
                                                    <th>Nama Barang</th>
                                                    <th>Catatan</th>
                                                    <th>Aksi</th>
                                            
                                                </tr>
                                            </thead>
                                        
                                            <tbody>
                                                <?php 
                                                    $db = new database();

                                                    if(!empty($_GET['name'])) {
                                                        $nama_sup = $_GET['name'];
                                                        $query = $db->tampil_data("SELECT * FROM barang_rusak WHERE nama_supplier='".$nama_sup."'");
                                                    } else {
                                                        $query = $db->tampil_data("SELECT * FROM barang_rusak");
                                                    }

                                                    
                                                   
                                                    

                                                    $nomor = 1;      

                                                    if($query) {
                                                    foreach($query as $data_barang) {	
                                                ?>
                                                    
                                                    <tr>
                                                        <td><?= $nomor; ?></td>
                                                        <td><?= $data_barang['kode_barang']; ?></td>
                                                        <td><?= $data_barang['nama_supplier']; ?></td>
                                                        <td><?= $data_barang['nama_barang']; ?></td>
                                                        <td> <?= $data_barang['catatan']; ?></td>
                                                        <td>													
                                                            <a href="<?= base_url(). "?page=edit&kode_barang=". $data_barang['kode_barang']. "&update=yes"?>" class="btn btn-warning btn-sm">Ubah</a> | 
                                                            <a href="<?= base_url(). "/fungsi/tukar-barang/tukar.php?kode_barang=". $data_barang['kode_barang']. "&hapus=yes";?>" class="btn btn-danger btn-sm">Hapus</a> 
                                                    </td>  
                                                    </tr>
                                                <?php 
                                                            $nomor++;                                              
                                                    }	}
                                                ?>
                                                                        
                                            </tbody>
                                        
                                        </table>     
                                    <?php
                                         }   
                                    ?>
                                   
                                </div>
                                
                                <?php
                                    if(empty($_GET['print'])) {
                                ?>
                                    <a href="?page=barang-rusak&print=true&name=<?= $nama_sup ?>" name="print" class="btn btn-default">
                                        <span class="fa fa-print"></span> Print Tabel
                                    </a>
                               <?php
                                    }
                                ?>
                                                    
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
          	</section>
      	</section>

          
	
