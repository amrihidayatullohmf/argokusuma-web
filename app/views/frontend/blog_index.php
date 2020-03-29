<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/banner-blog-landing.png'); ?>);">
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
		<div class="col-9 card-area blog">
			<div class="card-columns" id="project-container">
				<?php foreach($blogs['rows'] as $key => $value): ?>
					<a href="<?php echo $value['url'] ;?>">
					  <div class="card blog">
					    <img class="card-img-top img-fluid" src="<?php echo $value['thumbnail']['path'] ;?>" alt="Card image cap">
					 	<div class="text-area">
					 		<span><?php echo $value['date_formatted'] ;?>, <?php echo $value['total_comment'] ;?> Comment</span>
					 		<h1><?php echo $value['title'] ;?></h1>
					 		<p><?php echo $value['shortify'] ;?></p>
					 		<a href="<?php echo $value['url'] ;?>">Read more</a>
					 	</div>
					  </div>
				  	</a>
			  	<?php endforeach; ?>
			</div>	
			<div class="row justify-content-md-center">
				<button class="blue medium load-more-content" 
				data-template="#template-project"
				data-container="#project-container"
				data-nexturl="<?php echo $blogs['nexturl']; ?>">
		Load More
		</button>
			</div>		  
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

<script type="text/template" id="template-project">
			{{#rows}}
					<a href="{{url}}">
					  <div class="card blog">
					    <img class="card-img-top img-fluid" src="{{thumbnail.path}}" alt="Card image cap">
					 	<div class="text-area">
					 		<span>{{date_fromatted}}, {{total_comment}} Comment</span>
					 		<h1>{{title}}</h1>
					 		<p>{{shortify}}</p>
					 		<a href="{{url}}">Read more</a>
					 	</div>
					  </div>
				  	</a>
			{{/rows}}
</script>