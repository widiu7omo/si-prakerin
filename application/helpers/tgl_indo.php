<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
function tgl_indo2($day){ 
 $day = explode ("-",$day);
 switch ($day[1]){
 case 1:
 $day[1] = "Januari";
 break;
 case 2:
 $day[1] = "Februari";
 break;
 case 3:
 $day[1] = "Maret";
 break;
 case 4:
 $day[1] = "April";
 break;
 case 5:
 $day[1] = "Mei";
 break;
 case 6:
 $day[1] = "Juni";
 break;
 case 7:
 $day[1] = "Juli";
 break;
 case 8:
 $day[1] = "Agustus";
 break;
 case 9:
 $day[1] = "September";
 break;
 case 10:
 $day[1] = "Oktober";
 break;
 case 11:
 $day[1] = "November";
 break;
 case 12:
 $day[1] = "Desember";
 break; 
 }
 $day_indo = $day[2]." ".$day[1]." ".$day[0];
 return $day_indo;
}
	