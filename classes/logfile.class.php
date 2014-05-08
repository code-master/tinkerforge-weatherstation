<?php

/**
* Eine Klasse zum erstellen und loggen in Dateien.
*
* Bei der Initialisierung der Klasse wird der Ordner "log" erstellt, eine Ebene über der Document-root.
* Des weiteren wird eine Datei angelegt, deren Dateinamen aus dem Pfad und dem Name der loggenden Datei generiert wird.
*/
class Logfile
{
	function __construct()
	{
		$filename = str_replace('\\', '__', str_replace('/', '__', $_SERVER['PHP_SELF'])) . '.log';
		$dir = $_SERVER['DOCUMENT_ROOT'] . '/log';

		if (!is_dir($dir)) 
		{
			if (mkdir($dir))
			{
				chdir($dir);
			}
			else
			{
				exit("Das Logverzeichnis konnte nicht erstellt werden!\n");
			}
		}
		else
		{
			chdir($dir);
		}

		if (file_exists($filename)) 
		{
			if (is_writeable($filename)) 
			{
				$this->file = fopen($filename, 'a');
			}
			else
			{
				exit("Die Logdatei ist nicht beschreibbar! Bitte passen sie die Berechtigungen an.\n");
			}
		}
		elseif (!$this->file = fopen($filename, 'a')) 
		{
			exit("Die Logdatei konnte nicht erstellt werden.\n");
		}
	}

	/**
	 * Loggt die $infos in die Datei
	 * @param $infos = string or array
	 * @return bool
	 */
	public function log($infos)
	{
		if (is_array($infos)) 
		{
			foreach ($infos as $info) 
			{
				$this->log($info);
			}
			return true;
		}
		elseif (is_string($infos)) 
		{
			fwrite($this->file,	$infos . "\r\n");
			return true;
		}
		else
		{
			return false;
		}
	}

	function __destruct()
	{
		fclose($this->file);
	}
}