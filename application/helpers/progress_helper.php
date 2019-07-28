<?php
if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}
//change name to snake case

if ( ! function_exists( 'getProgress' ) ) {
	function getProgress( $status ) {
		switch ($status){
			case 'proses':
				$percent = 20;
				break;
			case 'cetak':
				$percent = 50;
				break;
			case 'kirim':
				$percent = 75;
				break;
			case 'pending':
				$percent = 95;
				break;
			case 'terima':
				$percent = 100;
				break;
			case 'tolak':
				$percent = 98;
				break;
			default : $percent = 0;
		}
		return $percent;
	}
}