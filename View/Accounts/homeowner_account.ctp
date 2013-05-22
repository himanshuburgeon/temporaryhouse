<div class="content-left">
	<h1>Homeowner Account</h1>
	<?php  echo $this->element('front_message');?>
	<div id="contractor" style="font-size:12px;">
		<?php echo $this->Form->create('contractor', array('action'=>'homeowner_account'));?>
		
		<div><strong>User name:</strong> <?=$homeowners['HomeOwner']['username']?> <b>(<?php echo $this->Html->link('change', array('controller'=>'accounts', 'action' => 'change_homeowner_username',$homeowners['HomeOwner']['id']), array('title'=>'Edit','rel'=>'tooltip'));?>)</b>
		</div> <br clear="all" />
		
		
		<div><strong>Password:</strong>  <?=$homeowners['HomeOwner']['password1']?>
		<b>(<?php echo $this->Html->link('change', array('controller'=>'accounts', 'action' => 'change_homeowner_password',$homeowners['HomeOwner']['id']), array('title'=>'Edit','rel'=>'tooltip'));?>)</b>
		</div>

	</div>
</div>
<?php echo $this->element('rightmenu'); ?>        
        
      
