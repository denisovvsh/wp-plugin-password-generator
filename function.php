<?php
function md5_password_activate() { 

  add_option( 'Activated_Plugin', 'Plugin-Slug' );

  /* activation code here */
}
register_activation_hook( MD5_PLUGIN, 'md5_password_activate' );

function md5_password_DEactivate() {

  delete_option( 'Activated_Plugin');

  /* DEactivation code here */
}
register_deactivation_hook( MD5_PLUGIN, 'md5_password_DEactivate' );

function md5_head_css() {
	wp_enqueue_style( 'md5_style_bootstrap', MD5_PLUGIN_DIR_HTTP.'/bootstrap.css'); 
}
add_action('wp_enqueue_scripts', 'md5_head_css' );

function md5_head_js() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'md5_function_js', MD5_PLUGIN_DIR_HTTP.'/function.js');
}
add_action('wp_enqueue_scripts', 'md5_head_js' );

function md5_ajax_data(){ 
	wp_localize_script( 'md5_function_js', 'ajax', 
		array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		)
	);
}
add_action('wp_enqueue_scripts', 'md5_ajax_data', 99 );

function md5_gen_pass_callback() {
	check_ajax_referer( 'ajax-nonce', 'nonce_code' );

	$key = preg_match("/^[\d]+$/i", $_POST['key']) ? (integer)$_POST['key'] : (integer)1234;
	$count_simbols = preg_match("/^[\d]+$/i", $_POST['count_simbols']) ? (integer)$_POST['count_simbols'] : (integer)6;

	if($count_simbols < 101 && $count_simbols > 3){
		$arr = md5_rand_string($key, $count_simbols);
	}else{
		$arr = array(2);
	}

	echo json_encode($arr);

	wp_die();
}

function md5_rand_string($key, $count_simbols) {
    $char = array(
    	1 => array('0123456789'), 
    	2 => array('abcdefghijklmnopqrstuvwxyz'), 
    	3 => array('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 
    	4 => array('`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\'), 
    	12 => array('0123456789', 'abcdefghijklmnopqrstuvwxyz'), 
    	13 => array('0123456789', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 
    	14 => array('0123456789','`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\'), 
    	23 => array('abcdefghijklmnopqrstuvwxyz', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 
    	24 => array('abcdefghijklmnopqrstuvwxyz', '`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\'), 
    	34 => array('ABCDEFGHIJKLMNOPQRSTUVWXYZ', '`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\'), 
    	123 => array('0123456789', 'abcdefghijklmnopqrstuvwxyz', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 
    	124 => array('0123456789', 'abcdefghijklmnopqrstuvwxyz', '`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\'), 
    	134 => array('0123456789', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\'), 
    	234 => array('abcdefghijklmnopqrstuvwxyz', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\'), 
    	1234 => array('0123456789', 'abcdefghijklmnopqrstuvwxyz', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '`~!@#$%^&*()_-+={[:;"\'<>,.?/|]}\\')
    );
    
    $arr = array();
    for ($n = 0; $n < 10; $n++) {
    	$randstring = '';
	    for ($i = 0; $i < $count_simbols; $i++) {
	    	$str = (integer)rand(0, (count($char[$key])-1));
	    	$position = (integer)rand( 0, (strlen($char[$key][$str])-1) );
	    	$simbol = $char[$key][$str]{$position};
	        $randstring .= $simbol;
	    }
		array_push( $arr, esc_html($randstring) );   
	}
	
	return $arr;
	wp_die();
}

function md5_gen_hash_callback() {
	check_ajax_referer( 'ajax-nonce', 'nonce_code' );

	$str = !empty($_POST['str_for_md5']) ? md5($_POST['str_for_md5']) : false;
	
	if($str){
		$arr = array($str);
	}else{
		$arr = array(2);
	}

	echo json_encode($arr);
	wp_die();
}