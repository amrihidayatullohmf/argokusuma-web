<?php
class News_model extends CI_Model {
	private $lang = 'id';

	function __construct() {
		parent::__construct();
	}

	public function set_lang($lang = 'id') {
		$this->lang = $lang;
	}

	public function get_thumbnail($news_id) {
		$thumb = $this->db->query('SELECT * FROM '.$this->db->dbprefix('news_images').' WHERE is_active = 1 AND news_id = '.$news_id.' ORDER BY id ASC LIMIT 0,1')->row();
		
		if(isset($thumb->image_path)) {
			if(!empty($thumb->image_path) and file_exists("./medias/blogs/".$thumb->image_path)) {
				return ['path'=>site_url('medias/blogs/'.$thumb->image_path),'name'=>$thumb->image_path,'alt'=>$thumb->alt_text];
			}
		}

		return ['path'=>site_url('assets/images/dummy.png'),'name'=>'dummy.png','alt'=>'Wardah Beauty'];
	}

	public function get_medias($news_id) {
		$medias = $this->db->query('SELECT * FROM '.$this->db->dbprefix('news_images').' WHERE is_active = 1 AND news_id = '.$news_id.' ORDER BY id ASC ')->result_array();
		$lists = [];

		foreach ($medias as $key => $value) {
			if(isset($value['image_path'])) {
				if(!empty($value['image_path']) and file_exists("./medias/blogs/".$value['image_path'])) {
					$lists[] = ['path'=>site_url('medias/blogs/'.$value['image_path']),'name'=>$value['image_path'],'alt'=>$value['alt_text']];
				}
			}
		}

		return $lists;
	}

	public function shortify($str = "", $offset = 0, $limit = 200,$end = '...') {
		$str = strip_tags($str);
		$ending = (strlen($str) > ($offset + $limit)) ? $end : '';
		return substr($str, $offset,$limit).$ending;
	} 

	private function prepare($rows = [],$options = []) {

		foreach ($rows as $key => $value) {
			$news_id = $value['id'];

			if(isset($options['thumbnail']) and $options['thumbnail'] == TRUE) {
				$thumbnail = $this->get_thumbnail($news_id);
				$thumbnail_wide = $thumbnail;

				if(!empty($value['thumbnail_square']) and file_exists("./medias/blogs/".$value['thumbnail_square'])) {
					$thumbnail['path'] = site_url("medias/blogs/".$value['thumbnail_square']);
				}

				if(!empty($value['thumbnail_wide']) and file_exists("./medias/blogs/".$value['thumbnail_wide'])) {
					$thumbnail_wide['path'] = site_url("medias/blogs/".$value['thumbnail_wide']);
				}

				$rows[$key]['thumbnail'] = $thumbnail;
				$rows[$key]['thumbnail_wide'] = $thumbnail_wide;
			}

			if(isset($options['medias']) and $options['medias'] == TRUE) {
				$rows[$key]['medias'] = $this->get_medias($news_id);
			}

			if(isset($options['shortify']) and $options['shortify'] == TRUE) {
				$rows[$key]['shortify'] = $this->shortify($value['content_text']);
			}

			if(isset($options['dateformat']) and !empty($options['dateformat'])) {
				$rows[$key]['date_formatted'] = date($options['dateformat'],strtotime($value['publish_date']));
			}

			$rows[$key]['url'] = site_url($this->lang.'/news/'.$value['slug']);
		}

		return $rows;
	}

