<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WebTools</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
     <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : ''; ?>">
    <link rel="icon" type="image/png" href="<?php echo site_url('assets/static/'.get_option('meta-favicon')); ?>" />

    <link rel="stylesheet" href="<?php echo assets_url('libs/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo assets_url('libs/font-awesome/css/font-awesome.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo assets_url('libs/ionicons/css/ionicons.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo assets_url('libs/adminlte/css/AdminLTE.min.css'); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo assets_url('libs/adminlte/css/skins/skin-red.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo assets_url('libs/adminlte/plugins/iCheck/flat/blue.css'); ?>">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/font-awesome/css/font-awesome.min.css'); ?>">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/sweetalert/sweetalert.css'); ?>">

    <!-- JQuery UI -->
    <link href="<?php echo base_url(); ?>assets/libs/jqueryui/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url(); ?>assets/libs/jqueryui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url(); ?>assets/libs/jqueryui/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" media="all">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/webtools.css?v='.date('U')); ?>">

    <?php echo $styles; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>W</b>T</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Web</b>Tools</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li>
                <a href="<?php echo site_url('webtools/auth/logout'); ?>"><i class="fa fa-power-off"></i> logout</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          	<!-- sidebar menu: : style can be found in sidebar.less -->
          	<ul class="sidebar-menu">
	            <li class="header">MAIN NAVIGATION</li>
	            <li>
	              <a href="<?php echo site_url('webtools/dashboard'); ?>">
	                <i class="fa fa-th"></i> <span>Dashboard</span>
	              </a>
	            </li>

              <li class="<?php echo $this->router->class=='medias' ? 'active' : ''; ?>"">
                <a href="<?php echo site_url('webtools/medias/slider'); ?>">
                  <i class="fa fa-image"></i> <span>Home Sliders</span>
                </a>
              </li>

              <li class="treeview <?php echo $this->router->class=='articles' ? 'active' : ''; ?>">
                <a href="<?php echo site_url('webtools/articles'); ?>">
                  <i class="fa fa-pencil"></i>
                  <span>Articles</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo $this->router->class=='articles' && $this->router->method=='index'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/articles'); ?>"><i class="fa fa-circle-o"></i> List Article</a>
                  </li>
                  <li class="<?php echo $this->router->class=='articles' && $this->router->method=='action'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/articles/action/add'); ?>"><i class="fa fa-circle-o"></i> Compose New</a>
                  </li>
                  <li class="<?php echo $this->router->class=='articles' && $this->router->method=='category'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/articles/category'); ?>"><i class="fa fa-circle-o"></i> Categories</a>
                  </li>
                  <li class="<?php echo $this->router->class=='articles' && $this->router->method=='comment'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/articles/comment'); ?>"><i class="fa fa-circle-o"></i> Comments</a>
                  </li>
                </ul>
              </li>

              <li class="treeview <?php echo $this->router->class=='portfolio' ? 'active' : ''; ?>">
                <a href="<?php echo site_url('webtools/portfolio'); ?>">
                  <i class="fa fa-image"></i>
                  <span>Portfolio</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo $this->router->class=='portfolio' && $this->router->method=='index'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/portfolio'); ?>"><i class="fa fa-circle-o"></i> List Portfolio</a>
                  </li>
                  <li class="<?php echo $this->router->class=='portfolio' && $this->router->method=='action'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/portfolio/action/add'); ?>"><i class="fa fa-circle-o"></i> Add Project</a>
                  </li>
                  <li class="<?php echo $this->router->class=='portfolio' && $this->router->method=='category'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/portfolio/category'); ?>"><i class="fa fa-circle-o"></i> Categories</a>
                  </li>
                  <li class="<?php echo $this->router->class=='portfolio' && $this->router->method=='clients'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/portfolio/clients'); ?>"><i class="fa fa-circle-o"></i> Clients</a>
                  </li>
                </ul>
              </li>

              <li class="treeview <?php echo $this->router->class=='services' ? 'active' : ''; ?>">
                <a href="<?php echo site_url('webtools/services'); ?>">
                  <i class="fa fa-briefcase"></i>
                  <span>Services</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo $this->router->class=='services' && $this->router->method=='index'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/services'); ?>"><i class="fa fa-circle-o"></i> List Services</a>
                  </li>
                  <li class="<?php echo $this->router->class=='services' && $this->router->method=='action'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/services/action/add'); ?>"><i class="fa fa-circle-o"></i> Add Service</a>
                  </li>
                </ul>
              </li>

              <li class="treeview <?php echo $this->router->class=='submission' ? 'active' : ''; ?>">
                <a href="<?php echo site_url('webtools/submission'); ?>">
                  <i class="fa fa-envelope"></i>
                  <span>Submissions</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo $this->router->class=='submission' && $this->router->method=='guestbook'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/submission/guestbook'); ?>"><i class="fa fa-circle-o"></i> Contact (Guestbook)</a>
                  </li>
                  <li class="<?php echo $this->router->class=='submission' && $this->router->method=='action'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/submission/testimonials'); ?>"><i class="fa fa-circle-o"></i> Testimonials</a>
                  </li>
                  <li class="<?php echo $this->router->class=='submission' && $this->router->method=='subscription'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/submission/subscription'); ?>"><i class="fa fa-circle-o"></i> E-Mail Subscriptions</a>
                  </li>
                </ul>
              </li>

              <li class="<?php echo $this->router->class=='teams' ? 'active' : ''; ?>"">
                <a href="<?php echo site_url('webtools/teams'); ?>">
                  <i class="fa fa-users"></i> <span>Teams</span>
                </a>
              </li>
	            
              <li class="treeview <?php echo $this->router->class=='settings' ? 'active' : ''; ?>">
                <a href="<?php echo site_url('webtools/settings'); ?>">
                  <i class="fa fa-cog"></i>
                  <span>Settings</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='general'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/general'); ?>"><i class="fa fa-circle-o"></i> General</a>
                  </li>
                  
                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='menubar'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/menubar'); ?>"><i class="fa fa-circle-o"></i> Menu Bar</a>
                  </li>

                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='footer'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/footer'); ?>"><i class="fa fa-circle-o"></i> Web Footer</a>
                  </li>

                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='homepage'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/homepage'); ?>"><i class="fa fa-circle-o"></i> Homepage</a>
                  </li>
              
                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='contact'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/contact'); ?>"><i class="fa fa-circle-o"></i> Contact Us</a>
                  </li>

                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='about-us'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/about-us'); ?>"><i class="fa fa-circle-o"></i> About Us</a>
                  </li>

                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='services'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/services'); ?>"><i class="fa fa-circle-o"></i> Services</a>
                  </li>

                  <li class="<?php echo $this->router->class=='settings' && $setting_current=='portfolio'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/settings/index/portfolio'); ?>"><i class="fa fa-circle-o"></i> Portofolio</a>
                  </li>
                </ul>
              </li>


          

              <?php if($user->group!=3): ?>
              
              <li class="treeview <?php echo $this->router->class=='admin' ? 'active' : ''; ?>">
                <a href="<?php echo site_url('webtools/admin'); ?>">
                  <i class="fa fa-user-secret"></i>
                  <span>Admin</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php echo $this->router->class=='admin' && $this->router->method=='index'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/admin'); ?>"><i class="fa fa-circle-o"></i> List</a>
                  </li>
                  <li class="<?php echo $this->router->class=='admin' && $this->router->method=='add'  ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('webtools/admin/add'); ?>"><i class="fa fa-circle-o"></i> Add new</a>
                  </li>
                </ul>
              </li>
              
              <?php endif; ?>

        	</ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        
        <section class="content-header">
          <h1><?php echo $page_title; ?> <small><?php echo $page_subtitle; ?></small></h1>
        </section>


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <?php echo $content; ?>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <!--
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
		-->

      
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo assets_url('libs/adminlte/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo assets_url('libs/adminlte/plugins/jQueryUI/jquery-ui.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo assets_url('libs/bootstrap/js/bootstrap.min.js'); ?>"></script>
    
    <!-- Slimscroll -->
    <script src="<?php echo assets_url('libs/adminlte/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo assets_url('libs/adminlte/plugins/fastclick/fastclick.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo assets_url('libs/adminlte/js/app.min.js'); ?>"></script>

    <script type="text/javascript">
    var baseurl = '<?php echo base_url('webtools'); ?>/';
    </script>

    <!-- Jquery Form -->
    <script src="<?php echo base_url(); ?>assets/libs/jquery.form.min.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo base_url('assets/libs/sweetalert/sweetalert.js'); ?>"></script>

    <!-- Tinymce -->
    <script src="<?php echo base_url('assets/libs/tinymce/tinymce.min.js'); ?>"></script>

    <!-- Jquery UI -->
    <script src="<?php echo base_url(); ?>assets/libs/jqueryui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/jqueryui/jquery-ui-timepicker-addon.js"></script>

    <script src="<?php echo assets_url('libs/tinymce/tinymce.min.js'); ?>"></script>

    <script src="<?php echo base_url('assets/js/webtools.js?v='.date('U')) ?>"></script>

    <?php echo $scripts; ?>
    
  </body>
</html>