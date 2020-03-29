<?php
class Project_model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function get_newest_project($max = 5) {
		$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('portofolio')} WHERE is_active = 1 AND is_pinned = 1 ORDER BY created_date DESC LIMIT 0,".$max);
		return $rows->result_array();
	}

	public function get_clients($max = 3) {
		$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('portofolio_clients')} WHERE is_active = 1 AND is_pinned = 1 ORDER BY created_date DESC LIMIT 0,".$max);
		return $rows->result_array();
	}

	public function get_categories() {
		$rows = $this->db->get_where('portofolio_categories',['is_active'=>1]);
		return $rows->result_array();
	}

	public function get_project_lists($slug = 'all',$offset = 0, $limit = 10) {
		$inids = "";

		if($slug != 'all') {
			$ids = $this->db->query("SELECT r.portofolio_id FROM {$this->db->dbprefix('portofolio_category_relations')} r LEFT JOIN {$this->db->dbprefix('portofolio_categories')} c ON c.id = r.category_id WHERE c.slug = '".$slug."' GROUP BY r.portofolio_id")->result_array();
			$lists = [];
			foreach ($ids as $key => $value) {
				$lists[] = $value['portofolio_id'];
			}
			
			if(count($lists) > 0) {
				$lists_str = implode(",", $lists);
				$inids = " AND id IN (".$lists_str.") ";	
			}
		}

		$query = "SELECT * FROM {$this->db->dbprefix('portofolio')} WHERE is_active = 1 ".$inids." ORDER BY created_date DESC";

		$total = $this->db->query($query)->num_rows();
		$rows = $this->db->query($query." LIMIT ".$offset.",".$limit)->result_array();
	
		foreach ($rows as $key => $value) {
			$rows[$key]['thumb'] = site_url('medias/projects/'.$value['thumbnail']);
			$rows[$key]['url'] = site_url('portfolio/'.$value['slug']);
			$rows[$key]['snippet'] = substr(strip_tags($value['overview']), 0, 100);
		}

		return ['rows'=>$rows,'total'=>$total];
	}

	public function get_detail($slug = '') {
		$get = $this->db->query("SELECT p.*, c.name AS cname FROM {$this->db->dbprefix('portofolio')} p LEFT JOIN {$this->db->dbprefix('portofolio_clients')} c ON c.id = p.client_id WHERE p.is_active = 1 AND p.slug = '".$slug."'")->row();
		
		if(!isset($get->id)) {
			return FALSE;
		}	

		$get->medias = $this->db->get_where('portofolio_images',['portofolio_id'=>$get->id,'is_active'=>1])->result_array();
		$categories = $this->db->query("SELECT c.category, c.id FROM {$this->db->dbprefix('portofolio_category_relations')} r LEFT JOIN {$this->db->dbprefix('portofolio_categories')} c ON c.id = r.category_id WHERE r.portofolio_id = ".$get->id." GROUP BY r.category_id")->result_array();

		$cids = [];
		$cnames = [];

		foreach ($categories as $key => $value) {
			$cids[] = $value['id'];
			$cname[] = $value['category'];
		}

		$get->categories = ['ids'=>$cids,'names'=>$cname];

		return $get;
	}

	public function get_related_projects($category_ids = [], $max = 4) {
		$where = "";

		if(count($category_ids) > 0) {
			//$where = ' WHERE r.category_id IN ('.implode(",", $category_ids).') ';
		}

		$get = $this->db->query("SELECT p.* FROM {$this->db->dbprefix('portofolio')} p LEFT JOIN {$this->db->dbprefix('portofolio_category_relations')} r ON p.id = r.portofolio_id ".$where." GROUP BY r.portofolio_id ORDER BY RAND() LIMIT 0,".$max)->result_array();
	
		foreach ($get as $key => $value) {
			$get[$key]['thumb'] = site_url('medias/projects/'.$value['thumbnail']);
			$get[$key]['url'] = site_url('portfolio/'.$value['slug']);
			$get[$key]['snippet'] = substr(strip_tags($value['overview']), 0, 100);
		}

		return $get;
	}

}