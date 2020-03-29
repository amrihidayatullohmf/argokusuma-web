<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'core/APP_Core.php';
class APP_Frontend extends APP_Core {

	private $_template_folder = 'frontend';

	private $_logthis = true;

	var $_social_config = array();

    function __construct()
    {
        parent::__construct(array(
        	'folder' => $this->_template_folder,
        	'log' => $this->_logthis
        ));

        $this->load->model('user_model');

        $this->_social_config = $this->config->item('app_social');

        $this->load->library('social/facebook',array(
                'appId' => $this->_social_config['facebook']['appId'],
                'secret' => $this->_social_config['facebook']['secret']
            ));

        $this->_template_master_data['facebook_appid'] = $this->_social_config['facebook']['appId'];
    
        $this->_data['latestnews'] = $this->news->get_latest(3);
        $this->_template_master_data['latestnews'] = $this->_data['latestnews'];
    }

    public function generate_csrf($name) {
        $this->session->unset_userdata($name);
        $csrf_token = sha1(date('U').md5(date($name)));
        $this->session->set_userdata($name,$csrf_token);
        return $csrf_token;
    }

    public function is_match_token($name,$token) {
        $get = $this->session->userdata($name);

        if($get == FALSE) {
            return FALSE;
        }

        return ($get == $token) ? TRUE : FALSE;
    }
}