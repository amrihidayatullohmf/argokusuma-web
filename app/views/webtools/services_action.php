<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/services/save'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($data->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $data->id; ?>">
              	<?php } ?>
              	<div class="box-body">
                  <div class="form-group">
                    <label for="caption">Title</label>
                    <input class="form-control" type="text" name="title" placeholder="" value="<?php if(isset($data->id)) echo $data->title; ?>">
                  </div>
                  <div class="form-group">
                    <label for="caption">Caption</label>
                    <input class="form-control" type="text" name="caption" placeholder="Extend from your title" value="<?php if(isset($data->id)) echo $data->caption; ?>">
                    <p class="help-block">This caption will be shown on service detail page</p>
                  </div>

                  <div class="form-group">
                    <label for="caption">Description</label>
                    <textarea class="form-control"  name="description" placeholder="Write short description here" rows="5"><?php if(isset($data->id)) echo $data->description; ?></textarea>
                  </div>

                  <div class="form-group" style="display: flex;justify-content: space-between;align-items: center; flex-wrap: wrap;">
                  	<fieldset style="width: 100%">
                  		<legend>Images</legend>
                  	</fieldset>
                  	<?php
                  	render_uploader('cover',((isset($data->id) and !empty($data->cover_image)) ? site_url('medias/services/'.$data->cover_image) : ''),'Cover Background',['70%','200px'],['1024px','300px']);
					render_uploader('icon',((isset($data->id) and !empty($data->icon_image)) ? site_url('medias/services/'.$data->icon_image) : ''),'Icon Image',['28%','200px'],['100px','100px']); 
                  	?>
                  </div>
                  

                  <fieldset><legend>Service Segment Content</legend></fieldset>

                  <div id="extend-content">
                  	<?php 
                  	if(isset($segments)) {
                  		foreach ($segments as $key => $value) {
                  			$i = $key + 1;
                  	?>
                  	<div class="form-group item" style="border:solid 1px #f0f0f0;padding: 10px">
                  		<input type="hidden" name="countersegment[<?php echo $i; ?>]" value="<?php echo $i; ?>">
                  		<input type="hidden" name="idsegment[<?php echo $i; ?>]" value="<?php echo $value['id']; ?>">
                  		<div class="row">
                  			<div class="col-xs-3">
                  				<?php render_uploader('thumb-'.$i,((!empty($value['image'])) ? site_url('medias/services/'.$value['image']) : ''),'Thumbnail Image',['100%','200px'],['100px','100px']); ?>
                  			</div>
                  			<div class="col-xs-9">
                  				<label>Title</label>
                  				<input type="text" name="ttl[<?php echo $i; ?>]" class="form-control" value="<?php echo $value['title']; ?>">
                  				<br>
                  				<label>Description</label>
                  				<textarea name="desc[<?php echo $i; ?>]" rows="3" class="form-control"><?php echo $value['description']; ?></textarea>
                  			</div>
                  		</div>
                  	</div>

                  	<?php } } ?>
                  	
                  </div>
                  <button type="button" class="btn btn-md btn-default" id="add-segment" style="width: 100%;">+ Add New Segment</button>
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Service</button>
              	</div>
            </form>
          </div>
</div>

<script type="text/template" id="template-segment">
					<div class="form-group item" style="border:solid 1px #f0f0f0;padding: 10px">
                  		<input type="hidden" name="countersegment[NUM]" value="NUM">
                  		<input type="hidden" name="idsegment[NUM]" value="0">
                  		<div class="row">
                  			<div class="col-xs-3">
                  				<?php render_uploader('thumb-NUM','','Thumbnail Image',['100%','200px'],['100px','100px']); ?>
                  			</div>
                  			<div class="col-xs-9">
                  				<label>Title</label>
                  				<input type="text" name="ttl[NUM]" class="form-control">
                  				<br>
                  				<label>Description</label>
                  				<textarea name="desc[NUM]" rows="3" class="form-control"></textarea>
                  			</div>
                  		</div>
                  	</div>
</script>