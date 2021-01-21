<?php

/*

Plugin Name: MD5 password

Plugin URI: http://

Description: Данный плагин позволяет генерировать пароли. Для отображения плагина разместите  шорт-код на любой странице или записи: [md5-password]

Version: 1.0

Author: Vadim Denisov

Author email: denisovvsh@gmail.com

	Copyright 2020  Vadim Denisov  (email: denisovvsh@gmail.com)



    This program is free software; you can redistribute it and/or modify

    it under the terms of the GNU General Public License as published by

    the Free Software Foundation; either version 2 of the License, or

    (at your option) any later version.



    This program is distributed in the hope that it will be useful,

    but WITHOUT ANY WARRANTY; without even the implied warranty of

    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

    GNU General Public License for more details.



    You should have received a copy of the GNU General Public License

    along with this program; if not, write to the Free Software

    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

define( 'MD5_VERSION', '1.0.1' );

define( 'MD5_REQUIRED_WP_VERSION', '4.9' );

define( 'MD5_PLUGIN', __FILE__ );

define( 'MD5_PLUGIN_BASENAME', plugin_basename( MD5_PLUGIN ) );

define( 'MD5_PLUGIN_NAME', trim( dirname( MD5_PLUGIN_BASENAME ), '/' ) );

define( 'MD5_PLUGIN_DIR', untrailingslashit( dirname( MD5_PLUGIN ) ) );

define( 'MD5_PLUGIN_DIR_HTTP', plugins_url('', MD5_PLUGIN));

define( 'MD5_PLUGIN_DIR_HTTP_ONLY_PATH', str_replace(get_site_url(), "", MD5_PLUGIN_DIR_HTTP));

require_once MD5_PLUGIN_DIR . '/function.php';
require_once MD5_PLUGIN_DIR . '/action-gen-pass.php';

function md5_pass_shortcode($attr) {
    if( !is_admin() ){
	   return apply_filters('gen_pass_hook', '');
    }
}
add_shortcode('md5-password', 'md5_pass_shortcode');



?>