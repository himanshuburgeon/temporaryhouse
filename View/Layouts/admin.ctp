<!doctype html>
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<title><?php echo $SITE['sitetitle']; ?>-<?php echo $title_for_layout; ?> : Admin Panel</title>
	<link href="<?php echo $SITE['siteurl'];?>/favicon.ico" type="image/x-icon" rel="shortcut icon" />
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	
	
	
	<!-- Load jquery for ckeditor and ckfinder -->
	<?php echo $this->Html->script(array('ckeditor/ckeditor.js','ckfinder/ckfinder.js'));?>
	<!-- End Load jquery for ckeditor and ckfinder -->
   
   
   <!-- load jquery and jquery ui --> 
	<script src= 
	"//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" 
	></script>
	
	 <script type='text/javascript' src= 
	'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.m
	in.js'></script> 
	
	<link rel="stylesheet" type="text/css" href= 
	"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base
	/jquery-ui.css" />
	
	<?php //echo $this->Html->script('admin/common.js'); ?>
	<?php //echo $this->Html->script('tiny_mce/tiny_mce.js'); ?>
	<?php echo $this->Html->script('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
   

	<!-- CSS Styles -->
	<?php echo $this->Html->css('admin/style.css');?>
	<?php echo $this->Html->css('admin/colors.css');?>
	<?php echo $this->Html->css('admin/jquery.fileinput.css');?>
	<?php echo $this->Html->css('admin/demo.css');?>
	<?php echo $this->Html->css('fancybox/jquery.fancybox-1.3.4.css');?>
	
	
	<!-- Google WebFonts -->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
	<?php echo $this->Html->script('admin/libs/modernizr-1.7.min.js'); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.fancybox').fancybox();
			});
	</script>
   
	
</head>

