<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Home extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->_addScript('assets/libs/lightslider/js/lightslider.min.js');
		$this->_addStyle('assets/libs/lightslider/css/lightslider.min.css');

		$script = '
			$(document).ready(function(){
				$("#homeslider").lightSlider({
					auto: true,
					vertical: true,
					item: 1,
					controls: false,
					verticalHeight:650,
					speed: 1000,
					loop: true,
					pause: 4000
				});
			});
		';

		$this->_addScript($script,'embed');

		$this->_data['slider'] = $this->general->get_slider();
		$this->_data['projects'] = $this->project->get_newest_project();
		$this->_data['testimonials'] = $this->general->get_newest_testimonay();

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function aboutus() {
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function contactus() {
		$this->_addContent($this->_data);
		$this->_render();
	}
}