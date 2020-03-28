<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/submission/testimonysave'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($data->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $data->id; ?>">
              	<?php } ?>
              	<div class="box-body">
                  <div class="form-group">
                    <label for="caption">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="User Name" value="<?php if(isset($data->id)) echo $data->user_name; ?>">
                  </div>
                  <div class="form-group">
                    <label for="caption">Type</label>
                    <input class="form-control" type="text" name="type" placeholder="e.g. Customer, Client" value="<?php if(isset($data->id)) echo $data->user_type; ?>">
                  </div>

                  <div class="form-group">
                    <label for="caption">Title</label>
                    <input class="form-control" type="text" name="title" placeholder="Your Testimony Caption" value="<?php if(isset($data->id)) echo $data->caption; ?>">
                  </div>

                  <div class="form-group">
                    <label for="caption">Testimony</label>
                    <textarea class="form-control"  name="testimony" placeholder="Write testimony here" rows="5"><?php if(isset($data->id)) echo $data->testimony; ?></textarea>
                  </div>
                  
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Testimony</button>
              	</div>
            </form>
          </div>
</div>