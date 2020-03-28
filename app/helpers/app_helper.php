<?php

if( !function_exists('aph_shorttext') ){
    function aph_shorttext($text,$numb) {
        if (strlen($text) > $numb) { 
          $text = substr($text, 0, $numb); 
          $text = substr($text,0,strrpos($text," ")); 
          $etc = " ...";  
          $text = $text.$etc; 
        }
        return $text; 
    }
}

/* Get assets URL */
if( !function_exists('assets_url') ){
    function assets_url($path=''){
        return base_url('assets/'.$path);
    }
}

/* Get shortname */
if( !function_exists('aph_shortname') ){
	function aph_shortname($fullname,$long=10){
		$name = '';
		if(strlen($fullname)<=$long){
			$name = $fullname;
		}else{
			$fn = explode(' ',$fullname);
			
            if( count($fn) > 1){
                if(strlen($fn[0] .' '. $fn[1])<=$long){
                    $name = $fn[0] .' '. $fn[1];
                }else{
                    $name = $fn[0];
                }
            }else{
                $name = $fn[0]; 
            }
            /*
            foreach($fn as $f){
				if(strlen($f)>1){
					$name = $f;
					break;
				}
			}
            */
		}
		return $name;
	}
}

/* Cut fullname */
if( !function_exists('aph_cut_name') ){
	function aph_cut_name($fullname,$word=2){
		$n = explode(' ',$fullname);
		$name = '';
		$f = true;
		for($i=0;$i<$word;$i++){
            if(isset($n[$i])){
    			if(!$f){
    				$name .= ' ';
    			}else{
    				$f = false;
    			}
    			$name .= $n[$i];
		    }
        }
		return $name;
	}
}

/* seconds to time string */
if( !function_exists('aph_seconds_to_time') ){
	function aph_seconds_to_time($time){
		$menit_text = '0m';
    $menit = floor($time/60);
    if($menit>0){
        $menit_text = $menit.'m';
    }
    $detik_text = '0s';
    $detik = $time%60;
    if($detik>0){
        $detik_text = $detik.'s';
    }		
		return $menit_text.' '.$detik_text;
	}
}

if ( ! function_exists('array_to_csv'))
{
    function array_to_csv($array, $download = "")
    {
        if ($download != "")
        {    
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
        }        

        ob_start();
        $f = fopen('php://output', 'w') or show_error("Can't open php://output");
        $n = 0;        
        foreach ($array as $line)
        {
            $n++;
            if ( ! fputcsv($f, $line))
            {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();

        if ($download == "")
        {
            return $str;    
        }
        else
        {    
            echo $str;
        }        
    }
}

if ( ! function_exists('query_to_csv'))
{
    function query_to_csv($query, $download = "")
    {
        $new_array = array();
        
        //first line
        $str = array();
        foreach ($query[0] as $k => $v) {
            $str[] = $k;
        }
        $new_array[] = $str;
        $str = array();
        
        //other line
        foreach ($query as $key => $value) {
            foreach ($value as $k => $v) {
                $str[] = $v;
            }

            $new_array[] = $str;
            $str = array();
        }

        array_to_csv($new_array,$download);
    }
}

if ( ! function_exists('aph_string_url'))
{
	function aph_string_url($text,$target='_BLANK') {
	    $text = @eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '<a target="'.$target.'" href="\\1">\\1</a>', $text);
	    $text = @eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '\\1<a target="'.$target.'" href="http://\\2">\\2</a>', $text);
	    $text = @eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})', '<a target="'.$target.'" href="mailto:\\1">\\1</a>', $text);
	    return $text;
	}
}

if ( ! function_exists('render_month_dropdown'))
{
    function render_month_dropdown($first_label="",$mo_selected=0) {
        $month = array(
                    'all' => 'Sepanjang Waktu',
                    'week' => '7 Hari Terakhir',
                    'month' => '30 Hari Terakhir',
                    'year' => '1 Tahun Terakhir',
                    'set' => 'Rentang Tanggal'
                 );

        $drop = "";

        if(!empty($first_label)) {
            echo '<option value="">'.$first_label.'</option>';
        }
        foreach ($month as $key => $value) {
            $select = ($i != 0 and $i == $key) ? 'selected' : '';
            echo '<option value="'.$key.'" '.$select.'>'.$value.'</option>';
        }
    }


    
}

