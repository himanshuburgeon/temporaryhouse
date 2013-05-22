<!DOCTYPE html> <!--[if lt IE 7 ]><html
class="ie ie6" lang="en-US"> <![endif]--> <!--[if IE 7 ]><html
class="ie ie7" lang="en-US"> <![endif]--> <!--[if IE 8 ]><html
class="ie ie8" lang="en-US"> <![endif]--> <!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en-US"> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temporary House</title>
<?php echo $this->Html->css('style.css'); ?>

<!-----------top_right_nav------------>
<?php echo $this->Html->css('languageswitcher.css'); ?>
<!-----------top_right_nav------------>

<!---------menu navigation----------->
<?php echo $this->Html->css('menu.css'); ?>
<?php echo $this->Html->script('jquery.js'); ?>
<?php echo $this->Html->script('menu.js'); ?>
<!---------menu navigation----------->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/base/jquery-ui.css" />
<?php echo $this->Html->script('languageswitcher.js'); ?>
</head> 

<body>
  <div style="display: block;" class="jbgallery">
    <div id="jbg" class="zoom">
      <?php echo $this->Html->image('bg.jpg',array('style'=>'display: inline','class'=>'zoom','id'=>'jbgallery-target','alt'=>''));?>
    </div>
  </div>
  
  <!---------top_right_nav---------->
<div class="wrapper">
  <div class="float_right">
    <div id="country-select">
      <form action="" id="language">
        <select id="country-options" name="country-options">
          <?php foreach($LANGUAGES as $code=> $name){ ?>
          <option <?=($SITE['language']==$code)?'selected="#"':'';?> title="?languages=<?=$code?>" value="<?=$code?>"><?=$name?></option>
          <?php } ?>
          
        </select>
      </form>
    </div>
  </div>
</div>

<section></section>
<!---------top_right_nav-------end---------->

<!-----------------header menu------------------->
<?php echo $this->element('header');?>
<!-----------------header menu------end------------------->

<div class="wrapper">
  <?php if($this->request->action!='home'){ ?>
    <div class="inner">
      <div class="float_left inner_pg_top_bg"><?php echo $this->Html->image('inner_pg_top_bg.png');?></div>
      <?php echo $content_for_layout; ?>
      <div class="float_left"><?php echo $this->Html->image('inner_pg_bottom_bg.png');?></div>
      <?php if($this->request->action!='search'){ ?>
      </div>
      <?php } ?>
  <?php } else { ?>
    <?php echo $content_for_layout; ?>
  <?php } ?>
  
  <?php if($this->request->action=='home'){?>
    <?=$this->element('footer_home')?>
  <?php }else { ?>
    <div class="clear"></div>
    <?=$this->element('footer');?>
  <?php } ?>
    <?php if($this->request->action!='search'){ ?>
    </div>
    <?php  } ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
