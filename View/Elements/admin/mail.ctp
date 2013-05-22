<?php echo $this->Html->script('admin/managecms.js');?>
<?php echo $this->Html->script('admin/fckeditor.js');?>
<script type="text/javascript">
function validate()
{//alert('ff');
	if(document.getElementById('MailTitle').value=='')
	{
		alert("Sorry! we cannot complete your request, please enter Mail Title");
		document.getElementById('MailTitle').focus();
		return false;
	}
	if(document.getElementById('MailFrom').value=='')
	{
		alert("Sorry! we cannot complete your request, please fill the Mail From field");
		document.getElementById('MailFrom').focus();
		return false;
	}
	if(document.getElementById('MailSubject').value=='')
	{
		alert("Sorry! we cannot complete your request, please enter Mail Subject");
		document.getElementById('MailSubject').focus();
		return false;
	}
}
</script>
<?=$this->element('admin/breadcrumbs');?>
<div>
      <article>
         <header>
           <h2>
            <?php if (!empty($this->request->data) && $this->request->data['Mail']['id']){
		echo __('update').' '.__('mail_format');
		}
		else{
		echo __('add').' '.__('mail_format');
		}
		?>
            </h2>
         </header>
       </article>
                
           <?php echo $this->element('admin/message');?>
           <?php 
		echo $this->Form->create('Mail', array('type' => 'file','onSubmit'=>"return validate()"));?>
		<?php echo $this->Form->input('id'); ?>
       <fieldset>
	    <dl>
		<dt><label><?php echo __('mail').' '.__('title') ?></label><span style="color:red;">*</span></dt>
		<dd><?php echo $this->Form->text('title',array('class'=> 'small','size'=>'45')); ?></dd>
		<dt>
		<label><?php echo __('mail').' '.__('from') ?><span style="color:red;">*</span></label>
		</dt>
                <dd><?php echo $this->Form->text('from',array('class'=> 'small','size'=>'45')); ?>
                </dd>
                 <dt>
		<label>Meta &nbsp<?php echo __('subject') ?><span style="color:red;">*</span></label>
		</dt>
                <dd> <?php echo $this->Form->text('subject',array('class'=> 'small','size'=>'45')); ?>
                 </dd>
                <dt>
		<label>Meta &nbsp<?php echo __('body') ?></label>
		</dt>
		<dd><?php					
					echo $this->Form->textarea('body', array('cols'=>'60','rows'=>'3'));
					echo $this->Fck->load('Mail.body');
				?>
		</dd>
                
                </dl>
              	</fieldset>
                <button type="submit">
                <?php 
			if (!empty($this->request->data) && $this->request->data['Mail']['id']):
				echo __('update');
				else:
				echo __('add');
			endif;
		?>
                </button>
<?php $this->Form->end();?>                
                
                
                
</div>