if ( ! function_exists('render_month_dropdown_2'))
{
    function render_month_dropdown_2($first_label="",$mo_selected=0) {
        $month = array(
                    'all' => 'Sepanjang Waktu',
                    '1' => 'Januari',
                    '2' => 'Februari',
                    '3' => 'Maret',
                    '4' => 'April',
                    '5' => 'Mei',
                    '6' => 'Juni',
                    '7' => 'Juli',
                    '8' => 'Agustus',
                    '9' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember'
                 );

        $drop = "";

        if(!empty($first_label)) {
            echo '<option value="">'.$first_label.'</option>';
        }
        foreach ($month as $key => $value) {
            $select = ($mo_selected != 0 and $mo_selected == $key) ? 'selected' : '';
            echo '<option value="'.$key.'" '.$select.'>'.$value.'</option>';
        }
    }


    
}

if ( ! function_exists('render_month_dropdown_3'))
{
    function render_month_dropdown_3($first_label="",$mo_selected=0) {
        $month = array(
                    'all' => 'Sepanjang Waktu',
                    '2015' => '2015',
                    '2016' => '2016',
                    '2017' => '2017',
                    '2018' => '2018',
                    '2019' => '2019',
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025'
                 );

        $drop = "";

        if(!empty($first_label)) {
            echo '<option value="">'.$first_label.'</option>';
        }
        foreach ($month as $key => $value) {
            $select = ($mo_selected != 0 and $mo_selected == $key) ? 'selected' : '';
            echo '<option value="'.$key.'" '.$select.'>'.$value.'</option>';
        }
    }


    
}

if ( ! function_exists('render_city_dropdown'))
{
    function render_city_dropdown($first_label="",$mo_selected=0) {
        $CI =& get_instance();
        $cities = $CI->api_model->get_where('kota',array('is_actived'=>1,'is_deleted'=>0))->result_array();

        $month = array(
                    'all' => 'Semua Kota'
                 );

        foreach ($cities as $key => $value) {
            $month[$value['id']] = $value['name'];
        }

        $drop = "";

        if(!empty($first_label)) {
            echo '<option value="">'.$first_label.'</option>';
        }
        foreach ($month as $key => $value) {
            $select = ($mo_selected != 0 and $mo_selected == $key) ? 'selected' : '';
            echo '<option value="'.$key.'" '.$select.'>'.$value.'</option>';
        }
    }
}

if( ! function_exists(('get_option'))) {
    function get_option($key = NULL,$is_serialized = FALSE,$filter = '') {
        if($key == NULL) {
            return "";
        }

        $CI =& get_instance();
        $val = $CI->db->get_where('options',array('option_key'=>$key))->row();
        $line_str = "";

        if(!$is_serialized) {
            $line_str = (isset($val->option_value)) ? $val->option_value : "";
        } else {
            $data = @unserialize($val->option_value);
            $line_str = ($data != FALSE) ? $data : ((isset($val->option_value)) ? $val->option_value : "");
        }

        $line_str = str_replace(["{{baseurl}}","{{year}}"], [base_url(),date('Y')], $line_str);

        switch ($filter) {
            case 'UPPERCASE':
                $line_str = strtoupper($line_str);
                break;
            case 'LOWERCASE':
                $line_str = strtolower($line_str);
                break;
            case 'CAMELCASE':
                $line_str = strtolower($line_str);
                $line_str = ucwords($line_str);
                break;
            case 'CAPITALFIRST':
                $line_str = strtolower($line_str);
                $line_str = ucfirst($line_str);
                break;
        }

        return $line_str;
    }
}
if ( ! function_exists('update_option')) {
     function update_option($key,$value,$attr=[]) {
        $CI =& get_instance();

        if(empty($key)) {
            return FALSE;
        }

        $val = $CI->db->get_where('options',array('option_key'=>$key))->row();

        if(!isset($val->option_key)) {
            $datas = array_merge(array('option_key'=>$key,'option_value'=>$value),$attr);
            return $CI->db->insert('options',$datas);
        }

        return $CI->db->update('options',array('option_value'=>$value),array('option_key'=>$key));
    }
}


