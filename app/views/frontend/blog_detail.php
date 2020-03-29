<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/banner-blog-detail.png'); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow">List Style and Right Sidebar</span>
			<h1 class="text-shadow">Blog</h1>
		</div>
	</div>
</div>

<div class="container-fluid portfolio-container">
	<div class="row justify-content-md-center">
		<div class="col-9 blog-detail-area">

		
			<?php if(!empty($detail['thumbnail_wide']['path'])): ?><img src="<?php echo $detail['thumbnail_wide']['path']; ?>" class="cover"><?php endif; ?>
			<span class="timestamp"><?php echo $detail['date_formatted']; ?>, <?php echo $detail['total_comment']; ?> Comment</span>
			<h1 class="title"><?php echo $detail['title']; ?></h1>
			<div class="content">
				<?php echo $detail['content']; ?>
			</div>

			<h2>Write a Comment</h2>
			<div class="comment-form">
				<form action="<?php echo site_url('blog/savecomment/'.$csrf_token); ?>"  method="post" class="ajax-form-csrf" id="blog-comment">
				  <input type="hidden" name="news_id" value="<?php echo $detail['id']; ?>">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Your email address will not be published. Required field are marked *</label>
				    <textarea class="form-control" placeholder="Comment*" rows="10" name="comment"></textarea>
				  </div>
				  <div class="row">
				    <div class="col">
				      <input type="text" class="form-control" name="name" placeholder="Name*" id="savename">
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name="email" placeholder="Email*" id="saveemail">
				    </div>
				    <div class="col">
				      <input type="text" class="form-control" name="website" placeholder="Web" id="savewebsite">
				    </div>
				  </div>
				  <br>
				  <div class="form-group form-check">
				    <input type="checkbox" class="form-check-input" id="saveinfocomment">
				    <label class="form-check-label" for="saveinfocomment">Save my information in this browser for the future comment</label>
				  </div>
				  <button type="submit" class="blue sbt">Post Comment</button>
				  <button type="button" class="blue ldr" style="display: none"><i class="fa fa-spinner fa-spin"></i></button>
				</form>
			</div>

			<h2>Comments</h2>
			<hr>
			<span class="timestamp"><?php echo $detail['total_comment']; ?> Comment</span>
			<br><br>
			<?php foreach ($comments as $key => $value) { ?>
			<div class="comment-item">
				<h2><?php echo $value['name']; ?></h2>
				<span><?php echo date('F jS Y',strtotime($value['created_date'])); ?>&nbsp;|&nbsp;<i class="fa fa-globe"></i>&nbsp;<a href="<?php echo $value['website']; ?>" target="_blank"><?php echo $value['website']; ?></a></span>
				<p><?php echo $value['comment']; ?></p>
				<div class="reply-area">
					<?php foreach ($value['reply'] as $k => $v) { ?>
					<div class="comment-item" style="border:none;border-left:solid 1px #ccc;background: #f0f0f0;">
						<h2><?php echo $v['name']; ?></h2>
						<span><?php echo date('F jS Y',strtotime($v['created_date'])); ?></span>
						<p><?php echo $v['comment']; ?></p>
					</div>
					<?php } ?>
				</div>
			</div>

			<?php } ?>

		</div>
		<div class="col-3 sidebar-blog">
			<form action="<?php echo site_url('blog'); ?>" method="get">
				<div class="input-group mb-3 search-box">
				  <input type="text" class="form-control" aria-label="Search" placeholder="Search..." name="query_search">
				  <div class="input-group-append">
				    <span class="input-group-text"><i class="fa fa-search"></i></span>
				  </div>
				</div>
			</form>

			<br>
			<h2>Categories</h2>
			<hr>

			<ul class="categories">
				<?php foreach ($categories as $key => $value) { ?>
				<li><a href="<?php echo site_url('blog/index/'.$value['slug']); ?>"><?php echo $value['category']; ?></a></li>
				<?php } ?>
			</ul>
			<br><br>

			<h2>Popular Posts</h2>
			<hr>

			<?php foreach($latestnews['lists'] as $key => $value): ?>
			<a href="<?php echo $value['url'] ;?>">
				<div class="popular-box">
					<img src="<?php echo $value['thumbnail']['path']; ?>" class="thumb">
					<div class="text-area">
						<h3><?php echo $value['title'] ;?></h3>
						<p><?php echo $value['date_formatted'] ;?></p>
					</div>
				</div>
			</a>
			<?php endforeach; ?>

		</div>
	</div>
	
</div>