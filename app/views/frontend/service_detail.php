<div class="container-fluid cover-area" style="background: url(<?php echo site_url('medias/services/'.$data['cover_image']); ?>);">
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
			
		<div class="col-11">
			<div class="row about-headline about">
				<div class="col-6 no-border">
					<span>What We Offer</span>
					<h1><?php echo $data['caption']; ?></h1>
				</div>
				<div class="col-6 no-padding">
					<span>&nbsp;</span>
					<p><?php echo $data['description']; ?></p>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="container-fluid common-section center-section-service">
	<?php
	foreach ($data['extends'] as $key => $value) {
		
	if($key % 2 == 0) {
	?>
	<div class="row justify-content-md-center no-padding">
		<div class="col-6 text">
			<h1><?php echo $value['title']; ?></h1>
			<p><?php echo $value['description']; ?></p>
		</div>
		<div class="col-6 no-padding">
			<img src="<?php echo site_url('medias/services/'.$value['image']); ?>" width="100%">
		</div>		
	</div>
	<?php } else { ?>
	<div class="row justify-content-md-center no-padding">
		<div class="col-6 no-padding">
			<img src="<?php echo site_url('medias/services/'.$value['image']); ?>" width="100%">
		</div>		
		<div class="col-6 text black">
			<h1><?php echo $value['title']; ?></h1>
			<p><?php echo $value['description']; ?></p>
		</div>
		
	</div>
	<?php }} ?>
	
</div>