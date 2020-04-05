<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Portfolio extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->_template_master_data['page_title'] = 'Portfolio';
		$this->_template_master_data['page_subtitle'] = 'Lists';

		$this->_addStyle('assets/libs/adminlte/plugins/datatables/dataTables.bootstrap.css');
		$this->_addScript('assets/libs/adminlte/plugins/datatables/jquery.dataTables.min.js');
		$this->_addScript('assets/libs/adminlte/plugins/datatables/dataTables.bootstrap.min.js');

		$js = '
			var tbl = $(".datatable").DataTable({
		        "processing": true,
		        "serverSide": true,
			    "deferRender": true,
			    "ajax": {
			    	"url": "'.site_url('webtools/portfolio/get_lists').'" ,
			    	"type": "POST"
			    }, 
			    "columns": [
			    	{
			    		"orderable": true,
			    		"data":"id"
			    	},
			    	{
			    		"orderable": false,
			    		"data":"thumbnail"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"project_name"
			    	},
			    	{
			    		"orderable": false,
			    		"data":"snippet"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"cname"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"pinned"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"created_date"
			    	},
			    	{
			    		"data":"id",
			    		"orderable": false,
			    		"sClass":"center",
			    		"render": function(data, type, row) {
 			    			return "<div class=\'btn-group pull-right\' role=\'group\'><a href=\''.site_url('webtools/portfolio/action/edit').'/"+data+"\' class=\'btn btn-sm btn-default\'><i class=\'fa fa-pencil\'></i>&nbsp;Edit</a><a href=\'#\' class=\'btn btn-sm btn-danger btn-confirm deletetrigger\' data-table=\'portofolio\' data-type=\'update\' data-param=\'is_active=0\' data-ids=\'id="+data+"\'><i class=\'fa fa-trash\'></i>&nbsp;Remove</a></div>";
					    } 
			    	}
			    ],
			    "initComplete": function( settings, json ) {
			    	deleteListener();
			    },
			    "drawCallback": function( settings ) {
			    	deleteListener();
			    }
		    });

		';
		$this->_addScript($js,'embed');

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function get_lists() {
		$draw = $this->input->post("draw");
		$start = $this->input->post("start");
		$length = $this->input->post("length");
		$search = $this->input->post("search");
		$sort = $this->input->post('order');

		//$start = 0;
		//$length = 10;

		$sumquery = "";
		$query = "";
		$order = "created_date DESC";

		if(isset($sort[0]['column']) and isset($sort[0]['dir'])) {
			if($sort[0]['column'] == 1) {
				$order = "p.id ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 3) {
				$order = "p.project_name ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 5) {
				$order = "c.name ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 5) {
				$order = "p.is_pinned ".$sort[0]['dir'];	
			} 
		}

		if(empty($search["value"])) {
			$sumquery = "SELECT p.*, c.name AS cname FROM {$this->db->dbprefix('portofolio')} p LEFT JOIN {$this->db->dbprefix('portofolio_clients')} c ON c.id = p.client_id WHERE p.is_active != 0 ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;
		} else {
			$sumquery = "SELECT p.*, c.name AS cname FROM {$this->db->dbprefix('portofolio')} p LEFT JOIN {$this->db->dbprefix('portofolio_clients')} c ON c.id = p.client_id WHERE p.is_active != 0 AND (p.project_name LIKE '%".$search["value"]."%' OR c.name LIKE '%".$search["value"]."%')  ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;		
		}

		$total = $this->db->query($sumquery)->num_rows();
		$lists = $this->db->query($query)->result_array();
		$now = strtotime(date('Y-m-d'));

		foreach ($lists as $key => $value) {
			$thumbnail = site_url('medias/dummy.png');
			if(!empty($value['thumbnail']) and file_exists("./medias/projects/".$value['thumbnail'])) {
				$thumbnail = site_url("medias/projects/".$value['thumbnail']);
			}
			$lists[$key]['thumbnail'] = "<img src='".$thumbnail."' class='img-thumbnail' width='100'>";
			$lists[$key]['snippet'] = substr(strip_tags($value['overview']), 0, 200);
			$lists[$key]['pinned'] = ($value['is_pinned'] == 1) ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>';
		
		}
		
		$result = array(
			"draw" => $draw,
			"recordsTotal" => intval($total),
			"recordsFiltered" => intval($total),						
			"data" => $lists
			);			

		echo json_encode($result);
		exit;	
	}

	public function action($action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Portofolio';
		$this->_template_master_data['page_subtitle'] = 'Compose';

		if($id != NULL and $action == 'edit') {
			$check = $this->db->get_where('portofolio',['id'=>$id,'is_active !='=>0])->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['data'] = $check;

				$getmedias = $this->db->get_where('portofolio_images',['portofolio_id'=>$id,'is_active'=>1])->result_array();
				$medias = [];
				foreach ($getmedias as $key => $value) {
					$medias[] = [
						'path' => site_url('medias/projects/'.$value['image_path']),
						'name' => $value['image_path']
					];
				}

				$this->_data['medias'] = $medias;

				$related = $this->db->get_where('portofolio_category_relations',['portofolio_id'=>$id])->result_array();
				$existcategories = [];

				foreach ($related as $key => $value) {
					$existcategories[] = $value['category_id'];
				}

				$this->_data['existcategories'] = $existcategories;
			}
		}

		//$this->add_tinymce();
		$this->_data['categories'] = $this->db->get_where('portofolio_categories',['is_active'=>1])->result_array();
		$this->_data['clients'] = $this->db->get_where('portofolio_clients',['is_active !='=>0])->result_array();

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function save() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');

		$id = $this->input->post('id');
		$title = $this->input->post('title');
		$client = $this->input->post('client');
		$overview = $this->input->post('overview');
		$state = $this->input->post('state');
		$pin = $this->input->post('pin');
		$exist = $this->input->post('existmedias');
		$category = $this->input->post('category');

		$pin = (isset($pin)) ? 1 : 0;

		if(!empty($title) and !empty($client) and !empty($overview)) {
			$thumbnail_square = (isset($_FILES['thumb'])) ? $_FILES['thumb']: NULL;
			$thumbnail_wide = (isset($_FILES['cover'])) ? $_FILES['cover']: NULL;

			$datas = array(
						'project_name' => $title,
						'slug' => slugify($title),
						'client_id' => $client,
						'overview' => $overview,
						'is_active' => $state,
						'is_pinned' => $pin
					 );

			if(isset($thumbnail_square)) {
				$up_desktop = $this->upload_file($thumbnail_square,'thumb-','./medias/projects/');
				if($up_desktop['uploaded'] == TRUE) {
					$datas['thumbnail'] = $up_desktop['filename'];
				}
			}

			if(isset($thumbnail_wide)) {
				$up_mobile = $this->upload_file($thumbnail_wide,'cover-','./medias/projects/');
				if($up_mobile['uploaded'] == TRUE) {
					$datas['cover'] = $up_mobile['filename'];
				}
			}

			$save = NULL;

			if(empty($id)) {
	  			$data['created_date'] = date('Y-m-d H:i:s');
				$save = $this->db->insert('portofolio',$datas);
  				$id = $this->db->insert_id();

			} else {
				$save = $this->db->update('portofolio',$datas,array('id'=>$id));
			}

			if(isset($save) and $save != FALSE) {
				$this->db->delete('portofolio_category_relations',['portofolio_id'=>$id]);

				if(isset($category) and count($category) > 0) {
					foreach ($category as $key => $value) {
						$this->db->insert('portofolio_category_relations',[
															'portofolio_id' => $id,
															'category_id' => $value
														   ]);
					}
				}

				$counter = 0;
				$this->db->update('portofolio_images',['is_active'=>0],['portofolio_id'=>$id]);

				if(isset($exist)) {	
					foreach ($exist as $key => $value) {
						$check = $this->db->get_where('portofolio_images',['image_path'=>$value,'portofolio_id'=>$id])->row();	
						if(isset($check->id)) {
							$this->db->update('portofolio_images',['is_active'=>1],['image_path'=>$value,'portofolio_id'=>$id]);
							$counter++;
						}
					}
				}

				if(isset($_FILES['medias'])) {
					foreach ($_FILES['medias']['name'] as $key => $value) {
						$media = [
							'name' => $_FILES['medias']['name'][$key],
							'tmp_name' => $_FILES['medias']['tmp_name'][$key],
							'size' => $_FILES['medias']['size'][$key],
							'error' => $_FILES['medias']['error'][$key]
						];
						$counter++;
						$up = $this->upload_file($media,'medias-'.($counter+1),'./medias/projects/');
						if($up['uploaded'] == TRUE) {
							$this->db->insert('portofolio_images',[
															'portofolio_id' => $id,
															'image_path' => $up['filename'],
															'is_active' => 1,
															'created_date' => date('Y-m-d H:i:s')
														   ]);
						}
					}
				}

				$return = array('code'=>200,'msg'=>'Project has been saved, thank you');
			} else {
				$return = array('code'=>500,'msg'=>'Fail to save Project, try again later');
			}
		}

		echo json_encode($return);
		exit;
	}

	public function category() {
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
		$this->_data['lists'] = $this->db->get_where("portofolio_categories",['is_active'=>1])->result_array();

		$this->_template_master_data['page_title'] = 'Portfolio';
		$this->_template_master_data['page_subtitle'] = 'Categories';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function categoryaction($action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Portfolio';
		$this->_template_master_data['page_subtitle'] = 'Manage Category';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('portofolio_categories')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['data'] = $check;
			}
		}

	
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function categorysave() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$category = $this->input->post('category');
		$slug = $this->input->post('slug');

		$datas = array(
					'category' => $category,
					'slug' => (empty($slug)) ? slugify($category) : $slug
				 );

		$save = NULL;

		if(empty($id)) {
			$datas['is_active'] = 1;
			$datas['created_date'] = date('Y-m-d H:i:s');
  			
			$save = $this->db->insert('portofolio_categories',$datas);
 			$id = $this->db->insert_id();
		} else {
			$save = $this->db->update('portofolio_categories',$datas,array('id'=>$id));
		}

		if(isset($save) and $save != FALSE) {
			$return = array('code'=>200,'msg'=>'Category has been saved, thank you');
		} else {
			$return = array('code'=>500,'msg'=>'Fail to save Category, try again later');
		}

		echo json_encode($return);
		exit;
	}


	public function clients() {
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
		$this->_data['lists'] = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('portofolio_clients')} s WHERE s.is_active = 1")->result_array();

		$this->_template_master_data['page_title'] = 'Clients';
		$this->_template_master_data['page_subtitle'] = 'List';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function actionclient($action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Clients';
		$this->_template_master_data['page_subtitle'] = 'Add New';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('portofolio_clients')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['slide'] = $check;
			}
		}


		$this->_addContent($this->_data);
		$this->_render();
	}

	public function saveclient() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$pin = $this->input->post('pin');
		$state = $this->input->post('state');

		$photo = (isset($_FILES['photo'])) ? $_FILES['photo']: NULL;
		
		$datas = array(
					'name' => $name,
					'is_pinned' => $pin,
					'is_active' => $state
				 );

		if(isset($photo)) {
			$up_desktop = $this->upload_file($photo,'client-','./medias/clients/');
			if($up_desktop['uploaded'] == TRUE) {
				$datas['icon'] = $up_desktop['filename'];
			}
		}
		$save = NULL;

		if(empty($id)) {
			if(!empty($datas['icon'])) {
				$datas['created_date'] = date('Y-m-d H:i:s');
  			
				$save = $this->db->insert('portofolio_clients',$datas);
  				$id = $this->db->insert_id();
  			}
		} else {
			$save = $this->db->update('portofolio_clients',$datas,array('id'=>$id));
		}

		if(isset($save) and $save != FALSE) {
			$return = array('code'=>200,'msg'=>'Client has been saved, thank you');
		} else {
			$return = array('code'=>500,'msg'=>'Fail to save Client, try again later');
		}

		echo json_encode($return);
		exit;
	}

}