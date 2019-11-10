<?php
/**
 *
 * Encrypt Download. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Picaron, https://github.com/picaronin/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ENCRYPTD_TITLE_LINK'		=> 'Download Link to Encrypt',
	'ENCRYPTD_LINK_EXPLAIN'		=> 'Enter the external download link and click on the “Accept” button to continue.',
	'ENCRYPTD_ADD_LINK'			=> 'Download Link',
	'ENCRYPTD_ALERT_URL'		=> '<strong>ATTENTION:</strong> You must enter a valid URL !!!',
	'ENCRYPTD_TITLE'			=> 'Enter the Link Data to Encrypt',
	'ENCRYPTD_NAME_FILE'		=> 'File Description:',
	'ENCRYPTD_FULL_URL'			=> 'Full URL of Download Link:',
	'ENCRYPTD_BUTTON'			=> 'Accept',
	'ENCRYPTD_EXPLAIN'			=> '<i>Note: The link will be ENCRYPTED. Save the link data, they cannot be recovered from now on.</i>',
	'ENCRYPTD_CORRECT'			=> 'Link successfully encrypted !!!',
	'ENCRYPTD_TITLE_BOX3'		=> 'Download Link Data:',
	'ENCRYPTD_OTHER'			=> 'Add another Link ??',
	'ENCRYPTD_TO_POST'			=> 'Add Link',
	'ENCRYPTD_ERROR'			=> 'Missing data to be able to manage the Download Link.<strong>You must reload the Page</strong>!!!!',
	'ENCRYPTD_FORUM_NOT_SAME'	=> 'This Domain does not have the necessary permissions to download the File.<br>The Download link belongs to the Domain: “%s”',
	'ENCRYPTD_USER_NOT_ALLOW'	=> 'You do not have the necessary permissions in this Forum to download the File',
	'ENCRYPTD_FORUM_NOT_ID'		=> 'This Forum cannot manage the download of the Archive.<br>This Download link belongs to the Forum with ID: “%s”',
	'ENCRYPTD_FORUM_ID'			=> '“%s in Forum ID: %s”',
	'ENCRYPTD_FILE_DESC'		=> 'Description:',
	'ENCRYPTD_FILE_FILE'		=> 'File:',
	'ENCRYPTD_FILE_MIME'		=> 'MIME Type:',
	'ENCRYPTD_FILE_SIZE'		=> 'Size:',
	'ENCRYPTD_LINK_DONWLOAD'	=> 'Download File - >>',
	'ENCRYPTD_LINK_ENABLED'		=> 'Download Enabled for',
	'ENCRYPTD_LINK_DISABLED'	=> 'Download DISABLED. Owner',
	'ENCRYPTD_LINK_ERROR'		=> 'Download Link is Corrupt.',
	'ENCRYPTD_LINK_ERROR_TIT'	=> 'ERROR ::: Download DISABLED',
	'ENCRYPTD_FINISH'			=> 'The process has been completed. Click on the “Add Link” button to make a copy of the Encrypted link in the body of the Message.',
	'ENCRYPTD_ALERT_FORUM'		=> '<strong>ATTENTION:</strong> You do not have sufficient permissions to create links with the “Encrypt Download” Extension in this Forum.',
	'ENCRYPTD_LNG_VERSION'		=> 'Version',
	'ENCRYPTD_PHPBB_ERROR'		=> '“Encrypt Download” cannot be installed.<br><br> - PhpBB 3.2.4 or later is required.',
	'ENCRYPTD_PHP_ERROR'		=> '“Encrypt Download” cannot be installed.<br><br> - Php 5.6 or later is required.',
	'ENCRYPTD_OLD_VERSION'		=> '“Encrypt Download” cannot be installed.<br><br>There is an outdated version of the installed extension.<br><br>Before installing the new version, it is necessary to completely uninstall the EncryptDownload_%1$s version.<br><br>You can download the obsolete version from the following link <a href="http://www.siteproall.com/pikaron/encryptdownload/EncryptDownload_%2$s.zip">Download EncryptDownload_%3$s</a>.',

	// Permissions
	'ACL_F_CREATE_ENCRYPTD'		=> 'Can CREATE links for “Encrypt Download” in the Forum',
	'ACL_F_SHOW_ENCRYPTD'		=> 'Can ACCESS the “Encrypt Download” links in the Forum',
));
