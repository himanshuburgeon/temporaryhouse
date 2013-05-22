<?=$this->element('admin/breadcrumbs');?>
<div>
    <article>
        <header>
            <h2><?php echo __('property_manager') ?></h2>
            <div style="float:right;">
                    <a href="javascript:" onClick="return formsubmit('<?= __('publish'); ?>');" class="button"><?php echo __('publish') ?></a>
                    <a href="javascript:" onClick="return formsubmit('<?= __('unpublish'); ?>');" class="button"><?php echo __('unpublish') ?></a>
                    <a href="javascript:" onClick="return formsubmit('<?= __('delete'); ?>');" class="button"><?php echo __('delete') ?></a>
                    <?php echo $this->Html->link(__('new'), array('controller'=>'properties', 'action' => 'admin_add'), array('escape' => false,'class'=>'button'));?>
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
	<?php echo $this->Form->create('Property', array('name'=>'Property','action' => 'delete/','id'=>'PropertyDeleteForm','onSubmit'=>'return validate(this)','class'=>'table-form'));?>
	<?php echo $this->Form->hidden('action',array('id'=>'action','value'=>'')); ?>
	
	<table >
		<tr>
			<th width="5%"><?php echo $this->Form->checkbox('check',array('value'=>1,'onchange'=>"CheckAll(this.value)",'class'=>'check-all')); ?></th>
			<th width="5%">SNo.</th>
			<th width="25%"><?php echo __('title') ?></th>
			<th width="25%"><?php echo __('owner') ?></th>
			<th width="20%"><?php echo __('photo') ?></th>
			<th width="10%"><?php echo __('publish') ?>/<?php echo __('unpublish') ?></th>
			<th width="10%"><?php echo __('action') ?></th>
		</tr>
		
		<tr>
			<td colspan="8">
				<ul id="mylist"  class="Main" >
		
		
		 <?php $i = $this->Paginator->counter('{:start}'); ?>
		<?php foreach ($Property as $Property){?>
		<li id="listItem_<?=$Property['Property']['id']?>" class="handle">
		<table width="100%">
		<tr>
			<td width="5%"><?php echo $this->Form->checkbox($Property['Property']['id'],array('value'=>$Property['Property']['id'])); ?></td>
			<td width="5%" ><?php echo $i++; ?></td>
			<td width="25%"><?php echo $Property['Property']['title']; ?></td>
			<td width="20%"><?php echo $Property['Owner']['name'].' '.$Property['Owner']['surname']; ?></td>
			<td width="20%"><?=$this->Html->image($Property['Property']['image']);?></td>
			<td width="10%" >
				<?php $image = ($Property['Property']['status']==1)?'admin/icon_success.png':'admin/icon_notification_error.png';?>
				<?=$this->Html->image($image);?>
			</td >
			<td width="10%">
				<ul class="actions">
					<li><?php echo $this->Html->link('edit', array('controller'=>'properties', 'action' => 'edit',$Property['Property']['id']), array('escape' => false,'class'=>'edit','title'=>'Edit Item','rel'=>'tooltip'));?></li>
					<li>
						<?=$this->Html->link('view', array('controller'=>'properties', 'action' => 'view', $Property['Property']['id']), array('escape' => false,'class'=>'view fancybox','title'=>'View Item','rel'=>'tooltip'))?>
					</li>
					<?php //if($parent_id==0){ ?>
					<li>
						<?//=$this->Html->link('Manage Sub Content', array('controller'=>'languages', 'action' => 'index', $language['Language']['id']), array('escape' => false,'class'=>'subcontent','title'=>'Manage Sub Content','rel'=>'tooltip'))?>
					</li>
					<?php //} ?>
				</ul >
			</td>
		</tr>
		</table>
		</li>
		<?php }?>
				</ul>
			</td>
		</tr>
		 <tfoot>
			 <tr>
				 <td colspan="5">
					 <?php $search_keyword = '' ?>
					
					 <?php if(!$Property){?>
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
	</form>
</div>
<script type="text/javascript">

  // When the document is ready set up our sortable with it's inherant function(s)

  $(document).ready(function() {
	 
	  
    $("#mylist").sortable({
		update : function () {
			 var order = $('#mylist').sortable('serialize');
				
				$.get('<?=Configure::read('HTTP_PATH');?>/admin/languages/change_order/?'+order, function(data) {
				  //alert(data);
				 
				});
			  
			  }
		});
  
});

</script>
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
			document.getElementById('LanguageDeleteForm').submit();
	}
}

function validate(){
		var ans="0";
		for(i=0; i<document.Property.elements.length; i++){
			if(document.Property.elements[i].type=="checkbox"){
				if(document.Property.elements[i].checked){
					ans="1";
					break;
				}
			}
		}
		if(ans=="0"){
			alert(" <?php echo __('Please').' '.__('select') .' '.__('property').' '.__('to') ?>  "+document.getElementById('action').value);
			return false;
		}else{
			var answer = confirm('<?php echo __('are').' '.__('you') .' '.__('sure').' '.__('you').' '.__('want').' '.__('to')?> '+document.getElementById('action').value+' <?php echo __('property') ?>');
			if(!answer)
				return false;
		}
		return true;
	}	


function CheckAll(chk)
{
//alert(document.getElementById('PageCheck').checked);
//alert(document.getElementsByTagName('checkbox').length);
	var fmobj=document.getElementById('PropertyDeleteForm');
	for (var i=0;i<fmobj.elements.length;i++) 
	{
		var e = fmobj.elements[i];
		if(e.type=='checkbox')
			fmobj.elements[i].checked=document.getElementById('PageCheck').checked;
	}
	
}

function change_url(){
	var search = '';
	var limit = document.getElementById('view').value;
	
	
	if(document.getElementById('search').value==''){
		search = '_blank';
	}else{
		search = document.getElementById('search').value.replace(/(^[\s]+|[\s]+$)/g, '');
	}
	
	document.location.href = '<?=Configure::read('HTTP_PATH');?>/admin/properties/index/'+search+'/'+limit;
	
}

</script>
<style type="text/css">

ul.Main {
  list-style-type: none;
  margin-left:-40px;
  margin-top:-1px;
}
ul li.Main2 {
	color:#000000;
    border: 1px solid #cccccc;
    cursor: move;
    margin-bottom: 0px;
    background:  #FFFFFF;
    border: 1px solid #efefef;
    width: 763px;
    text-align: left;
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;
}	
ul li.Main3 {
	color:#000000;
    border: 1px solid  #FFE8E8;
    cursor: move;
    margin-bottom: 0px;
    background: #FFE8E8;
    border: 1px solid #efefef;
    width: 763px;
    text-align: left;
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;
	
}
 

</style>
<style type="text/css">

ul.Main {
  list-style-type: none;
  margin-left:0px;
  margin-top:-1px;
  cursor: move;
}
ul li.Main2 {
	color:#000000;
    border: 1px solid #cccccc;
    cursor: move;
    margin-bottom: -3px;
    background:  #FFFFFF;
    border: 1px solid #efefef;
    width: 763px;
    text-align: left;
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;
}	
ul li.Main3 {
	color:#000000;
    border: 1px solid  #FFE8E8;
    cursor: move;
    margin-bottom: -3px;
    background: #FFE8E8;
    border: 1px solid #efefef;
    width: 763px;
    text-align: left;
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;
	
}

</style>

