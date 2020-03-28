<div class="col-xs-12">
	<div class="box box-solid">
        <div class="box-body">
		<form method="post" enctype="multipart/form-data" action="<?php echo site_url('webtools/settings/save_setting'); ?>" id="general-setting"  >
		  <div class="alert" style="display: none"></div>
		  <input type="hidden" name="setting-group" value="<?php echo $category; ?>">
		  <?php 
		  foreach ($fields as $key => $value) { 
		  	if($value['editable'] == 0) {
		  		continue;
		  	}
		  	$caption = $value['caption'];
		  	if($value['field_type'] == 'text') {
		  		if($value['multiple_langs'] == 1) {
		  ?>
		  <div class="row">
		  	<?php foreach ($languages as $a => $b) { ?>
		  	<div class="col-md-6">
		  	 <div class="form-group">
		  	   <label for="field<?php echo $value['id'].$a; ?>"><?php echo $caption." (".ucwords($a).")"; ?></label>
		  	   <input type="text" class="form-control" id="field<?php echo $value['id'].$a; ?>" placeholder="" name="<?php echo $value['option_key'].'['.$b.']'; ?>" value="<?php echo get_option($value['option_key']); ?>" <?php if($value['editable'] == 0) echo 'disabled'; ?>>
		  	   <p class="help-block"><?php echo $value['desclimer']; ?></p>
		  	 </div>
     		</div>
        	<?php } ?>
		  </div>
		  <?php } else { ?>
		  	<div class="form-group">
			    <label for="field<?php echo $value['id']; ?>"><?php echo $caption; ?></label>
			    <input type="text" class="form-control" id="field<?php echo $value['id']; ?>" placeholder="" name="<?php echo $value['option_key']; ?>" value="<?php echo get_option($value['option_key']); ?>" <?php if($value['editable'] == 0) echo 'disabled'; ?>>
			    <p class="help-block"><?php echo $value['desclimer']; ?></p>
			  </div>
		  <?php 
		  } 
		  } else if($value['field_type'] == 'image')  { ?>
		  <div class="form-group">
		    <label for="field<?php echo $value['id']; ?>"><?php echo $caption; ?></label>
		    <?php 
		    $filename = get_option($value['option_key']);
		    if(!empty($filename)) {
		    	echo '<br><img src="'.site_url('assets/static/'.$filename).'"  class="img-thumbnail" width="200" style="background:#f0f0f0"><br><br>';
		    }
		    ?>
		    <input type="file" name="<?php echo $value['option_key']; ?>" accept="png,jpg,jpeg,gif" class="form-control" id="field<?php echo $value['id']; ?>" placeholder="" <?php if($value['editable'] == 0) echo 'disabled'; ?>>
		  	<p class="help-block"><?php echo $value['desclimer']; ?></p>
		  </div>
		  <?php 
		  } else if($value['field_type'] == 'longtext')  { 
		  	if($value['multiple_langs'] == 1) {
		  		$text = @unserialize($value['option_value']);
		  ?>
		 

		   <div class="form-group">
            <fieldset>
                <legend><?php echo $caption; ?></legend>
                <ul class="nav nav-tabs" role="tablist">
                    <?php $i = 0; foreach($languages as $a => $b): ?>
                    <li role="presentation" <?php if($i == 0) echo 'class="active"'; ?>><a href="#<?php echo $value['option_key'].$a; ?>" aria-controls="<?php echo $value['option_key'].$a; ?>" role="tab" data-toggle="tab"><?php echo $b['label']; ?></a></li>
                    <?php $i++; endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php $i = 0; foreach($languages as $a => $b): ?>
                    <div role="tabpanel" class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="<?php echo $value['option_key'].$a; ?>">
                        <textarea class="form-control" name="<?php echo $value['option_key'].'['.$a.']'; ?>" id="field<?php echo $value['id'].$a; ?>" placeholder=""  <?php if($value['editable'] == 0) echo 'disabled'; ?> rows="3"><?php echo isset($text[$a]) ? $text[$a] : $value['option_value']; ?></textarea>
			  			<p class="help-block"><?php echo $value['desclimer']; ?></p>
                    </div>
                    <?php $i++; endforeach; ?>
                </div>         
             </fieldset>           
        	</div>
		  
		  <?php } else { ?>
		  <div class="form-group">
		    <label for="field<?php echo $value['id']; ?>"><?php echo $caption; ?></label>
		    <textarea class="form-control" name="<?php echo $value['option_key']; ?>" id="field<?php echo $value['id']; ?>" placeholder=""  <?php if($value['editable'] == 0) echo 'disabled'; ?> rows="3"><?php echo get_option($value['option_key']); ?></textarea>
		  	<p class="help-block"><?php echo $value['desclimer']; ?></p>
		  </div>
		  <?php } } else if($value['field_type'] == 'toggle')  { ?>
		  <div class="form-group" style="margin: 30px 0;display: flex;justify-content: flex-start;align-items: center;">
		    <div>
		    <div class="onoffswitch">
			    <input type="checkbox" name="<?php echo $value['option_key']; ?>" class="onoffswitch-checkbox" value="1" id="field<?php echo $value['id']; ?>" <?php echo (get_option($value['option_key']) == 1) ? 'checked' : ''; ?>>
			    <label class="onoffswitch-label" for="field<?php echo $value['id']; ?>">
			        <span class="onoffswitch-inner"></span>
			        <span class="onoffswitch-switch"></span>
			    </label>
			</div>
			</div>
			<label for="field<?php echo $value['id']; ?>"><?php echo $caption; ?></label>
		  </div>
		  <?php } else if($value['field_type'] == 'number')  { ?>
		  <div class="form-group">
		    <label for="field<?php echo $value['id']; ?>"><?php echo $caption; ?></label>
		    <input type="number" min="1" name="<?php echo $value['option_key']; ?>" class="form-control" style="width: 100px" id="field<?php echo $value['id']; ?>" placeholder="" value="<?php echo get_option($value['option_key']); ?>" <?php if($value['editable'] == 0) echo 'disabled'; ?>>
		  	<p class="help-block"><?php echo $value['desclimer']; ?></p>
		  </div>
		  <?php 
		     }
			} 
		  ?>
		  <hr>

		  <button type="button" class="btn btn-danger submit submit-btn-file" data-rel="#general-setting">Save Changes</button>
		  <button type="reset" class="btn btn-default">Reset</button>
		</form>
        </div>
    </div>
</div>