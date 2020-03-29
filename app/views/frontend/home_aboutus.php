<div class="container-fluid cover-area" style="background: url(assets/static/<?php echo get_option('aboutus-cover'); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow"><?php echo get_option('about-title'); ?></span>
			<h1 class="text-shadow"><?php echo get_option('about-sub-title'); ?></h1>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-md-center">
		
		<div class="col-11">
			<div class="row about-headline about">
				<div class="col no-border">
					<span><?php echo get_option('aboutus-headline'); ?></span>
					<h1><?php echo get_option('aboutus-headline-heading'); ?></h1>
					<p><?php echo get_option('aboutus-headline-body'); ?></p>
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
				<?php foreach ($teams as $key => $value) { ?>
				<div class="team">
					<img src="<?php echo site_url('medias/teams/'.$value['photo']); ?>">
					<div class="text">
						<h1><?php echo $value['name']; ?></h1>
						<span><?php echo $value['position']; ?></span>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>		
	</div>
</div>

<div class="vision">
	<img src="<?php echo site_url('assets/static/'.get_option('vission-mission-background')); ?>">
	<div class="overlay"></div>
	<div class="text-area">
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-5">
					<span class="number"><?php echo get_option('aboutus-mission-number'); ?></span>
					<h2><?php echo get_option('aboutus-mission-title'); ?></h2>
					<p><?php echo get_option('aboutus-mission-body'); ?></p>
				</div>
				<div class="col-5">
					<span class="number"><?php echo get_option('aboutus-vission-number'); ?></span>
					<h2><?php echo get_option('aboutus-vission-title'); ?></h2>
					<p><?php echo get_option('aboutus-vission-body'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid common-section">
	<div class="row justify-content-md-center">
		<div class="col-11 text-center">
			<span class="sub"><?php echo get_option('aboutus-bottom-subtitle'); ?></span><br>
			<h1><?php echo get_option('aboutus-bottom-title'); ?></h1>
			<p><?php echo get_option('aboutus-bottom-body'); ?></p>
			<a href="<?php echo site_url('contact-us'); ?>">
				<button class="blue medium">Contact Us&nbsp;&nbsp;<img src="<?php echo site_url('assets/static/arrowsubscribe.png'); ?>" height="15"></button>
			</a>
		</div>
		<div class="col-11">
			<div class="line-separator no-padding"></div>
		</div>
		<div class="col-11 clients text-center">
			<p><?php echo get_option('client-pre-text'); ?></p>
			<div class="client-logos">
				<?php foreach ($clients as $key => $value) { ?>
				<div class="logo"><img src="<?php echo site_url('medias/clients/'.$value['icon']); ?>" alt="<?php echo $value['name']; ?>"></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>