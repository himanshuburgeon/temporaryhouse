<script language="javascript">
function validatefields(val)
{
	if(document.getElementById('LanguageName').value==''){
		alert("Please Enter The Title");
		document.getElementById('LanguageName').focus();
		return false;
	}
	if(document.getElementById('LanguageLanguageTitle').value==''){
		alert("Please Enter The Language Title");
		document.getElementById('LanguageLanguageTitle').focus();
		return false;
	}
	
}
function saveform()
{
	document.getElementById('LanguagePublish').value=1;
	document.getElementById('LanguageCms').submit();
}
</script>

<div>
    <article>
        <header>
           <h2>
             <?php if(isset($this->request->data['Language']['id'])):
			echo __('update').''.__('language');
		else:
			echo __('add').' '.__('language');
		endif;
		?>
            </h2>
        </header>
     </article>
		<?php 
            if(!empty($this->request->data) && $this->request->data['Language']['id'])$act='edit';
             else $act='add';
         ?>
		<?=$this->element('admin/message');?>
		<?php echo $this->Form->create('Language',array('name'=>'languages','id'=>'LanguageCms','action'=>$act,'onsubmit'=>'return validatefields();'));?>
		<?php echo $this->Form->input('id');?>
         <!-- Inputs -->
		<!-- Use class .small, .medium or .large for predefined size -->
	<fieldset>
			<dl>
			
			<dt>
				<label><?php echo __('language') ?> <?php echo __('name') ?> <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->text('name',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
				<label><?php echo __('language') ?> <?php echo __('code') ?> <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->text('code',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			</dl>
    </fieldset>
            <?php echo $this->Form->hidden('status',array('value'=>'1')); ?>
			<?php //e($form->hidden('publish',array('value'=>'0')); ?>
			<button type="submit">
            <?php 
				if(isset($this->data['Language']['id'])):
										echo __('update');
									else:
										echo __('add');
									endif;
				?>
                </button> <?php echo __('or') ?> 
                <?php echo $this->Html->link(__('cancel'), array('controller'=>'languages', 'action' => 'index'));?>
                
                <?php echo $this->Form->end();?>
</div>
 