<!-- Add class .fixed for fixed layout. You would need also edit CSS file for width -->
<body>
	<?php //print_r($ADMIN_PERMISSIONS)?>
	<div class="fixed-wraper">

	<!-- Aside Block -->
	<section role="navigation">
		<!-- Header with logo and headline -->
		<header>
			 <?php if($SITE['siteimage'])echo $this->Html->image('site_config/'.$SITE['siteimage'],array('style'=>''));  ?>			
		</header>
		<div style="float:right">
				<?php unset($LANGUAGES['rus']); ?>
				<?php echo $this->Form->input('language',array('options'=>$LANGUAGES,'div'=>false,'label'=>false,'lagend'=>false,'value'=>$SITE['language'],'onchange'=>'window.location.href=window.location.href+"?languages="+this.value')); ?>
				
		</div>
		
		<!-- User Info -->
			<section id="user-info">
								
				<?php if(isset($SITE['adminimage'])) { ?>
				<?php echo $this->Html->image('site_config/'.$SITE['adminimage']);?>
				<?php } else { ?>
				<?php echo $this->Html->image('admin/sample_user.png');?>
				<?php } ?>
				<div>
					<a href="#" title="Account Settings and Profile Page"><?php if($loggedIn): ?><? echo ucfirst($SITE['adminname']); ?><?php endif; ?></a>
		       
					<em>Administrator</em>                
			
					<ul>
						<li><?php echo $this->Html->link(__('view_website'), array('controller'=>'../pages', 'action' => 'home'),array('class'=>'button-link','rel'=>'tooltip','title'=>__('view_website'),'target'=>'_blank')); ?>
			    </li>
						<li><?php echo $this->Html->link(__('logout'), array('controller'=>'../users', 'action' => 'logout'), array('class'=>'button-link','rel'=>'tooltip','title'=>__('logout')));?>
						</li>
					</ul>
				</div>
				
			</section>
		<!-- /User Info -->
		
		<!-- Main Navigation -->
		<nav id="main-nav">
			<ul>
				<li class="<?php if($this->params['controller']=="users" && $this->params['action']=="admin_welcome") echo "current"; ?>">
				<?php echo $this->Html->link(__('dashboard'), array('controller'=>'users', 'action' => 'welcome'),array('class'=>'dashboard no-submenu'));?>
				</li>
				
				<?php if((isset($ADMIN_PERMISSIONS['PagesController']) && $ADMIN_PERMISSIONS['PagesController']) || $ADMIN_USERS['User']['usertype']=='A'){ ?>
				<!-- Use class .current to open submenu on page load -->
				<li class="<?php if($this->params['controller']=="pages") echo "current"; ?>">				
					<?php echo $this->Html->link(__('content_manager'), array('controller'=>'pages', 'action' => 'index'),array('class'=>'content no-submenu'));?>
				</li>
				<?php } ?>
				
				
				<?php if((isset($ADMIN_PERMISSIONS['OwnersController']) && $ADMIN_PERMISSIONS['OwnersController']) || $ADMIN_USERS['User']['usertype']=='A'){ ?>
				<li class="<?php if($this->params['controller']=="owners") echo "current"; ?>">				
					<?php echo $this->Html->link(__('owner_manager'), array('controller'=>'owners', 'action' => 'index'),array('class'=>'owner no-submenu'));?>
				</li>
				<?php } ?>
				<?php if((isset($ADMIN_PERMISSIONS['PropertiesController']) && $ADMIN_PERMISSIONS['PropertiesController']) || $ADMIN_USERS['User']['usertype']=='A'){ ?>
				<li class="<?php if($this->params['controller']=="properties") echo "current"; ?>">				
					<?php echo $this->Html->link(__('property_manager'), array('controller'=>'properties', 'action' => 'index'),array('class'=>'property no-submenu'));?>
				</li>
				<?php } ?>
				<?php //if((isset($ADMIN_PERMISSIONS['LanguagesController']) && $ADMIN_PERMISSIONS['LanguagesController']) || $ADMIN_USERS['User']['usertype']=='A'){ ?>
				<!--<li class="<?php //if($this->params['controller']=="languages") echo "current"; ?>">				
					<?php //echo $this->Html->link(__('language_manager'), array('controller'=>'languages', 'action' => 'index'),array('class'=>'language no-submenu'));?>
				</li>-->
				<?php //} ?>
				
								
				<?php if($ADMIN_USERS['User']['usertype']=='A'){ ?>
				<li class="<?php if($this->params['controller']=="users" && ($this->params['action']=="admin_index" or $this->params['action']=="admin_permission" or $this->params['action']=="admin_add" or $this->params['action']=="admin_edit")) echo "current"; ?>">
				<?php echo $this->Html->link(__('sub_admin_manager'),array(),array('class'=>'users'));?>
					
					<ul>
						<li class="<?php if($this->params['controller']=="users" && $this->params['action']=="admin_add") echo "current"; ?>"><?php echo $this->Html->link(__('add_sub_admin'), array('controller'=>'users', 'action' => 'add'));?></li>
						<li class="<?php if($this->params['controller']=="users" && $this->params['action']=="admin_index") echo "current"; ?>"><?php echo $this->Html->link(__('manage_sub_admin'), array('controller'=>'users', 'action' => 'index'));?></li>
					</ul>
				</li>
				<?php } ?>
			
				<?php if((isset($ADMIN_PERMISSIONS['MessagesController']) && $ADMIN_PERMISSIONS['MessagesController']) || $ADMIN_USERS['User']['usertype']=='A'){ ?>
				<li class="<?php if($this->params['controller']=="messages") echo "current"; ?>">
				<?php echo $this->Html->link(__('message_manager'), array('controller'=>'messages', 'action' => 'index'),array('class'=>'message no-submenu'));?>
				</li>
				<?php } ?>
                
                <?php if((isset($ADMIN_PERMISSIONS['MailsController']) && $ADMIN_PERMISSIONS['MailsController']) || $ADMIN_USERS['User']['usertype']=='A'){ ?>
				<li class="<?php if($this->params['controller']=="mails") echo "current"; ?>">
				<?php echo $this->Html->link(__('mail_format_manager'), array('controller'=>'mails', 'action' => 'index'),array('class'=>'mail no-submenu'));?>
				</li>
				<?php } ?>
						
				
					
					
				<li class="<?php if(($this->params['controller']=="sites" || $this->params['controller']=="users") and ($this->params['action']=="admin_siteconfig" || $this->params['action']=="admin_changepassword"))
					echo "current"; ?>"><?php echo $this->Html->link(__('setting'),array(),array('class'=>'settings'));?>
					<ul>
						<?php if($ADMIN_USERS['User']['usertype']=='A'){ ?>
						<li <?php if($this->params['controller']=="sites") echo "class=\"current\""; ?> ><?php echo $this->Html->link(__('site_configuration'), array('controller'=>'sites', 'action' => 'siteconfig'));?></li>
						<?php } ?>
						
						<li class="<?php if($this->params['controller']=="users") echo "current"; ?>"><?php echo $this->Html->link(__('change_password'), array('controller'=>'users', 'action' => 'changepassword'));?></li>
						
					</ul>
				</li>
			</ul>
		</nav>
		<!-- /Main Navigation -->
		
	</section>
	<!-- /Aside Block -->
	
	<!-- Main Content -->
	<section role="main">
		
		<?php echo $content_for_layout; ?>
		<br clear="all" />
        <?php echo $this->element('sql_dump'); ?>
     </section> 
	<!-- /Fixed Layout Wrapper -->
	
	
	<!-- JS Libs at the end for faster loading -->
	<?php echo $this->Html->script('admin/libs/selectivizr.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.tipsy.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.fileinput.js'); ?>
	<?php echo $this->Html->script('admin/jquery/excanvas.js'); ?>
	<?php echo $this->Html->script('admin/script.js'); ?>
	<?php //echo $this->Html->script('admin/jquery/jquery.datepicker.js'); ?>
        <?php echo $this->Html->script('admin/jquery/jquery.fullcalendar.min.js'); ?>
	
	<script>
		var _gaq=[['_setAccount','UA-XXXXXXX'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
</body>
</html>
