<?php

namespace heyAuto\DemoBundle\Crypto;

class MCrypt
{
	private $iv = 'fedcba9876543210'; #Same as in JAVA
	private $key = '0123456789abcdef'; #Same as in JAVA


	function __construct()
	{
	}

	/**
	 * @param string $str
	 * @param bool $isBinary whether to encrypt as binary or not. Default is: false
	 * @return string Encrypted data
	 */
	function encrypt($str, $isBinary = false)
	{
		echo "oryginal: ".$str."\n";
// 		$str = $this->stripPLAccents($str);
		$str = $this->PLAccentsToUnicode($str);
		echo "unicoded: ".$str."\n";
		
		$iv = $this->iv;
		$str = $isBinary ? $str : utf8_decode($str);

		$td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);

		mcrypt_generic_init($td, $this->key, $iv);
		$encrypted = mcrypt_generic($td, $str);

		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		return $isBinary ? $encrypted : bin2hex($encrypted);
	}

	/**
	 * @param string $code
	 * @param bool $isBinary whether to decrypt as binary or not. Default is: false
	 * @return string Decrypted data
	 */
	function decrypt($code, $isBinary = false)
	{
		$code = $isBinary ? $code : $this->hex2bin($code);
		$iv = $this->iv;

		$td = mcrypt_module_open('rijndael-128', ' ', 'cbc', $iv);

		mcrypt_generic_init($td, $this->key, $iv);
		$decrypted = mdecrypt_generic($td, $code);

		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);

		$dec = $isBinary ? trim($decrypted) : utf8_encode(trim($decrypted));
		$dec = $this->unicodeToPLAccents($dec);
		
		return $dec;
	}

	protected function hex2bin($hexdata)
	{
		$bindata = '';

		for ($i = 0; $i < strlen($hexdata); $i += 2) {
			$bindata .= chr(hexdec(substr($hexdata, $i, 2)));
		}

		return $bindata;
	}
	
	private function stripPLAccents($textToStrip) {
		$conversion_array = array(    
				'ę' => 'e',
				'Ę' => 'E',
				'ó' => 'o',
				'Ó' => 'O',
				'ą' => 'a',
				'Ą' => 'A',
				'ś' => 's',
				'Ś' => 'S',
				'ł' => 'l',
				'Ł' => 'L',
				'ż' => 'z',
				'Ż' => 'Z',
				'ź' => 'z',
				'Ź' => 'Z',
				'ć' => 'c',
				'Ć' => 'C',
				'ń' => 'n',
				'Ń' => 'N'
		);
		$stripped = strtr( $textToStrip, $conversion_array );
		
		return $stripped;
	}

	private function PLAccentsToUnicode($text) {
		$conversion_array = array(    
				'ę' => '&#281;',
				'Ę' => '&#280;',
				'ó' => '&#243;',
				'Ó' => '&#211;',
				'ą' => '&#261;',
				'Ą' => '&#260;',
				'ś' => '&#347;',
				'Ś' => '&#346;',
				'ł' => '&#322;',
				'Ł' => '&#321;',
				'ż' => '&#380;',
				'Ż' => '&#379;',
				'ź' => '&#378;',
				'Ź' => '&#377;',
				'ć' => '&#263;',
				'Ć' => '&#262;',
				'ń' => '&#324;',
				'Ń' => '&#323;'
		);
		$unicoded = strtr( $text, $conversion_array );
		
		return $unicoded;
		}	
	
	
		private function unicodeToPLAccents($text) {
			$conversion_array = array(
					'&#281;' => 'ę',
					'&#280;' => 'Ę',
					'&#243;' => 'ó',
					'&#211;' => 'Ó',
					'&#261;' => 'ą',
					'&#260;' => 'Ą',
					'&#347;' => 'ś',
					'&#346;' => 'Ś',
					'&#322;' => 'ł',
					'&#321;' => 'Ł',
					'&#380;' => 'ż',
					'&#379;' => 'Ż',
					'&#378;' => 'ź',
					'&#377;' => 'Ź',
					'&#263;' => 'ć',
					'&#262;' => 'Ć',
					'&#324;' => 'ń',
					'&#323;' => 'Ń'
			);
			$unicoded = strtr( $text, $conversion_array );
		
			return $unicoded;
		}
	}
