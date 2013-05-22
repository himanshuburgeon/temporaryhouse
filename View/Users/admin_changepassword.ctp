<?php echo $this->Html->script('admin/change_password.js');?>

<div>
        <article>
		<header>
			<h2><?php echo __('change_password') ?></h2>
                </header>
        </article>
                
        <?php echo $this->element('admin/message');?>
        <?php echo $this->Form->create('User', array('name' => 'user','action' => 'changepassword','onSubmit'=>'return validatefields()'));?>
        <fieldset>
		<dl>
			<dt><label><?php echo __('current') ?> <?php echo __('password') ?> </label><span style="color:red;">*</span></dt>
			<dd><?php echo $this->Form->password('oldpassword', array('class'=>'small','size' => 20)); ?></dd>
		</dl>
		
		<dl>
                    	<dt><label><?php echo __('new') ?> <?php echo __('password') ?> </label><span style="color:red;">*</span></dt>
			<dd><?php echo $this->Form->password('password', array('class'=>'small','size' => 20)); ?></dd>
		</dl>
		
		<dl>
                    	<dt><label><?php echo __('confirm') ?> <?php echo __('password') ?> </label><span style="color:red;">*</span></dt>
			<dd><?php echo $this->Form->password('password2', array('class'=>'small','size' => 20)); ?></dd>
		</dl>

        </fieldset>
        <button type="submit">
               <?php echo __('change_password') ?>
        </button>
        
	<?php $this->Form->end();?>
	
</div>



