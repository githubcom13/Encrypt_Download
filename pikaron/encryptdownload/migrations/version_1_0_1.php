<?php
/**
 *
 * Encrypt Download. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Picaron, https://github.com/picaronin/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace pikaron\encryptdownload\migrations;

class version_1_0_1 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\v320');
	}

	public function update_data()
	{
		return array(
			// Add config
			array('config.add', array('version_encryptdownload', '1.0.1')),

			// Add permissions
			array('permission.add', array('f_show_encryptdownload', false)),
			array('permission.add', array('f_create_encryptdownload', false)),

			// Set permissions
			array('permission.permission_set', array('ROLE_FORUM_BOT', 'f_show_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_FULL', 'f_show_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_LIMITED', 'f_show_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_LIMITED_POLLS', 'f_show_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_NEW_MEMBER', 'f_show_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_NOACCESS', 'f_show_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_ONQUEUE', 'f_show_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_POLLS', 'f_show_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_READONLY', 'f_show_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_STANDARD', 'f_show_encryptdownload', 'role', true)),

			array('permission.permission_set', array('ROLE_FORUM_BOT', 'f_create_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_FULL', 'f_create_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_LIMITED', 'f_create_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_LIMITED_POLLS', 'f_create_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_NEW_MEMBER', 'f_create_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_NOACCESS', 'f_create_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_ONQUEUE', 'f_create_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_POLLS', 'f_create_encryptdownload', 'role', true)),
			array('permission.permission_set', array('ROLE_FORUM_READONLY', 'f_create_encryptdownload', 'role', false)),
			array('permission.permission_set', array('ROLE_FORUM_STANDARD', 'f_create_encryptdownload', 'role', true)),

			// Add encryptdownload bbcode
			array('custom', array(array($this, 'install_encryptdownload_bbcode'))),
		);
	}

	public function revert_data()
	{
		return array(
			// Delete config
			array('config.remove', array('version_encryptdownload')),

			// Remove permissions
			array('permission.remove', array('f_show_encryptdownload')),
			array('permission.remove', array('f_create_encryptdownload')),

			// Unset permissions
			array('permission.permission_unset', array('ROLE_FORUM_BOT', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_FULL', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_LIMITED', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_LIMITED_POLLS', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_NEW_MEMBER', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_NOACCESS', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_ONQUEUE', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_POLLS', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_READONLY', 'f_show_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_STANDARD', 'f_show_encryptdownload', 'role')),

			array('permission.permission_unset', array('ROLE_FORUM_BOT', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_FULL', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_LIMITED', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_LIMITED_POLLS', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_NEW_MEMBER', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_NOACCESS', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_ONQUEUE', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_POLLS', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_READONLY', 'f_create_encryptdownload', 'role')),
			array('permission.permission_unset', array('ROLE_FORUM_STANDARD', 'f_create_encryptdownload', 'role')),

			// Delete encryptdownload bbcode
			array('custom', array(array($this, 'remove_encryptdownload_bbcode'))),
		);
	}

	// Add encryptdownload bbcode
	public function install_encryptdownload_bbcode()
	{
		global $db;
		$functions_encryptdownload = new \pikaron\encryptdownload\includes\bbcode_installer($db, $this->phpbb_root_path, $this->php_ext);
		$functions_encryptdownload->install_bbcode();
	}

	// Delete encryptdownload bbcode
	public function remove_encryptdownload_bbcode()
	{
		global $db;
		$functions_encryptdownload = new \pikaron\encryptdownload\includes\bbcode_installer($db, $this->phpbb_root_path, $this->php_ext);
		$functions_encryptdownload->delete_bbcode();
	}
}
