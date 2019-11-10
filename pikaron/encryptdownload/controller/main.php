<?php
/**
 *
 * Encrypt Download. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Picaron, https://github.com/picaronin/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace pikaron\encryptdownload\controller;

class main
{
	/** @var \pikaron\encryptdownload\core\encryptdownload_link */
	protected $encryptdownload_link;

	/**
	* Constructor
	*
	* @var \pikaron\encryptdownload\core\encryptdownload_link		  $encryptdownload_link
	*
	*/
	public function __construct(
		\pikaron\encryptdownload\core\encryptdownload_link $encryptdownload_link
	)
	{
		$this->encryptdownload_link = $encryptdownload_link;
	}

	public function handle($mode = '')
	{
		$mode = trim($mode);

		if (!$mode)
		{
			trigger_error('ENCRYPTD_ERROR');
		}

		switch ($mode)
		{
			case 'input':
				$this->encryptdownload_link->input();
			break;

			case 'make':
				$this->encryptdownload_link->make();
			break;
		}
	}
}
