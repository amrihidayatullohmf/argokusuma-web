<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Submission extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
	}


	public function guestbook($page = 1) {
		$keyword = $this->input->post('keyword');

		$this->_data['keyword'] = $keyword;
		$this->_data['page'] = (isset($page) and !empty($page)) ? $page : 1;

		$offset = 0;
		$limit = 10;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$query = "SELECT * FROM {$this->db->dbprefix('contact_submission')} WHERE is_active != 0 ORDER BY created_date DESC";

		if(!empty($keyword)) {
			$query = "SELECT * FROM {$this->db->dbprefix('contact_submission')} WHERE is_active != 0 AND (first_name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR comment LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' ) ORDER BY created_date DESC";
		}

		$total_row = $this->db->query($query)->num_rows();
		$content = $this->db->query($query." LIMIT ".$offset.",".$limit)->result_array();

		$total_page = ceil($total_row / $limit);

		$pagination = $this->pagination($page,$total_page);

		$this->_data['content'] = array(
									'content' => $content,
									'pagination' => $pagination
								  );


		$this->_template_master_data['page_title'] = 'Contact Submission';
		$this->_template_master_data['page_subtitle'] = '';
		$this->_addContent($this->_data);
		$this->_render();		
	}

	

	public function delete($id = 0) {
		$return = ['code'=>200];
		$set = $this->db->update('contact_submission',['is_active'=>0],['id'=>$id]);

		echo json_encode($return);
		exit;
	}

	public function exportguestbook() {
		set_time_limit(0);
		
		$lists = $this->db->query("SELECT * FROM {$this->db->dbprefix('contact_submission')} WHERE is_active != 0  ORDER BY created_date ASC")->result_array();
	
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=guestbook-'.date('Ymd-His').'.csv');

		$output = fopen('php://output', 'w');

		fputcsv($output, array(
							'ID',
							'First Name',
							'Last Name',
							'E-Mail',
							'Comment',
							'Created Date',
							'Last Modified Date'
						 )
				);	

		foreach ($lists as $key => $value) {
			fputcsv($output, array(
								$value['id'],
								$value['first_name'],
								$value['last_name'],
								$value['email'],
								$value['comment'],
								"=\"".$value['created_date']."\"",
								"=\"".$value['modified_date']."\""
							 )
					);	
		}
	}

	public function subscription() {
		$this->_template_master_data['page_title'] = 'Subscription';
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
			    	"url": "'.site_url('webtools/submission/get_lists').'" ,
			    	"type": "POST"
			    }, 
			    "columns": [
			    	{
			    		"orderable": true,
			    		"data":"id"
			    	},
			    	{
			    		"orderable": false,
			    		"data":"email"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"ip_address"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"user_agent"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"created_date"
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
				$order = "id ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 2) {
				$order = "email ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 3) {
				$order = "ip_address ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 4) {
				$order = "user_agent ".$sort[0]['dir'];	
			} 
		}

		if(empty($search["value"])) {
			$sumquery = "SELECT * FROM {$this->db->dbprefix('subscription')} WHERE is_active != 0 ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;
		} else {
			$sumquery = "SELECT * FROM {$this->db->dbprefix('subscription')} WHERE is_active != 0 AND (email LIKE '%".$search["value"]."%' OR ip_address LIKE '%".$search["value"]."%' OR user_agent LIKE '%".$search["value"]."%' )  ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;		
		}

		$total = $this->db->query($sumquery)->num_rows();
		$lists = $this->db->query($query)->result_array();
		
		$result = array(
			"draw" => $draw,
			"recordsTotal" => intval($total),
			"recordsFiltered" => intval($total),						
			"data" => $lists
			);			

		echo json_encode($result);
		exit;	
	}

	public function exportsubscriptoin() {
		set_time_limit(0);
		
		$lists = $this->db->query("SELECT * FROM {$this->db->dbprefix('subscription')} WHERE is_active != 0  ORDER BY created_date ASC")->result_array();
	
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=subscription-'.date('Ymd-His').'.csv');

		$output = fopen('php://output', 'w');

		fputcsv($output, array(
							'ID',
							'E-Mail',
							'Ip Address',
							'User Agent',
							'Created Date'
						 )
				);	

		foreach ($lists as $key => $value) {
			fputcsv($output, array(
								$value['id'],
								$value['email'],
								$value['ip_address'],
								$value['user_agent'],
								"=\"".$value['created_date']."\""
							 )
					);	
		}
	}

	public function testimonials() {
		$this->_template_master_data['page_title'] = 'Testimonials';
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
			    	"url": "'.site_url('webtools/submission/get_testimonials').'" ,
			    	"type": "POST"
			    }, 
			    "columns": [
			    	{
			    		"orderable": true,
			    		"data":"id"
			    	},
			    	{
			    		"orderable": false,
			    		"data":"user_name"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"user_type"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"caption"
			    	},
			    	{
			    		"orderable": false,
			    		"data":"snippet"
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
 			    			return "<div class=\'btn-group pull-right\' role=\'group\'><a href=\''.site_url('webtools/submission/testimonyaction/edit').'/"+data+"\' class=\'btn btn-sm btn-default\'><i class=\'fa fa-pencil\'></i>&nbsp;Edit</a><a href=\'#\' class=\'btn btn-sm btn-danger btn-confirm deletetrigger\' data-table=\'testimonials\' data-type=\'update\' data-param=\'is_active=0\' data-ids=\'id="+data+"\'><i class=\'fa fa-trash\'></i>&nbsp;Remove</a></div>";
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

	public function get_testimonials() {
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
				$order = "id ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 2) {
				$order = "user_name ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 3) {
				$order = "user_type ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 4) {
				$order = "caption ".$sort[0]['dir'];	
			} 
		}

		if(empty($search["value"])) {
			$sumquery = "SELECT * FROM {$this->db->dbprefix('testimonials')} WHERE is_active != 0 ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;
		} else {
			$sumquery = "SELECT * FROM {$this->db->dbprefix('testimonials')} WHERE is_active != 0 AND (user_name LIKE '%".$search["value"]."%' OR user_type LIKE '%".$search["value"]."%' OR caption LIKE '%".$search["value"]."%' )  ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;		
		}

		$total = $this->db->query($sumquery)->num_rows();
		$lists = $this->db->query($query)->result_array();

		foreach ($lists as $key => $value) {
			$lists[$key]['snippet'] = substr(strip_tags($value['testimony']), 0,100);
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

	public function testimonyaction($action = 'add', $id = 0) {
		$this->_template_master_data['page_title'] = 'Testimony';
		$this->_template_master_data['page_subtitle'] = 'Add New';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('testimonials')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
			if(isset($check->id)) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['data'] = $check;
			}
		}

	
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function testimonysave() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');
	
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$title = $this->input->post('title');
		$testimony = $this->input->post('testimony');

		if(!empty($name) and !empty($type) and !empty($title) and !empty($testimony)) {
			$datas = array(
						'user_name' => $name,
						'user_type' => $type,
						'caption' => $title,
						'testimony' => $testimony
					 );

			$save = NULL;

			if(empty($id)) {
				$datas['is_active'] = 1;
				$datas['created_date'] = date('Y-m-d H:i:s');
	  			
				$save = $this->db->insert('testimonials',$datas);
	 			$id = $this->db->insert_id();
			} else {
				$save = $this->db->update('testimonials',$datas,array('id'=>$id));
			}

			if(isset($save) and $save != FALSE) {
				$return = array('code'=>200,'msg'=>'Testimony has been saved, thank you');
			} else {
				$return = array('code'=>500,'msg'=>'Fail to save Testimony, try again later');
			}
		}

		echo json_encode($return);
		exit;
	}
}