<div class="container-fluid cover-area" style="background: url(assets/static/aboutcover.png);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow">About Us</span>
			<h1 class="text-shadow">Imagine Creates.</h1>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-md-center">
		
		<div class="col-11">
			<div class="row about-headline">
				<div class="col no-border">
					<span><?php echo get_option('about-headline-sub-1'); ?></span>
					<h1><?php echo get_option('about-headline-heading-1'); ?></h1>
					<p><?php echo get_option('about-headline-body-1'); ?></p>
					<a href="<?php echo site_url('about-us'); ?>">Read More About Us</a>
				</div>
				<div class="col">
					<div class="slide-image">
						<div class="image-top">
							<img src="<?php echo site_url('assets/static/aboutslide1.png'); ?>">
						</div>
						<div class="image-bottom">
							<img src="<?php echo site_url('assets/static/aboutslide2.png'); ?>">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-11">
			<div class="line-separator no-padding no-margin"></div>
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

<div class="container-fluid common-section grey">
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
	</div>
</div>

<div class="vision">
	<img src="<?php echo site_url('assets/static/backgroundaboutvm.png'); ?>">
	<div class="overlay"></div>
	<div class="text-area">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-5">
					<span class="number">01.</span>
					<h2>Our Mission</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc ac massa malesuada rhoncus ut vel eros. Phasellus vel congue velit.</p>
				</div>
				<div class="col-5">
					<span class="number">02.</span>
					<h2>Our Vission</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc ac massa malesuada rhoncus ut vel eros. Phasellus vel congue velit.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid common-section">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<span class="sub">Get Started</span><br>
			<h1>Ready to Get Started</h1>
			<p>Our team is always ready to work with exciting and ambitious clients. If you are ready to start your creative partnership with us. Get in touch</p>
			<a href="<?php echo site_url('contact-us'); ?>">
				<button class="blue medium">Contact Us&nbsp;&nbsp;<img src="<?php echo site_url('assets/static/arrowsubscribe.png'); ?>" height="15"></button>
			</a>
		</div>
		<div class="col-11">
			<div class="line-separator no-padding"></div>
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