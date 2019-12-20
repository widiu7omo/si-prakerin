<?php
include("includes/defines.php");
include("includes/connect.php");

function generate_key(){
	return uniqid().uniqid().uniqid();
}
function writeout_key(){
	$handle = fopen('./.key.text','w');
	fwrite($handle,generate_key());
	fclose($handle);
	return true;
}
if(isset($_POST['generate'])){
	if(writeout_key()){
		echo json_encode(array('status'=>'success'));
	}
}
$openKey = fopen('./.key.text','r');
$key = fgets($openKey);
if(isset($_POST['key'])){
	if($key == $_POST['key']){
		$query = "select 
        tb_user.nip,
        tb_user.UserName,
        tb_user.Password,
        tb_user.nama_lengkap, 
        tb_biodata.alamat,
        tb_biodata.tempat_lahir,
        tb_biodata.tgl_lahir,
        tb_biodata.jk 
        from tb_user 
            inner join tb_biodata on tb_user.id_user = tb_biodata.id_user 
            where tb_user.on_off = 'on' 
            AND UserName REGEXP '[\@]*politala\.ac\.(.+)' 
            AND tb_user.id_status_kerja = 1";

		$result = mysql_query($query);

		$rows = array();
		while ($row = mysql_fetch_array($result)) {
			array_push($rows,$row);
		}
		echo json_encode($rows);

	}
	else{
		echo json_encode(array('status'=>'error','message'=>'Wrong key'));
	}
}
