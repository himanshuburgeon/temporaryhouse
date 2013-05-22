<ul class="tabs">
	<li><a class="active" href="#tab1">Contractor</a></li>
</ul>
<div class="cha-tab acount_list" id="tab1">
	<ul id="navigation" class="treeview">
		<li class="open">
		<?php echo $this->Html->link('Main Page',array('controller'=>'contractors','action'=>'home'),array('class'=>'selected')); ?>
		<?php $menulist=$this->requestAction('pages/request_topmenu/48'); ?>
			<?php if($menulist){ ?>
				<ul>
					<?php foreach($menulist as $menu){ ?>
						<li>
							<?php echo $this->Html->link($menu['Page']['name'],array('controller'=>'contractors','action'=>'view',$menu['Page']['id'])); ?>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
		<!--<li class="open"><a href="" class="selected">Membership Information</a></li>-->
		<li class="open collapsable"><div class="hitarea open-hitarea collapsable-hitarea"></div><a href="Javascript:void(0);" class="selected">Account Management</a>
			<ul>
				<li><?php echo $this->Html->link('Status of Account',array('controller'=>'accounts','action'=>'account_status'));?></li>
				<li><?php echo $this->Html->link('Homeowner List',array('controller'=>'contractors','action'=>'homeowner_user_list'));?></li>
				<li><?php echo $this->Html->link('Homeowner Account',array('controller'=>'accounts','action'=>'homeowner_account'));?></li>
				
				<li><?php echo $this->Html->link('Change Username',array('controller'=>'accounts','action'=>'change_username'));?></li>
				<li class="last"><?php echo $this->Html->link('Change Password',array('controller'=>'accounts','action'=>'change_password'));?></li>
			</ul>
		 </li>
		 <li class="collapsable"><div class="hitarea collapsable-hitarea"></div><?php echo $this->Html->link('Order Product',array('controller'=>'contractors','action'=>'order_products'));?>
			<ul style="display: block;">
				<li><?php echo $this->Html->link('Order History',array('controller'=>'contractors','action'=>'order_history'));?></li>
			</ul>
		</li>
		<li class="open"><?php echo $this->Html->link('Pay dues',array('controller'=>'accounts','action'=>'pay_dues')); ?></li>
		
		<li><?php echo $this->Html->link('Contact Us',array('controller'=>'pages','action'=>'view/27'));?></li>
		<li class="last">
			<?php echo $this->Html->link('Logout',array('controller'=>'contractors','action'=>'logout'),array('class'=>'selected')); ?>
		</li>
	</ul>
</div>
     
