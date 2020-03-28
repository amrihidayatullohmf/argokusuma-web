<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Webtools.php';
class Articles extends APP_Webtools {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->_template_master_data['page_title'] = 'Articles';
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
			    	"url": "'.site_url('webtools/articles/get_lists').'" ,
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
			    		"data":"title"
			    	},
			    	{
			    		"orderable": true,
			    		"data":"snippet"
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
 			    			return "<div class=\'btn-group pull-right\' role=\'group\'><a href=\''.site_url('webtools/articles/action/edit').'/"+data+"\' class=\'btn btn-sm btn-default\'><i class=\'fa fa-pencil\'></i>&nbsp;Edit</a><a href=\'#\' class=\'btn btn-sm btn-danger btn-confirm deletetrigger\' data-table=\'news\' data-type=\'update\' data-param=\'is_active=0\' data-ids=\'id="+data+"\'><i class=\'fa fa-trash\'></i>&nbsp;Remove</a></div>";
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
				$order = "id ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 3) {
				$order = "title ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 4) {
				$order = "tagline ".$sort[0]['dir'];	
			} else if($sort[0]['column'] == 5) {
				$order = "is_pinned ".$sort[0]['dir'];	
			} 
		}

		if(empty($search["value"])) {
			$sumquery = "SELECT * FROM {$this->db->dbprefix('news')} WHERE is_active != 0 ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;
		} else {
			$sumquery = "SELECT * FROM {$this->db->dbprefix('news')} WHERE is_active != 0 AND (title LIKE '%".$search["value"]."%' OR tagline LIKE '%".$search["value"]."%' OR content LIKE '%".$search["value"]."%' )  ORDER BY ".$order;
            $query = $sumquery." LIMIT ".$start.",".$length;		
		}

		$total = $this->db->query($sumquery)->num_rows();
		$lists = $this->db->query($query)->result_array();
		$now = strtotime(date('Y-m-d'));

		foreach ($lists as $key => $value) {
			$thumbnail = $this->news->get_thumbnail($value['id']);
			if(!empty($value['thumbnail_square']) and file_exists("./medias/blogs/".$value['thumbnail_square'])) {
				$thumbnail['path'] = site_url("medias/blogs/".$value['thumbnail_square']);
			}
			$lists[$key]['thumbnail'] = "<img src='".$thumbnail['path']."' class='img-thumbnail' width='100'>";
			$lists[$key]['pinned'] = ($value['is_pinned'] == 1) ? '<span class="label label-success">Allowed</span>' : '';
			$lists[$key]['snippet'] = substr(strip_tags($value['content']), 0, 200);
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
		$this->_template_master_data['page_title'] = 'Articles';
		$this->_template_master_data['page_subtitle'] = 'Compose';

		if($id != NULL and $action == 'edit') {
			$check = $this->news->get_detail_by_id($id,TRUE);
			if(isset($check['id'])) {
				$this->_template_master_data['page_subtitle'] = 'Update';
				$this->_data['data'] = $check;

				$medias = [];
				foreach ($check['medias'] as $key => $value) {
					$medias[] = $value['path'];
				}

				$this->_data['medias'] = $medias;

				$related = $this->db->get_where('news_category_relations',['news_id'=>$id])->result_array();
				$existcategories = [];

				foreach ($related as $key => $value) {
					$existcategories[] = $value['category_id'];
				}

				$this->_data['existcategories'] = $existcategories;
			}
		}

		//$this->add_tinymce();
		$this->_data['categories'] = $this->db->get_where('news_categories',['is_active'=>1])->result_array();

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function save() {
		$return = array('code'=>500,'msg'=>'Please complete form correctly');

		$id = $this->input->post('id');
		$title = $this->get_input_lang('title');
		$tagline = $this->get_input_lang('tagline');
		$content = $this->get_input_lang('content');
		$state = $this->input->post('state');
		$schedule = $this->input->post('schedule');
		$timestamp = $this->input->post('timestamp');
		$pin = $this->input->post('pin');
		$exist = $this->input->post('existmedias');
		$category = $this->input->post('category');

		$pin = (isset($pin)) ? 1 : 0;

		if($title['complete'] and $content['complete']) {
			$thumbnail_square = (isset($_FILES['thumbnail_square'])) ? $_FILES['thumbnail_square']: NULL;
			$thumbnail_wide = (isset($_FILES['thumbnail_wide'])) ? $_FILES['thumbnail_wide']: NULL;

			$datas = array(
						'title' => $title['maintext'],
						'slug' => slugify($title['maintext']),
						'content' => $content['maintext'],
						'is_active' => $state,
						'publish_date' => $schedule,
						'created_date' => (empty($timestamp)) ? date('Y-m-d H:i:s') : $timestamp,
						'is_pinned' => $pin
					 );

			if(isset($thumbnail_square)) {
				$up_desktop = $this->upload_file($thumbnail_square,'thumb-square','./medias/blogs/');
				if($up_desktop['uploaded'] == TRUE) {
					$datas['thumbnail_square'] = $up_desktop['filename'];
				}
			}

			if(isset($thumbnail_wide)) {
				$up_mobile = $this->upload_file($thumbnail_wide,'thumb-wide','./medias/blogs/');
				if($up_mobile['uploaded'] == TRUE) {
					$datas['thumbnail_wide'] = $up_mobile['filename'];
				}
			}

			$save = NULL;

			if(empty($id)) {
	  			
				$save = $this->db->insert('news',$datas);
  				$id = $this->db->insert_id();

			} else {
				$save = $this->db->update('news',$datas,array('id'=>$id));
			}

			if(isset($save) and $save != FALSE) {
				$this->save_text('news','title',$id,$title['lists']);
				$this->save_text('news','content',$id,$content['lists']);

				$this->db->delete('news_category_relations',['news_id'=>$id]);

				if(isset($category) and count($category) > 0) {
					foreach ($category as $key => $value) {
						$this->db->insert('news_category_relations',[
															'news_id' => $id,
															'category_id' => $value
														   ]);
					}
				}

				$return = array('code'=>200,'msg'=>'Article has been saved, thank you');
			} else {
				$return = array('code'=>500,'msg'=>'Fail to save Article, try again later');
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
		$this->_data['lists'] = $this->db->get_where("news_categories",['is_active'=>1])->result_array();

		$this->_template_master_data['page_title'] = 'Articles';
		$this->_template_master_data['page_subtitle'] = 'Categories';
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function categoryaction($action = 'add',$id = NULL) {
		$this->_template_master_data['page_title'] = 'Articles';
		$this->_template_master_data['page_subtitle'] = 'Manage Category';

		if($id != NULL) {
			$check = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('news_categories')} s WHERE s.is_active != 0 AND s.id = '".$id."'")->row();
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
  			
			$save = $this->db->insert('news_categories',$datas);
 			$id = $this->db->insert_id();
		} else {
			$save = $this->db->update('news_categories',$datas,array('id'=>$id));
		}

		if(isset($save) and $save != FALSE) {
			$return = array('code'=>200,'msg'=>'Category has been saved, thank you');
		} else {
			$return = array('code'=>500,'msg'=>'Fail to save Category, try again later');
		}

		echo json_encode($return);
		exit;
	}

	public function comment($page = 1) {
		$keyword = $this->input->post('keyword');

		$this->_data['keyword'] = $keyword;
		$this->_data['page'] = (isset($page) and !empty($page)) ? $page : 1;

		$offset = 0;
		$limit = 10;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$query = "SELECT n.title, n.slug, n.thumbnail_square, c.* FROM {$this->db->dbprefix('news_comments')} c LEFT JOIN {$this->db->dbprefix('news')} n ON n.id = c.news_id WHERE c.is_active != 0 AND c.parent_id = 0 ORDER BY c.created_date DESC";

		if(!empty($keyword)) {
			$query = "SELECT n.title, n.slug, n.thumbnail_square, c.* FROM {$this->db->dbprefix('news_comments')} c LEFT JOIN {$this->db->dbprefix('news')} n ON n.id = c.news_id WHERE c.is_active != 0 AND c.parent_id = 0 AND (c.name LIKE '%".$keyword."%' OR c.email LIKE '%".$keyword."%' OR c.comment LIKE '%".$keyword."%' OR n.title LIKE '%".$keyword."%' ) ORDER BY c.created_date DESC";
		}

		$total_row = $this->db->query($query)->num_rows();
		$content = $this->db->query($query." LIMIT ".$offset.",".$limit)->result_array();
		
		foreach ($content as $key => $value) {
			$content[$key]['children'] = $this->db->query("SELECT n.title, n.slug, n.thumbnail_square, c.* FROM {$this->db->dbprefix('news_comments')} c LEFT JOIN {$this->db->dbprefix('news')} n ON n.id = c.news_id WHERE c.is_active != 0  AND c.parent_id = '".$value['id']."' ORDER BY c.created_date DESC")->result_array();
		}


		$total_page = ceil($total_row / $limit);

		$pagination = $this->pagination($page,$total_page);

		$this->_data['content'] = array(
									'content' => $content,
									'pagination' => $pagination
								  );


		$this->_template_master_data['page_title'] = 'Comment';
		$this->_template_master_data['page_subtitle'] = '';
		$this->_addContent($this->_data);
		$this->_render();		
	}

	

	public function delete($id = 0) {
		$return = ['code'=>500];
		$set = $this->db->update('news_comments',['is_active'=>0],['id'=>$id]);


		if(isset($set)) {
			$set = $this->db->update('news_comments',['is_active'=>0],['parent_id'=>$id]);
			$return['code'] = 200;
		}

		echo json_encode($return);
		exit;
	}

	public function reply() {
		$return = ['code'=>500,'msg'=>'Please complete your data !'];

		$product_id = $this->input->post('product_id');
		$parent_id = $this->input->post('parent_id');
		$comment = $this->input->post('comment');

		if(!empty($comment) and !empty($product_id) and !empty($parent_id)) {

			$ins = $this->db->insert('news_comments',[
															'news_id' => $product_id,
															'parent_id' => $parent_id,
															'comment' => $comment,
															'name' => 'Administrator',
															'is_active' => 1,
															'created_date' => date('Y-m-d H:i:S')
													     ]);

			if(isset($ins) and $ins != FALSE) {
				$this->db->update('news_comments',['is_active'=>1],['id'=>$parent_id]);				

				$return = ['code'=>200,'msg'=>'Your reply has been succesfully saved, Thank you !'];
			} else {
				$return = ['code'=>500,'msg'=>'Fail to save your reply, try again later !'];
			}
		}

		echo json_encode($return);
		exit;
	}
}