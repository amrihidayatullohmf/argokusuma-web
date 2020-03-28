<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Teams extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
	}


	public function index() {
		$this->_addStyle('assets/libs/adminlte/plugins/datatables/dataTables.bootstrap.css');
		$this->_addScript('assets/libs/adminlte/plugins/datatables/jquery.dataTables.min.js');
		$this->_addScript('assets/libs/adminlte/plugins/datatables/dataTables.bootstrap.min.js');

		$js = '
			var table = $(".datatable").DataTable({
				"initComplete": function( settings, json ) {
			    	deleteListener(table,false);
			    },
			    "drawCallback": function( settings ) {
			    	deleteListener(table,false);
			    }
			});
		';

		$this->_addScript($js,'embed');
		$this->_data['lists'] = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('teams')} s WHERE s.is_active = 1")->result_array();

		$this->_template_master_data['page_title'] = 'Teams';
		$this->_template_master_data['page_subtitle'] = 'List';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function action($action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Teams';
		$this->_template_master_data['page_subtitle'] = 'Add New';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('teams')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['slide'] = $check;
			}
		}


		$this->_addContent($this->_data);
		$this->_render();
	}

	public function save() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$position = $this->input->post('position');

		$photo = (isset($_FILES['photo'])) ? $_FILES['photo']: NULL;
		
		$datas = array(
					'name' => $name,
					'position' => $position
				 );

		if(isset($photo)) {
			$up_desktop = $this->upload_file($photo,'team-','./medias/teams/');
			if($up_desktop['uploaded'] == TRUE) {
				$datas['photo'] = $up_desktop['filename'];
			}
		}
		$save = NULL;

		if(empty($id)) {
			if(!empty($datas['photo'])) {
				$datas['is_active'] = 1;
				$datas['created_date'] = date('Y-m-d H:i:s');
  			
				$save = $this->db->insert('teams',$datas);
  				$id = $this->db->insert_id();
  			}
		} else {
			$save = $this->db->update('teams',$datas,array('id'=>$id));
		}

		if(isset($save) and $save != FALSE) {
			$return = array('code'=>200,'msg'=>'Team has been saved, thank you');
		} else {
			$return = array('code'=>500,'msg'=>'Fail to save Team, try again later');
		}

		echo json_encode($return);
		exit;
	}

}