if( ! function_exists(('get_option_lang'))) {
    function get_option_lang($key = NULL) {
        if($key == NULL) {
            return "";
        }

        $CI =& get_instance();

        $lang = $CI->session->userdata('global_language');
        
        if($lang == FALSE) {
            $lang = 'id';
        }

        $val = $CI->db->get_where('options',array('option_key'=>$key))->row();
       
        if(isset($val->option_value)) {
           $lang = strtolower($lang);
           $line = @unserialize($val->option_value); 
           if($line != FALSE and isset($line[$lang])) {
              return $line[$lang];
           } else {
              return $line;
           }
        }
        return "";
    }
}

if ( ! function_exists('add_option')) {
     function add_option($key,$value,$attr = []) {
        $CI =& get_instance();

        if(empty($key)) {
            return FALSE;
        }

        $datas = array_merge(array('option_key'=>$key,'option_value'=>$value),$attr);
        return $CI->db->insert('options',$datas);
    }
}

if( ! function_exists(('get_lang'))) {
    function get_lang($type = NULL,$item = NULL,$ref = NULL,$lang = 'id') {
        if($type == NULL or $item == NULL or $ref == NULL) {
            return "";
        }

        $CI =& get_instance();
        $val = $CI->db->get_where('langs',array('ref_id'=>$ref,'type'=>$type,'item'=>$item,'language'=>$lang))->row();
       
        return (isset($val->text)) ? $val->text : '';
    }
}

if( ! function_exists(('get_lang_text'))) {
    function get_lang_text($lang = 'id',$type = NULL,$item = NULL,$ref = NULL) {
        if($type == NULL or $item == NULL or $ref == NULL) {
            return "";
        }

        $CI =& get_instance();
        $val = $CI->db->get_where('langs',array('ref_id'=>$ref,'type'=>$type,'item'=>$item,'language'=>$lang))->row();
       
        return (isset($val->text)) ? $val->text : '';
    }
}

if( ! function_exists(('set_lang'))) {
    function set_lang($lang = 'id', $type = NULL,$item = NULL,$ref = NULL, $text = "") {
        if($type == NULL or $item == NULL or $ref == NULL) {
            return "";
        }

        $CI =& get_instance();
        $check = $CI->db->get_where('langs',array('ref_id'=>$ref,'type'=>$type,'item'=>$item,'language'=>$lang))->row();
       
        if(isset($check->id)) {
            return $CI->db->update('langs',['text'=>$text],['id'=>$check->id]);
        }

        return $CI->db->insert('langs',array('ref_id'=>$ref,'type'=>$type,'item'=>$item,'language'=>$lang,'text'=>$text));
    }
}



if( ! function_exists('check_image') ) {
    function check_image($path,$filename) {
        $return = site_url('assets/images/dummy.png');

        if(!empty($filename) and file_exists("./".$path.$filename)) {
            $return = site_url($path.$filename);
        }

        return $return;
    }
}

if( ! function_exists('slugify') ) {
    function slugify($text) {
        $text = strtolower($text);
        $replace_lists = array(" ","\"","'","\\",",",".","?","/","<",">",
                               ":",";","{","}","[","]","|","+","=","(",")",
                               "*","&","ˆ","%","$","#","@","!","`","˜");
        $replace = str_replace($replace_lists,"-",$text);
        return strtolower($replace);
    }
}

if( ! function_exists('get_available_langs') ) {
    function get_available_langs() {
        $langs = get_option('language-options');
        $langs = @unserialize($langs);

        if($langs == FALSE) {
            return [];
        }

        return $langs;
    }
}

