<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Medias extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		redirect('webtools/dashboard');
	}

	public function slider($section = 'homepage') {
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
		
		if(in_array($section, ['homepage'])) {
			$this->_template_master_data['current_page'] = 'medias';
		}
		$this->_data['section'] = $section;	

		$this->_addScript($js,'embed');
		$this->_data['lists'] = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('sliders')} s WHERE s.is_active = 1 AND s.section = '".$section."'")->result_array();

		$this->_template_master_data['page_title'] = 'Sliders';
		$this->_template_master_data['page_subtitle'] = 'List';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function slideraction($section = 'homepage',$action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Sliders';
		$this->_template_master_data['page_subtitle'] = 'Add New';
		$this->_data['section'] = $section;

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('sliders')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['slide'] = $check;
			}
		}

		if(in_array($section, ['homepage'])) {
			$this->_template_master_data['current_page'] = 'medias';
		}

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function save_slide() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$caption = $this->input->post('caption');
		$linktext = $this->input->post('linktext');
		$link = $this->input->post('link');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$section = $this->input->post('section');
		$linktype = $this->input->post('linktype');

		$desktop = (isset($_FILES['desktop'])) ? $_FILES['desktop']: NULL;
		$mobile = (isset($_FILES['mobile'])) ? $_FILES['mobile']: NULL;
		$filedownload = (isset($_FILES['filedownload'])) ? $_FILES['filedownload']: NULL;

		$datas = array(
					'section' => $section,
					'title' => $title,
					'caption' => $caption,
					'link' => $link,
					'link_type' => $linktype,
					'link_text' => $linktext,
					'start_date' => $start_date,
					'end_date' => $end_date
				 );

		if(isset($desktop)) {
			$up_desktop = $this->upload_file($desktop,'slider-desktop','./medias/sliders/');
			if($up_desktop['uploaded'] == TRUE) {
				$datas['desktop_image'] = $up_desktop['filename'];
			}
		}

		if(isset($mobile)) {
			$up_mobile = $this->upload_file($mobile,'slider-mobile','./medias/sliders/');
			if($up_mobile['uploaded'] == TRUE) {
				$datas['mobile_image'] = $up_mobile['filename'];
			}
		}

		if(isset($filedownload)) {
			$name = $filedownload['name'];
			$tmp_name = $filedownload['tmp_name'];
			$size = $filedownload['size'];
			$error = $filedownload['error'];

			if($size > 0 and $error == 0) {
				$ext = explode(".", $name);
				$ext = end($ext);
				$ext = strtolower($ext);

				//$newname = "download-".date('U').".".$ext;

				$newname = strtolower($name);
				$newname = str_replace(" ", "-", $newname);

				if(@move_uploaded_file($tmp_name, "./medias/sliders/".$newname)) {
					$datas['link_file'] = $newname;
				} else {
					if(@copy($tmp_name, "./medias/sliders/".$newname)) {
						$datas['link_file'] = $newname;
					}
				}
			}
		}

		$save = NULL;

		if(empty($id)) {
			if(!empty($datas['desktop_image']) and !empty($datas['mobile_image'])) {
				$datas['is_active'] = 1;
				$datas['created_date'] = date('Y-m-d H:i:s');
  			
				$save = $this->db->insert('sliders',$datas);
  				$id = $this->db->insert_id();
  			}
		} else {
			$save = $this->db->update('sliders',$datas,array('id'=>$id));
		}

		if(isset($save) and $save != FALSE) {
			$return = array('code'=>200,'msg'=>'Slider has been saved, thank you');
		} else {
			$return = array('code'=>500,'msg'=>'Fail to save slider, try again later');
		}

		echo json_encode($return);
		exit;
	}

}