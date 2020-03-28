<div class="col-xs-12">
	<div class="box box-solid">
           
        <div class="box-body">
            <fieldset>
              	<legend style="padding-bottom:5px">
              		Lists&nbsp;&nbsp;
              		<a href="<?php echo site_url('webtools/medias/slideraction/'.$section.'/add'); ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Slider</a>

              	</legend>
              <div class="table-responsive">
              <table class="datatable table table-bordered table-hover table-striped">
		        <thead>
		          <tr>
		            <th>ID</th>
		            <th width="200">Desktop Slider</th>
		            <th width="200">Mobile Slider</th>
		            <th>Caption</th>
		            <th>Link Type</th>
		            <th>Publish Date</th>
		            <th width="130px">&nbsp;</th>
		          </tr>
		        </thead>
		        <tbody>
		          <?php foreach ($lists as $key => $value) { ?>
		          <tr>
		          	<td><?php echo $value['id']; ?></td>
		          	<td><img src="<?php echo site_url("medias/sliders/".$value['desktop_image']); ?>" class="img-thumbnail" width="180"></td>
		          	<td><img src="<?php echo site_url("medias/sliders/".$value['mobile_image']); ?>" width="180" class="img-thumbnail"></td>
		          	<td><?php echo $value['caption']; ?></td>
		          	<td><?php echo $value['link_type']; ?></td>
		          	<td><?php echo $value['start_date']." - ".$value['end_date']; ?></td>
		          	<td>
		          		<div class="btn-group pull-right">
		          			<a href="<?php echo site_url('webtools/medias/slideraction/'.$section.'/edit/'.$value['id']); ?>" class="btn btn-default btn-sm" title="edit"><i class="fa fa-pencil"></i> Edit</a>
		          			<a href="" class="btn btn-danger btn-sm deletetrigger" data-table="sliders" data-type="update" data-param="is_active=0" data-ids="id=<?php echo $value['id']; ?>" title="delete"><i class="fa fa-trash"></i> Remove</a>
		          		</div>
		          	</td>
		          </tr>
		          <?php } ?>
		        </tbody>
		      </table>
		  	  </div>
            </fieldset>
        </div>
    </div>
</div>