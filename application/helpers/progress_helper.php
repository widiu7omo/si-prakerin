<?php
if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}
//change name to snake case

if ( ! function_exists( 'getProgress' ) ) {
	function getProgress( $status ) {
		$progress_percentage = 100/5;
		switch ($status){
			case 'proses':
				$percent = $progress_percentage;
				break;
			case 'cetak':
				$percent = $progress_percentage*2;
				break;
			case 'kirim':
				$percent = $progress_percentage*3;
				break;
			case 'pending':
				$percent = $progress_percentage*4;
				break;
			case 'terima':
				$percent = $progress_percentage*5;
				break;
			case 'tolak':
				$percent = 98;
				break;
			default : $percent = 0;
		}
		return $percent;
	}
}
