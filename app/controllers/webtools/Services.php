<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Services extends APP_Webtools {

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
		$this->_data['lists'] = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('services')} s WHERE s.is_active = 1")->result_array();

		$this->_template_master_data['page_title'] = 'Services';
		$this->_template_master_data['page_subtitle'] = 'List';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function action($action = 'add', $id = 0) {
		$this->_template_master_data['page_title'] = 'Service';
		$this->_template_master_data['page_subtitle'] = 'Add New';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('services')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['data'] = $check;

				$this->_data['segments'] = $this->db->get_where('services_extends',['service_id'=>$id,'is_active'=>1])->result_array();
			}
		}

	
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function save() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$caption = $this->input->post('caption');
		$title = $this->input->post('title');
		$description = $this->input->post('description');

		if(!empty($title) and !empty($caption) and !empty($description)) {
			$datas = array(
						'title' => $title,
						'caption' => $caption,
						'description' => $description
					 );

			$thumbnail_square = (isset($_FILES['icon'])) ? $_FILES['icon']: NULL;
			$thumbnail_wide = (isset($_FILES['cover'])) ? $_FILES['cover']: NULL;

			if(isset($thumbnail_square)) {
				$up_desktop = $this->upload_file($thumbnail_square,'icon-','./medias/services/');
				if($up_desktop['uploaded'] == TRUE) {
					$datas['icon_image'] = $up_desktop['filename'];
				}
			}

			if(isset($thumbnail_wide)) {
				$up_mobile = $this->upload_file($thumbnail_wide,'cover-','./medias/services/');
				if($up_mobile['uploaded'] == TRUE) {
					$datas['cover_image'] = $up_mobile['filename'];
				}
			}

			$save = NULL;

			if(empty($id)) {
				$datas['is_active'] = 1;
				$datas['created_date'] = date('Y-m-d H:i:s');
	  			
				$save = $this->db->insert('services',$datas);
	 			$id = $this->db->insert_id();
			} else {
				$save = $this->db->update('services',$datas,array('id'=>$id));
			}

			if(isset($save) and $save != FALSE) {
				$countersegment = $_POST['countersegment'];


				foreach ($countersegment as $key => $value) {
					$idsegment = (isset($_POST['idsegment'][$value])) ? $_POST['idsegment'][$value] : 0;
					$title = (isset($_POST['ttl'][$value])) ? $_POST['ttl'][$value] : '';
					$desc = $_POST['desc'][$value];
					$thumb = (isset($_FILES['thumb'])) ? $_FILES['thumb']: NULL;

					$datas = [
						'service_id' => $id,
						'title' => $title,
						'description' => $desc
					];

					if($thumb != NULL) {
						if(isset($thumb['name'][$value])) {
							$name = $thumb['name'][$value];
							$tmp_name = $thumb['tmp_name'][$value];
							$size = $thumb['size'][$value];
							$error = $thumb['error'][$value];

							if($size > 0 and $error == 0) {
								if(!@move_uploaded_file($tmp_name, "./medias/services/".$name)) {
									if(@copy($tmp_name, "./medias/services/".$name)) {
										$datas['image'] = $name;
									}
								} else {
									$datas['image'] = $name;
								}
							}
						}
					}

					if(empty($idsegment)) {
						$datas['is_active'] = 1;
						$datas['created_date'] = date('Y-m-d H:i:s');

						$save = $this->db->insert('services_extends',$datas);
					} else {
						$save = $this->db->update('services_extends',$datas,['id'=>$idsegment]);
					}
				}
				

				$return = array('code'=>200,'msg'=>'Service has been saved, thank you');
			} else {
				$return = array('code'=>500,'msg'=>'Fail to save Service, try again later');
			}
		}

		echo json_encode($return);
		exit;
	}


}