<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
//change name to snake case
if (!function_exists('masterdata')) {
	function masterdata($table, $where = null, $select = null, $resultArray = false, $order = null)
	{
		$ci =& get_instance();
		if ($select != null) {
			$ci->db->select($select);
		}

		if ($order) {
			$ci->db->order_by($order);
		}

		if ($where != null) {
			if ($resultArray) {
				return $ci->db->get_where($table, $where)->result();
			}

			return $ci->db->get_where($table, $where)->row();
		}

		return $ci->db->get($table)->result();
	}
}
if (!function_exists('getCurrentTahun')) {
	function getCurrentTahun()
	{
		$ci =& get_instance();
		$ci->db->select('tb_waktu.id_waktu as id,tahun_akademik.tahun_akademik as now,tahun_akademik.id_tahun_akademik as tahun_id')->from('tb_waktu')->join('tahun_akademik', 'tb_waktu.id_tahun_akademik = tahun_akademik.id_tahun_akademik', 'INNER');

		return $ci->db->get()->row();
	}
}

if (!function_exists('dynamic_insert')) {
	function dynamic_insert($table, $data)
	{
		$ci =& get_instance();
		$ci->db->insert($table, $data);
	}
}
if (!function_exists('custom_query')) {
	function custom_query($query, $resultArray = false)
	{
		$ci =& get_instance();
		if ($resultArray) {
			return $ci->db->query($query)->result();
		}
		return $ci->db->query($query)->row();
	}
}
if (!function_exists('convert_date')) {
	function convert_date($date, $format = 'long')
	{
		$month_name = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		if ($format == 'long') {
			$expleded = explode('-', $date);
			if (count($expleded) == 3) {
				return $expleded[2] . ' ' . $month_name[$expleded[1] - 1] . ' ' . $expleded[0];
			} else {
				return $date;
			}
		}
	}
}
if (!function_exists('explode_date')) {
	function explode_date($date)
	{
		$expleded = explode('T', $date);
		if (count($expleded) == 2) {
			return $expleded[0];
		} else {
			return $date;
		}
	}
}

if (!function_exists('get_time_range')) {
	function get_time_range($start, $end, $return)
	{
		$arrStart = explode('T', $start);
		$arrEnd = explode('T', $end);
		$dateStart = $arrStart[0];
		$dateEnd = $arrEnd[0];
		$timeStart = $arrStart[1];
		$timeEnd = $arrEnd[1];
		if ($return == 'time') {
			if ($start === "") {
				return null;
			}
			$arrTimeStart = explode(':', $timeStart);
			$arrTimeEnd = explode(':', $timeEnd);
			if ((count($arrTimeStart) === 3) and count($arrTimeEnd) === 3) {
				unset($arrTimeStart[2]);
				unset($arrTimeEnd[2]);
			}
			return implode(':', $arrTimeStart) . ' - ' . implode(':', $arrTimeEnd);
		}
		if ($return == 'start') {
			if ($start === "") {
				return null;
			}
			return $timeStart;
		}
		if ($return == 'end') {
			if ($start === "") {
				return null;
			}
			return $timeEnd;
		}
		if ($return == 'datestart') {
			return $dateStart;
		}
		if ($return == 'date') {
			return $dateStart . ' - ' . $dateEnd;
		}
	}
}

if (!function_exists('datajoin')) {
	function datajoin($table, $where = null, $select = null, $join = null, $orwhere = null, $order = null, $wherein = null, $group = null)
	{
		$ci =& get_instance();
		if ($select != null) {
			$ci->db->select($select);
		}
		if ($where != null) {
			$ci->db->where($where);
		}
		if ($orwhere != null) {
			$ci->db->or_where($orwhere);
		}
		if ($wherein != null) {
			$ci->db->where_in($wherein[0], $wherein[1], false);
		}
		if ($join != null) {
			if (is_array($join[0])) {
				foreach ($join as $jo) {
					$ci->db->join($jo[0], $jo[1], $jo[2]);
				}
			} else {
				$ci->db->join($join[0], $join[1], $join[2]);
			}
		}
		if ($group != null) {
			$ci->db->group_by($group);
		}
		if ($order != null) {
			$ci->db->order_by($order);
		}
		return $ci->db->from($table)->get()->result();

	}
}
/* End of file ModelName.php */
?>
