<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Service extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function detail($slug = 'digital-products') {
		$this->_addContent($this->_data);
		$this->_render();
	}

}