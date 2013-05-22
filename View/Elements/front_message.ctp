<?php if ($this->Session->check('Message.flash')): ?>
<div class="notification success">
<?php echo $this->Session->flash(); ?>
	<a href="#" class="close">
		<?php echo $this->Html->image('cross_grey_small.png',array('alt'=>'close')); ?>
	</a>
	
</div>
<?php endif;?>



<?php if ($this->Session->check('Message.error')): ?>
<div class="notification error">
<?php echo  $this->Session->flash('error'); ?>
	<a href="#" class="close">
		<?php echo $this->Html->image('cross_grey_small.png',array('alt'=>'close')); ?>
	</a>

</div>
<?php endif;?>
