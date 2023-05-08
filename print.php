<?php 
	// require 'config.php';
	// include $view;
	// $lihat = new view($config);
	// $toko = $lihat -> toko();
	// $hsl = $lihat -> penjualan();

    require "assets/database.php";

    $db = new database();
    $query_toko = $db->get_data("SELECT * FROM toko");
    $query_keranjang_jual = $db->tampil_data("SELECT * FROM keranjang_jual");

    // print_r($query_toko['nama_toko']);
    // print_r($query_keranjang_jual['nama_barang']);
    // exit;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>print</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<center>
						<p><?= $query_toko['nama_toko'];?></p>
						<p><?= $query_toko['alamat_toko'];?></p>
						<p>Tanggal : <?= date("j F Y, G:i");?></p>
						<p>Kasir : <?= $_GET['nama_kasir'];?></p>
					</center>
					<table class="table table-bordered" style="width:100%;">
						<tr>
							<td>No.</td>
							<td>Barang</td>
							<td>Jumlah</td>
                            <td>Harga Satuan</td>
							<td>Total</td>
						</tr>
						<?php $no=1; foreach($query_keranjang_jual as $isi){?>
						<tr>
							<td><?= $no;?></td>
							<td><?= $isi['nama_barang'];?></td>
							<td><?= $isi['jumlah'];?></td>
                            <td><?=  number_format($isi['harga_satuan']);?></td>
							<td><?= number_format($isi['total']);?></td>
						</tr>
						<?php $no++; }?>
					</table>
					<div class="pull-right">
						<?php
                        //  $hasil = $lihat -> jumlah();
                          ?>
						Total : Rp.<?= number_format($_GET['total']);?>,-
						<br/>
						Bayar : Rp.<?= number_format($_GET['bayar']);?>,-
						<br/>
						Kembali : Rp.<?= number_format($_GET['kembali']);?>,-
					</div>
					<div class="clearfix"></div>
					<center>
						<p>Terima Kasih Telah berbelanja di toko kami !</p>
					</center>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</body>
</html>
