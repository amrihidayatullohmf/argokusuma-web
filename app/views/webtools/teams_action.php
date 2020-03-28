<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/teams/save'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($slide->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $slide->id; ?>">
              	<?php } ?>
              	<div class="box-body">

                  <div class="row">
                    <div class="col-xs-3">
                      <?php render_uploader('photo',((isset($slide) and !empty($slide->photo)) ? site_url('medias/teams/'.$slide->photo) : ''),'Photo  Team',['100%','350px'],['200px','400px']); ?>
                    </div>
                    <div class="col-xs-9">
                      <div class="form-group">
                        <label for="caption">Name</label>
                        <input class="form-control" type="text" name="name" placeholder="" value="<?php if(isset($slide->id)) echo $slide->name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="caption">Position</label>
                        <input class="form-control" type="text" name="position" placeholder="" value="<?php if(isset($slide->id)) echo $slide->position; ?>">
                      </div>
                    </div>

                  </div>
                  
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Team</button>
              	</div>
            </form>
          </div>
</div>