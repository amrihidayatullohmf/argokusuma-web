<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/portfolio/save'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($data->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $data->id; ?>">
              	<?php } ?>
              	<div class="box-body">
              		<div class="row">
	            		<div class="col-md-9">
		                  <div class="form-group">
		                    <label for="caption">Project Name</label>
		                    <input class="form-control" type="text" name="title" placeholder="" value="<?php if(isset($data->id)) echo $data->project_name; ?>">
		                  </div>
		                  <div class="form-group">
		                    <label for="caption">Clients</label>
		                    <!--
		                    <input class="form-control" type="text" name="client" placeholder="" value="<?php if(isset($data->id)) echo $data->project_name; ?>">
		                -->
		                  	<select class="form-control" name="client">
								<?php foreach ($clients as $key => $value) { ?>
								<option value="<?php echo $value['id']; ?>"  <?php if(isset($data) and $data->client_id == $value['id']) echo 'selected'; ?>><?php echo $value['name']; ?></option>
								<?php } ?>
							</select>
							<p class="help-block"><a href="<?php echo site_url('portfolio/clients'); ?>" target="_blank">Manage Client Here</a></p>
		                  </div>

		                  <div class="form-group">
		                    <label for="caption">Overview</label>
		                    <textarea class="form-control"  name="overview" placeholder="Write short description here" rows="5"><?php if(isset($data->id)) echo $data->overview; ?></textarea>
		                  </div>

		                  <div class="form-group" style="display: flex;justify-content: space-between;align-items: center; flex-wrap: wrap;">
		                  	<fieldset style="width: 100%">
		                  		<legend>Cover Image Background</legend>
		                  	</fieldset>
		                  	<?php render_uploader('cover',((isset($data->id) and !empty($data->cover)) ? site_url('medias/projects/'.$data->cover) : ''),'Cover Background',['100%','200px'],['1024px','300px']); ?>
		                  </div>
		                  

		                  <fieldset><legend>Medias</legend></fieldset>
		                  <?php render_multi_uploader('medias', (isset($medias) ? $medias : []),'Add Photo',['24%','180px'],['Max 1200px','Max 1200px']); ?>
                  
                		</div>
                		<div class="col-md-3">
                			<div class="panel panel-default">
							  <div class="panel-heading">Publish Setting</div>
							  <div class="panel-body">
							      <div class="form-group">
								    <label>Save As</label>
								    <select class="form-control" name="state">
								    	<option value="1"  <?php if(isset($data) and $data->is_active == 1) echo 'checked'; ?>>Publish</option>
								    	<option value="2"  <?php if(isset($data) and $data->is_active == 2) echo 'checked'; ?>>Draft</option>
								    </select>
								  </div>
								 
								  <hr>
								  <div class="form-group">
								  	<div class="checkbox">
									    <label>
									      <input type="checkbox" value="1" name="pin" <?php if(isset($data) and $data->is_pinned == 1) echo 'checked'; ?>> Pin on Homepage
									    </label>
									</div>
								  </div>
							  </div>
							</div>

							<fieldset>
            					<legend>Thumbnail Image</legend>
            				</fieldset>

            				<?php render_uploader('thumb',((isset($data->id) and !empty($data->thumbnail)) ? site_url('medias/projects/'.$data->thumbnail) : ''),'Thumbnail',['100%','200px'],['200px','200px']); ?>
                		
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
	     							<p class="help-block"><a href="<?php echo site_url('portfolio/category'); ?>" target="_blank">+ Add New Category</a></p>
								  </div>
							  </div>
							</div>
                		</div>
                	</div>
                </div>
                </form>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Service</button>
              	</div>
            </form>
          </div>
</div>
