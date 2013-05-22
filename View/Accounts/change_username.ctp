<script language="javascript">
	function validate(){
		$('.notification').remove();
		var error = 0 ;
		$msg = '';
		if(document.getElementById('username').value==''){
			$msg = '<div class="notification error"><div id="errorMessage" class="message">Please enter username</div><a class="close" href="#"><img alt="close" src="/nib/img/cross_grey_small.png"></a></div>';
			$('#contractor').prepend($msg);
			error = 1;
			document.getElementById('username').focus();
			
		}else{
			if($('#t_password').is(':visible')) {
				if(document.getElementById('password1').value==''){
					$msg = '<div class="notification error"><div id="errorMessage" class="message">Please enter your password to change username</div><a class="close" href="#"><img alt="close" src="/nib/img/cross_grey_small.png"></a></div>';
					$('#contractor').prepend($msg);
					$('#password1').focus();
					error = 1;
				}
			}else{
				$msg = '<div class="notification error"><div id="errorMessage" class="message">Please enter your password to change username</div><a class="close" href="#"><img alt="close" src="/nib/img/cross_grey_small.png"></a></div>';
				$('#contractor').prepend($msg);
				$('#t_password').show();
				$('#password1').focus();
				error = 1;
			}
			
			
			
		}
		
		$('.close').click(function(){
				$(this).parent().fadeTo(350, 0, function () {$(this).slideUp(600);});
				return false;
		});
			
		if(error==0){
			return true;
		}else{
			return false;
		}
		
	}
</script>

<div class="content-left">
	<h1>Change Username</h1>
	<?php  echo $this->element('front_message');?>
	<div id="contractor">
		<?php echo $this->Form->create('account', array('action'=>'change_username','onSubmit'=>"return validate()"));?>
		
		<div class="contractor">Username</div>
		<?php echo $this->Form->text('username',array('class'=> 'float-left','size'=>'45','id'=>'username')); ?>
		<div id="t_password" style="display:none;">
			<div class="contractor">Enter Password</div>
			<?php echo $this->Form->password('password1',array('class'=> 'float-left','size'=>'45','id'=>'password1')); ?>
		</div>
		<div class="contractor">&nbsp;</div>
		 <?php echo $this->Form->submit('change',array('class'=> 'float-left','style'=>'margin-top:0;')); ?>         
	</div>
</div>
<?php echo $this->element('rightmenu'); ?>        
        
      
