<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//change name to snake case
if ( ! function_exists('generate_id'))
{
    function get_status_dosen_id($session_id)
    {
        $ci=& get_instance();
        return $ci->db->query('SELECT ')->result();
    }   
}

/* End of file ModelName.php */
 ?>
