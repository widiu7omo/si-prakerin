<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
if (!function_exists('getmenu')) {
	function getmenu($level)
	{
		$menus = array();
		switch ($level):
			case 'admin':
				$menus = array();
				break;
			case 'dosen':
				$menus = array(
					(object)array('name' => 'Bimbingan',
						'icon' => 'collection',
						'color' => 'pink',
						'href' => site_url('bimbingan')),
					(object)array('name' => 'Seminar',
						'icon' => 'calendar-grid-58',
						'color' => 'green',
						'href' => site_url('sidang'))
				);
				break;
			case 'mahasiswa':
				$menus = array(
					(object)array('name' => 'Magang',
						'icon' => 'building',
						'color' => 'orange',
						'href' => site_url('magang')),
					(object)array('name' => 'Bimbingan',
						'icon' => 'collection',
						'color' => 'pink',
						'href' => site_url('bimbingan')),
					(object)array('name' => 'Laporan',
						'icon' => 'book-bookmark',
						'color' => 'info',
						'href' => site_url('laporan')),
					(object)array('name' => 'Sidang',
						'icon' => 'calendar-grid-58',
						'color' => 'green',
						'href' => site_url('sidang'))
				);
				break;
			default:
				break;
		endswitch;
		return $menus;
	}
}
