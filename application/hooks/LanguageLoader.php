<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('menu',$siteLang);
			$ci->lang->load('puzzle',$siteLang);
			$ci->lang->load('leftsidebar',$siteLang);
			$ci->lang->load('myprofile',$siteLang);
			$ci->lang->load('rightsidebar',$siteLang);
			$ci->lang->load('index',$siteLang);
			$ci->lang->load('footer',$siteLang);
        } else {
            $ci->lang->load('menu','english');
			//$ci->lang->load('menu','kannada');
			$ci->lang->load('puzzle','english');
			$ci->lang->load('leftsidebar','english');
			$ci->lang->load('myprofile','english');
			$ci->lang->load('rightsidebar','english');
			$ci->lang->load('index','english');
			$ci->lang->load('footer','english');
        }
    }
}

?>