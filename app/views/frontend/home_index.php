<div class="slider-container">
	<ul id="homeslider">
	  <?php foreach ($slider as $key => $value): ?>
	  <li>
	      <img src="<?php echo site_url('medias/sliders/'.$value['desktop_image']); ?>">
	  	  <div class="text-area container text-shadow ">
	  	  	<div class="row">
		  	  	<div class="col-12">
			  	  	<span><?php echo $value['section']; ?></span><br>
			  	  	<h1><?php echo $value['caption']; ?></h1>
			  	  	<a href="<?php echo $value['link']; ?>">
			  	  		<button class="blue medium"><?php echo $value['link_text']; ?></button>
			  	  	</a>
   		  	    </div>
		  	</div>
	  	  </div>
	  </li>
	  <?php endforeach ?>
	</ul>
</div>
<div class="container-fluid offset-top">
	<div class="row justify-content-md-center">
		<div class="col-11 blue-container">
			<div class="row">
				<div class="col text-center">
					<div class="icon-area">
						<img src="<?php echo site_url('assets/static/'.get_option('service-icon-1')); ?>">
						<div class="circle"></div>
					</div>
					<h1><?php echo get_option('service-head-1'); ?></h1>
					<p><?php echo get_option('service-body-1'); ?></p>
				</div>
				<div class="col text-center">
					<div class="icon-area">
						<div class="icon"><img src="<?php echo site_url('assets/static/'.get_option('service-icon-2')); ?>"></div>
						<div class="circle"></div>
					</div>
					<h1><?php echo get_option('service-head-2'); ?></h1>
					<p><?php echo get_option('service-body-2'); ?></p>
				</div>
				<div class="col text-center">
					<div class="icon-area">
						<div class="icon"><img src="<?php echo site_url('assets/static/'.get_option('service-icon-3')); ?>"></div>
						<div class="circle"></div>
					</div>
					<h1><?php echo get_option('service-head-3'); ?></h1>
					<p><?php echo get_option('service-body-3'); ?></p>
				</div>
			</div>
		</div>
		<div class="col-11">
			<div class="row about-headline">
				<div class="col">
					<span><?php echo get_option('about-headline-sub-1'); ?></span>
					<h1><?php echo get_option('about-headline-heading-1'); ?></h1>
					<p><?php echo get_option('about-headline-body-1'); ?></p>
					<a href="<?php echo site_url('about-us'); ?>">Read More About Us</a>
				</div>
				<div class="col">
					<span><?php echo get_option('about-headline-sub-2'); ?></span>
					<h1><?php echo get_option('about-headline-heading-2'); ?></h1>
					<p><?php echo get_option('about-headline-body-2'); ?></p>
					<a href="<?php echo site_url('about-us'); ?>">Read More About Us</a>
				</div>
			</div>
		</div>
		<div class="col-11">
			<div class="embed-responsive embed-responsive-21by9">
			  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/35XxJMhqP60?rel=0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="col-11">
			<div class="row stat-area">
				<div class="col text-center">
					<div class="counter-area">
						<img src="<?php echo site_url('assets/static/'.get_option('stat-icon-1')); ?>">
						<span class="counter" data-max="<?php echo get_option('stat-value-1'); ?>"><?php echo get_option('stat-value-1'); ?></span>
					</div>
					<p><?php echo get_option('stat-label-1'); ?></p>
				</div>
				<div class="col text-center">
					<div class="counter-area">
						<img src="<?php echo site_url('assets/static/'.get_option('stat-icon-2')); ?>">
						<span class="counter" data-max="<?php echo get_option('stat-value-2'); ?>"><?php echo get_option('stat-value-1'); ?></span>
					</div>
					<p><?php echo get_option('stat-label-2'); ?></p>
				</div>
				<div class="col text-center">
					<div class="counter-area">
						<img src="<?php echo site_url('assets/static/'.get_option('stat-icon-3')); ?>">
						<span class="counter" data-max="<?php echo get_option('stat-value-3'); ?>"><?php echo get_option('stat-value-1'); ?></span>
					</div>
					<p><?php echo get_option('stat-label-3'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid show-case">
	<div class="row justify-content-md-center">
		<div class="col-11 text-left">
			<span class="sub"><?php echo get_option('showcase-sub-heading'); ?></span><br>
			<h1><?php echo get_option('showcase-heading'); ?></h1>
			<div class="desc">
				<p><?php echo get_option('showcase-body'); ?></p>
				<a href="<?php echo site_url('portfolio'); ?>">
					<button class="blue big">View all project</button>
				</a>
			</div>
		</div>
		<div class="col-12 no-padding">
			<div class="showcase-box">
				<?php foreach ($projects as $key => $value): ?>
				<div class="box">
					<a href="<?php echo site_url('portfolio/'.$value['slug']); ?>">
						<div class="pop">
							<img src="<?php echo site_url('medias/projects/'.$value['thumbnail']); ?>" alt="<?php echo $value['project_name']; ?>">
							<div class="text-area">
								<h1><?php echo $value['project_name']; ?></h1>
								<p><?php echo substr(strip_tags($value['overview']), 0,100); ?></p>
							</div>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid testimonials">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<span class="sub"><?php echo get_option('testimonials-sub-heading'); ?></span><br>
			<h1><?php echo get_option('testimonials-heading'); ?></h1>
		</div>
		<div class="col-11">
			<div class="testimonials-box">
				<?php foreach ($testimonials as $key => $value): ?>
					<div class="box">
						<button class="quote"><img src="<?php echo site_url('assets/static/quote.png'); ?>"></button>
						<h2>"<?php echo $value['caption']; ?>"</h2>
						<p><?php echo $value['testimony']; ?></p>
						<br>
						<span>
							<b><?php echo $value['user_name']; ?></b><br>
							<?php echo $value['user_type']; ?>
						</span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="col-11 clients text-center">
			<p>Our clients are always satified with the quality of services:</p>
			<div class="client-logos">
				<div class="logo"><img src="<?php echo site_url('medias/clients/01.png'); ?>"></div>
				<div class="logo"><img src="<?php echo site_url('medias/clients/02.png'); ?>"></div>
				<div class="logo"><img src="<?php echo site_url('medias/clients/03.png'); ?>"></div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid common-section">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<h1><?php echo get_option('teams-heading'); ?></h1>
		</div>
		<div class="col-11">
			<div class="teams-box">
				<div class="team">
					<img src="<?php echo site_url('medias/teams/teamdummy.png'); ?>">
					<div class="text">
						<h1>Rendra Setyo AE</h1>
						<span>Founder &amp; CEO</span>
					</div>
				</div>
				<div class="team">
					<img src="<?php echo site_url('medias/teams/teamdummy.png'); ?>">
					<div class="text">
						<h1>Rendra Setyo AE</h1>
						<span>Founder &amp; CEO</span>
					</div>
				</div>
				<div class="team">
					<img src="<?php echo site_url('medias/teams/teamdummy.png'); ?>">
					<div class="text">
						<h1>Rendra Setyo AE</h1>
						<span>Founder &amp; CEO</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-11">
			<div class="line-separator"></div>
		</div>
		<div class="col-11 text-center">
			<span class="sub"><?php echo get_option('blog-sub-heading'); ?></span><br>
			<h1><?php echo get_option('blog-heading'); ?></h1>
			<p><?php echo get_option('blog-body'); ?></p>
		</div>
		<div class="col-11">
			<div class="blog-box">
				<div class="box">
					<img src="<?php echo site_url('medias/blogs/blog1.png'); ?>">
					<div class="text">
						<span>February 21st 2020, 0 Comment</span>
						<h1>Business</h1>
						<a href="#">Read More</a>
					</div>
				</div>
				<div class="box">
					<img src="<?php echo site_url('medias/blogs/blog2.png'); ?>">
					<div class="text">
						<span>February 21st 2020, 0 Comment</span>
						<h1>Business</h1>
						<a href="#">Read More</a>
					</div>
				</div>
				<div class="box">
					<img src="<?php echo site_url('medias/blogs/blog3.png'); ?>">
					<div class="text">
						<span>February 21st 2020, 0 Comment</span>
						<h1>Business</h1>
						<a href="#">Read More</a>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="container-fluid newsletter-area">
	<div class="row">
		<div class="col-12 text-center">
			<h1><?php echo get_option('newsletter-heading'); ?></h1>
			<p><?php echo get_option('newsletter-body-before'); ?></p>
			<form action="" method="post">
				<div class="input-area">
					<input type="text" name="email" placeholder="Your email address">
					<button class="arrow"></button>
				</div>
			</form>
			<p><?php echo get_option('newsletter-body-after'); ?></p>
		</div>
	</div>
</div>