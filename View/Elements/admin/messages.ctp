<script language="javascript">
function validatefields(val)
{
	if(document.getElementById('MessageName').value==''){
		alert("Please enter the message title");
		document.getElementById('MessageName').focus();
		return false;
	}
	/*if(document.getElementById('MessageMsg').value==''){
		alert("Please enter the message text");
		document.getElementById('MessageMsg').focus();
		return false;
	}*/
	
}
function saveform()
{
	document.getElementById('NewsPublish').value=1;
	document.getElementById('NewsCms').submit();
}
</script> 
<?=$this->element('admin/breadcrumbs');?>
<div>
	<article>
		<header>
			<h2>
				<?php 
					if (isset($this->request->data['Message']['id'])):
						echo __('update').' '.__('message');
					else:
						echo __('add').' '.__('message');
					endif;
				?>
			</h2>
		</header>
	</article>
	<?php echo $this->element('admin/message');?>
	<?php
		if(!empty($this->data) && $this->data['Message']['id']  )$act='edit';
		else $act='add';
	?>
	<?php echo $this->Form->create('Message',array('name'=>'mesaage','id'=>'MessageCms','action'=>$act,'onsubmit'=>'return validatefields();'))?>
	<?php echo $this->Form->hidden('id');?>
	<?php print_r($LANGUAGES); ?>
	<fieldset>
		<dl>
			<dt>
				<label><?php echo __('message').' '.__('title') ?><span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->text('name',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			
			<dt>
				<label><?php echo __('message') ?>&nbsp eng.<span style="color:red;">*</span></label>
			</dt>
			
			<dd>
				<?php echo $this->Form->textarea('Message.msg.eng',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
				<label><?php echo __('message') ?>&nbsp rus.<span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->textarea('Message.msg.rus',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
				<label><?php echo __('message') ?>&nbsp ita.<span style="color:red;">*</span></label>
			</dt>
			
			<dd>
				<?php echo $this->Form->textarea('Message.msg.ita',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
		</dl>
	</fieldset>
	
	<button type="submit">
		<?php
			if (isset($this->request->data['Message']['id'])):
				echo __('update');
			else:
				echo __('add');
			endif;
		?>
	</button> <?php echo __('or') ?>
	<?php echo $this->Html->link(__('cancel'), array('controller'=>'messages', 'action' => 'index'));?>
	<?php echo $this->Form->end();?>
</div>
