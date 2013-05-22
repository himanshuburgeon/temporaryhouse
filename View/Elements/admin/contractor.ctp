<?=$this->element('admin/breadcrumbs');?>
<div>
	<article>
		<header>
			<h2>
				<?php 
					if (!empty($this->request->data) && $this->request->data['Contractor']['id']){
						echo ('Update Contractor');
					}
					else{
						echo ('Add Contractor');
					}
				?>
			</h2>
		</header>
	</article>
	
	<?php echo $this->element('admin/message');?>
	<?php echo $this->Form->create('Contractor', array('type' => 'file','onSubmit'=>"return validate()"));?>
	<?php echo $this->Form->input('id'); ?>
	
	<fieldset>
		<legend>Personal Detail</legend>
		<dl>
			<dt>
				<label>Name</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('name',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>Email <span style="color:red;">*</span></label>
		
			</dt>
			<dd>
				<?php echo $this->Form->text('email',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>Phone no.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('home_phone_no',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<!--<dt>
				<label>Date of Birth.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php// echo $this->Form->text('dob',array('class'=> 'small datepicker','size'=>'45')); ?>
			</dd>-->
			<dt>
				<label>Address.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('home_address',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>City.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('home_city',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>State.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('home_state',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>Zip Code.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('home_zip',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<!--<dt>
				<label>Photo.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php// echo $this->Form->file('imageupload', array('class'=> 'fileupload customfile-input')); ?>
				<p style="padding-bottom:15px;">(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
				<?php// if(isset($this->request->data) && $this->request->data['Contractor']['photo']): ?>&nbsp;&nbsp;
				<?php// echo $this->Html->image("contractors/".$this->data['Contractor']['photo'],array('border'=>'0'));?>
				<?php// endif ?>
			</dd>
			-->
			
		</dl>
		
		
	</fieldset>
	
	
	<fieldset>
		<legend>Fees Detail</legend>
		<dl>
			<dt>
				<label>Sign Up Fees</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('sign_up_fee',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>Quarterly Fees</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('quarterly_fee',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
				<label>Send Mail</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->checkbox('send_mail',array('class'=> '','size'=>'45')); ?>
			</dd>
			<dt>
				<label>Status</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->input('status',array('options'=>array('0'=>'Not Approved','1'=>'Approved','2'=>'Deactive'),'class'=>'small','div'=>false, 'legend'=>false, 'label'=>false)); ?>
				
		</dl>
	</fieldset>
	
	<button type="submit">
		<?php
			if (!empty($this->request->data) && $this->request->data['Contractor']['id']):
				echo ('Update');
				else:
				echo ('Add');
			endif;
		?>
	</button>
<?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
 $(function() {
	$( ".datepicker" ).datepicker({ altFormat: "yy-mm-dd",dateFormat: "yy-mm-dd", maxDate: "-10Y" });
});
</script>


