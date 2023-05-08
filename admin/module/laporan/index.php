 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
	  <?php 

			$bulan_tes =array(
				'01'=>"January",
				'02'=>"February",
				'03'=>"March",
				'04'=>"April",
				'05'=>"May",
				'06'=>"June",
				'07'=>"July",
				'08'=>"August",
				'09'=>"September",
				'10'=>"October",
				'11'=>"November",
				'12'=>"December"
			);


            //konek database
            $db = new database();

			// echo $_POST['hari'];

		?>
      <section id="main-content">
          <section class="wrapper">
		
		  <div class="row">
			<div class="col-lg-12 main-chart">
				<h3 class="text-center">
					<!--<a  style="padding-left:2pc;" href="fungsi/hapus/hapus.php?laporan=jual" onclick="javascript:return confirm('Data Laporan akan di Hapus ?');">
						<button class="btn btn-danger">RESET</button>
					</a>-->
					<?php if(!empty($_GET['cari_data'])){ ?>
						
						Data Laporan Penjualan <?= $_POST['bln'];?> <?= $_POST['thn'];?>
					<?php }elseif(!empty($_GET['hari'])){
						$hari = tgl_indo($_POST['hari']);
						$_POST['hari'] = $hari;
					?>
						
						Data Laporan Penjualan <?= $_POST['hari'];?>
					<?php }else{?>
						Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
					<?php }?>
				</h3>
			</div>
		  </div>
		  <br>

		  <div class="row">
			<div class="col-lg-6 main chart">
						<!-- cari data perbulan dan tahun -->
						<!-- <h4>Cari Laporan Per Bulan</h4> -->
						<form method="POST" action="?page=laporan&cari_data=ok">
							<table class="table table-striped">
								<tr>
									<th>
										Pilih Bulan
									</th>
									<th>
										Pilih Tahun
									</th>
									<th>
										Aksi
									</th>
								</tr>
								<tr>
								<td>
									<select name="bln"  class="form-control">
										<option><?= date('F');?></option>
										<?php
											$bulan=array("January","February","March","April","May","June","Juli","August","September","October","November","December");
											$jlh_bln=count($bulan);
											$bln1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
											$no=1;
											for($c=0; $c<$jlh_bln; $c++){
												echo"<option value='$bulan[$c]'> $bulan[$c] </option>";
											$no++;}
										?>
									</select>

								</td>
								<td>
								<?php
									$now=date('Y');
									echo "<select name='thn' class='form-control'>";
									echo "
									<option>". date('Y') ."</option>";
									for ($a=2017;$a<=$now;$a++)
									{
										echo "<option value='$a'>$a</option>";
									}
									echo "</select>";
									?>
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan" class="btn btn-warning">
										<i class="fa fa-refresh"></i> Refresh</a>
										
									<?php if(!empty($_GET['cari_data'])){?>
										<a href="excel.php?cari=yes&bln=<?=$_POST['bln'];?>&thn=<?=$_POST['thn'];?>" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
										<a href="excel.php" class="btn btn-success"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
								</tr>
							</table>		
			</div>

			<div class="col-lg-6 main chart">
				<!-- pilih cari hari -->
				<form method="POST" action="<?= "?page=laporan&hari=cek" ?>">
							<table class="table table-striped">
								<tr>
									<th>
										Pilih Hari
									</th>
									<th>
										Aksi
									</th>
								</tr>
								<tr>
								<td>
									<input type="date" value="<?= date('Y-m-d');?>" class="form-control" name="hari">
								</td>
								<td>
									<input type="hidden" name="periode" value="ya">
									<button class="btn btn-primary">
										<i class="fa fa-search"></i> Cari
									</button>
									<a href="index.php?page=laporan" class="btn btn-warning">
										<i class="fa fa-refresh"></i> Refresh</a>
										
									<?php if(!empty($_GET['hari'])){?>
										<a href="excel.php?hari=cek&tgl=<?= $_POST['hari'];?>" class="btn btn-info"><i class="fa fa-download"></i>
										Excel</a>
									<?php }else{?>
										<a href="excel.php" class="btn btn-success"><i class="fa fa-download"></i>
										Excel</a>
									<?php }?>
								</td>
								</tr>
							</table>
						</form>
			</div>
		  </div>

		  <div class="row">
			<div class="col-lg-12 main-chart">
			<table class="table table-bordered tabel-laporan" id="example1">
								<thead>
									<tr style="background:#DF9188;color:#333;">
										<th> No</th>
										<th> ID Barang</th>
										<th> Nama Barang</th>
										<th style="width:10%;"> Jumlah</th>
										<th style="width:10%;"> Modal</th>
										<th style="width:10%;"> Total</th>
										<th> Kasir</th>
										<th> Tanggal Input</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$no=1; 
										if(!empty($_GET['cari_data'])){
											$hari = $_POST['bln'] ." ".$_POST['thn'];
											
											$tanggal = $hari;
											
											$hasil = $db->tampil_data("SELECT * FROM nota INNER JOIN data_barang ON nota.kode_barang=data_barang.kode_barang
                                                  INNER JOIN kasir ON nota.id_kasir=kasir.id_kasir WHERE tanggal_input LIKE '%$tanggal%'");
											if(!$hasil)  {
												$tampil_barang = "Tidak ada data!";
											}

										}elseif(!empty($_GET['hari'])){
											$hari = $_POST['hari'];
											$tanggal = $hari;
											
											$hasil = $db->tampil_data("SELECT * FROM nota INNER JOIN data_barang ON nota.kode_barang=data_barang.kode_barang
                                                  INNER JOIN kasir ON nota.id_kasir=kasir.id_kasir WHERE tanggal_input LIKE '%$tanggal%'");
											if(!$hasil)  {
												$tampil_barang = "Tidak ada data!";
											}
                                            
										}else{
											//$hasil = $lihat -> jual();

                                            // echo $bulan_tes[date('m')];
                                            // exit;
                                           // $bulan = $bulan_tes[date('m')];

											
											$tanggal = $bulan_tes[date('m')];
											
											$hasil = $db->tampil_data("SELECT * FROM nota INNER JOIN data_barang ON nota.kode_barang=data_barang.kode_barang
                                                  INNER JOIN kasir ON nota.id_kasir=kasir.id_kasir WHERE tanggal_input LIKE '%$tanggal%'");
										}
									?>
									<?php 
										
										$bayar = 0;
										$jumlah = 0;
										$modal = 0;
										$keuntungan = 0;
										if(!isset($tampil_barang)) {
											if($hasil) {
												foreach($hasil as $isi){ 
													$bayar += $isi['total'];
													$modal += $isi['harga_satuan'];
													$jumlah += $isi['jumlah'];
													$keuntungan += ($isi['laba'] * $isi['jumlah']);
											
									?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['kode_barang'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['jumlah'];?> </td>
										<td>Rp.<?php echo number_format($isi['harga_satuan']);?>,-</td>
										<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
										<td><?php echo $isi['nama_kasir'];?></td>
										<td><?php echo $isi['tanggal_input'];?></td>
										
									</tr>
									<?php $no++;}}}?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3">Total Terjual</td>
										<th><?php echo $jumlah;?></td>
										<th>Rp.<?php echo number_format($modal);?>,-</th>
										<th>Rp.<?php echo number_format($bayar);?>,-</th>
										<th style="background:#0bb365;color:#fff;">Keuntungan</th>
										<th style="background:#0bb365;color:#fff;">
											Rp.<?php echo number_format($keuntungan);?>,-</th>
									</tr>
								</tfoot>
							</table>
			</div>
		  </div>

          </section>
      </section>
	

