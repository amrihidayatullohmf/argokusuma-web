<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/medias/save_slide'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($slide->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $slide->id; ?>">
              	<?php } ?>
              	<input type="hidden" name="section" value="<?php echo $section; ?>">
              	<div class="box-body">
                  <div class="form-group">
                    <label for="caption">Title</label>
                    <input class="form-control" type="text" name="title" placeholder="Title" value="<?php if(isset($slide->id)) echo $slide->title; ?>">
                  </div>

                  <div class="form-group">
                    <label for="caption">Description</label>
                    <textarea class="form-control" type="text" name="caption" placeholder="Description"><?php if(isset($slide->id)) echo $slide->caption; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="caption">Button Text</label>
                    <input class="form-control" type="text" name="linktext" placeholder="Text" value="<?php if(isset($slide->id)) echo $slide->link_text; ?>">
                  </div>

                  <div class="form-group">
                    <label for="link">Link Action Type </label>
                    <select class="form-control" name="linktype">
                      <option value="none" <?php if(isset($slide->id) and $slide->link_type == 'none') echo 'selected'; ?>>None</option>
                      <option value="url" <?php if(isset($slide->id) and $slide->link_type == 'url') echo 'selected'; ?>>Link URL (Open Web page when clicked)</option>
                      <option value="file" <?php if(isset($slide->id) and $slide->link_type == 'file') echo 'selected'; ?>>Link File (Download file when clicked)</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="link">Link URL</label>
                    <input class="form-control" type="text" name="link" placeholder="Link" value="<?php if(isset($slide->id)) echo $slide->link; ?>">
                    <p class="help-block">This URL will be opened if you choose Link Action Type URL</p>
                  </div>

                  <div class="form-group">
                    <label for="link">Link File</label>
                    <?php if(isset($slide->id) and !empty($slide->link_file)): ?>
                    <p><i class="fa fa-file"></i>&nbsp;<?php echo $slide->link_file; ?></p>
                    <?php endif; ?>
                    <input class="form-control" type="file" name="filedownload">
                    <p class="help-block">This File will be downloaded if you choose Link Action Type File</p>
                  </div>

                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
		                    <label for="link">Start Date</label>
		                    <input class="form-control datetimepicker" type="text" name="start_date" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php if(isset($slide->id)) echo $slide->start_date; ?>">
		                </div>
                  	</div>
                  	<div class="col-md-6">
                  		<div class="form-group">
		                    <label for="link">End Date</label>
		                    <input class="form-control datetimepicker" type="text" name="end_date" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php if(isset($slide->id)) echo $slide->end_date; ?>">
		                </div>
                  	</div>
                  </div>

                  <fieldset>
                    <legend>Slide Image</legend>
                  </fieldset>
                  <div class="row">
                    <div class="col-md-6">
                      <?php render_uploader('desktop',((isset($slide) and !empty($slide->desktop_image)) ? site_url('medias/sliders/'.$slide->desktop_image) : ''),'Desktop Slide',['500px','236px'],['1600px','756px']); ?>
                    </div>
                    <div class="col-md-6">
                      <?php render_uploader('mobile', ((isset($slide) and !empty($slide->mobile_image)) ? site_url('medias/sliders/'.$slide->mobile_image) : ''),'Mobile Slide',['300px','400px'],['768px','988px']); ?>
                    </div>
                  </div>
                  <!--
                  <div class="form-group">
                    <label for="username">Desktop</label>
                    <?php if(isset($slide->id)) { ?>
                    <br>
                    <img src="<?php echo site_url('medias/sliders/'.$slide->desktop_image); ?>" width="300" class="img-thumbnail"><br><br>
                	<?php } ?>
                    <input class="form-control" name="desktop" type="file">
                  </div>

                  <div class="form-group">
                    <label for="username">Mobile</label>
                    <?php if(isset($slide->id)) { ?>
                    <br>
                    <img src="<?php echo site_url('medias/sliders/'.$slide->mobile_image); ?>" width="200" class="img-thumbnail"><br><br>
                	<?php } ?>
                    <input class="form-control" name="mobile" type="file">
                  </div>
             	    -->
                  
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Slide</button>
              	</div>
            </form>
          </div>
</div>