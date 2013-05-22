<div class="content-left">
	<h1>Contractor Status of Account</h1>
	<div class="status-account">
		<?php echo $this->Form->create('account', array('action'=>'','onSubmit'=>"",'class'=>'st-account'));?>
			<label for="membersince" class="member-label">Member since </label>
			<div class="status-txt"><strong><?php echo date("Y-m-d",strtotime($account_info['Contractor']['created_at'])); ?></strong></div>
			<div class="clear" style="padding-top:10px;"></div>
			<div class="membersince_left">
				<label for="membersince" class="member-label">Current amount due</label>
				<?php if(($account_info['Contractor']['paid_sign_up_fee'])==0){
					$amount=($account_info['Contractor']['sign_up_fee'])+($account_info['Contractor']['quarterly_fee']);
					}
					else $amount=$account_info['Contractor']['quarterly_fee'];
					?>
				<div class="status-txt"><strong><?php echo '$'.$amount; ?></strong></div>
			</div>
			<div class="membersince_right">
				<label for="membersince" class="member-label">due by</label>
				<div class="status-txt"><strong><?php echo date("Y-m-d",strtotime($account_info['Contractor']['end_date'])); ?></strong></div>
				<br>
                <div class="status-make-payment">
				<?php 
				function datediff($date1,$date2){
					$difference = abs(strtotime($date2) - strtotime($date1));
					$days = round((($difference/60)/60)/24,0);
					return $days;
				}
				$current_date=date("Y-m-d",strtotime(date("Y-m-d")));
				$end_date=date("Y-m-d",strtotime($account_info['Contractor']['end_date']));
				$diff= datediff($current_date,$end_date); 
				
				if($diff<=10)
				echo $this->Html->link('Make Payment',array('controller'=>'accounts', 'action' => 'pay_dues'));
				?>
                </div>
            </div>
			<div class="clear" style="padding-top:10px;"></div>
            <p><strong>Past payments</strong></p>
			<?php foreach($payments as $payment){ ?>
			<div class="clear"></div>
			<div class="membersince_left1">
				<label for="membersince" class="member-label">Date</label>
				<?php echo $this->Form->text('date',array('class'=> 'input-account','readonly'=>'readonly','value'=>date("Y-m-d",$payment['Payment']['date']))); ?>	
			</div>
			<div class="membersince_right1">
				<label for="membersince" class="member-label">Amount Paid $</label>
				<?php echo $this->Form->text('amount',array('class'=> 'input-account','readonly'=>'readonly','value'=>$payment['Payment']['amount'])); ?>
			</div>
			<?php } ?>
			<?php if(empty($payments)){ ?>
				<div style="text-align:center;color:red;">No Past Payments</div>
			<?php } ?>
	</div>
</div>
<?php echo $this->element('rightmenu'); ?>
