<div class="content-right"><!----------------content-right----------------->
	<div class="content-box">
		<?php $homeowner_session = $this->Session->read('Member.homeowner'); ?>
		<?php $contractor_session = $this->Session->read('Member.contractor'); ?>
		
		
		<?php
			if(!empty($contractor_session)){
				echo $this->element('contractor_rightmenu');
			}
			else if(!empty($homeowner_session)){
				echo $this->element('home_owner_rightmenu');
			}
			else{
				echo $this->element('login');
			}
		?>
	</div><!------------------------content-box-end------------------------>
</div>
