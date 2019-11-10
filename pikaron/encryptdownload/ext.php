<?php
/**
 *
 * Encrypt Download. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Picaron, https://github.com/picaronin/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace pikaron\encryptdownload;

/**
* Extension class No DEA Emails for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
	/**
	* Check whether or not the extension can be enabled.
	* @return bool
	* @access public
	*/
	public function is_enableable()
	{
		$config = $this->container->get('config');
		$language = $this->container->get('language');
		$language->add_lang('encryptdownload', 'pikaron/encryptdownload');

		// Verify if there is a previous version 1.0.0 are installed
		if (isset($config['version_encryptdownload']) && $config['version_encryptdownload'] == '1.0.0')
		{
			trigger_error($language->lang('ENCRYPTD_OLD_VERSION', $config['version_encryptdownload'], $config['version_encryptdownload'], $config['version_encryptdownload']), E_USER_WARNING);
		}

		/**
		 * Check phpBB requirements
		 *
		 * Requires phpBB 3.2.4 or greater
		 *
		 * @return bool
		 */
		$is_ver_phpbb = phpbb_version_compare($config['version'], '3.2.4', '>=');

		// Display a custom warning message if requirement fails.
		if (!$is_ver_phpbb)
		{
			trigger_error($language->lang('ENCRYPTD_PHPBB_ERROR'), E_USER_WARNING);
		}

		/**
		 * Check PHP requirements
		 *
		 * Requires PHP 5.6.0 or greater
		 *
		 * @return bool
		 */
		$is_ver_php = phpbb_version_compare(PHP_VERSION, '5.6.0', '>=');

		// Display a custom warning message if requirement fails.
		if (!$is_ver_php)
		{
			trigger_error($language->lang('ENCRYPTD_PHP_ERROR'), E_USER_WARNING);
		}

		return $is_ver_phpbb && $is_ver_php;

	}
}
