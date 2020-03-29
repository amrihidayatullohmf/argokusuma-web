<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Settings extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
		$this->_template_master_data['setting_current'] = 'general';
	}

	public function index($category = 'general')
	{
		$this->_data['category'] = $category;
		$this->_data['fields'] = $this->db->get_where('options',['option_group'=>$category])->result_array();

		$this->_template_master_data['setting_current'] = $category;

		$this->_template_master_data['page_title'] = 'Settings';
		$this->_template_master_data['page_subtitle'] = ucwords($category);
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function save_setting() {
		$return = array('code'=>200,'msg'=>'Your changes have been saved, Thank you');

		$type = $this->input->post('setting-group',TRUE);
		$fields = $this->db->get_where('options',['option_group'=>$type])->result_array();

		foreach ($fields as $key => $value) {
			$newvalue = "";

			if($value['field_type'] == 'text' or $value['field_type'] == 'longtext' or $value['field_type'] == 'richtext' or $value['field_type'] == 'number'  or $value['field_type'] == 'select') {
				$newvalue = $this->input->post($value['option_key']);	
				if(is_array($newvalue)) {
					$newvalue = serialize($newvalue);
				}
			} else if($value['field_type'] == 'toggle') {
				$newvalue = (isset($_POST[$value['option_key']])) ? 1 : 0;
			} else if($value['field_type'] == 'image') {
				if(isset($_FILES[$value['option_key']])) {
					$files = $_FILES[$value['option_key']];

					$name = $files['name'];
					$temp = $files['tmp_name'];
					$err  = $files['error'];
					$size = $files['size'];

					$ext  = explode(".", $name);
					$ext  = strtolower(end($ext));

					$newname = $value['option_key']."-".date('U').".".$ext;

					if(!move_uploaded_file($temp, "./assets/static/".$newname)) {
						if(copy($temp, "./assets/static/".$newname)) {
							$newvalue = $newname;
						}
					} else {
						$newvalue = $newname;
					}
				}				
			} 


			if(!empty($newvalue) or (empty($newvalue) and $value['field_type'] == 'number')  or (empty($newvalue) and $value['field_type'] == 'toggle')) {
				$upd = update_option($value['option_key'],$newvalue);
			}
		}

		echo json_encode($return);
		exit;
	}

	public function manifesto() {
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
		$this->_data['lists'] = $this->db->get_where("manifesto",['is_active'=>1])->result_array();

		$this->_template_master_data['page_title'] = 'Manifesto';
		$this->_template_master_data['page_subtitle'] = 'List';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function manifestoaction($action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Manifesto';
		$this->_template_master_data['page_subtitle'] = 'Add New';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM wd_manifesto s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['data'] = $check;
			}
		}

	
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function savemanifesto() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$content = $this->input->post('content');

		$icon = (isset($_FILES['icon'])) ? $_FILES['icon']: NULL;

		$datas = array(
					'title' => $title,
					'content' => $content
				 );

		if(isset($icon)) {
			$up_desktop = $this->upload_file($icon,'manifesto','./medias/manifesto/');
			if($up_desktop['uploaded'] == TRUE) {
				$datas['icon_image'] = $up_desktop['filename'];
			}
		}

		$save = NULL;

		if(empty($id)) {
			$datas['is_active'] = 1;
			$datas['created_date'] = date('Y-m-d H:i:s');
  			
			$save = $this->db->insert('manifesto',$datas);
 			$id = $this->db->insert_id();
		} else {
			$save = $this->db->update('manifesto',$datas,array('id'=>$id));
		}

		if(isset($save) and $save != FALSE) {
			$return = array('code'=>200,'msg'=>'Manifesto has been saved, thank you');
		} else {
			$return = array('code'=>500,'msg'=>'Fail to save Manifesto, try again later');
		}

		echo json_encode($return);
		exit;
	}
}