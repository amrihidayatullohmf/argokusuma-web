<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Home extends APP_Frontend {

	public function __construct()
	{
		parent::__construct();

		$this->_data['clients'] = $this->project->get_clients(3);
	}

	public function index() {
		$this->_data['slider'] = $this->general->get_slider();
		$this->_data['projects'] = $this->project->get_newest_project();
		$this->_data['testimonials'] = $this->general->get_newest_testimony();
		$this->_data['teams'] = $this->general->get_teams(3);		

		$csrf_token = $this->generate_csrf('subscription_form');
		$this->_data['csrf_token'] = $csrf_token;

		$this->_addContent($this->_data);
		$this->_render();
	}

	


	public function subscription($csrf_token = '') {
		$return = ['code'=>500,'msg'=>'CSRF Token session is expired, please reload page to renew token !'];

		if($this->is_match_token('subscription_form',$csrf_token)) {
			$email = $this->input->post('email',TRUE);
			if(!empty($email)) {
				if(!$this->general->is_exist_subscription($email)) {
					$save = $this->general->save_subscription($email);

					if(isset($save) and $save != FALSE) {
						$csrf_token = $this->generate_csrf('subscription_form');	
						$return = ['code'=>200,'msg'=>'Thank you for submitting your E-Mail','action'=>site_url('home/subscription/'.$csrf_token)];
					} else {
						$return = ['code'=>500,'msg'=>'Fail to save your email, try again later !'];
					}					
				} else {
					$return = ['code'=>500,'msg'=>'E-Mail is already exist !'];
				}
			} else {
				$return = ['code'=>500,'msg'=>'E-Mail Can not be empty !'];
			}
		}

		echo json_encode($return);
		exit;
	}

	public function aboutus() {
		$this->_data['teams'] = $this->general->get_teams(1000);	
		$this->_addContent($this->_data);
		$this->_render();
	}

	public function contactus() {
		$csrf_token = $this->generate_csrf('contact_form');
		$this->_data['csrf_token'] = $csrf_token;

		$this->_addContent($this->_data);
		$this->_render();
	}

	public function contactsubmission($csrf_token) {
		$return = ['code'=>500,'msg'=>'CSRF Token session is expired, please reload page to renew token !'];

		if($this->is_match_token('contact_form',$csrf_token)) {
			$firstname = $this->input->post('firstname',TRUE);
			$lastname = $this->input->post('lastname',TRUE);
			$email = $this->input->post('email',TRUE);
			$message = $this->input->post('message',TRUE);
			if(!empty($email) and !empty($message) and !empty($firstname)) {
				$save = $this->general->save_contact_submission($firstname,$lastname,$email,$message);

				if(isset($save) and $save != FALSE) {
					$csrf_token = $this->generate_csrf('contact_form');	
					$return = ['code'=>200,'msg'=>'Thank you for submitting your message','action'=>site_url('home/subscription/'.$csrf_token)];
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