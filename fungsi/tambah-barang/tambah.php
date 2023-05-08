<?php
    
    include "../../assets/database.php";
    include "../../assets/tgl_indo.php";
    include "../../assets/functionAll.php";
    // echo $_FILES['faktur_supplier']['tmp_name'];
    // exit;

    if(isset($_POST['submit'])) {
        $db = new database();
        $query = false;

        $faktur_supplier = $_FILES['faktur_supplier']['name'];

        if(!isset($_GET['faktur'])) {
            $kode_barang = $_POST['kode_barang'];

            //ambil data barang pada tabel data_barang
            $query = $db->get_data("SELECT * FROM data_barang WHERE kode_barang='".$kode_barang."'");

            //cek apakah kode barang sudah ada atau belum pada data_barang nya
            if($query) {
                echo "<script>alert('Kode barang $kode_barang sudah dalam tabel!');
                        document.location='../../index.php?page=barang'
                </script>";

            } else {
                
                $nama_supplier = $_POST['nama_supplier'];
                $nama_barang = $_POST['nama_barang'];
                $stok = $_POST['stok'];
                $harga_satuan = $_POST['harga_satuan'];
                $laba = $_POST['laba'];
                $harga_jual = $harga_satuan + $laba;

                //insert data ke data_barang
                $query = $db->query_data("INSERT INTO data_barang (id, kode_barang, nama_supplier, nama_barang, stok, harga_satuan, laba, harga_jual)
                VALUES ('', '".$kode_barang."', '".$nama_supplier."', '".$nama_barang."', '".$stok."', '".$harga_satuan."', '".$laba."', '".$harga_jual."')");
            
            }
        } 
        
        if(!empty($faktur_supplier)) {
                set_time_limit(0);
                $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
                
                if ($_FILES['faktur_supplier']["error"] > 0) {
                    $output['error']= "Error in File";
                } elseif (!in_array($_FILES['faktur_supplier']["type"], $allowedImageType)) {
                    echo "You can only upload JPG, PNG and GIF file";
                    echo "<font face='Verdana' size='2' ><BR><BR><BR>
                            <a href='../../index.php?page=barang'>Back to upform</a><BR>";
        
                }elseif (round($_FILES['faktur_supplier']["size"] / 1024) > 10000) { //4096
                    echo "WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB";
                    echo "<font face='Verdana' size='2' ><BR><BR><BR>
                            <a href='../../index.php?page=barang'>Back to upform</a><BR>";
        
                }else{
                    $target_path = "../../admin/module/suppliers/faktur-galeri/img-faktur/";
                    $target_path = $target_path . basename( $_FILES['faktur_supplier']['name']); 
                    if (file_exists("$target_path")){ 
                        echo "<font face='Verdana' size='2' >Ini Terjadi Karena Telah Masuk Nama File Yang Sama,
                        <br> Silahkan Rename File terlebih dahulu<br>";
        
                    echo "<font face='Verdana' size='2' ><BR><BR><BR>
                            <a href='../../index.php?page=barang'>Back to upform</a><BR>";
        
                    } elseif (move_uploaded_file($_FILES['faktur_supplier']['tmp_name'], $target_path)){
   
                    $faktur_supplier = $_FILES['faktur_supplier']['name']; 
                    $nama_supplier = $_POST['nama_supplier'];
                    $tanggal_faktur = $_POST['tgl'];
                    
                    //medapatkan id supplier dulu
                    $query_idSup = $db->get_data("SELECT id FROM suppliers WHERE nama_supplier='".$nama_supplier."'");

                    $id_supplier = $query_idSup['id'];

                    //insert faktur ke tabel faktur_supplier
                    $query_faktur = $db->query_data("INSERT INTO faktur_supplier (id_faktur, nama_supplier, foto_faktur, tanggal_faktur, id_supplier)
                                                        VALUES ('', '".$nama_supplier."', '".$faktur_supplier."', '".$tanggal_faktur."', '".$id_supplier."')");
                    }
                }     
       }

         
            if($query || $query_faktur) {
                echo "<script>alert('Data berhasil ditambahkan!');
                document.location='../../index.php?page=barang'
                </script>";
            } else {
                echo "<script>alert('Data gagal ditambahkan!');
                document.location='../../index.php?page=barang'
                </script>";
            }

    }

   

?>