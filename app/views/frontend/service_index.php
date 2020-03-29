<div class="container-fluid cover-area" style="background: url(assets/static/<?php echo get_option('service-cover'); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow"><?php echo get_option('service-title'); ?></span>
			<h1 class="text-shadow"><?php echo get_option('service-sub-title'); ?></h1>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-md-center">
		<div class="col-11 blue-container smaller white common-section text-center">
			<span class="sub"><?php echo get_option('service-title'); ?></span>
			<h1><?php echo get_option('service-highlight-title'); ?></h1>
			<p><?php echo get_option('service-highlight-body'); ?></p>
			<div class="row">
				<?php $i = 1; foreach ($services as $key => $value) { ?>
				<div class="col text-center">
					<a href="<?php echo site_url('what-we-do/'.$value['slug']); ?>">
						<div class="icon-area">
							<img src="<?php echo site_url('medias/services/'.$value['icon_image']); ?>">
							<div class="circle"></div>
						</div>
					</a>
					<h1 class="center"><?php echo $value['title']; ?></h1>
					<p><?php echo substr(strip_tags($value['description']),0,100); if(strlen(strip_tags($value['description'])) > 100) echo '...'; ?></p>
				</div>
				<?php
				if($i % 3 == 0) { echo '<div class="w-100"><br></div>'; }
				$i++;
				} 
				?>
				
			</div>
		</div>
		
	</div>
</div>
<div class="container-fluid common-section center-section-service">
	<div class="row justify-content-md-center no-padding">
		<div class="col-6 text">
			<span class="sub"><?php echo get_option('service-middle-sub-title'); ?></span><br>
			<h1><?php echo get_option('service-middle-title'); ?></h1>
			<p><?php echo get_option('service-middle-body'); ?></p>
			<a href="<?php echo site_url('portfolio'); ?>">View Our Work</a>
		</div>
		<div class="col-6">
			<img src="<?php echo site_url('assets/static/passenger.png'); ?>" width="100%">
		</div>
	</div>
</div>
<div class="container-fluid common-section">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<span class="sub"><?php echo get_option('testimonials-sub-heading'); ?></span><br>
			<h1><?php echo get_option('testimonials-heading'); ?></h1>
			<div class="testimonial-slides init-slick-slider"
				 data-dots="false"
				 data-infinite="true"
				 data-speed="1000"
				 data-autoplay="true"
				 data-arrows="true"
				 data-slide="1"
				 data-toslide="1"
				 data-usearrowobj="true"
				 data-prev="#prev-slide"
				 data-next="#next-slide"
				 id="testimony-sliders">
				<?php foreach ($testimonials as $key => $value) { ?>
				<div class="item">
					<h3>"<?php echo $value['caption']; ?>"</h3>
					<p class="half"><?php echo $value['testimony']; ?></p>
					<br><br>
					<p class="half">
						<b><?php echo $value['user_name']; ?></b><br>
						<?php echo $value['user_type']; ?>
					</p>
				</div>
				<?php } ?>
			</div>
			<div class="nav-slide">
				<button class="nav" id="prev-slide">&larr;</button>
				<span><b id="counter">1</b> / <?php echo count($testimonials); ?></span>
				<button class="nav" id="next-slide">&rarr;</button>
			</div>
		</div>
	</div>
</div>
<br><br>
