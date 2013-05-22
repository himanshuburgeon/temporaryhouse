<div class="content-left">
	<h1>Edit Homeowner Name</h1>
	<?php echo $this->element('front_message'); ?>
	<?php echo $this->Form->create('HomeOwner', array('url'=>array('controller'=>'accounts','action'=>'change_homeowner_username')));?>
	<?php echo $this->Form->hidden('id'); ?>
	
	<div class="contractor">New User Name :</div>
	<?php echo $this->Form->text('username',array('class'=> 'float-left','size'=>'45')); ?>
	
	<div class="contractor">Enter Contractor Password :</div>
	<?php echo $this->Form->password('password',array('class'=> 'float-left','size'=>'45')); ?>
	<div class="contractor">&nbsp;</div>
	<?php echo $this->Form->submit('change',array('class'=> 'float-left')); ?>
</div>
<?php echo $this->element('rightmenu'); ?>
