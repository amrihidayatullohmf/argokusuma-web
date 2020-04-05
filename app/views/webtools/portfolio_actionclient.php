<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/portfolio/saveclient'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($slide->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $slide->id; ?>">
              	<?php } ?>
              	<div class="box-body">

                  <div class="row">
                    <div class="col-xs-3">
                      <?php render_uploader('photo',((isset($slide) and !empty($slide->icon)) ? site_url('medias/projects/'.$slide->icon) : ''),'Client Logo',['100%','220px'],['100px','100px']); ?>
                    </div>
                    <div class="col-xs-9">
                      <div class="form-group">
                        <label for="caption">Name</label>
                        <input class="form-control" type="text" name="name" placeholder="" value="<?php if(isset($slide->id)) echo $slide->name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="caption">Pin Client</label>
                        <select class="form-control" name="pin">
                        	<option value="1" <?php if(isset($slide) and $slide->is_pinned == 1) echo 'selected'; ?>>Yes</option>
                        	<option value="0" <?php if(isset($slide) and $slide->is_pinned == 0) echo 'selected'; ?>>No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="caption">Status</label>
                        <select class="form-control" name="state">
                        	<option value="1" <?php if(isset($slide) and $slide->is_active == 1) echo 'selected'; ?>>Publish</option>
                        	<option value="2" <?php if(isset($slide) and $slide->is_active == 2) echo 'selected'; ?>>Draft</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Client</button>
              	</div>
            </form>
          </div>
</div>