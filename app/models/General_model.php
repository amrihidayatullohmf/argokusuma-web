<?php
class General_model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}


	public function get_slider() {
		$now = date('Y-m-d H:i:s');
		$slides = $this->db->query("SELECT s.* FROM {$this->db->dbprefix('sliders')} s WHERE s.start_date <= '".$now."' AND s.end_date >= '".$now."' AND s.is_active = 1");
		return $slides->result_array();
	}

	public function get_newest_testimony($max = 3) {
		$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('testimonials')} WHERE is_active = 1 ORDER BY created_date DESC LIMIT 0,".$max);
		return $rows->result_array();
	}

	public function get_teams($max = 3) {
		$rows = $this->db->query("SELECT * FROM {$this->db->dbprefix('teams')} WHERE is_active = 1 ORDER BY created_date DESC LIMIT 0,".$max);
		return $rows->result_array();
	}

	public function is_exist_subscription($email) {
		$check = $this->db->get_where('subscription',['email'=>$email,'is_active'=>1]);
		return ($check->num_rows() > 0) ? TRUE : FALSE;
	}

	public function save_subscription($email) {
		$this->load->library('user_agent');

		$user_agent = $this->agent->browser()." ".$this->agent->version()." ".$this->agent->mobile();
		$ip_address = $this->input->ip_address();

		return $this->db->insert('subscription',[
									'email' => $email,
									'ip_address' => $ip_address,
									'user_agent' => $user_agent,
									'is_active' => 1,
									'created_date' => date('Y-m-d H:i:s')
								]);
	}

	public function save_contact_submission($firstname,$lastname,$email,$message) {
		return $this->db->insert('contact_submission',[
									'first_name' => $firstname,
									'last_name' => $lastname,
									'email' => $email,
									'comment' => $message,
									'created_date' => date('Y-m-d H:i:s')
								]);
	}

	public function get_services() {
		return $this->db->get_where('services',['is_active'=>1])->result_array();
	}

	public function get_detail_service($slug) {
		$detail = $this->db->get_where('services',['is_active'=>1,'slug'=>$slug])->row_array();

		if(!isset($detail['id'])) {
			return FALSE;
		}

		$detail['extends'] = $this->db->get_where('services_extends',['service_id'=>$detail['id']])->result_array();

		return $detail;
	}

}