if( ! function_exists('render_tab_text') ) {
    function render_tab_text($heading = '', 
                             $name = '', 
                             $default_value = '', 
                             $lang_value_attr = [],
                             $additional_class = '',
                             $max_character = 0) {
        $langs = get_available_langs();
        ob_start();

        ?>
        <div class="form-group">
            <fieldset>
                <legend><?php echo $heading; ?></legend>
                <!--
                <ul class="nav nav-tabs" role="tablist">
                    <?php $i = 0; foreach($langs as $key => $value): ?>
                    <li role="presentation" <?php if($i == 0) echo 'class="active"'; ?>><a href="#<?php echo $name.$key; ?>" aria-controls="<?php echo $name.$key; ?>" role="tab" data-toggle="tab"><?php echo $value['label']; ?></a></li>
                    <?php $i++; endforeach; ?>
                </ul>
            -->
                <div class="tab-content">
                    <?php 
                    $i = 0; 
                    foreach($langs as $key => $value): 
                        $val = $default_value; 
                        if(isset($lang_value_attr['type']) and isset($lang_value_attr['item']) and isset($lang_value_attr['ref'])) {
                            $val = get_lang_text($key,$lang_value_attr['type'],$lang_value_attr['item'],$lang_value_attr['ref']);
                            if(empty($val)) {
                                $val = $default_value;
                            }
                        }
                    ?>
                    <div role="tabpanel" class="tab-pane <?php if($max_character > 0) echo "max-limit" ?> <?php if($i == 0) echo 'active'; ?>" id="<?php echo $name.$key; ?>">
                        <input class="form-control <?php echo $additional_class; ?>" type="text" name="<?php echo $name; ?>[<?php echo $key; ?>]" value="<?php echo $val; ?>">
                        <?php if($max_character > 0): ?><p class="help-block"><span class="counter-left" data-max="<?php echo $max_character; ?>"><?php echo $max_character - strlen($val); ?></span> Characters left</p><?php endif; ?>
                    </div>
                    <?php $i++; endforeach; ?>
                </div>         
            </fieldset>           
        </div>

        <?php

        echo ob_get_clean();
    }
}

if( ! function_exists('render_tab_long_text') ) {
    function render_tab_long_text($heading = '', 
                             $name = '', 
                             $default_value = '', 
                             $lang_value_attr = [],
                             $additional_class = '') {
        $langs = get_available_langs();
        ob_start();

        ?>
        <div class="form-group">
            <fieldset>
                <legend><?php echo $heading; ?></legend>
                <!--
                <ul class="nav nav-tabs" role="tablist">
                    <?php $i = 0; foreach($langs as $key => $value): ?>
                    <li role="presentation" <?php if($i == 0) echo 'class="active"'; ?>><a href="#<?php echo $name.$key; ?>" aria-controls="<?php echo $name.$key; ?>" role="tab" data-toggle="tab"><?php echo $value['label']; ?></a></li>
                    <?php $i++; endforeach; ?>
                </ul>
            -->
                <div class="tab-content">
                    <?php 
                    $i = 0; 
                    foreach($langs as $key => $value): 
                        $val = $default_value; 
                        if(isset($lang_value_attr['type']) and isset($lang_value_attr['item']) and isset($lang_value_attr['ref'])) {
                            $val = get_lang_text($key,$lang_value_attr['type'],$lang_value_attr['item'],$lang_value_attr['ref']);
                            if(empty($val)) {
                                $val = $default_value;
                            }
                        }
                    ?>
                    <div role="tabpanel" class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="<?php echo $name.$key; ?>">
                        <textarea style="width: 100%;height: 300px;" class="form-control <?php echo $additional_class; ?>" type="text" name="<?php echo $name; ?>[<?php echo $key; ?>]"><?php echo $val; ?></textarea>
                    </div>
                    <?php $i++; endforeach; ?>
                </div>         
            </fieldset>           
        </div>

        <?php

        echo ob_get_clean();
    }
}

