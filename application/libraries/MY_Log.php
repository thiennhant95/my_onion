<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY Log Class
 */
class MY_Log extends CI_Log {

    public  $_levels = array('BATCH' => '0', 'ERROR' => '1', 'INFO' => '2',  'DEBUG' => '3', 'ALL' => '4');

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	// --------------------------------------------------------------------

	/**
	 * @override
	 * Write Log File
	 *
	 * Generally this function will be called using the global log_message() function
	 *
	 * @param	string	the error level
	 * @param	string	the error message
	 * @param	bool	whether the error is a native PHP error
	 * @param	string	the prefix of log
	 * @return	bool
	 */
	public function write_log($level = 'error', $msg, $php_error = FALSE, $prefix = 'system', $ignore_level = false)
	{
		if ($this->_enabled === FALSE)
		{
			return FALSE;
		}

		$level = strtoupper($level);

		if (!$ignore_level) {
			if ( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
			{
				return FALSE;
			}
		}

		$filepath = $this->_log_path . $prefix . '.log';
		$message  = '';

		if ( ! file_exists($filepath))
		{
			$message .= "<"."?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?".">\n\n";
		}

		if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
		{
			return FALSE;
		}

		if (!$ignore_level)
		{
			$message .= $level.' '.(($level == 'INFO') ? ' -' : '-').' '.date($this->_date_fmt). ' --> '.$msg."\n";
		} else {
			$message .= date($this->_date_fmt). ' --> '.$msg."\n";
		}

		flock($fp, LOCK_EX);
		fwrite($fp, $message);
		flock($fp, LOCK_UN);
		fclose($fp);

		@chmod($filepath, FILE_WRITE_MODE);
		return TRUE;
	}

}
// END MY Log Class

/* End of file MY_Log.php */
/* Location: ./application/libraries/MY_Log.php */
