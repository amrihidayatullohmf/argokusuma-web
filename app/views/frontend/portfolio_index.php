<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/banner-portfolio-landing.png'); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow">Our Projects</span>
			<h1 class="text-shadow">Portfolio</h1>
		</div>
	</div>
</div>

<div class="container-fluid portfolio-container">
	<div class="row justify-content-md-center">
		<div class="col-11 category-area">
			<a href="#" class="active">All</a>
			<a href="#">Branding</a>
			<a href="#">Design</a>
			<a href="#">People</a>
			<a href="#">Products</a>
		</div>
	</div>
	<div class="row justify-content-md-center">
		<div class="col-11 card-area">
			<div class="card-columns">
				<?php for($i = 1; $i <= 9; $i++): ?>
					<a href="<?php echo site_url('portfolio/branding') ;?>">
					  <div class="card">
					    <img class="card-img-top img-fluid" src="<?php echo site_url('assets/static/portfolio-dummy-'.$i.'.png'); ?>" alt="Card image cap">
					 	<div class="overlay"></div>
					 	<div class="text-area">
					 		<h1>Project Name</h1>
					 		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc ac massa malesuada rhoncus ut vel eros. Phasellus vel congue velit. </p>
					 	</div>
					  </div>
				  	</a>
			  	<?php endfor; ?>
			</div>			  
		</div>
	</div>
	<div class="row justify-content-md-center">
		<button class="blue medium">Load More</button>
	</div>
</div>