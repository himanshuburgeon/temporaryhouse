<?=$this->element('admin/breadcrumbs');?>
<div>
	<article>
		<header>
			<h2><?php echo __('mail_format_manager') ?></h2>
			<div style="float:right;">
				<!--
				<a href="javascript:" onClick="return formsubmit('Publish');" class="button"><?php echo __('publish') ?></a>
				<a href="javascript:" onClick="return formsubmit('Unpublish');" class="button"><?php echo __('unpublish') ?></a>
				<a href="javascript:" onClick="return formsubmit('Delete');" class="button"><?php echo __('delete') ?></a>
				-->
				<?php //echo $this->Html->link(__('new'), array('controller'=>'mails', 'action' => 'add'), array('escape' => false,'class'=>'button'));?>
			</div>
		</header>
	</article>
	<div class="input text" style="overflow:hidden;">
		<?php echo __('search') ?>: <?php echo $this->Form->input('search',array('label'=>false,'id'=>'search','div'=>false,'value'=>$search,'style'=>'margin-left:10px; margin-right:10px;')); ?>
		<?php echo __('view') ?>:
		<?php echo $this->Form->input('view',array('options'=>array('20'=>'20','50'=>'50','100'=>'100','ALL'=>'All'),'id'=>'view','div'=>false, 'legend'=>false, 'label'=>false,'value'=>$limit,'style'=>'margin-left:10px;')); ?>
		<button type="button" style="margin-top:10px; margin-left:10px" onclick="change_url();"><?php echo __('search') ?></button>
	</div>
	<br clear = "all" />
	<?php echo $this->element('admin/message');?>
	<?php echo $this->Form->create('Mail', array('name'=>'mail','action' => 'delete','id'=>'MailDeleteForm','onSubmit'=>'return validate(this,\'MailDeleteForm\')'));?>
	<?php echo $this->Form->hidden('action',array('id'=>'action','value'=>'')); ?>
	<table width="248" >
		<tr>
			<!--<th width="5%"><?php echo $this->Form->checkbox('check',array('value'=>1,'onchange'=>"CheckAll(this,'checkallcol')",'class'=>'check-all')); ?></th>-->
			<th width="38">SNo.</th>
			<th width="104">Mail Title</th>
			<th width="90" ><?php echo __('action') ?></th>
		</tr>
		<?php  $i = $this->Paginator->counter('{:start}'); ?>
		<?php foreach ($mails as $mail){?>
		<tr>
			<!--<td width="5%"><?php echo $this->Form->checkbox($mail['Mail']['id'],array('value'=>$mail['Mail']['id'],'class'=>'checkallcol')); ?></td>-->
			<td ><?php echo $i++; ?></td>
			<td><?php echo $mail['Mail']['title']; ?></td>
		    <td>
				<ul class="actions">
					<li><?php echo $this->Html->link('edit', array('controller'=>'mails', 'action' => 'edit',$mail['Mail']['id']), array( 'class'=>'edit','title'=>'Edit Item','rel'=>'tooltip'));?></li>
					<li><?=$this->Html->link('view', array('controller'=>'mails', 'action' => 'view', $mail['Mail']['id']), array('escape' => false,'class'=>'view fancybox','title'=>'View mail format','rel'=>'tooltip'))?></li>
					
				</ul>
			</td>
		</tr>
		<? }?>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php if(!$mails){?>
						<div style='color:#FF0000'><?php echo __('no_record_found') ?></div>
					<?php } else{ ?>
						<ul class="pagination">
							<?php if($this->Paginator->first()){?>
							
							<li><?php echo $this->Paginator->first('« First',array('class'=>'button gray')); ?></li>
							
							<?php } ?>
							
							<?php if($this->Paginator->hasPrev()){?>
							
							<li><?php echo $this->Paginator->prev('< Previous',array('class'=>'button gray'), null, array('class'=>'disabled'));?>&nbsp;... &nbsp;</li>
							
							<?php } ?>
							
							<?=$this->Paginator->numbers(array('modulus'=>6,'tag'=>'li','class'=>'','separator'=>'')); ?>
							
							<?php if($this->Paginator->hasNext()){?>
							
							<li>&nbsp;... &nbsp;<?php echo $this->Paginator->next('Next >',array('class'=>'button gray'));?></li>
							
							<?php } ?>
							
							<?php if($this->Paginator->last()){?>
							
							<li><?php echo $this->Paginator->last('Last »',array('class'=>'button gray')); ?></li>
							
							<?php } ?>
						</ul>
					<?php } ?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<script type="text/javascript">
function formsubmit(action)
{
	//alert(action);
	var flag=true;
//	if(action=='Delete')
		//flag=confirm('Are You Sure, You want to Delete this Page(s)!');
	if(flag)
	{
		document.getElementById('action').value=action;
		if(validate())
			document.getElementById('MailDeleteForm').submit();
	}
}

function validate(){
		var ans="0";
		for(i=0; i<document.mail.elements.length; i++){
			if(document.mail.elements[i].type=="checkbox"){
				if(document.mail.elements[i].checked){
					ans="1";
					break;
				}
			}
		}
		if(ans=="0"){
			alert("Please select mails format to "+document.getElementById('action').value);
			return false;
		}else{
			var answer = confirm('Are you sure you want to '+document.getElementById('action').value+' Mail(s)');
			if(!answer)
				return false;
		}
		return true;
	}	

function CheckAll(chk)
{
//alert(document.getElementById('PageCheck').checked);
//alert(document.getElementsByTagName('checkbox').length);
	var fmobj=document.getElementById('MailDeleteForm');
	for (var i=0;i<fmobj.elements.length;i++) 
	{
		var e = fmobj.elements[i];
		if(e.type=='checkbox')
			fmobj.elements[i].checked=document.getElementById('MailCheck').checked;
	}
	
}

function change_url(){
	var search = '';
	var limit = document.getElementById('view').value;
	
	if(document.getElementById('search').value==''){
		search = '_blank';
	}else{
		search = document.getElementById('search').value;
	}
	
	document.location.href = '<?=Configure::read('HTTP_PATH');?>/admin/mails/index/'+search+'/'+limit;
}

</script>
