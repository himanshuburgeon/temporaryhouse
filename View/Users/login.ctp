<!doctype html>
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<title><?php echo $SITE['sitetitle']; ?>: Admin Panel</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="<?php echo Configure::read('HTTP_PATH');?>/favicon.ico" type="image/x-icon" rel="shortcut icon" />
	
	<!-- CSS Styles -->
	<?php echo $this->Html->css('admin/style.css');?>
	<?php echo $this->Html->css('admin/colors.css');?>
	<?php echo $this->Html->css('admin/jquery.tipsy.css');?>

	
	<!-- Google WebFonts -->
	<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic' rel='stylesheet' type='text/css'>
	<?php echo $this->Html->script('admin/libs/modernizr-1.7.min.js'); ?>


</head>
<body class="login">
	<section role="main">
	
		<?php //echo $this->Html->link($this->Html->image('site_config/'.$SITE['siteimage']), array('controller'=>'users', 'action'=>'index')); ?>
        <?php echo $this->Html->image('site_config/'.$SITE['siteimage']);?>
        
	
		<!-- Login box -->
		<article id="login-box">
		
			<div class="article-container">
			
				<!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et dignissim metus. Maecenas id augue ac metus tempus aliquam. </p> -->
				
				<!-- Notification -->
				<?php if ($this->Session->check('Message.auth')): ?>
				<div class="notification error">
					<a href="#" class="close-notification" title="Hide Notification" rel="tooltip">x</a>
					<p><strong>Error notification</strong>
					
					<?php echo $this->Session->flash('auth'); ?>
					</p>
				</div>
				<?php endif; ?>
				<!-- /Notification -->
			
				<?php echo  $this->Form->create('User', array('action' => 'login'));?>
					<fieldset>
						
						<dl>
							<dt>
								<label>Username</label>
							</dt>
							<dd>
								<?php echo $this->Form->text('username', array('class' => 'large')); ?>
							</dd>
							<dt>
								<label>Password</label>
							</dt>
							<dd>
								<?php echo $this->Form->password('password', array('class'=> 'large')); ?>
							</dd>
							
						</dl>
						  
					</fieldset>
					 
					<button class="right" type="submit">Log in</button>		
					
				</form>
			
			</div>
		
		</article>
		<!-- /Login box -->
		<ul class="login-links">
			<li><?php echo $this->Html->link('Lost password?', array('controller'=>'users', 'action' => 'forgotpassword'), array('class'=>'leftnav'));?></li>
			
			<li><?php echo $this->Html->link('Return to site Home Page', array('controller'=>'pages', 'action' => 'home'), array('class'=>'leftnav'));?></li>
		</ul>
		
	</section>

	<!-- JS Libs at the end for faster loading -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<?php echo $this->Html->script('admin/libs/selectivizr.js'); ?>
	<?php echo $this->Html->script('admin/jquery/jquery.tipsy.js'); ?>
	<?php echo $this->Html->script('admin/login.js'); ?>
	<script>
		var _gaq=[['_setAccount','UA-XXXXXX'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
</body>
</html>
