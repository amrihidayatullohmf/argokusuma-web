<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-Frame-Options" content="deny">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <title><?php echo isset($meta_title) ? $meta_title : ''; ?></title>
  <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : ''; ?>">
  <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : ''; ?>">
  <link rel="icon" type="image/png" href="<?php echo site_url('assets/static/'.get_option('meta-favicon')); ?>" />

  <link href="<?php echo base_url(); ?>assets/css/reset.css" rel="stylesheet" type="text/css" media="all">
  <link href="<?php echo base_url(); ?>assets/libs/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
  <link href="<?php echo base_url(); ?>assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">

  <?php if(ENVIRONMENT == 'production'): ?>
  <link href="<?php echo base_url(); ?>assets/css/fonts.min.css" rel="stylesheet" type="text/css" media="all">
  <link href="<?php echo base_url(); ?>assets/css/style.min.css" rel="stylesheet" type="text/css" media="all">
  <?php else: ?>
  <link href="<?php echo base_url(); ?>assets/css/fonts.css" rel="stylesheet" type="text/css" media="all">
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" media="all">
  <?php endif; ?>

  <?php echo $styles; ?>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- ANTI CLICKJACK -->
  <style id="antiClickjack">body{display:none !important;}</style>
  <script type="text/javascript">
  if (self === top) { var antiClickjack = document.getElementById("antiClickjack");antiClickjack.parentNode.removeChild(antiClickjack);} else {top.location = self.location;}
  </script>

</head>
<body>

  <div id="wrapper">
    <header>
      <div class="wrapper common-1200">
        <div class="brand-area">
          <a href="<?php echo site_url(); ?>">
            <img src="<?php echo site_url('assets/static/'.get_option('main-logo')); ?>" alt="<?php echo get_option('meta-title'); ?>">
          </a>
        </div>
        <div class="menu-area">
          <ul class="menu">
            <?php if(get_option('home-menu-visibility')): ?><li><a class="text-shadow" href="<?php echo site_url(); ?>"><?php echo get_option('home-menu-text'); ?></a></li><?php endif; ?>
            <?php if(get_option('about-menu-visibility')): ?><li><a class="text-shadow" href="<?php echo site_url('about-us'); ?>"><?php echo get_option('about-menu-text'); ?></a></li><?php endif; ?>
            <?php if(get_option('service-menu-visibility')): ?><li><a class="text-shadow" href="<?php echo site_url('what-we-do'); ?>"><?php echo get_option('service-menu-text'); ?></a></li><?php endif; ?>
            <?php if(get_option('portfolio-menu-visibility')): ?><li><a class="text-shadow" href="<?php echo site_url('portfolio'); ?>"><?php echo get_option('portfolio-menu-text'); ?></a></li><?php endif; ?>
            <?php if(get_option('blog-menu-visibility')): ?><li><a class="text-shadow" href="<?php echo site_url('blog'); ?>"><?php echo get_option('blog-menu-text'); ?></a></li><?php endif; ?>
            <?php if(get_option('contact-menu-visibility')): ?><li><a class="text-shadow" href="<?php echo site_url('contact-us'); ?>"><?php echo get_option('contact-menu-text'); ?></a></li><?php endif; ?>

          </ul>
        </div>
      </div>
    </header>
    <section id="body">
      <div class="body-container">
         <?php echo $content; ?>
      </div>
    </section>
    <footer>
      <div class="wrapper common-1200">
        <div class="section">
          <h2><?php echo get_option('contact-section-heading'); ?></h2>
          <ul class="link-lists">
            <li><a href="mailto:<?php echo get_option('email-address'); ?>"><?php echo get_option('email-address'); ?></a></li>
            <li><a href="tel:<?php echo get_option('phone-number'); ?>"><?php echo get_option('phone-number'); ?></a></li>
            <li><a href="#"><?php echo get_option('office-address'); ?></a></li>
          </ul>
        </div>
        <div class="section">
          <h2><?php echo get_option('quicklink-section-heading'); ?></h2>
          <ul class="link-lists">
            <?php if(get_option('service-menu-visibility')): ?><li><a href="<?php echo site_url(); ?>"><?php echo get_option('service-menu-text'); ?></a></li><?php endif; ?>
            <?php if(get_option('portfolio-menu-visibility')): ?><li><a href="<?php echo site_url(); ?>"><?php echo get_option('portfolio-menu-text'); ?></a></li><?php endif; ?>
            <?php if(get_option('blog-menu-visibility')): ?><li><a href="<?php echo site_url(); ?>"><?php echo get_option('blog-menu-text'); ?></a></li><?php endif; ?>
          </ul>
        </div>
        <div class="section">
          <h2><?php echo get_option('latest-section-heading'); ?></h2>
          <ul class="link-lists">
            <li><a href="#">Business<br><span>February 21st 2020</span></a></li>
            <li><a href="#">Business<br><span>February 21st 2020</span></a></li>
            <li><a href="#">Business<br><span>February 21st 2020</span></a></li>
          </ul>
        </div>
        <div class="section">
          <h2><?php echo get_option('contact-section-heading'); ?></h2>
          <ul class="link-lists">
            <li><a href="<?php echo get_option('instagram-url'); ?>" target="_blank"><?php echo get_option('instagram-label'); ?></a></li>
            <li><a href="<?php echo get_option('youtube-url'); ?>" target="_blank"><?php echo get_option('youtube-label'); ?></a></li>
            <li><a href="<?php echo get_option('twitter-url'); ?>" target="_blank"><?php echo get_option('twitter-label'); ?></a></li>
          </ul>
        </div>

        <div class="section-full">
          <span><?php echo get_option('copyright-text'); ?></span>
        </div>
      </div>
    </footer>
      
  </div>  

  <div id="fb-root"></div>

  <script src="<?php echo base_url(); ?>assets/libs/jquery-1.11.0.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/libs/bootstrap-4.4.1/js/bootstrap.min.js"></script>
  <?php if(ENVIRONMENT == 'production'): ?>
  <script src="<?php echo base_url(); ?>assets/js/scripts.min.js"></script>
  <?php else: ?>
  <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
  <?php endif; ?>
  <script>
  var baseurl = '<?php echo base_url(); ?>';
  </script>
    
  <?php echo $scripts; ?>

  <?php echo isset($google_analytic) ? $google_analytic : ''; ?> 
  
</body>
</html>