<?php

define(LOGS_BASE, "logs/");

class LogFile {
	var $logName;

	function LogFile($fileName = NULL) {
		$this->logName = LOGS_BASE . $fileName;
		if (!file_exists($this->logName)) {
			if (!$fp = fopen($this->logName, "w")) {
				fclose($fp);
			}
		}
	}

	function write($message)
	{
		if (!is_writeable($this->logName)) {
			return false;
		}
		if (!$fp = fopen($this->logName, "a")) {
			return false;
		}

		$ret = fwrite($fp, date("Y-m-d h:m:s"));
		$ret &= fwrite($fp, "\t");
		$ret &= fwrite($fp, $_SERVER['REMOTE_ADDR']);
		$ret &= fwrite($fp, "\t");
		$ret &= fwrite($fp, $_SERVER['HTTP_X_FORWARDED_FOR']);
		$ret &= fwrite($fp, "\t");
		$ret &= fwrite($fp, $message);
		$ret &= fwrite($fp, "\n\r");
		fclose($fp);

		return $ret;
	}

}

?>