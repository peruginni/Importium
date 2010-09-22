<?php

/**
 * Text
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class Text
{
    
    /**#@+ Character sets identifiers */
	const ALPHANUMERIC = 'alphanumeric';
	/**#@-*/

    /**
     * Create random string
     *
     * @param string $characterSet possibilites defined in class constants
     * @param int $length length of output string
     * @return string
     */
    static function random($characterSet = null, $length=4)
	{
        if($characterSet === null) {
            $characterSet = self::ALPHANUMERIC;
        }

		$characters = '';
		switch($characterSet) {
			case self::ALPHANUMERIC:
				$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
				break;
		}
		$charactersLength = strlen($characters);

		$output = '';
		while(strlen($output)!=$length) {
			$position = mt_rand(0, $charactersLength-1);
			$output .= $characters[$position];
		}
		return $output;
	}

	/**
	 * Kohana Framework 
	 *
	 * Returns human readable sizes.
	 * @see  Based on original functions written by:
	 * @see  Aidan Lister: http://aidanlister.com/repos/v/function.size_readable.php
	 * @see  Quentin Zervaas: http://www.phpriot.com/d/code/strings/filesize-format/
	 *
	 * @param   integer  size in bytes
	 * @param   string   a definitive unit
	 * @return  string
	 */
	public static function bytes($bytes, $force_unit = NULL, $format = NULL, $si = TRUE)
	{
		// Format string
		$format = ($format === NULL) ? '%01.2f %s' : (string) $format;

		// IEC prefixes (binary)
		if ($si == FALSE OR strpos($force_unit, 'i') !== FALSE)
		{
			$units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
			$mod   = 1024;
		}
		// SI prefixes (decimal)
		else
		{
			$units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
			$mod   = 1000;
		}

		// Determine unit to use
		if (($power = array_search((string) $force_unit, $units)) === FALSE)
		{
			$power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
		}

		return sprintf($format, $bytes / pow($mod, $power), $units[$power]);
	}


    /**
     * Convert text to URL-like format
     * @param string $string text to convert to url-like format
     * @return string converted text
     */
	static function urilize($string)
	{
		$string = self::cs_utf2ascii($string);
		$string = strtolower($string);

        $string = preg_replace('/.[^abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-]/', '', $string);

		$string = str_replace(' ', '_', $string);
		$string = str_replace("\n", '_', $string);
		$string = str_replace('__', '_', $string);

		return $string;
	}

    
    /**
     * Convert text from utf8 to ascii (safe handling with diacrtical chars)
     *
     * @copyright dgx http://latrine.dgx.cz/odstraneni-diakritiky-z-ruznych-kodovani
     * @staticvar array $tbl
     * @param string $s text to convert
     * @return string converted text
     */
    public static function cs_utf2ascii($s)
    {
        static $tbl = array(
            "\xc3\xa1"=>"a","\xc3\xa4"=>"a","\xc4\x8d"=>"c","\xc4\x8f"=>"d",
            "\xc3\xa9"=>"e","\xc4\x9b"=>"e","\xc3\xad"=>"i","\xc4\xbe"=>"l",
            "\xc4\xba"=>"l","\xc5\x88"=>"n","\xc3\xb3"=>"o","\xc3\xb6"=>"o",
            "\xc5\x91"=>"o","\xc3\xb4"=>"o","\xc5\x99"=>"r","\xc5\x95"=>"r",
            "\xc5\xa1"=>"s","\xc5\xa5"=>"t","\xc3\xba"=>"u","\xc5\xaf"=>"u",
            "\xc3\xbc"=>"u","\xc5\xb1"=>"u","\xc3\xbd"=>"y","\xc5\xbe"=>"z",
            "\xc3\x81"=>"A","\xc3\x84"=>"A","\xc4\x8c"=>"C","\xc4\x8e"=>"D",
            "\xc3\x89"=>"E","\xc4\x9a"=>"E","\xc3\x8d"=>"I","\xc4\xbd"=>"L",
            "\xc4\xb9"=>"L","\xc5\x87"=>"N","\xc3\x93"=>"O","\xc3\x96"=>"O",
            "\xc5\x90"=>"O","\xc3\x94"=>"O","\xc5\x98"=>"R","\xc5\x94"=>"R",
            "\xc5\xa0"=>"S","\xc5\xa4"=>"T","\xc3\x9a"=>"U","\xc5\xae"=>"U",
            "\xc3\x9c"=>"U","\xc5\xb0"=>"U","\xc3\x9d"=>"Y","\xc5\xbd"=>"Z"
        );
        return strtr($s, $tbl);
    }

}


