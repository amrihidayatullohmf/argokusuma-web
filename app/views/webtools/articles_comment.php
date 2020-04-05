
<div class="col-xs-12">
  <div class="box box-danger">
    <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
          <div class="col-md-12">
          	<div class="col-md-7">
          	</div>
	        <form action="<?php echo site_url('webtools/articles/comment/'); ?>" method="post">
	        <div class="input-group col-md-5 pull-right">
		      <input type="text" class="form-control" placeholder="Search" value="<?php echo $keyword; ?>" name="keyword">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
		      </span>
		    </div>
		    </form>
          </div>
        </div>
    </div>
  </div>

  <input type="hidden" id="meta_keyword" value="<?php echo $keyword; ?>">
  <input type="hidden" id="post_type" value="review">

  <?php foreach ($content['content'] as $key => $value) { ?>
  <div data-id="<?php echo $value['id']; ?>" class="bs-callout <?php if($value['is_active'] == 2) echo 'pending'; ?>">
    <div class="box-body">
        <div class="row">
          <div class="col-md-12">
          
          	<h4 style="margin-bottom: 0px;margin-top: 0;">
          		
          		<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				     <i class="fa fa-user"></i>
				  </button>
				</div>
				<strong><?php echo ucwords($value['name']); ?></strong><br>

          	</h4>
          	<h6 style="margin-top: 4px;margin-bottom: 15px">
          		<?php echo date('F, d Y',strtotime($value['created_date'])); ?>
          		<br>
          	</h6>
         	
         	<h5><strong><i class="fa fa-pencil"></i> <?php echo $value['title']; ?></strong></h5>
         	
         	<p align="left">
         		<?php echo $value['comment']; ?>
         	</p>

         

         	<div class="child-area">
         	<?php 
         	if(isset($value['children'])) { 
         		foreach ($value['children'] as $k => $v) {
         	?>
         	<blockquote class="reply">
         	  <button class="button-remove trigger-comment-delete " data-target="articles" data-id="<?php echo $v['id']; ?>"><i class="fa fa-trash"></i></button>
         	  <strong>Administrator</strong>
			  <p style="font-size: 14px">
			  	<?php echo $v['comment']; ?>
			  	<footer><cite title="Source Title"><?php echo date('F, d Y',strtotime($v['created_date'])); ?></cite></footer>
			  </p>
			</blockquote>
         	<?php } } ?>
         	</div>

         	<div style="display: none" class="reply-area">
         		<form action="<?php echo site_url('webtools/articles/reply'); ?>" method="post" class="ajax-form">
         		<textarea name="comment" class="form-control required" style="width: 100%;height: 100px" placeholder="Your reply here..."></textarea>
         		<input type="hidden" name="product_id" value="<?php echo $value['news_id']; ?>">
         		<input type="hidden" name="parent_id" value="<?php echo $value['id']; ?>">
         		<div class="btn-group" role="group" aria-label="..." style="margin-top: 10px">
         			<button class="btn btn-primary btn-md submit-btn"><i class="fa fa-check"></i>&nbsp;Send Reply</button>
         			<a href="#" class="btn btn-danger btn-md hide-reply"><i class="fa fa-times"></i>&nbsp;Cancel</a>
         		</div>
         		</form>
         	</div>


         	<div class="btn-group button-area" role="group" aria-label="..." style="margin-top: 10px">
         		<a href="#" class="btn btn-danger btn-md trigger-comment-delete btn-delete" data-target="articles" data-id="<?php echo $value['id']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a>
         		<?php if(isset($value['children']) and count($value['children']) == 0) { ?><a href="#" class="btn btn-default btn-md show-reply"><i class="fa fa-comment-o"></i>&nbsp;Reply</a><?php } ?>
         	</div>
          </div>
        </div>
    </div>
  </div>
  <?php } ?>
  <div class="btn-group pull-right" aria-label="">
  	<a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/comment/index/'.$content['pagination']['first']); ?>">First</a>
  	<?php if(isset($content['pagination']['prev'])) { ?><a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/comment/index/'.$content['pagination']['prev']); ?>">Prev</a><?php } ?>
  	<?php for($i = $content['pagination']['endpoint'][0]; $i <= $content['pagination']['endpoint'][1]; $i++) { ?>
  	<a class="btn btn-<?php echo ($page == $i) ? 'danger' : 'default'; ?> btn-md" role="group" href="<?php echo site_url('webtools/comment/index/'.$i); ?>"><?php echo $i; ?></a>
  	<?php } ?>
  	<?php if(isset($content['pagination']['next'])) { ?><a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/comment/index/'.$content['pagination']['next']); ?>">Next</a><?php } ?>
  	<a class="btn btn-default btn-md" role="group" href="<?php echo site_url('webtools/comment/index/'.$content['pagination']['last']); ?>">Last</a>
  </div>


</div>
