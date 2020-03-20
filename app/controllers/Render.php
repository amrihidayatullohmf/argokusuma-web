<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/APP_Frontend.php';
class Render extends APP_Frontend {

	public function __construct() {
		parent::__construct();
	}

	public function serial() {
		$data = [
			'id' => ['label'=>'Indonesia','flag'=>'id.png'],
			'en' => ['label'=>'English','flag'=>'us.png']
		];
		echo serialize($data);
		exit;
	}

	public function lang() {
		if(isset($_POST['key']) and !empty($_POST['key'])) {
			$keys = $this->input->post('key');
			$keys = strtolower($keys);
			$langs = get_option('language-options',TRUE);
			$vals = [];
			$opts = [];
			foreach ($langs as $key => $value) {
				$vals[$key] = $this->input->post($key);
				$opts[] = $key;
			}
			$opts_str = implode(",", $opts);
			$vals_str = serialize($vals);
			$caption = str_replace("-", " ", $keys);
			$caption = ucwords($caption);

			update_option($keys,$vals_str,array('option_group'=>'lang','field_type'=>'longtext','caption'=>$caption,'language_options'=>$opts_str,'editable'=>1));
		}
		$this->load->view('frontend/render_lang');
	}

	public function images() {
		$datas = [
			[
				'key' => "upper-home-images",
				'caption' => 'Homepage Welcome Background',
				'sets' => [
					's1.jpg',
					's3.jpg',
					's4.jpg',
					's5.jpeg',
					's6.jpg',
					's7.jpeg',
					's8.jpg',
					's9.jpg',
					's10.jpg'
				]
			],
			[
				'key' => "background-urban-jajan",
				'caption' => 'Urban Jajan Background',
				'sets' => 'urbanjajan.jpg'
			],
			[
				'key' => "background-temu-rasa",
				'caption' => 'Temu Rasa Background',
				'sets' => 'temurasa.jpg'
			],
			[
				'key' => "background-serambi-temu",
				'caption' => 'Serambi Temu Background',
				'sets' => 'serambi.jpg'
			],
			[
				'key' => "background-testimony",
				'caption' => 'Testimony Background',
				'sets' => 'testimony.jpg'
			],
			[
				'key' => "top-cover-about",
				'caption' => 'Top Cover About',
				'sets' => 'cover1.jpg'
			],
			[
				'key' => "about-tiles",
				'caption' => 'About Tiles Background',
				'sets' => [
					's1.jpg',
					's2.jpeg',
					's3.jpg',
					's4.jpg',
					's5.jpeg',
					's6.jpg',
					's7.jpeg',
					's8.jpg',
					's9.jpg',
					's10.jpg',
					's3.jpg',
					's4.jpg'
				]
			],
			[
				'key' => "top-cover-urbanjajan",
				'caption' => 'Top Cover About',
				'sets' => 'cover1.jpg'
			],
			[
				'key' => "top-cover-serambi",
				'caption' => 'Top Cover About',
				'sets' => 'cover2.jpg'
			],
			[
				'key' => "top-cover-temurasa",
				'caption' => 'Top Cover About',
				'sets' => 'cover3.jpg'
			],
			[
				'key' => "top-cover-gallery",
				'caption' => 'Top Cover Gallery',
				'sets' => 'cover4.jpg'
			]
		];

		foreach ($datas as $key => $value) {
			$vals = (is_array($value['sets'])) ? serialize($value['sets']) : $value['sets'];
			update_option($value['key'],$vals,array('option_group'=>'image','field_type'=>'imagesets','caption'=>$value['caption'],'language_options'=>'','editable'=>1));
		}
	}

	public function exportoptions() {
		header('Content-Type: application/json');
		$types = $this->db->query('SELECT DISTINCT(option_group) AS optgroup FROM ak_options')->result_array();
		$exports = [];
		foreach ($types as $key => $value) {
			$lists = $this->db->get_where('options',['option_group'=>$value['optgroup']])->result_array();
			$rows = [];
			foreach ($lists as $k => $v) {
				$rows[] = [
					'option_key' => $v['option_key'],
					'option_value' => $v['option_value'],
					'field_type' => $v['field_type'],
					'caption' => $v['caption'],
					'desclimer' => $v['desclimer'],
					'editable' => $v['editable']
				];
			}
			$exports[$value['optgroup']] = $rows;
		}
		echo json_encode($exports);
		exit;
	}

	public function importoptions() {
		$get = $this->input->get('filename');
		$file = (isset($get) and !empty($get)) ? $get : 'options01.json';

		$json = file_get_contents('./medias/'.$file);

		if(!empty($json) and $json != FALSE) {
			$json = json_decode($json);

			foreach ($json as $key => $value) {
				foreach ($value as $k => $v) {
					$check = $this->db->get_where('options',['option_key'=>$v->option_key])->row();
					$set = NULL;

					$datas = [
						'option_key' => $v->option_key,
						'option_value' => $v->option_value,
						'option_group' => $key,
						'field_type' => $v->field_type,
						'caption' => $v->caption,
						'desclimer' => $v->desclimer,
						'editable' => $v->editable
					];

					if(isset($check->id)) {
						$set = $this->db->update('options',$datas,['id'=>$check->id]);
					} else {
						$set = $this->db->insert('options',$datas);
					}

					if(isset($set) and $set != FALSE) {
						echo $key." - ".$v->option_key."<br>";
					}
				}
			}
		}

	}

	
}