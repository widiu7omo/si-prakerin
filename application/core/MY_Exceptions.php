<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extending the default errors to always give JSON errors
 *
 * @author Oliver Smith
 */

class MY_Exceptions extends CI_Exceptions
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * 404 Page Not Found Handler
	 *
	 * @param   string  the page
	 * @param   bool    log error yes/no
	 * @return  string
	 */
	function show_404($page = '', $log_error = TRUE)
	{
		// By default we log this, but allow a dev to skip it
		if ($log_error)
		{
			log_message('error', '404 Page Not Found --> '.$page);
		}

		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		header('HTTP/1.1 404 Not Found');

		echo json_encode(
			array(
				'status' => FALSE,
				'error' => 'Unknown method',
			)
		);

		exit;
	}

	/**
	 * General Error Page
	 *
	 * This function takes an error message as input
	 * (either as a string or an array) and displays
	 * it using the specified template.
	 *
	 * @access  private
	 * @param   string  the heading
	 * @param   string  the message
	 * @param   string  the template name
	 * @param   int     the status code
	 * @return  string
	 */
	function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		header('HTTP/1.1 500 Internal Server Error');

		echo json_encode(
			array(
				'status' => FALSE,
				'error' => array('heading'=>$heading,'message'=>$message),
			)
		);

		exit;
	}

	/**
	 * Native PHP error handler
	 *
	 * @access  private
	 * @param   string  the error severity
	 * @param   string  the error string
	 * @param   string  the error filepath
	 * @param   string  the error line number
	 * @return  string
	 */
	function show_php_error($severity, $message, $filepath, $line)
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		header('HTTP/1.1 500 Internal Server Error');

		echo json_encode(
			array(
				'status' => FALSE,
				'error' => array('serverity'=>$severity,'message'=>$message,'path'=>$filepath,'line'=>$line),
			)
		);

		exit;
	}
}

?>
