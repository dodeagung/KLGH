<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(isset($page_title)) : ?><?php echo $page_title ?> - <?php endif; ?><?php echo $this->settings->info->site_name ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php if(isset($page_desc)) : ?>
          <meta name="description" content="<?php echo $page_desc ?>">
        <?php endif; ?>
        <!-- Bootstrap -->
        <link href="<?php echo $this->common->theme_backend();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $this->common->theme_backend();?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

         <!-- Styles -->
        <link href="<?php echo $this->common->theme_backend();?>styles/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->common->theme_backend();?>styles/dashboard.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->common->theme_backend();?>styles/responsive.css" rel="stylesheet" type="text/css">
    <!--
        <link href="<?php echo $this->common->theme_backend();?>plugins/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet" type="text/css"> -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <link href="<?php echo $this->common->theme_backend();?>styles/costume.css" rel="stylesheet" type="text/css">
        <?php echo $cssExternal; ?>
        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        </script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.material.min.css"/>


        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.material.min.js"></script>

        <script type="text/javascript">
          $.widget.bridge('uitooltip', $.ui.tooltip);
        </script>
        <script src="<?php echo $this->common->theme_backend();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->common->theme_backend();?>scripts/custom/costume.js"></script>


        <!-- Favicon: http://realfavicongenerator.net -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $this->common->theme_backend();?>images/favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $this->common->theme_backend();?>images/favicon/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->common->theme_backend();?>images/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $this->common->theme_backend();?>images/favicon/apple-touch-icon-76x76.png">
        <link rel="icon" type="image/png" href="<?php echo $this->common->theme_backend();?>images/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo $this->common->theme_backend();?>images/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php echo $this->common->theme_backend();?>images/favicon/manifest.json">
        <link rel="mask-icon" href="<?php echo $this->common->theme_backend();?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="<?php echo $this->common->theme_backend();?>images/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="<?php echo base_url() ?>images/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
          $.widget.bridge('uitooltip', $.ui.tooltip);
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
              $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?>
    </head>
    <body>

    <nav class="navbar navbar-header2 navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url("backend/admin") ?>" title="<?php echo $this->settings->info->site_name ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo_other."_262x38.".$this->settings->info->ext_site_logo_other ?>" height="38"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <?php if($this->user->loggedin) : ?>
            <li class="user_bit"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar user_icon"> <a href="<?php echo site_url("backend/user_settings") ?>"><?php echo $this->user->info->username ?></a></li>
            <li><a href="<?php echo site_url("backend/login/logout/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_149") ?></a></li>
          <?php else : ?>
          <li><a href="<?php echo site_url("backend/login") ?>"><?php echo lang("ctn_150") ?></a></li>
            <li><a href="<?php echo site_url("backend/register") ?>"><?php echo lang("ctn_151") ?></a></li>
          <?php endif; ?>
          </ul>

        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <?php if(isset($sidebar)) : ?>
          <?php echo $sidebar ?>
        <?php endif; ?>
          <ul class="newnav nav nav-sidebar">
      <li class="<?php if(isset($activeLink['home']['general'])) echo "active" ?>"><a href="<?php echo site_url("backend") ?>"><span class="glyphicon glyphicon-home sidebar-icon"></span> <?php echo lang("ctn_154") ?> <span class="sr-only">(current)</span></a></li>
           <?php if($this->user->loggedin && isset($this->user->info->user_role_id) &&
           ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment)

           ) : ?>
              <li id="admin_sb">
                <a data-toggle="collapse" data-parent="#admin_sb" href="#admin_sb_c" class="collapsed <?php if(isset($activeLink['admin'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-wrench sidebar-icon"></span> <?php echo lang("ctn_157") ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="admin_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['admin'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <?php if($this->user->info->admin || $this->user->info->admin_settings) : ?>
                      <li class="<?php if(isset($activeLink['admin']['settings'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_158") ?></a></li>
                      <li class="<?php if(isset($activeLink['admin']['social_settings'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/social_settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_159") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                    <li class="<?php if(isset($activeLink['admin']['members'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/members") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_160") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['custom_fields'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/custom_fields") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_346") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin) : ?>
                    <li class="<?php if(isset($activeLink['admin']['user_roles'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/user_roles") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_316") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['menus'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/menus") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_437") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                    <li class="<?php if(isset($activeLink['admin']['user_groups'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/user_groups") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_161") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['ipblock'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/ipblock") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_162") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin) : ?>
                      <li class="<?php if(isset($activeLink['admin']['email_templates'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/email_templates") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_163") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
                      <li class="<?php if(isset($activeLink['admin']['email_members'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/email_members") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_164") ?></a></li>
                    <?php endif; ?>
                    <?php if($this->user->info->admin || $this->user->info->admin_payment) : ?>
                    <li class="<?php if(isset($activeLink['admin']['payment_settings'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/payment_settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_246") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['payment_plans'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/payment_plans") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_258") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['payment_logs'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/payment_logs") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_288") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['premium_users'])) echo "active" ?>"><a href="<?php echo site_url("backend/admin/premium_users") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_325") ?></a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </li>
            <?php endif; ?>            
            <!-- Content Menu -->
            <li id="content_sb">
                <a data-toggle="collapse" data-parent="#content_sb" href="#content_sb_c" class="collapsed <?php if(isset($activeLink['content'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-file sidebar-icon"></span> <?php echo lang("ctn_399") ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="content_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['content'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                  <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
                   <!--<li class="<?php if(isset($activeLink['content']['general'])) echo "active" ?>"><a href="<?php echo site_url("backend/content") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_438") ?></a></li>
                   <li class="<?php if(isset($activeLink['content']['categories'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/categories") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_439") ?></a></li> -->
                   <li class="<?php if(isset($activeLink['content']['slider'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/sliders") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_449") ?></a></li>
                 <?php endif; ?>
          <!--
                   <li class="<?php if(isset($activeLink['content']['pages'])) echo "active" ?>"><a href="<?php echo site_url("backend/page") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_440") ?></a></li>
           
                   <li class="<?php if(isset($activeLink['content']['cats'])) echo "active" ?>"><a href="<?php echo site_url("backend/page/categories") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_441") ?></a></li> -->
           
            <a data-toggle="collapse" data-parent="#content_sb_c" href="#content_sb_p" class="collapsed <?php if(isset($activeLink['content']['post'])) echo "active" ?>" >
            <span class="glyphicon glyphicon-file admin-sb-link"></span> <?php echo lang("ctn_490") ?>
            <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
          </a>
          <div id="content_sb_p" class="panel-collapse collapse sub-links-inner <?php if(isset($activeLink['content']['post'])) echo "in" ?>">
               <li class="<?php if(isset($activeLink['content']['post']['manage'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/post") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_486") ?></a></li>     
               
               <li class="<?php if(isset($activeLink['content']['post']['category'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/post_categories") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_442") ?></a></li>
               
               <li class="<?php if(isset($activeLink['content']['post']['view'])) echo "active" ?>"><a href="<?php echo site_url("backend/post/categories") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_441") ?></a></li>  
           </div>
           
           <a data-toggle="collapse" data-parent="#content_sb_c" href="#content_sb_g" class="collapsed <?php if(isset($activeLink['content']['gallery'])) echo "active" ?>" >
            <span class="glyphicon glyphicon-file admin-sb-link"></span> <?php echo lang("ctn_494") ?>
            <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
          </a>
          <div id="content_sb_g" class="panel-collapse collapse sub-links-inner <?php if(isset($activeLink['content']['gallery'])) echo "in" ?>">
               <li class="<?php if(isset($activeLink['content']['gallery']['manage'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/gallery") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_487") ?></a></li>     

               <li class="<?php if(isset($activeLink['content']['gallery']['manageimagefront'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/image_front") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_504") ?></a></li> 
               
               <li class="<?php if(isset($activeLink['content']['gallery']['album'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/gallery_albums") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_496") ?></a></li> 

               <li class="<?php if(isset($activeLink['content']['gallery']['viewalbum'])) echo "active" ?>"><a href="<?php echo site_url("backend/gallery/albums") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_500") ?></a></li>                

               <li class="<?php if(isset($activeLink['content']['gallery']['category'])) echo "active" ?>"><a href="<?php echo site_url("backend/content/gallery_categories") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_442") ?></a></li>
               
               <li class="<?php if(isset($activeLink['content']['gallery']['view'])) echo "active" ?>"><a href="<?php echo site_url("backend/gallery/categories") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_441") ?></a></li>  
           </div>
           
           
           
                  </ul>
                </div>
              </li>
       <!--accomodation Block-->
            <li id="accomodation_sb">
                <a data-toggle="collapse" data-parent="#accomodation_sb" href="#accomodation_sb_c" class="collapsed <?php if(isset($activeLink['accomodation'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-file sidebar-icon"></span> <?php echo "Manage Room"//accomodation ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="accomodation_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['accomodation'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                  <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
                  <li class="<?php if(isset($activeLink['accomodation']['room'])) echo "active" ?>"><a href="<?php echo site_url("backend/hotel/accomodation/room") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo "Room Setting" //Setting ?></a></li>
                 <?php endif; ?> 

                 <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
                  <li class="<?php if(isset($activeLink['accomodation']['plan'])) echo "active" ?>"><a href="<?php echo site_url("backend/hotel/accomodation/room_plan") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo "Room Plan" //Setting ?></a></li>
                 <?php endif; ?>

           
           
             
           
           
                  </ul>
                </div>
              </li>          

               
            <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
                  <li class="<?php if(isset($activeLink['accomodation']['plan'])) echo "active" ?>"><a href="<?php echo site_url("backend/hotel/booking/booking_plan") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo "Booking Plan" //Setting ?></a></li>
            <?php endif; ?>

            <li class="<?php if(isset($activeLink['members']['general'])) echo "active" ?>"><a href="<?php echo site_url("backend/members") ?>"><span class="glyphicon glyphicon-user sidebar-icon"></span> <?php echo lang("ctn_155") ?></a></li>
            <li class="<?php if(isset($activeLink['settings']['general'])) echo "active" ?>"><a href="<?php echo site_url("backend/user_settings") ?>"><span class="glyphicon glyphicon-cog sidebar-icon"></span> <?php echo lang("ctn_156") ?></a></li>
          <?php if($this->settings->info->payment_enabled) : ?> 
            <li class="<?php if(isset($activeLink['funds']['general'])) echo "active" ?>"><a href="<?php echo site_url("backend/funds") ?>"><span class="glyphicon glyphicon-piggy-bank sidebar-icon"></span> <?php echo lang("ctn_245") ?></a></li>
            <li class="<?php if(isset($activeLink['funds']['plans'])) echo "active" ?>"><a href="<?php echo site_url("backend/funds/plans") ?>"><span class="glyphicon glyphicon-list-alt sidebar-icon"></span> <?php echo lang("ctn_273") ?></a></li> -->
          <?php endif; ?>
         <li class="<?php if(isset($activeLink['test']['general'])) echo "active" ?>"><a href="<?php echo site_url("backend/test") ?>"><span class="glyphicon glyphicon-heart sidebar-icon"></span> <?php echo lang("ctn_165") ?></a></li>
           <li id="restricted_sb">
                <a data-toggle="collapse" data-parent="#restricted_sb" href="#restricted_sb_c" class="collapsed <?php if(isset($activeLink['restricted'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-lock sidebar-icon"></span> <?php echo lang("ctn_166") ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="restricted_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['restricted'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <li class="<?php if(isset($activeLink['restricted']['general'])) echo "active" ?>"><a href="<?php echo site_url("backend/test/restricted_admin") ?>"><span class="glyphicon glyphicon-wrench"></span> <?php echo lang("ctn_167") ?> <span class="sr-only">(current)</span></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['groups'])) echo "active" ?>"><a href="<?php echo site_url("backend/test/restricted_group") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_168") ?></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['users'])) echo "active" ?>"><a href="<?php echo site_url("backend/test/restricted_user") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_169") ?></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['premium'])) echo "active" ?>"><a href="<?php echo site_url("backend/test/restricted_premium") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_289") ?></a></li>
                  </ul>
                </div>
              </li> 
            <?php include("custom_menus.php") ?>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div id="responsive-menu-links">
          <select name='link' OnChange="window.location.href=$(this).val();" class="form-control">
          <option value='<?php echo site_url("backend") ?>'><?php echo lang("ctn_154") ?></option>
          <option value='<?php echo site_url("backend/members") ?>'><?php echo lang("ctn_155") ?></option>
          <option value='<?php echo site_url("backend/user_settings") ?>'><?php echo lang("ctn_156") ?></option>
          <?php if($this->user->loggedin && isset($this->user->info->user_role_id) &&
           ($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment)

           ) : ?>
           <?php if($this->user->info->admin || $this->user->info->admin_settings) : ?>
            <option value='<?php echo site_url("backend/admin/settings") ?>'><?php echo lang("ctn_158") ?></option>
            <option value='<?php echo site_url("backend/admin/social_settings") ?>'><?php echo lang("ctn_159") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
            <option value='<?php echo site_url("backend/admin/members") ?>'><?php echo lang("ctn_160") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin) : ?>
            <option value='<?php echo site_url("backend/admin/user_roles") ?>'><?php echo lang("ctn_316") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
            <option value='<?php echo site_url("backend/admin/user_groups") ?>'><?php echo lang("ctn_161") ?></option>
            <option value='<?php echo site_url("backend/admin/ipblock") ?>'><?php echo lang("ctn_162") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin) : ?>
            <option value='<?php echo site_url("backend/admin/email_templates") ?>'><?php echo lang("ctn_163") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin || $this->user->info->admin_members) : ?>
            <option value='<?php echo site_url("backend/admin/email_members") ?>'><?php echo lang("ctn_164") ?></option>
            <?php endif; ?>
            <?php if($this->user->info->admin || $this->user->info->admin_payment) : ?>
            <option value='<?php echo site_url("backend/admin/payment_settings") ?>'><?php echo lang("ctn_246") ?></option>
            <option value='<?php echo site_url("backend/admin/payment_plans") ?>'><?php echo lang("ctn_258") ?></option>
            <option value='<?php echo site_url("backend/admin/payment_logs") ?>'><?php echo lang("ctn_288") ?></option>
            <option value='<?php echo site_url("backend/admin/premium_users") ?>'><?php echo lang("ctn_325") ?></option>
            <?php endif; ?>
          <?php endif; ?>
          <?php if($this->common->has_permissions(array("admin", "content_manager", "content_worker"), $this->user)) : ?>
          <option value='<?php echo site_url("backend/content") ?>'><?php echo lang("ctn_438") ?></option>
          <option value='<?php echo site_url("backend/content/categories") ?>'><?php echo lang("ctn_439") ?></option>
        <?php endif; ?>
          <option value='<?php echo site_url("backend/page") ?>'><?php echo lang("ctn_440") ?></option>
          <option value='<?php echo site_url("backend/page/categories") ?>'><?php echo lang("ctn_441") ?></option>
          <option value='<?php echo site_url("backend/test") ?>'><?php echo lang("ctn_165") ?></option>
          <?php if($this->settings->info->payment_enabled) : ?>
          <option value='<?php echo site_url("backend/funds") ?>'><?php echo lang("ctn_245") ?></option>
          <!--<option value='<?php echo site_url("backend/funds/plans") ?>'><?php echo lang("ctn_273") ?></option>
          <?php endif; ?> -->
          <option value='<?php echo site_url("backend/test/restricted_admin") ?>'><?php echo lang("ctn_167") ?></option>
          <option value='<?php echo site_url("backend/test/restricted_group") ?>'><?php echo lang("ctn_168") ?></option>
          <option value='<?php echo site_url("backend/test/restricted_user") ?>'><?php echo lang("ctn_169") ?></option>
          <option value='<?php echo site_url("backend/test/restricted_premium") ?>'><?php echo lang("ctn_289") ?></option>
          </select>
        </div>
        <?php if($this->settings->info->install) : ?>
          <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-info"><b><span class="glyphicon glyphicon-warning-sign"></span></b> <a href="<?php echo site_url("backend/install") ?>">Great job on uploading all the files and setting up the site correctly! Let's now create the Admin account and set the default settings. Click here! This message will disappear once you have run the install process.</a></div>
                        </div>
                    </div>
        <?php endif; ?>
        <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                        </div>
                    </div>
        <?php endif; ?> 
        <?php $gle = $this->session->flashdata('globalerrormsg'); ?>
        <?php if(!empty($gle)) :?>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('globalerrormsg') ?></div>
                        </div>
                    </div>
        <?php endif; ?>

        <?php echo $content ?>

        <hr>
        <p class="align-center small-text"> <?php echo $this->settings->info->site_name ?> V<?php echo $this->settings->version ?> - <a href="<?php echo site_url("backend/home/change_language") ?>"><?php echo lang("ctn_171") ?></a></p>

          </div>
      </div>
    </div>
  <?php echo $jsExternal;?>

    </body>
</html>
