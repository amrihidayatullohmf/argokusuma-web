<?php
class General_model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}


	public function get_slider() {
		$now = date('Y-m-d H:i:s');
		$slides = $this->db->query("SELECT s.* FROM ak_sliders s WHERE s.start_date <= '".$now."' AND s.end_date >= '".$now."' AND s.is_active = 1");
		return $slides->result_array();
	}

	public function get_newest_testimonay($max = 3) {
		$rows = $this->db->query('SELECT * FROM ak_testimonials WHERE is_active = 1 ORDER BY created_date DESC LIMIT 0,'.$max);
		return $rows->result_array();
	}

}