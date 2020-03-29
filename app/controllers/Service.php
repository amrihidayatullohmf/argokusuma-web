<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Service extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->_data['testimonials'] = $this->general->get_newest_testimony(20);
		$this->_data['services'] = $this->general->get_services();
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function detail($slug = 'digital-products') {
		$data = $this->general->get_detail_service($slug);

		if($data == FALSE) {
			redirect('what-we-do');
		}

		$this->_data['data'] = $data;
		$this->_addContent($this->_data);
		$this->_render();
	}

}