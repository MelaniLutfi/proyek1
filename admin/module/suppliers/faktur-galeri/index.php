<?php
  include "../../../../assets/database.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bootstrap Photo Gallery Demo</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

    <link href="dist/jquery.bsPhotoGallery-min.css" rel="stylesheet">
    <script src="dist/jquery.bsPhotoGallery-min.js"></script>	
	
    </script>
    <script>
      $(document).ready(function(){
        $('ul.first').bsPhotoGallery({
          "classes" : "col-xl-3 col-lg-2 col-md-4 col-sm-4",
          "hasModal" : true,
          "shortText" : false  
        });
      });
    </script>
  </head>
  <style>
      /**************STYLES ONLY FOR DEMO PAGE**************/
      @import url(https://fonts.googleapis.com/css?family=Bree+Serif);
      body {
        background:#ebebeb; 
      }   
  </style>
  <body>
    <div class="container">
        <div class="row" style="text-align:center; border-bottom:1px dashed #ccc;  padding:30px 0 20px 0; margin-bottom:40px;">
            <div class="col-lg-12">
            <h3 style="font-family:'Bree Serif', arial; font-weight:bold; font-size:30px;">
                FAKTUR NOTA
            </h3>

            </div>
        </div>

        <ul class="row first">

          <?php
              $id = $_GET['name'];
              $db = new database();
              $query_faktur = $db->tampil_data("SELECT foto_faktur, tanggal_faktur FROM faktur_supplier WHERE id_supplier='".$id."'");
              
              if($query_faktur)  {

              foreach($query_faktur as $isi) {
          ?>
            <li>
                <img alt="Rocking the night away"  src="img-faktur/<?= $isi['foto_faktur']?>">
                <p><?= $isi['tanggal_faktur']?></p>
            </li>
              
          <?php
              }}
          ?>
   
        </ul>




    </div> <!-- /container -->









  </body>


</html>
