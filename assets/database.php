<?php
class database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "proyek1_databarang";
    var $koneksi = "";
    function __construct(){
        $this->koneksi = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        if(mysqli_connect_errno()){
            echo "koneksi database gagal : " . mysqli_connect_error();
        }
    }
    function tampil_data($query)
    {
        $sql = mysqli_query($this->koneksi,$query);

        if(mysqli_num_rows($sql) > 0) {
            while($data = mysqli_fetch_array($sql)){
                $hasil[] = $data;
            }
            return $hasil;
            
        } else {
            return  false;
        }
      
    }

    function query_data($query)
    {
        $sql = mysqli_query($this->koneksi,$query);
        if($sql = true){
            return  true;
        }
        else{
            return false;
        }
    }

    function get_data($query)
    {
        $sql = mysqli_query($this->koneksi,$query);
        return $sql->fetch_assoc();
    }
}
?>