	public function get_pinned($max = 3,$start_order = 1) {

		$query = 'SELECT n.*, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n  WHERE '
				.'n.is_active = 1 AND n.is_pinned = 1 '
				.'ORDER BY n.created_date DESC '
				.'LIMIT '.($start_order-1).','.$max;

		$rows = $this->db->query($query)->result_array();
		return $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE
							  ]);
	}

	public function get_trending($max = 3,$page = 1) {
		$offset = 0;
		$limit = $max;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$query = 'SELECT n.*, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n  WHERE '
				.'n.is_active = 1 AND n.is_pinned = 1 '
				.'ORDER BY n.created_date DESC ';

		$rows = $this->db->query($query.' LIMIT '.$offset.','.$limit)->result_array();
		$total = $this->db->query($query)->num_rows();
		
		$lists = $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE
							  ]);

		$totalpage = ceil($total/$limit);
		$nextpage = ($page < $totalpage) ? $page+1 : 0;

		return [
			'lists' => $lists,
			'nextpage' => $nextpage,
			'currentpage' => $page
		];
	}

	public function get_lists($max = 10,$page = 1,$excludes = []) {
		$offset = 0;
		$limit = $max;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$exclude_query = "";
		if(count($excludes) > 0) {
			$exclude_query = " AND id NOT IN (".implode(",", $excludes).") ";
		}

		$query = 'SELECT n.*, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n  WHERE '
				.'n.is_active = 1 '.$exclude_query.' '
				.'ORDER BY n.is_pinned ASC, n.created_date DESC ';

		$rows = $this->db->query($query.'LIMIT '.$offset.", ".$limit)->result_array();
		$total = $this->db->query($query)->num_rows();

		$lists = $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE,
									'dateformat' => 'd F Y'
							  ]);

		$totalpage = ceil($total/$limit);
		$nextpage = ($page < $totalpage) ? $page+1 : 0;

		return [
			'lists' => $lists,
			'nextpage' => $nextpage,
			'currentpage' => $page
		];
	}

	public function get_lists_from_category($category_id = 0, $max = 10,$page = 1,$excludes = []) {
		$offset = 0;
		$limit = $max;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$exclude_query = "";
		if(count($excludes) > 0) {
			$exclude_query = " AND id NOT IN (".implode(",", $excludes).") ";
		}

		$include_query = "";
		$rows = [];
		$total = 0;

		if($category_id != 0) {
			$rel = $this->db->get_where('news_category_relations',['category_id'=>$category_id])->result_array();
			$ids = [];
			foreach ($rel as $key => $value) {
				$ids[] = $value['news_id'];
			}

			if(count($ids) > 0) {
				$include_query = " AND id IN (".implode(",", $ids).") ";

				$query = 'SELECT n.*, '
				    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
				    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
				    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
					.'FROM '.$this->db->dbprefix('news').' n  WHERE '
					.'n.is_active = 1 '.$exclude_query.' '.$include_query.' '
					.'ORDER BY n.is_pinned ASC, n.created_date DESC ';

				$rows = $this->db->query($query.'LIMIT '.$offset.", ".$limit)->result_array();
				$total = $this->db->query($query)->num_rows();
			}
		} else {
			$query = 'SELECT n.*, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n  WHERE '
				.'n.is_active = 1 '.$exclude_query.' '
				.'ORDER BY n.is_pinned ASC, n.created_date DESC ';

			$rows = $this->db->query($query.'LIMIT '.$offset.", ".$limit)->result_array();
			$total = $this->db->query($query)->num_rows();
		}
		
		$lists = $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE,
									'dateformat' => 'd F Y'
									
							  ]);

		$totalpage = ceil($total/$limit);
		$nextpage = ($page < $totalpage) ? $page+1 : 0;

		return [
			'lists' => $lists,
			'nextpage' => $nextpage,
			'currentpage' => $page
		];
	}

	public function get_detail_by_slug($slug) {
		$query = 'SELECT n.*,'
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n  WHERE n.is_active = 1 AND n.slug = "'.$slug.'" ';

		$rows = $this->db->query($query)->result_array();

		if(count($rows) == 0) {
			return FALSE;
		}

		$rows = $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE,
									'medias' => TRUE
							  ]);
		return end($rows);	
	}

	public function get_detail_by_id($id,$ignore_draft = FALSE) {
		$query = 'SELECT n.*, n.thumbnail_wide AS thumb_wide, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n  WHERE n.id = "'.$id.'" ';

		$query .= ($ignore_draft) ? ' AND n.is_active != 0 ' : ' AND n.is_active = 1 ';

		$rows = $this->db->query($query)->result_array();

		if(count($rows) == 0) {
			return FALSE;
		}

		$rows = $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE,
									'medias' => TRUE
							  ]);
		return end($rows);	
	}

	public function get_categories() {
		return $this->db->get_where('news_categories',['is_active'=>1])->result_array();
	}

	public function get_product_by_category($category_id = 0, $page = 1, $max = 4) {
		$offset = 0;
		$limit = $max;

		if($page > 1) {
			$offset = ($page - 1) * $limit;
		}

		$query = 'SELECT n.*, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n LEFT JOIN '.$this->db->dbprefix('news_category_relations').' r ON r.news_id = n.id WHERE '
				.'n.is_active = 1 AND r.category_id = '.$category_id.' '
				.'ORDER BY n.is_pinned ASC, n.created_date DESC ';

		$rows = $this->db->query($query.'LIMIT '.$offset.", ".$limit)->result_array();
		$total = $this->db->query($query)->num_rows();

		$lists = $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE,
									'dateformat' => 'Y/m/d'
							  ]);

		$totalpage = ceil($total/$limit);
		$nextpage = ($page < $totalpage) ? $page+1 : 0;
		$prevpage = ($page > 1) ? $page-1 : 0;

		return [
			'lists' => $lists,
			'nextpage' => $nextpage,
			'prevpage' => $prevpage,
			'category' => $category_id,
			'currentpage' => $page
		];
	}

	public function get_by_search($query = "") {
		$query = 'SELECT n.*, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "title" AND ref_id = n.id) AS title_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "tagline" AND ref_id = n.id) AS tagline_text, '
			    .'(SELECT text FROM '.$this->db->dbprefix('langs').' WHERE language = "'.$this->lang.'" AND type = "news" AND item = "content" AND ref_id = n.id) AS content_text '
				.'FROM '.$this->db->dbprefix('news').' n WHERE (title LIKE "%'.$query.'%" OR tagline LIKE "%'.$query.'%" OR content LIKE "%'.$query.'%") AND n.is_active = 1 '
				.'ORDER BY n.is_pinned ASC, n.created_date DESC ';

		$rows = $this->db->query($query)->result_array();

		return $this->prepare($rows,[
									'shortify' => TRUE,
									'thumbnail' => TRUE,
									'dateformat' => 'Y/m/d'
							  ]);


		
	}
}