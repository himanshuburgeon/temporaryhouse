<script language="javascript">
function checkemail(str){
	var filter=/^.+@.+\..{2,3}$/;
	testresults=false;
	if (filter.test(str))
		testresults=true;
	return testresults;
}
function isAlphabet(str)
{
	var filter= /^[a-zA-Z]+[a-zA-Z]+[a-zA-Z ]{0,98}$/; 
	testresults=false;
	if (filter.test(str))
		testresults=true;
	return testresults;
}  
function IsNumeric(strString){
	var strValidChars = "0123456789";
	var strChar;
	var blnResult = true;
	if (strString.length == 0) return false;
		for (i = 0; i < strString.length && blnResult == true; i++){
			strChar = strString.charAt(i);
				if (strValidChars.indexOf(strChar) == -1){
					blnResult = false;
				}
		}
		return blnResult;
}
function validate()
{
	if(document.getElementById('UserFirstName').value=='')
	{
		alert("Please Enter first name");
		document.getElementById('UserFirstName').focus();
		return false;
	}
	if(document.getElementById('UserFirstName').value!='')
	{
		if(!isAlphabet(document.getElementById('UserFirstName').value))
		{
			alert("Please enter valid name ");
			document.getElementById('UserFirstName').focus();
			return false;
		}
	}
	if(document.getElementById('UserLastName').value=='')
	{
		alert("Please enter last name");
		document.getElementById('UserLastName').focus();
		return false;
	}	
	if(document.getElementById('UserLastName').value!='')
	{
		if(!isAlphabet(document.getElementById('UserLastName').value))
		{
			alert("Please enter valid name ");
			document.getElementById('UserLastName').focus();
			return false;
		}
	}
	if(document.getElementById('UserEmailId').value=='')
	{
		alert("Please enter email id");
		document.getElementById('UserEmailId').focus();
		return false;
	}
	if(!checkemail(document.getElementById('UserEmailId').value))
	{
		alert("Please enter a valid email id");
		document.getElementById('UserEmailId').focus();
		return false;
	}
	if(document.getElementById('UserUsername').value=='')
	{
		alert("Please enter username");
		document.getElementById('UserUsername').focus();
		return false;
	}
	
}
</script>

<div>
        <article>
		<header>
                        <h2>
				<?php 
					if (!empty($this->data) && $this->data['User']['id'])
					{
						echo __('update').' '.__('user');
					}
					else
					{
						echo __('add').' '.__('user');
					}
				?>
                        </h2>
                </header>
        </article>
	
	<?php echo $this->element('admin/message');?>
        
	<?php 	if (!empty($this->request->data) && $this->request->data['User']['id']) $act='edit';
		else $act='add';
	?>
	
        <?php echo $this->Form->create('User', array('action'=>$act,'onSubmit'=>"//return validate()"));?>
	<?php echo $this->Form->input('id'); ?>
        <fieldset>
		<dl>
			<dt>
				<label><?php echo __('first') ?> <?php echo __('name') ?> <span style="color:red;">*</span></label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('firstName',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label><?php echo __('last') ?> <?php echo __('name') ?> <span style="color:red;">*</span></label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('lastName',array('class'=> 'small','size'=>'45')); ?>
			</dd>

                    	<dt>
				<label><?php echo __('email') ?> <span style="color:red;">*</span></label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('emailId',array('class'=>'small','size'=>'45'));?>
			</dd>
                        
                        <dt>
				<label><?php echo __('user').''.__('name') ?> <span style="color:red;">*</span></label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('username',array('class'=>'small','size'=>'45'));?>
			</dd>			
                        <dt>
				<label><?php echo __('contact') ?> <?php echo __('number') ?> </label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('phone',array('class'=>'small','size'=>'45'));?>
			</dd>                        
                        <dt>
				<label><?php echo __('street') ?> <?php echo __('address') ?> </label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('address',array('class'=>'small','size'=>'45'));?>
			</dd>                        
                        <dt>
				<label><?php echo __('city') ?> </label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('city',array('class'=>'small','size'=>'45'));?>
			</dd>                        
                        <dt>
				<label><?php echo __('state') ?> </label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('state',array('class'=>'small','size'=>'45'));?>
			</dd>                        
                        <dt>
				<label>Zip </label>
			</dt>
                        <dd>
				<?php echo $this->Form->text('zip',array('class'=>'small','size'=>'45'));?>
			</dd>                        
                        <dt>
				<label><?php echo __('country') ?> </label>
			</dt>
                        <dd>
				<?php echo $this->Form->input('country',array('options'=>Configure::read('COUNTRY'),'class'=>'small','div'=>false, 'legend'=>false, 'label'=>false)); ?>
			</dd>
		</dl>
        </fieldset>
        <button type="submit">
		<?php 
			if (!empty($this->data) && $this->data['User']['id']):
				echo __('update');
			else:
				echo __('add');
			endif;
		?>
	</button> <?php echo __('or') ?> 
	<?php echo $this->Html->link(__('cancel'), array('controller'=>'users', 'action' => 'index'));?>
	
	<?php echo  $this->Form->end();?>
</div>



