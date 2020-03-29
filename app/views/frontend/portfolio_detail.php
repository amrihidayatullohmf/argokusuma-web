<div class="container-fluid cover-area" style="background: url(<?php echo (!empty($data->cover)) ? site_url('medias/projects/'.$data->cover) : site_url('assets/static/banner-portfolio-detail.png'); ?>);">
	<div class="overlay"></div>
	<div class="row">
		<div class="col-10 text-left">
			<span class="text-shadow">Single Project</span>
			<h1 class="text-shadow"><?php echo $data->project_name; ?></h1>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row justify-content-md-center no-margin">
			
		<div class="col-11 no-padding">
			<div class="row about-headline about portfolio no-margin">
				<div class="col-6 no-border no-padding desktop-flex">
					
					<div class="row image-display-portfolio">
						<?php 
						$i = 0;
						foreach($data->medias as $key => $value) { ?>
						<?php if($i % 3 == 0): ?>
						<div class="col-12 box"><img src="<?php echo site_url('medias/projects/'.$value['image_path']); ?>"></div>
						<?php else: ?>
						<div class="col-6 box"><img src="<?php echo site_url('medias/projects/'.$value['image_path']); ?>"></div>
						<?php endif; ?>
						<?php $i++; } ?>
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
					<p><?php echo $data->overview; ?><</p>
				
					<br><br>

					<h2>Client</h2>
					<p><?php echo $data->cname; ?></p>

					<br><br>

					<h2>Category</h2>
					<p><?php echo implode(", ", $data->categories['names']); ?></p>
				</div>
			</div>
		</div>
		<div class="col-11 no-padding">
			<div class="row other-project">
				<?php foreach($related as $key => $value): ?>
				<a href="<?php echo $value['url']; ?>">
					<div class="col other-box">
						<img src="<?php echo $value['thumb']; ?>">		
						<h2><?php echo $value['project_name']; ?></h2>	
						<span></span>	
					</div>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

