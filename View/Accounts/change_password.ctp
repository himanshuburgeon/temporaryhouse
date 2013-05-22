<script language="javascript">
	function validate(){
			if(document.getElementById('AccountPassword1').value==''){
				alert("Please Enter Old Password");
				document.getElementById('AccountPassword1').focus();
				return false;
			}
			if(document.getElementById('AccountPassword').value==''){
				alert("Please Enter new password");
				document.getElementById('AccountPassword').focus();
				return false;
			}
			if(document.getElementById('AccountConfirmPassword').value==''){
				alert("Please Enter Confirm Password");
				document.getElementById('AccountConfirmPassword').focus();
				return false;
			}
			if(document.getElementById('AccountPassword').value!=document.getElementById('AccountConfirmPassword').value){
				alert("Confirm password does not match to the new password");
				document.getElementById('AccountConfirmPassword').focus();
				return false;
			}
		}
</script>

<div class="content-left">
	<h1>Change Password</h1>
	<?php  echo $this->element('front_message');?>
	<div id="contractor">
		<?php echo $this->Form->create('account', array('action'=>'change_password','onSubmit'=>"return validate()"));?>
		<div class="contractor">Old Password<span style="color:red;">*</span></div>
		<?php echo $this->Form->password('password1',array('class'=> 'float-left','size'=>'45')); ?>
		<div class="contractor">New Password<span style="color:red;">*</span></div>
		<?php echo $this->Form->password('password',array('class'=> 'float-left','size'=>'45')); ?>
		<div class="contractor">Confirm New Password:<span style="color:red;">*</span></div>
		<?php echo $this->Form->password('confirmPassword',array('class'=> 'float-left','size'=>'45')); ?>`
		<div class="contractor">&nbsp;</div>
		 <?php echo $this->Form->submit('change',array('class'=> 'float-left','style'=>'margin-top:0;')); ?>         
	</div>
</div>
<?php echo $this->element('rightmenu'); ?>        
        
      
