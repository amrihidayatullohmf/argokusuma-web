
<div class="col-xs-12">
	<div class="box">
		<form role="form" method="POST" action="<?php echo site_url('webtools/articles/save'); ?>" id="ajax-form-file" enctype="multipart/form-data">
            <?php if(isset($data['id'])) { ?>
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <?php } ?>
            <div class="box-body">
            	<div class="row">
            		<div class="col-md-9">

		                <?php render_tab_text('Article Title','title',(!isset($data) ? '' : $data['title']),['type'=>'news','item'=>'title','ref'=>(isset($data) ? $data['id'] : 0)],'',200); ?>
		                <?php render_tab_long_text('Article Content','content',(!isset($data) ? '' : $data['content']),['type'=>'news','item'=>'content','ref'=>(isset($data) ? $data['id'] : 0)],'tinymce'); ?>
		                <!--
		                <br>
		                <fieldset>
		                	<legend>Photos</legend>
		                </fieldset>
		                <?php //render_multi_uploader('medias', (isset($data) ? $data['medias'] : []),'Add Photo',['24%','180px'],['Max 1200px','Max 1200px']); ?>
            			-->
            		</div>
            		<div class="col-md-3">
            			<div class="panel panel-default">
						  <div class="panel-heading">Publish Setting</div>
						  <div class="panel-body">
						      <div class="form-group">
							    <label>Save As</label>
							    <select class="form-control" name="state">
							    	<option value="1"  <?php if(isset($data) and $data['is_active'] == 1) echo 'checked'; ?>>Publish</option>
							    	<option value="2"  <?php if(isset($data) and $data['is_active'] == 2) echo 'checked'; ?>>Draft</option>
							    </select>
							  </div>
							  <div class="form-group">
							    <label>Scheduled On</label>
							    <input type="text" class="form-control datetimepicker" name="schedule" value="<?php echo (isset($data)) ? $data['publish_date'] : date('Y-m-d H:i:s'); ?>">
							  </div>
							  <div class="form-group">
							    <label>Timestamp</label>
							    <input type="text" class="form-control datetimepickerall" name="timestamp" value="<?php echo (isset($data)) ? $data['created_date'] : date('Y-m-d H:i:s'); ?>">
							  </div>
							  <hr>
							  <div class="form-group">
							  	<div class="checkbox">
								    <label>
								      <input type="checkbox" value="1" name="pin" <?php if(isset($data) and $data['is_pinned'] == 1) echo 'checked'; ?>> Allow Comment
								    </label>
								</div>
							  </div>
						  </div>
						</div>
            			<fieldset>
            				<legend>Thumbnail Image</legend>
            			</fieldset>
            			<?php render_uploader('thumbnail_square',((isset($data) and !empty($data['thumbnail_square'])) ? site_url('medias/blogs/'.$data['thumbnail_square']) : ''),'Thumbnail Square',['100%','220px'],['200px','200px']); ?>
            			<br>
            			<?php render_uploader('thumbnail_wide', ((isset($data) and !empty($data['thumb_wide'])) ? site_url('medias/blogs/'.$data['thumb_wide']) : ''),'Cover Wide',['100%','150px'],['300px','150px']); ?>
            			<br>
            			
            			<div class="panel panel-default">
						  <div class="panel-heading">Categories</div>
						  <div class="panel-body">
							  <div class="form-group" id="tags-control" data-ids="<?php if(isset($tags)) echo $tags; ?>">
							  	<?php foreach ($categories as $key => $value) { ?>
							  	<div class="checkbox">
								    <label>
								      <input type="checkbox" value="<?php echo $value['id']; ?>" name="category[]" <?php if(isset($data) and isset($existcategories) and in_array($value['id'], $existcategories)) echo 'checked'; ?>> <?php echo $value['category']; ?>
								    </label>
								</div>
     							<?php } ?>
     							<p class="help-block"><a href="<?php echo site_url('articles/category'); ?>" target="_blank">+ Add New Category</a></p>
							  </div>
						  </div>
						</div>
            		</div>
            		<div class="col-md-12">
            			<br><hr>
            			<button class="btn btn-danger btn-md tinymce-content submit-btn-file" data-rel="#ajax-form-file">Save Article</button>
            			<button class="btn btn-default btn-md" type="reset">Reset</button>
            		</div>
            	</div>
            </div>
        </form>

		
		
	</div>
</div>