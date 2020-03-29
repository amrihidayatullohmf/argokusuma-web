<div class="container-fluid cover-area" style="background: url(assets/static/<?php echo get_option('contactus-cover'); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow">Get In Touch</span>
			<h1 class="text-shadow">Contact Us.</h1>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-md-center">
		<div class="col-11 blue-container white">
			<div class="row">
				<div class="col text-center">
					<div class="group">
						<div class="icon-area">
							<img src="<?php echo site_url('assets/static/icon4.png'); ?>">
							<div class="circle"></div>
						</div>
						<div class="text-area">
							<h1>Location</h1>
							<p><?php echo get_option('office-address'); ?></p>
						</div>
					</div>
					
				</div>
				<div class="col text-center">
					<div class="group">
						<div class="icon-area">
							<img src="<?php echo site_url('assets/static/icon5.png'); ?>">
							<div class="circle"></div>
						</div>
						<div class="text-area">
							<h1>Phone</h1>
							<p><?php echo get_option('phone-number'); ?></p>
						</div>
					</div>
					
				</div>
				<div class="col text-center">
					<div class="group">
						<div class="icon-area">
							<img src="<?php echo site_url('assets/static/icon6.png'); ?>">
							<div class="circle"></div>
						</div>
						<div class="text-area">
							<h1>E-Mail</h1>
							<p><?php echo get_option('email-address'); ?></p>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="col-11">
			<div class="line-separator no-padding no-margin"></div>
		</div>

		<div class="col-11">
			<div class="row about-headline about">
				<div class="col no-border text-center">
					<span>Get In Touch</span>
					<h1 class="center">Leave Comment</h1>
					<form action="<?php echo site_url('home/contactsubmission/'.$csrf_token); ?>" method="post" class="ajax-form-csrf">
					  <div class="form-row">
					    <div class="col">
					      <input type="text" class="form-control" name="firstname" placeholder="First name">
					    </div>
					    <div class="col">
					      <input type="text" class="form-control" name="lastname" placeholder="Last name">
					    </div>
					    <div class="w-100"><br></div>
					    <div class="col-12">
					      <input type="text" class="form-control" name="email" placeholder="E-Mail Address">
					    </div>
					    <div class="w-100"><br></div>
					    <div class="col-12">
					      <textarea class="form-control" name="message" placeholder="Your Message" rows="7"></textarea>
					    </div>
					    <div class="w-100"><br></div>
					    <div class="col-12">
					    	<button class="blue medium sbt" type="submit">Submit</button>
					    	<button class="blue medium ldr" type="button" style="display: none"><i class="fa fa-spinner fa-spin"></i></button>
					    </div>
					  </div>
					</form>
				</div>
				<div class="col">
					<div class="map-embed">
						<iframe src="<?php echo get_option('embed-map-url'); ?>" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>