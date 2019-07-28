<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//change name to snake case
if ( ! function_exists('generate_id'))
{
    function generate_id($table,$primarykey,$defaultKey = null)
    {
        $ci=& get_instance();
        $lastID = $ci->db->select_max($primarykey)->get($table)->row_array();
        if($lastID[$primarykey] == null){
        	$lastID[$primarykey] = $defaultKey;
        }
	    $subId = str_split($lastID[$primarykey], 3);
        $lastNumber = (int) $subId[1]++;
        $lastNumber++;
        return $subId[0] . sprintf("%03s", $lastNumber);
    }   
}

/* End of file ModelName.php */
 ?>