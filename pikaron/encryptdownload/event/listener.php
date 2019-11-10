<?php
/**
 *
 * Encrypt Download. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, pikaron, https://github.com/pikaronin/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace pikaron\encryptdownload\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var functions */
	protected $functions_encryptdownload;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpBB root path */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \pikaron\encryptdownload\core\functions_encryptdownload		$functions_encryptdownload
	* @param \phpbb\db\driver\driver_interface								$db
	* @param \phpbb\auth\auth												$auth
	* @param \phpbb\request\request											$request
	* @param \phpbb\config\config											$config
	* @param \phpbb\template\template										$template
	* @param string															$root_path
	* @param string															$php_ext
	*
	*/
	public function __construct(
		\pikaron\encryptdownload\core\functions_encryptdownload $functions_encryptdownload,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\auth\auth $auth,
		\phpbb\request\request $request,
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		$root_path,
		$php_ext
	)
	{
		$this->functions_encryptdownload	= $functions_encryptdownload;
		$this->db							= $db;
		$this->auth							= $auth;
		$this->request						= $request;
		$this->config						= $config;
		$this->template						= $template;
		$this->root_path					= $root_path;
		$this->php_ext						= $php_ext;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'user_setup',
			'core.text_formatter_s9e_render_after'		=> 'text_formatter_s9e_render_after',
			'core.posting_modify_template_vars'			=> 'posting_modify_template_vars',
			'core.permissions'							=> 'permissions',
		);
	}

	// Load Lenguage
	public function user_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'pikaron/encryptdownload',
			'lang_set' => 'encryptdownload',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	// Decrypt Links
	public function text_formatter_s9e_render_after($event)
	{
		$html = $event['html'];

		// Locate Links
		$matches = $this->functions_encryptdownload->Get_Substrings($html, '<encryptdownload>', '</encryptdownload>');

		if (count($matches))
		{
			// Take forum id
			$forumid = $this->request->variable('f', 0);

			if (!$forumid)
			{
				$post_id = $this->request->variable('p', 0);
				if ($post_id)
				{
					$sql = 'SELECT forum_id
						FROM ' . POSTS_TABLE . "
						WHERE post_id = $post_id";
					$result = $this->db->sql_query($sql);
					$row = $this->db->sql_fetchrow($result);
					$this->db->sql_freeresult($result);
					$forumid = (int) $row['forum_id'];
				}
				else
				{
					$topic_id = $this->request->variable('t', 0);
					if ($topic_id)
					{
						$sql = 'SELECT forum_id
							FROM ' . POSTS_TABLE . "
							WHERE topic_id = $topic_id";
						$result = $this->db->sql_query($sql);
						$row = $this->db->sql_fetchrow($result);
						$this->db->sql_freeresult($result);
						$forumid = (int) $row['forum_id'];
					}
				}
			}

			// Take domain
			$domain = ($this->request->server('SERVER_NAME')) ? str_replace('www.', '', $this->request->server('SERVER_NAME')) : 'encryptdownload';

			foreach ($matches as $text)
			{
				// Does not manage repeated links
				$pos = strpos($html, $text);
				if ($pos !== false)
				{
					$alldata = explode('PiCaRoN', $text);

					// Check Link
					if (!isset($alldata[0]) || !isset($alldata[1]))
					{
						$error_encrypt = true;
						$owner = $data = array();
					}
					else
					{
						$owner = explode('|||', $this->functions_encryptdownload->DecodeString(strrev($alldata[0]), 'PiCaRoN'));
						$data  = explode('|||', $this->functions_encryptdownload->DecodeString(strrev($alldata[1]), $domain));
						$error_encrypt = false;
					}

					$forumid_ED	 = isset($owner[0]) ? $owner[0] : '';
					$domain_ED	 = isset($owner[1]) ? $owner[1] : '';
					$url		 = isset($data[0]) ? $data[0] : '';
					$description = isset($data[1]) ? $data[1] : '';

					// Take info of file
					$filename = $mimeType = '';
					$size = 0;

					if ($domain == $domain_ED && $forumid == $forumid_ED)
					{
						list($filename, $mimeType, $size) = $this->functions_encryptdownload->Url_Info($url);
					}

					$this->template->assign_vars(array(
						'ENCRYPTD_FORUM_SHOW'	=> ($this->auth->acl_get('f_show_encryptdownload', $forumid)) ? true : false,
						'ENCRYPTD_FORUM_SAME'	=> ($domain == $domain_ED) ? true : false,
						'ENCRYPTD_FORUM_NOT_ID'	=> ($forumid == $forumid_ED) ? true : false,
						'ENCRYPTD_DATA_FILE'	=> ((int) $size > 1) ? true : false,
						'ENCRYPTD_DOMAIN'		=> $domain_ED,
						'ENCRYPTD_FORUM_ID'		=> $forumid_ED,
						'ENCRYPTD_URL_FILE'		=> $url,
						'ENCRYPTD_URL_FORUM_ID'	=> generate_board_url()."/viewforum.{$this->php_ext}?f=" . $forumid_ED,
						'ENCRYPTD_DESC_FILE'	=> $description,
						'ENCRYPTD_NAME_FILE'	=> ((int) $size > 1) ? $filename : $description,
						'ENCRYPTD_MIME_FILE'	=> $mimeType,
						'ENCRYPTD_SIZE_FILE'	=> $this->functions_encryptdownload->bytes_to_MB($size),
						'ENCRYPTD_ERROR'		=> $error_encrypt,
					));

					// Generate the page template
					$this->template->set_filenames(array(
						'encryptdownload'	=> '@pikaron_encryptdownload/encryptdownload/encryptdownload_download.html'
					));

					$content = $this->template->assign_display('encryptdownload', '', true);

					// Implode html
					$html = str_replace('<encryptdownload>' . $text . '</encryptdownload>', $content, $html);
				}
			}
			$event['html'] = $html;
		}
	}

	//	Posting Topic
	public function posting_modify_template_vars($event)
	{
		$this->template->assign_vars(array(
			'ENCRYPTD_LOAD_INIT'	=> "{$this->root_path}app.{$this->php_ext}/encryptdownload/input",
			'ENCRYPTD_VERSION'		=> $this->config['version_encryptdownload'],
		));
	}

	/**
	* Show permissions
	*/
	public function permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['f_create_encryptdownload'] = array('lang' => 'ACL_F_CREATE_ENCRYPTD', 'cat' => 'misc');
		$permissions['f_show_encryptdownload'] = array('lang' => 'ACL_F_SHOW_ENCRYPTD', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}
}
