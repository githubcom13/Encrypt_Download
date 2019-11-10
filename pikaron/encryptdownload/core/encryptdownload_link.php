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

class encryptdownload_link
{
	/** @var functions */
	protected $functions_encryptdownload;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpBB root path */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \pikaron\encryptdownload\core\functions_encryptdownload		$functions_encryptdownload
	* @param \phpbb\template\template										$template
	* @param \phpbb\language\language										$language
	* @param \phpbb\auth\auth												$auth
	* @param \phpbb\request\request											$request
	* @param \phpbb\user													$user
	* @param string															$root_path
	* @param string															$php_ext
	*
	*/
	public function __construct(
		\pikaron\encryptdownload\core\functions_encryptdownload $functions_encryptdownload,
		\phpbb\template\template $template,
		\phpbb\language\language $language,
		\phpbb\auth\auth $auth,
		\phpbb\request\request $request,
		\phpbb\user $user,
		$root_path,
		$php_ext
	)
	{
		$this->functions_encryptdownload	= $functions_encryptdownload;
		$this->template						= $template;
		$this->language						= $language;
		$this->auth							= $auth;
		$this->request						= $request;
		$this->user							= $user;
		$this->root_path					= $root_path;
		$this->php_ext						= $php_ext;
	}

	function input()
	{
		// Take forum_id
		$string = str_replace('&amp;', '&', $this->request->server('HTTP_REFERER'));
		$str = explode('?', $string);
		parse_str($str[1], $var);

		$forumid = isset($var['f']) ? $var['f'] : $this->user->data['session_forum_id'];

		$this->template->assign_vars(array(
			'ENCRYPTD_TEMPLATE_INPUT'	=> true,
			'ENCRYPTD_TEMPLATE_MAKE'	=> false,
			'ENCRYPTD_FORUM_ID_ERROR'	=> (!$forumid) ? true : false,
			'ENCRYPTD_FORUM_CREATE'		=> ($this->auth->acl_get('f_create_encryptdownload', $forumid)) ? true : false,
			'ENCRYPTD_URL_MAKE'			=> "{$this->root_path}app.{$this->php_ext}/encryptdownload/make",
		));

		// Generate the page
		page_header($this->language->lang('ENCRYPTD_ADD_LINK'));

		// Generate the page template
		$this->template->set_filenames(array(
			'body'	=> 'encryptdownload/encryptdownload_link.html'
		));

		page_footer();
	}

	function make()
	{
		$url		= trim($this->request->variable('encryptdownload', ''));
		$namefile	= trim($this->request->variable('namefile', 'undefined'));

		// Take forum_id
		$string = str_replace('&amp;', '&', $this->request->server('HTTP_REFERER'));
		$str = explode('?', $string);
		parse_str($str[1], $var);
		$forumid = isset($var['f']) ? $var['f'] : $this->user->data['session_forum_id'];

		// Take domain
		$domain = ($this->request->server('SERVER_NAME')) ? str_replace('www.', '', $this->request->server('SERVER_NAME')) : 'encryptdownload';

		// Encode link
		$addowner		= $forumid . '|||' . $domain;
		$ownerencrypt	= $this->functions_encryptdownload->EncodeString($addowner, 'PiCaRoN');
		$addurl			= $url . '|||' . substr($namefile, 0, 140);
		$urlencrypt		= $this->functions_encryptdownload->EncodeString($addurl, $domain);
		$linkok			= '[encryptdownload]' . strrev($ownerencrypt) . 'PiCaRoN' . strrev($urlencrypt) . '[/encryptdownload]';

		$this->template->assign_vars(array(
			'ENCRYPTD_TEMPLATE_INPUT'	=> false,
			'ENCRYPTD_TEMPLATE_MAKE'	=> true,
			'ENCRYPTD_ERRORS'			=> (!$url) ? true : false,
			'ENCRYPTD_URL_MAKE'			=> "{$this->root_path}app.{$this->php_ext}/encryptdownload/input",
			'LINK_OK'					=> $linkok,
		));

		// Generate the page
		page_header($this->language->lang('ENCRYPTD_ADD_LINK'));

		// Generate the page template
		$this->template->set_filenames(array(
			'body'	=> 'encryptdownload/encryptdownload_link.html'
		));

		page_footer();
	}
}
