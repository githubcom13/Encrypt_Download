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
	'ENCRYPTD_TITLE_LINK'		=> 'Enlace de Descarga para Encriptar',
	'ENCRYPTD_LINK_EXPLAIN'		=> 'Introduzca el enlace de descarga externo y haga clic en el botón “Aceptar” para continuar.',
	'ENCRYPTD_ADD_LINK'			=> 'Enlace de Descarga',
	'ENCRYPTD_ALERT_URL'		=> '<strong>ATENCION:</strong> ¡¡¡ Tiene que indicar una URL válida !!!',
	'ENCRYPTD_TITLE'			=> 'Introduzca los Datos del Enlace para Encriptar',
	'ENCRYPTD_NAME_FILE'		=> 'Descripción del Archivo:',
	'ENCRYPTD_FULL_URL'			=> 'URL completa del Enlace de Descarga:',
	'ENCRYPTD_BUTTON'			=> 'Aceptar',
	'ENCRYPTD_EXPLAIN'			=> '<i>Nota: El enlace va a ser ENCRIPTADO. Guarde los datos del enlace, en delante no se podrán recuperar.</i>',
	'ENCRYPTD_CORRECT'			=> '¡¡¡ Enlace Encriptado satisfactoriamente !!!',
	'ENCRYPTD_TITLE_BOX3'		=> 'Datos del Enlace de Descarga:',
	'ENCRYPTD_OTHER'			=> '¿¿ Agregar otro Enlace ??',
	'ENCRYPTD_TO_POST'			=> 'Agregar Enlace',
	'ENCRYPTD_ERROR'			=> '¡¡¡¡ Faltan datos para poder gestionar el Enlace de Descarga. <strong>Debe de recargar la Página</strong> !!!!',
	'ENCRYPTD_FORUM_NOT_SAME'	=> 'Este Dominio No tiene los permisos necesarios para descargar el Archivo.<br>El enlace de Descarga pertenece al Dominio: “%s”',
	'ENCRYPTD_USER_NOT_ALLOW'	=> 'Usted No tiene los permisos necesarios en este Foro para descargar el Archivo',
	'ENCRYPTD_FORUM_NOT_ID'		=> 'Este Foro No puede gestionar la descarga del Archivo.<br>Este enlace de Descarga pertenece al Foro con ID: “%s”',
	'ENCRYPTD_FORUM_ID'			=> '“%s en Foro ID: %s”',
	'ENCRYPTD_FILE_DESC'		=> 'Descripción:',
	'ENCRYPTD_FILE_FILE'		=> 'Archivo:',
	'ENCRYPTD_FILE_MIME'		=> 'Tipo MIME:',
	'ENCRYPTD_FILE_SIZE'		=> 'Tamaño:',
	'ENCRYPTD_LINK_DONWLOAD'	=> 'Descargar Archivo -->>',
	'ENCRYPTD_LINK_ENABLED'		=> 'Descarga Habilitada para',
	'ENCRYPTD_LINK_DISABLED'	=> 'Descarga DESHABILITADA. Propietario',
	'ENCRYPTD_LINK_ERROR'		=> 'El Enlace de Descarga está Corrupto.',
	'ENCRYPTD_LINK_ERROR_TIT'	=> 'ERROR ::: Descarga DESHABILITADA',
	'ENCRYPTD_FINISH'			=> 'Ha concluido el proceso. Haga click en el botón “Agregar Enlace” para realizar una copia del enlace Encriptado en el cuerpo del Mensaje.',
	'ENCRYPTD_ALERT_FORUM'		=> '<strong>ATENCION:</strong> Usted no tiene permisos suficientes para crear enlaces con la Extensión “Encrypt Download” en este Foro.',
	'ENCRYPTD_LNG_VERSION'		=> 'Versión',
	'ENCRYPTD_PHPBB_ERROR'		=> '“Encrypt Download” no se puede instalar.<br><br>- Se requiere phpBB 3.2.4 o posterior.',
	'ENCRYPTD_PHP_ERROR'		=> '“Encrypt Download” no se puede instalar.<br><br>- Se requiere php 5.6 o posterior.',
	'ENCRYPTD_OLD_VERSION'		=> '“Encrypt Download” no se puede instalar.<br><br>Existe una versión obsoleta de la extension instalada.<br><br>Antes de instalar la nueva version, es necesario desinstalar completamente la version EncryptDownload_%1$s<br><br>Puede descargar la version obsoleta desde el siguiente enlace <a href="http://www.siteproall.com/pikaron/encryptdownload/EncryptDownload_%2$s.zip">Descargar EncryptDownload_%3$s</a>.',

	// Permissions
	'ACL_F_CREATE_ENCRYPTD'		=> 'Puede CREAR enlaces para “Encrypt Download” en el Foro',
	'ACL_F_SHOW_ENCRYPTD'		=> 'Puede ACCEDER a los enlaces de “Encrypt Download” en el Foro',
));
