<ul class='tabs'>
	<li><a href='#tab1' class="active">Contractors</a></li>
	<li><?php echo $this->Html->link('Homeowner','#tab2') ?></li>
</ul>
<div id='tab1'>
	<?php echo $this->Form->create('Contractor',array('url'=>array('controller'=>'pages','action'=>'home'))); ?>
	<?php echo $this->Form->hidden('type',array('value'=>'contractor')); ?>
	<label for="username">Username</label>
	<?php echo $this->Form->text('username',array('class'=>'username')); ?>
	<br />
	<label for="username">Password</label>
	<?php echo $this->Form->password('password',array('class'=>'password')); ?>
	<br/>
	<label>username: himanshumahara34</label> 
	 <label>password: 267921162</label> 
	<?php echo $this->Form->submit('Login',array('class'=>'submit','value'=>'Login')); ?>
	<p><?php echo $this->Html->link('Forgot Password',array('controller'=>'contractors','action'=>'forgot_password')); ?>|
	<?php echo $this->Html->link('Register',array('controller'=>'contractors','action'=>'sign_up'));?>
	</p>
	<?php echo $this->Form->end(); ?>
</div>
<div id='tab2'>
	<?php echo $this->Form->create('HomeOwners',array('url'=>array('controller'=>'pages','action'=>'home'))); ?>
	<?php echo $this->Form->hidden('type',array('value'=>'homeowner')); ?>
	<label for="username">Username</label>
	<?php echo $this->Form->text('username',array('class'=>'username')); ?>
	<br />
	<label for="username">Password</label>
	<?php echo $this->Form->password('password',array('class'=>'password')); ?>
	<br/>
	<label>username: himanshumahara_ho_ho</label> 
	 <label>password: 1697785426</label> 
	<?php echo $this->Form->submit('Login',array('Login'=>'submit','value'=>'Login')); ?>
	<?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->script('tabs.js'); ?>