if( ! function_exists('render_uploader') ) {
    function render_uploader($name = '', 
                             $default_value = '',
                             $placeholder = '',
                             $box_size = [200,200],
                             $label_size = [200,200]) {
        ob_start();

        ?>
        <div class="box-upload" style="width: <?php echo $box_size[0]; ?>;height: <?php echo $box_size[1]; ?>;">
             <input type="file" class="image-picker" name="<?php echo $name; ?>">
             <div class="base">
                <div class="label">
                    <i class="fa fa-photo"></i>
                    <br>
                    <span><?php echo $placeholder; ?><br><b><?php echo $label_size[0]; ?> x <?php echo $label_size[1]; ?></b></span>
                </div>
             </div>
             <img src="<?php echo $default_value;?>" <?php if(!empty($default_value)) echo 'class="on"';?>>
             <button class="upload-button" type="button"><i class="fa fa-upload"></i></button>
        </div>

        <?php

        echo ob_get_clean();
    }
}

if( ! function_exists('render_multi_uploader') ) {
    function render_multi_uploader($name = '', 
                             $default_value = [],
                             $placeholder = '',
                             $box_size = [200,200],
                             $label_size = [200,200]) {
        ob_start();

        ?>
        <div class="multi-uploader-media" id="<?php echo $name.'multiuploader'; ?>">
            <div class="filepicker-container" style="width: 0;height: 0;overflow: hidden;">
                <?php 
                foreach ($default_value as $key => $value) { 
                    echo '<input type="text" name="exist'.$name.'[]" id="'.$name.$key.'" value="'.$value['name'].'">';
                }
                ?>    
            </div>
            <?php 
            foreach ($default_value as $key => $value) { 
            ?>
            <div class="box-image" style="width: <?php echo $box_size[0]; ?>;height: <?php echo $box_size[1]; ?>;" data-relid="#<?php echo $name.$key; ?>">
                <img src="<?php echo $value['path']; ?>" class="on">
                <button class="remove" type="button"><i class="fa fa-trash"></i></button>
            </div>
            <?php }  ?>
            <div class="box-upload" style="width: <?php echo $box_size[0]; ?>;height: <?php echo $box_size[1]; ?>;">
                 <div class="base">
                    <div class="label">
                        <i class="fa fa-plus"></i>
                        <br>
                        <span><?php echo $placeholder; ?><br><b><?php echo $label_size[0]; ?> x <?php echo $label_size[1]; ?></b></span>
                    </div>
                 </div>
                 <button class="upload-button multi-uploader" 
                         data-name="<?php echo $name; ?>"
                         data-container="#<?php echo $name.'multiuploader'; ?>" 
                         data-width="<?php echo $box_size[0]; ?>"
                         data-height="<?php echo $box_size[1]; ?>" 
                         type="button"><i class="fa fa-upload"></i></button>
            </div>
        </div>
        <?php

        echo ob_get_clean();
    }
}

if( !function_exists('get_user_point') ) {
    function get_user_point($uid) {
        $CI =& get_instance();
        $user = $CI->db->get_where('user',array('id'=>$uid,'is_active'=>1))->row();

        if(!isset($user->id)) {
            return 0;
        }

        $phone = $user->phone;

        if(empty($phone)) {
            return 0;
        }

        $url = "https://crm.pti-cosmetics.com/api/wardah/consumer/point?token=".get_option('pti-point-token')."&phone=".$phone;

        $ch = curl_init();  
 
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
     
        $output=curl_exec($ch);
     
        curl_close($ch);

        if(!empty($output) and $output != FALSE) {
            $save = $CI->db->update('user',['point_count'=>$output],['id'=>$user->id]);

            if(isset($save) and $save != FALSE) {
                $CI->db->insert('user_point_log',[
                                                'user_id' => $user->id,
                                                'point' => $output,
                                                'created_date' => date('Y-m-d H:i:s')
                                                ]);

                return $output;
            }
        }

        return 0;
    } 
}

if( !function_exists('date_compared_array') ) {
    function date_compared_array($a, $b) {
        $t1 = strtotime($a['submission_date']);
        $t2 = strtotime($b['submission_date']);
        return $t2 - $t1;
    }    
}
