<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Blog extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();
		$this->_data['latestnews'] = $this->news->get_latest(4);
		$this->_data['categories'] = $this->news->get_categories();
	}

	public function index($category = 'all') {
		$query = $this->input->get('query_search');
		
		$this->_data['active_category'] = $category;
		$this->_data['blogs'] = $this->get_data(1,$category,$query,FALSE);

		$this->_addContent($this->_data);
		$this->_render();
	}


	public function get_data($page = 1,$category_slugs = 'all',$query = '',$json = TRUE) {
		$offset = 0;
		$limit = 3;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$rows = $this->news->get_news_lists($category_slugs,$query,$offset,$limit);
		$total_page = ($rows['total'] > 0) ?  ceil($rows['total'] / $limit) : 0;
		$next_page = ($page < $total_page) ? $page + 1 : 0;
		$next_url = ($next_page > 0) ? site_url('blog/get_data/'.$next_page.'/'.$category_slugs.'/'.$query) : '';

		$return = [
			'page' => $page,
			'nexturl' => $next_url,
			'total_page' => $total_page,
			'total_row' => $rows['total'],
			'rows' => $rows['rows']
		];

		if(!$json) {
			return $return;
		} else {
			echo json_encode($return);
			exit;
		}
	}



	public function detail($slug = 'branding') {
		$detail = $this->news->get_detail_by_slug($slug);

		if($detail == FALSE) {
			redirect('blog');
		}

		$this->_data['detail'] = $detail;
		$this->_data['comments'] = $this->news->get_comment($detail['id']);
		
		$csrf_token = $this->generate_csrf('comment_form');
		$this->_data['csrf_token'] = $csrf_token;

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function savecomment($csrf_token) {
		$return = ['code'=>500,'msg'=>'CSRF Token session is expired, please reload page to renew token !'];

		if($this->is_match_token('comment_form',$csrf_token)) {
			$news_id = $this->input->post('news_id',TRUE);
			$name = $this->input->post('name',TRUE);
			$website = $this->input->post('website',TRUE);
			$email = $this->input->post('email',TRUE);
			$comment = $this->input->post('comment',TRUE);
			if(!empty($email) and !empty($comment) and !empty($name)) {
				$save = $this->news->save_comment($news_id,$name,$email,$website,$comment);

				if(isset($save) and $save != FALSE) {
					$csrf_token = $this->generate_csrf('comment_form');	
					$return = ['code'=>200,'msg'=>'Thank you for submitting your comment, we will review your comment before publishing it','action'=>site_url('blog/savecomment/'.$csrf_token)];
				} else {
					$return = ['code'=>500,'msg'=>'Fail to save your email, try again later !'];
				}					
				
			} else {
				$return = ['code'=>500,'msg'=>'Please complete form correctly !'];
			}
		}

		echo json_encode($return);
		exit;
	}

}