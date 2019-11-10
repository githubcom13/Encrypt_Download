<?php
/**
 *
 * Encrypt Download. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Picaron, https://github.com/picaronin/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace pikaron\encryptdownload\core;

class functions_encryptdownload
{
	/** @var \phpbb\request\request */
	protected $request;

	/**
	* Constructor
	*
	* @param \phpbb\request\request $request
	* @access public
	*/
	public function __construct
	(
		\phpbb\request\request $request
	)
	{
		$this->request = $request;
	}

	public function EncodeString($string, $key)
	{
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted = openssl_encrypt($string, 'aes-256-cbc', $key, 0, $iv);
		return rtrim(strtr(base64_encode($encrypted . '::' . $iv), '+/', '-_'), '=');
	}

	public function DecodeString($string, $key)
	{
		list($encrypted_data, $iv) = explode('::', base64_decode(strtr($string, '-_', '+/')), 2);
		return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
	}

	public function Url_Info($url = null)
	{
		$filename = $mimeType = '';
		$size = 0;

		// Verify if the URL is valid
		if (filter_var($url, FILTER_VALIDATE_URL))
		{
			$headers = @get_headers($url);
			if (isset($headers[0]) && strpos($headers[0], ' 200 OK') !== false)
			{
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_TIMEOUT_MS, 800);
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT_MS, 800);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_NOBODY, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$head = curl_exec($ch);

				$mimeType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
				$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
				$path = parse_url($url, PHP_URL_PATH);
				$filename = substr($path, strrpos($path, '/') + 1);

				curl_close($ch);
			}
		}

		return array ($filename, $mimeType, $size);
	}

	// Convert Bytes
	public function bytes_to_MB($size)
	{
		$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
		$base = 1024;
		$class = min((int)log($size , $base) , count($si_prefix) - 1);

		if ($size < 1)
		{
			$size = sprintf('%1.2f' , '0.00') . ' MB';
		}
		else
		{
			$size = sprintf('%1.2f' , $size / pow($base,$class)) . ' ' . $si_prefix[$class];
		}
		return $size;
	}

	// Get Substrings of the String
	function Get_Substrings($text, $sopener, $scloser)
	{
		$result = array();

		$noresult = substr_count($text, $sopener);
		$ncresult = substr_count($text, $scloser);

		if ($noresult < $ncresult)
		{
			$nresult = $noresult;
		}
		else
		{
			$nresult = $ncresult;
		}

		unset($noresult);
		unset($ncresult);

		for ($i=0;$i<$nresult;$i++)
			{
				$pos = strpos($text, $sopener) + strlen($sopener);
				$text = substr($text, $pos, strlen($text));
				$pos = strpos($text, $scloser);
				$result[] = substr($text, 0, $pos);
				$text = substr($text, $pos + strlen($scloser), strlen($text));
			}
		return $result;
	}

}
