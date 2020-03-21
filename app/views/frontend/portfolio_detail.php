<div class="container-fluid cover-area" style="background: url(<?php echo site_url('assets/static/banner-portfolio-detail.png'); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow">Single Project</span>
			<h1 class="text-shadow">Branding</h1>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-md-center no-margin">
			
		<div class="col-11 no-padding">
			<div class="row about-headline about portfolio no-margin">
				<div class="col-6 no-border no-padding desktop-flex">
					
					<div class="row image-display-portfolio">
						<?php for($i = 0; $i < 4; $i++) { ?>
						<?php if($i % 3 == 0): ?>
						<div class="col-12 box"><img src="<?php echo site_url('assets/static/detail-dummy-'.($i+1).'.png'); ?>"></div>
						<?php else: ?>
						<div class="col-6 box"><img src="<?php echo site_url('assets/static/detail-dummy-'.($i+1).'.png'); ?>"></div>
						<?php endif; ?>
						<?php } ?>
					</div>
				</div>
				<div class="col-6 no-border no-padding mobile-flex">
					<div class="row image-display-portfolio no-margin no-padding">
					<?php for($i = 0; $i < 4; $i++) { ?>
						<div class="col-12 box"><img src="<?php echo site_url('assets/static/detail-dummy-'.($i+1).'.png'); ?>"></div>
					<?php } ?>
					</div>
				</div>
				<div class="col-6 no-padding">
					<h2>Project Overview</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc ac massa malesuada rhoncus ut vel eros. Phasellus vel congue velit. Curabitur nec aliquam sem. Nam vestibulum accumsan vestibulum. Aenean ipsum sapien, viverra sit amet orci at, semper condimentum nisl. Donec scelerisque eros sed sem consectetur tincidunt. Curabitur lobortis egestas ullamcorper. Nulla faucibus quam id ultrices molestie.</p>
				
					<br><br>

					<h2>Client</h2>
					<p>Brand &amp; Co</p>

					<br><br>

					<h2>Category</h2>
					<p>Branding, Product</p>
				</div>
			</div>
		</div>
		<div class="col-11 no-padding">
			<div class="row other-project">
				<?php for($i = 1; $i <= 4; $i++): ?>
				<a href="<?php echo site_url('portfolio/branding'); ?>">
					<div class="col other-box">
						<img src="<?php echo site_url('assets/static/portfolio-dummy-'.$i.'.png'); ?>">		
						<h2>Barista Coffee</h2>	
						<span>Branding</span>	
					</div>
				</a>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>

