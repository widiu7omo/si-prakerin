<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//change name to snake case
if ( ! function_exists('count_notification'))
{
    function count_notification($receiver,$status = null){
        $ci=& get_instance();
        if($status == 0){
            $ci->db->where(['status'=>$status]);
        }
        elseif($status == 1){
            $ci->db->where(['status'=>$status]);
        }
        $ci->db->where(['penerima'=>$receiver]);
        
        return $ci->db->count_all_results('tb_notification');
    }
}
if ( ! function_exists('get_notification'))
{
    function get_notification($receiver,$status = 0){
        $ci=& get_instance();
            $ci->db->select(['uri','pesan','pengirim','waktu'])->from('tb_notification')->where(['penerima'=>$receiver]);
            if($status == 0){
                $ci->db->where(['status'=>$status]);
            }
            elseif($status == 1){
                $ci->db->where(['status'=>$status]);
            }
            $ci->db->order_by('waktu','DESC');
            return $ci->db->get()->result();
        }
}
if ( ! function_exists('set_notification'))
{
    //data contain penerima, pengirim, pesan
    function set_notification($pengirim = null,$penerima = null,$pesan,$hal,$uri = null){
        $ci=& get_instance();
            $data = array('pengirim'=>$pengirim,'penerima'=>$penerima,'pesan'=>$pesan,'hal'=>$hal);
            if($uri != null){
            	$data['uri'] = $uri;
            }
            //@TODO:add validation, if data already set, then just doing nothing
            $ci->db->insert('tb_notification',$data);
        }
}
if ( ! function_exists('update_notification'))
{
    //data contain penerima, pengirim, pesan
    function update_notification($status,$hal,$penerima){
        $ci=& get_instance();
            $isRead = $status == 'read'?1:0;
            $data = array('status'=>$isRead);
            $where = array('hal'=>$hal,'penerima'=>$penerima);//TODO:change hal to pesan, cz pesan rarely same;
            $ci->db->update('tb_notification',$data,$where);
        }
}
if ( ! function_exists('clear_notification')) {
	//data contain penerima, pengirim, pesan
	function clear_notification($penerima) {
		$ci     =& get_instance();
		$isRead = 1;
		$where =array('penerima'=>$penerima);
		$data   = array( 'status' => $isRead );
		$ci->db->update( 'tb_notification', $data,$where );
	}
}

if ( ! function_exists('timediff_notification'))
{
    //data contain penerima, pengirim, pesan
    function timediff_notification($timeNotification){
        $ci=& get_instance();
            $now = new DateTime();
            $timeNotif = new DateTime($timeNotification);
            $timeDiff = $now->diff($timeNotif);
            $format = '%y years %m months %a days %h hours %i minutes ago';
            if($timeDiff->y == 0){
                $format = '%m months %a days %h hours %i minutes ago';
            }
            if ($timeDiff->m == 0) {
                $format = '%a days %h hours %i minutes ago';    
            }
            if ($timeDiff->d == 0){
                $format = '%h hours %i minutes ago';                
            }
            if ($timeDiff->h == 0){
                $format = '%i minutes ago';                                
            }
            return $timeDiff->format($format);
        }
}

?>
