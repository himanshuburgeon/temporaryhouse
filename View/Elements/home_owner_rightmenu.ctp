<ul class='tabs'>
	<li><a href='#tab1' class="active">Homeowner</a></li>
</ul>
<div id='tab1' class="cha-tab acount_list">
	<ul id="navigation">
		<li><?php echo $this->Html->link('Educate',array('controller'=>'homeowners','action'=>'view',49));?>
			<?php $menulist=$this->requestAction('pages/request_topmenu/49'); ?>
			<?php if($menulist){ ?>
				<ul>
					<?php foreach($menulist as $menu){ ?>
						<li>
							<?php echo $this->Html->link($menu['Page']['name'],array('controller'=>'homeowners','action'=>'view',$menu[		'Page']['id'])); ?>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
		<li>
			<?php echo $this->Html->link('Investigate',array('controller'=>'homeowners','action'=>'view',55));?>
			<?php $menulist=$this->requestAction('pages/request_topmenu/55'); ?>
			<?php if($menulist){ ?>
				<ul>
					<?php foreach($menulist as $menu){ ?>
						<li>
							<?php echo $this->Html->link($menu['Page']['name'],array('controller'=>'homeowners','action'=>'view',$menu['Page']['id'])); ?>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
		<li>
			<?php echo $this->Html->link('Tool Kit',array('controller'=>'homeowners','action'=>'view',60));?>
		</li>
		
		<li>
			<?php echo $this->Html->link('Contact us',array('controller'=>'homeowners','action'=>'view',64));?>
			<?php $menulist=$this->requestAction('pages/request_topmenu/64'); ?>
			<?php if($menulist){ ?>
				<ul>
					<?php foreach($menulist as $menu){ ?>
						<li>
							<?php echo $this->Html->link($menu['Page']['name'],array('controller'=>'homeowners','action'=>'view',$menu['Page']['id'])); ?>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
		
		<li>
			<?php echo $this->Html->link('Logout',array('controller'=>'homeowners','action'=>'logout')); ?>
		</li>
	</ul>
</div>
      
