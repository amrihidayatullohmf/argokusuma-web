<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Dashboard extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->_template_master_data['page_title'] = 'Dashboard';
		$this->_template_master_data['page_subtitle'] = 'Control panel';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function delete($type="update") {
		$return = array('code'=>500);

		$param = $this->input->post('param',TRUE);
		$ids   = $this->input->post('iddata',TRUE);
		$table = $this->input->post('table',TRUE);

		if(!empty($ids) and !empty($param)) {

			$del = NULL;
			$exp = explode("=", $param);
			$param_key = $exp[0];
			$param_val = $exp[1];
			$ids = explode("=", $ids);
			$id_key = $ids[0];
			$id_val = $ids[1];

			if($type == "update") {
				$del = $this->db->update($table,array($param_key=>$param_val),array($id_key=>$id_val));
			} else {
				$del = $this->db->delete($table,array($id_key=>$id_val));
			}

			if(isset($del)) {
				$return = array('code'=>200);
			}
		}

		echo json_encode($return);
		exit;
	}
}