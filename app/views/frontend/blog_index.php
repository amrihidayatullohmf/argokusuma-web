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
			<div class="card-columns">
				<?php for($i = 1; $i <= 9; $i++): ?>
					<a href="<?php echo site_url('blog/branding') ;?>">
					  <div class="card blog">
					    <img class="card-img-top img-fluid" src="<?php echo site_url('assets/static/portfolio-dummy-'.$i.'.png'); ?>" alt="Card image cap">
					 	<div class="text-area">
					 		<span>March 27th 2020, 0 Comment</span>
					 		<h1>Article Name</h1>
					 		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc ac massa malesuada rhoncus ut vel eros. Phasellus vel congue velit. </p>
					 		<a href="<?php echo site_url('blog/article-name'); ?>">Read more</a>
					 	</div>
					  </div>
				  	</a>
			  	<?php endfor; ?>
			</div>	
			<div class="row justify-content-md-center">
				<button class="blue medium">Load More</button>
			</div>		  
		</div>
		<div class="col-3 sidebar-blog">
			<form action="">
				<div class="input-group mb-3 search-box">
				  <input type="text" class="form-control" aria-label="Search" placeholder="Search...">
				  <div class="input-group-append">
				    <span class="input-group-text"><i class="fa fa-search"></i></span>
				  </div>
				</div>
			</form>

			<br>
			<h2>Categories</h2>
			<hr>

			<ul class="categories">
				<li><a href="">Business</a></li>
				<li><a href="">Company</a></li>
				<li><a href="">Creative</a></li>
				<li><a href="">Marketing</a></li>
			</ul>
			<br><br>

			<h2>Popular Posts</h2>
			<hr>

			<?php for($i = 1; $i <= 4; $i++): ?>
			<a href="<?php echo site_url('blog/branding') ;?>">
				<div class="popular-box">
					<img src="<?php echo site_url('assets/static/portfolio-dummy-'.$i.'.png'); ?>" class="thumb">
					<div class="text-area">
						<h3>Business</h3>
						<p>March 27th 2020</p>
					</div>
				</div>
			</a>
			<?php endfor; ?>

		</div>
	</div>
	
</div>