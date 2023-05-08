 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

	  
      <?php 
		//   $id = $_SESSION['admin']['id_member'];
		if(empty($_SESSION['kasir']) ) {
			echo "<h1 class='text-center'>Transaksi penjualan hanya bisa dilakukan oleh kasir!<h1>";
			exit;
		} else {
			$hasil = $_SESSION['kasir'];

			if(!isset($_GET['cari'])) {
				$_GET['cari'] = '';
			} 
	
		}

      ?>
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12 main-chart">
						<!-- <h3>Keranjang Penjualan</h3> -->
						<!-- <br> -->
						
						<div class="col-sm-12">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h4><i class="fa fa-search"></i> Cari Barang</h4>
								</div>
								<div class="panel-body">
										<input type="text" class="form-control" id="cari" placeholder="Masukan : Kode / Nama Barang  [ENTER]">
										<!-- <butto type='submit' name="button"></button> -->
									<div id="hasil-cari">
											<div class="panel-body">
											<?php 
												$db = new database();
												$hasil1 = $db->tampil_data("SELECT * FROM data_barang a INNER JOIN best_seller b 
															ON  a.kode_barang=b.kode_barang ORDER BY jumlah  DESC LIMIT 5");
											?>
											<table class="table table-stripped" width="100%" id="example2">
												<tr>
													<th>No</th>
													<th>Kode Barang</th>
													<th>Nama Barang</th>	
													<th>Stok</th>							
													<th>Harga Jual</th>
													<th>Aksi</th>
												</tr>	
											<?php
												if($hasil1) {
													$no = 1;
													$warna = array("gold", "gold", "gold", "silver", "silver");
													foreach($hasil1 as $hasil){?>
														<tr>
															<td><?= $no;?><i class='fas fa-crown' style='font-size:10px;color:<?= $warna[$no-1]?>'></i></td>
															<td><?= $hasil['kode_barang'];?></td>
															<td><?= $hasil['nama_barang'];?></td>
															<td><?= $hasil['stok'];?></td>
															<td><?= $hasil['harga_jual'];?></td>
															<td>

																<a href="<?= base_url(). "/fungsi/tambah-keranjang/tambah.php?kode_barang=" . $hasil['kode_barang'];?>"
																class="btn btn-success">
																<span class="fa fa-shopping-cart"></span></a>
															</td>

														</tr>
											<?php $no++;}}?>

											</table>
										</div>
      
									</div>
								</div>	
								
							</div>
						</div>

						<div class="col-sm-12">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h4><i class="fa fa-shopping-cart"></i> KASIR
									<!-- <a class="btn btn-danger pull-right" style="margin-top:-0.5pc;" href="fungsi/hapus/hapus.php?penjualan=jual">
										<b>RESET KERANJANG</b></a>
									</h4> -->
								</div>
								<div class="panel-body">
									<div id="keranjang">
										<table class="table table-bordered">
											<tr>
												<td><b>Tanggal</b></td>
												<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
										</table>
										<table class="table table-bordered" id="example1">
											<thead>
											
												<tr>
													<td> No</td>
													<td> Nama Barang</td>
													<td style="width:10%;"> Jumlah</td>
													<td style="width:20%;"> Total</td>
													<td> Kasir</td>
													<td> Aksi</td>
												</tr>
											</thead>
											<tbody>
												<?php 
													$total_bayar=0; 
													$bayar = 0;
													$hitung = 0;
													$no=1; 
													//$hasil_penjualan = $lihat -> penjualan();

													$db = new database();
													$query = $db->tampil_data("SELECT * FROM keranjang_jual INNER JOIN kasir on keranjang_jual.id_kasir=kasir.id_kasir");
													
													if($query) {
													
												?>
														<?php foreach($query  as $isi){?>
														<tr>
																<td><?= $no;?></td>
																<td><?= $isi['nama_barang'];?></td>
																<td>
															
															<!-- aksi ke table penjualan -->
															<form method="POST" action="<?= base_url()."/fungsi/update-keranjang/update.php" ?>">
																	<input type="number" name="jumlah" value="<?= $isi['jumlah'];?>" class="form-control">
																	<input type="hidden" name="id" value="<?= $isi['kode_barang'];?>" class="form-control">
																	<input type="hidden" name="kode_barang" value="<?= $isi['kode_barang'];?>" class="form-control">
																	<input type="hidden" name="total" value="<?= $isi['total'];?>" class="form-control">
																	<input type="hidden" name="harga_satuan" value="<?= $isi['harga_satuan'];?>" class="form-control">

																</td>
																<td>Rp.<?= number_format($isi['total']);?>,-</td>	
																<td><?= $isi['nama_kasir'];?></td>
																<td>
																	<button type="submit" name="submit"class="btn btn-warning">Update</button>
															</form>
															<!-- aksi ke table penjualan -->
																	<a href="<?= base_url()."/fungsi/hapus-keranjang/hapus.php?hapus=yes&kode_barang=". $isi['kode_barang'] ?>"  class="btn btn-danger"><i class="fa fa-times"></i>
																	</a>
																</td>
														</tr>
														<?php 
															$no++;
															$total_bayar += $isi['total'];
														}
													} else {
													?>
														<p>No data available</p>
													<?php
													}
												
												?>
											</tbody>
									</table>

									<br/>
									
									<div id="kasirnya">
										<table class="table table-stripped">
											<?php
											//ketika dolar get nota belum dibuat
											if(!isset($_GET['nota'])) {
												$_GET['nota'] = 'no';
											}

											//proses bayar dan ke nota
											if(!empty($_GET['nota'] == 'yes')) {
												$total = $_POST['total'];
												$bayar = $_POST['bayar'];
												if(!empty($bayar))
												{
													$hitung = $bayar - $total;
													if($bayar >= $total)
													{
														$kode_barang = $_POST['kode_barang'];
														$id_kasir = $_POST['id_kasir'];
														$jumlah = $_POST['jumlah'];
														$total = $_POST['total1'];
														$tgl_input = $_POST['tanggal_input'];

														$jumlah_dipilih = count($kode_barang);
														
														for($x=0; $x < $jumlah_dipilih; $x++) {
															$kode_bar[$x] = $kode_barang[$x];
														}

														// print_r($kode_bar);
														// exit;
														
														$db = new database();
														for($x=0; $x<$jumlah_dipilih; $x++){
															
															$query_nota = $db->query_data("INSERT INTO nota (id_nota, kode_barang, id_kasir, jumlah, total, tanggal_input) 
																		VALUES ('', '".$kode_bar[$x]."', '".$id_kasir[$x]."', '".$jumlah[$x]."', '".$total[$x]."', '".$tgl_input[$x]."')");
															
															$query = $db->get_data("SELECT * FROM data_barang WHERE kode_barang='".$kode_bar[$x]."'");
															
															//$laba += $query['harga_satuan'] * $jumlah[$x];

															$stok = $query['stok'];
															$kode_barang  = $query['kode_barang'];

															$total_stok = $stok - $jumlah[$x];
															// echo $total_stok;
															$query = $db->query_data("UPDATE data_barang SET stok = '".$total_stok."' WHERE kode_barang='".$kode_barang."'");
															
															


															//masukkan data ke dalam best seller

															$query_best = $db->get_data("SELECT * FROM best_seller WHERE kode_barang='".$kode_barang."'");

															if(!$query_best) {
																//masukkan data													
																$query_best = $db->query_data("INSERT INTO best_seller (id, kode_barang, jumlah)
																			VALUES ('', '".$kode_barang."', '".$jumlah[$x]."')");
															
															} else if($query_best) {
																// echo $jumlah;
																// exit;
																$query_best = $db->get_data("SELECT * FROM best_seller WHERE kode_barang='".$kode_barang."'");
														
																$jumlah[$x] += $query_best['jumlah'];
																$query_best = $db->query_data("UPDATE best_seller SET jumlah = '".$jumlah[$x]."' WHERE kode_barang='".$kode_barang."'");
															}
															
														}

														 	//masukkan data dari nota kedalam keuangan
															$tgl_skrng = date("j F Y");
														 	$query_nota = $db->tampil_data("SELECT total, jumlah, harga_satuan FROM nota INNER JOIN data_barang
															 				ON nota.kode_barang=data_barang.kode_barang WHERE tanggal_input LIKE '%$tgl_skrng%' ");

														

														 	$omset = 0;
															$laba = 0;
															$total_hargasatuan = 0;

												
															foreach($query_nota as $isi_nota) {	
																$omset += $isi_nota['total'];
																$total_hargasatuan += $isi_nota['harga_satuan'];
																// echo $total_hargasatuan;
																// echo "<br>";
																
																
															}
														
															$laba = $omset - $total_hargasatuan;
															
															 $query_keuangan = $db->query_data("INSERT INTO keuangan (id, omset, laba, tanggal_input)
															 					VALUES ('', '".$omset."', '".$laba."', '".$tgl_skrng."')");

														echo '<script>alert("Belanjaan Berhasil Di Bayar !");</script>';
													}else{
														echo '<script>alert("Uang Kurang ! Rp.'.$hitung.'");</script>';
													}
												}
											}
											?>
											<!-- aksi ke table nota -->
											<form method="POST" action="index.php?page=jual&nota=yes#kasirnya">
												<?php 
													$query = $db->tampil_data("SELECT * FROM keranjang_jual INNER JOIN kasir on keranjang_jual.id_kasir=kasir.id_kasir");
													if(!$query) {
														$kosong = "<p>Belum ada barang</p>";
													}
													if(isset($kosong)) {
														echo $kosong;
														
													} else {
														foreach($query as $isi){?>
													<input type="hidden" name="kode_barang[]" value="<?= $isi['kode_barang'];?>">
													<input type="hidden" name="id_kasir[]" value="<?= $isi['id_kasir'];?>">
													<input type="hidden" name="jumlah[]" value="<?= $isi['jumlah'];?>">
													<input type="hidden" name="total1[]" value="<?= $isi['total'];?>">
													<input type="hidden" name="tanggal_input[]" value="<?= $isi['tanggal_input'];?>">
													
												<?php $no++; }?>
												<tr>
													<td>Total Semua  </td>
													<td>
													<input type="hidden" class="form-control" name="total" value="<?= $total_bayar;?>">
														<input type="text" class="form-control"  value="<?=  number_format($total_bayar);?>">
													</td>
												
													<td>Bayar  </td>
													<td><input type="text" class="form-control" name="bayar" value="<?= $bayar;?>"></td>
													<td><button class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button>													
												</tr>
											</form>
											<?php
													}
											?>
											<!-- aksi ke table nota -->
											<tr>
												<td>Kembali</td>
												<td><input type="text" class="form-control" value="<?= number_format($hitung);?>"></td>
												<td></td>
												<td>
													<a href="print.php?nama_kasir=<?=$_SESSION['kasir']['nama_kasir'];?>
													&bayar=<?=$bayar;?>&kembali=<?= $hitung;?>&total=<?= $total_bayar;?>" target="_blank">
													<button class="btn btn-default">
														<i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
													</button></a>
												</td>
											<?php
												//}
											?>
											</tr>
										</table>
										<br/>
										<br/>
									</div>
								</div>
							</div>
						</div>
				  </div>
              </div>
          </section>
      </section>
	

 <script type="text/javascript">
		$(document).ready(function(){
			

			$("#cari").keyup(function(){
				var input = $("#cari").val();
				if(input != "") {	
					$.ajax({
					type:'POST',
					url:'admin/module/jual/hasil-cari.php',
					data:{
					cari:$("#cari").val(),
					},
					success:function(data){
					// alert(data);
					$("#hasil-cari").html(data);
					console.log(data);
						if(data != "") {
							$("#hasil-cari").show();
						}
					}
					
				});
				} else {	
					// alert(input);			
					location.reload(true);
				}
				
			});
			
		});
</script>