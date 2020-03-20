<?php
class Project_model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	public function get_newest_project($max = 5) {
		$rows = $this->db->query('SELECT * FROM ak_projects WHERE is_active = 1 ORDER BY created_date DESC LIMIT 0,'.$max);
		return $rows->result_array();
	}


}