<div class="content-right">
	<div class="content-box">
		<ul class="tabs">
			<?php $menulist=$this->requestAction('pages/request_topmenu/27'); ?>
			<?php //echo "<pre>";print_r($menulist);die; ?> 
			<?php if($menulist){ ?>
			<li><?php echo $this->Html->link('Contact Us',array('controller'=>'pages','action'=>'view',27), array('class'=>'active'));?></li>
			<?php } ?>
		</ul>
		
		<div class="cha-tab acount_list" id="tab1">
			<?php echo $this->Form->create('page',array('controller'=>'pages','action'=>'view',27));?>
			<label for="username">Name</label>
			<?php echo $this->Form->text('name',array('class'=>'username')); ?>
			<br />
			
			<label for="username">Email</label>
			<?php echo $this->Form->text('email',array('class'=>'password')); ?>
			<br />
			
			<label for="username">Phone no.</label>
			<?php echo $this->Form->text('phone',array('class'=>'password')); ?>
			<br />
			
			<label for="username">Message</label>
			<?php echo $this->Form->textarea('message',array('type'=>'text'));?>
			<br />
			<?php echo $this->Form->end(__('Submit')); ?>
		</div>
	</div><!------------------------content-box-end------------------------>
</div>
