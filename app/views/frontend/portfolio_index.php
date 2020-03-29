
<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/'.get_option('portfolio-cover')); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow"><?php echo get_option('portfolio-title'); ?></span>
			<h1 class="text-shadow"><?php echo get_option('portfolio-sub-title'); ?></h1>
		</div>
	</div>
</div>

<div class="container-fluid portfolio-container">
	<div class="row justify-content-md-center">
		<div class="col-11 category-area">
			<a href="<?php echo site_url('portfolio/index/all'); ?>" <?php if($active_category == 'all') echo 'class="active"'; ?>>All</a>
			<?php foreach ($categories as $key => $value) { ?>
			<a href="<?php echo site_url('portfolio/index/'.$value['slug']); ?>" <?php if($active_category == $value['slug']) echo 'class="active"'; ?>><?php echo $value['category']; ?></a>
			<?php } ?>
		</div>
	</div>
	<div class="row justify-content-md-center">
		<div class="col-11 card-area">
			<div class="card-columns" id="project-container">
				<?php foreach($projects['rows'] as $key => $value): ?>
					<a href="<?php echo $value['url']; ?>">
					  <div class="card">
					    <img class="card-img-top img-fluid" src="<?php echo $value['thumb']; ?>" alt="<?php echo $value['project_name']; ?>">
					 	<div class="overlay"></div>
					 	<div class="text-area">
					 		<h1><?php echo $value['project_name']; ?></h1>
					 		<p><?php echo $value['snippet']; ?></p>
					 	</div>
					  </div>
				  	</a>
			  	<?php endforeach; ?>
			</div>			  
		</div>
	</div>
	<div class="row justify-content-md-center">
		<button class="blue medium load-more-content" 
				data-template="#template-project"
				data-container="#project-container"
				data-nexturl="<?php echo $projects['nexturl']; ?>">
		Load More
		</button>
	</div>
</div>

<script type="text/template" id="template-project">
			{{#rows}}
					<a href="{{url}}">
					  <div class="card">
					    <img class="card-img-top img-fluid" src="{{thumb}}" alt="{{project_name}}">
					 	<div class="overlay"></div>
					 	<div class="text-area">
					 		<h1>{{project_name}}</h1>
					 		<p>{{snippet}}/p>
					 	</div>
					  </div>
				  	</a>
			{{/rows}}
</script>