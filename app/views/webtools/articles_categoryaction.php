<div class="col-xs-12">
		<div class="box box-danger">
            <form role="form" method="POST" action="<?php echo site_url('webtools/articles/categorysave'); ?>" id="ajax-form-file" enctype="multipart/form-data">
              	<?php if(isset($data->id)) { ?>
              	<input type="hidden" name="id" value="<?php echo $data->id; ?>">
              	<?php } ?>
              	<div class="box-body">
                  <div class="form-group">
                    <label for="caption">Category</label>
                    <input class="form-control" type="text" name="category" placeholder="Caption" value="<?php if(isset($data->id)) echo $data->category; ?>">
                  </div>
                  <div class="form-group">
                    <label for="caption">Slug</label>
                    <input class="form-control" type="text" name="slug" placeholder="(Optional)" value="<?php if(isset($data->id)) echo $data->slug; ?>">
                  </div>
                  
                </div>
              	<div class="box-footer">
                	<button class="btn btn-danger submit-btn-file" data-rel="#ajax-form-file" type="submit">Save Category</button>
              	</div>
            </form>
          </div>
</div>