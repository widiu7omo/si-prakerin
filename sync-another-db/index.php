<?php
define("HOST","localhost");
// define("DB","pegawai");
define("DB","simprakerin");
// define('UNAME', 'prakerin');
define('UNAME', 'root');
// define('PASS', 's1mpr4k3r1n');
define('PASS', '');

$connection = new mysqli(HOST,UNAME,PASS,DB);
if($connection->connect_error){
    die("Cant connect to database, check your configuration ".$connection->connection_error);
}

$query = "SELECT  `nip_nik`,  
                  `username`,  
                  `status`,  
                  `id_pangkat_golongan`,  
                  `nama_pegawai`, 
                  `alamat_pegawai`,  
                  `jk_pegawai`,  
                  `email_pegawai`,  
                  `tempat_lahir_pegawai`,  
                  `tanggal_lahir_pegawai`,  
                  `no_hp_pegawai`,  
                  `id_jabatan`,  
                  `id_golongan` 
                  FROM `simprakerin`.`tb_pegawai`";
        
$result = $connection->query($query);

$rows = array();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        array_push($rows,$row);
    }
}
echo json_encode($rows);
$connection->close();  