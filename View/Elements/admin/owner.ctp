<script language="javascript">
/*function validatefields(val)
{
	if(document.getElementById('OwnerName').value==''){
		alert("Please Enter The Title");
		document.getElementById('OwnerName').focus();
		return false;
	}
	if(document.getElementById('OwnerOwnerTitle').value==''){
		alert("Please Enter The Owner Title");
		document.getElementById('OwnerOwnerTitle').focus();
		return false;
	}
	
}*/
function saveform()
{
	document.getElementById('OwnerPublish').value=1;
	document.getElementById('OwnerCms').submit();
}
</script>
<?=$this->element('admin/breadcrumbs');?>
<div>
    <article>
        <header>
           <h2>
             <?php if(isset($this->request->data['Owner']['id'])):
			echo __('update').' '.__('owner');
		else:
			echo __('add').' '.__('owner');
		endif;
		?>
            </h2>
        </header>
     </article>
		<?php 
            if(!empty($this->request->data) && $this->request->data['Owner']['id'])$act='edit';
             else $act='add';
         ?>
		<?=$this->element('admin/message');?>
		<?php echo $this->Form->create('Owner',array('name'=>'owners','id'=>'OwnerCms','action'=>$act,'onsubmit'=>'return validatefields();'));?>
		<?php echo $this->Form->input('id');?>
         <!-- Inputs -->
		<!-- Use class .small, .medium or .large for predefined size -->
	<fieldset>
			<dl>
			
			<dt>
				<label><?php echo __('name') ?> <span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('name'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('name',array('class'=> 'small  '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('name')): ?>
					<span class="error-message"><?php echo __($this->Form->error('name',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
				
			</dd>
			<dt>
				<label><?php echo __('surname') ?><span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('surname'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('surname',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('surname')): ?>
					<span class="error-message"><?php echo __($this->Form->error('surname',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('mobile').' '.__('number') ?>&nbsp; (xxx-xxx-xxxx) <span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('mobile'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('mobile',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('mobile')): ?>
					<span class="error-message"><?php echo __($this->Form->error('mobile',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('email') ?> <span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('email'))?'invalid':''; ?>
			<dd>				
				<?php echo $this->Form->text('email',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('email')): ?>
					<span class="error-message"><?php echo __($this->Form->error('email',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
				
			</dd>
			<dt>
				<label><?php echo __('address') ?><span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('address'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('address',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('address')): ?>
					<span class="error-message"><?php echo __($this->Form->error('address',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('city') ?><span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('city'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('city',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('city')): ?>
					<span class="error-message"><?php echo __($this->Form->error('city',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('Cap') ?><span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('cap'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('cap',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('cap')): ?>
					<span class="error-message"><?php echo __($this->Form->error('cap',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('VAT') ?><span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('vat'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('vat',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('vat')): ?>
					<span class="error-message"><?php echo __($this->Form->error('vat',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('tax').' '.__('code') ?> <span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('tax_code'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('tax_code',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('tax_code')): ?>
					<span class="error-message"><?php echo __($this->Form->error('tax_code',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('iban') ?><span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('iban'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('iban',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('iban')): ?>
					<span class="error-message"><?php echo __($this->Form->error('iban',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('bic / swift') ?><span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('bic_swift'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('bic_swift',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('bic_swift')): ?>
					<span class="error-message"><?php echo __($this->Form->error('bic_swift',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('holder_c/c') ?> <span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('holders_cc'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('holders_cc',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('holders_cc')): ?>
					<span class="error-message"><?php echo __($this->Form->error('holders_cc',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			<dt>
				<label><?php echo __('Notes') ?>  <span style="color:red;">*</span></label>
			</dt>
			<?php $error_class= ($this->Form->isFieldError('notes'))?'invalid':''; ?>
			<dd>
				<?php echo $this->Form->text('notes',array('class'=> 'small '.$error_class,'size'=>'45')); ?>
				<?php if($this->Form->isFieldError('notes')): ?>
					<span class="error-message"><?php echo __($this->Form->error('notes',null,array('wrap'=>false))); ?></span>
				<?php endif; ?>
			</dd>
			
			
			
			</dl>
    </fieldset>
            <?php echo $this->Form->hidden('status',array('value'=>'1')); ?>
			<?php //e($form->hidden('publish',array('value'=>'0')); ?>
			<button type="submit">
            <?php 
				if(isset($this->data['Owner']['id'])):
										echo __('update');
									else:
										echo __('add');
									endif;
				?>
                </button> <?php echo __('or') ?>
                <?php echo $this->Html->link(__('cancel'), array('controller'=>'owners', 'action' => 'index'));?>
                
                <?php echo $this->Form->end();?>
</div>
 
