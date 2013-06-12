<?php

/**
 * Description of BPMediaUploadShortcode
 *
 * @author joshua
 */
class RTMediaUploadShortcode {

    var $add_sc_script = false;
	var $deprecated = false;

    public function __construct() {
		
        add_shortcode('rtmedia_uploader', array($this, 'pre_render'));
		$method_name = strtolower(str_replace('RTMedia', '', __CLASS__));

		if(is_callable("RTMediaDeprecated::{$method_name}",true, $callable_name)){
			$this->deprecated=RTMediaDeprecated::$method_name();
		}
		
        // add_action('init', array($this, 'register_script'));
        //add_action('wp_footer', array($this, 'print_script'));
    }
	
	function display_allowed() {
		
		$flag = (!(is_home() || is_post_type_archive())) && is_user_logged_in();
		
		$flag = apply_filters('before_rtmedia_uploader_display', $flag);
		return $flag;
	}

    function pre_render($attr) {

		if( $this->display_allowed() ) {
			$this->add_sc_script = true;
			RTMediaUploadTemplate::render($attr);
		}
    }
	
	
	
	

    

}

?>
