<?php
    require_once("data.php");

    class orangtua{
        protected $koneksi;

        public function __construct()
        {
            $this->koneksi = new mysqli(SERVER, USER, PASS, DB);

            if ($this->koneksi->connect_errno){
                echo "Terdapat error koneksi ke database dengan error seperti berikut: <br>";
                echo $this->koneksi->connect_error;
            }
        }
    }
?>