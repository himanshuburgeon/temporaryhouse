<script type="text/javascript">	

function formsubmit(action)
{
	//alert(action);
	var flag=true;
//	if(action=='Delete')
		//flag=confirm('Are You Sure, You want to Delete this User(s)!');
	if(flag)
	{
		document.getElementById('action').value=action;
		if(validate())
			document.getElementById('UserDeleteForm').submit();
	}
}

function validate()
{
	var ans="0";
	for(i=0; i<document.user.elements.length; i++)
	{
		if(document.user.elements[i].type=="checkbox"){
			if(document.user.elements[i].checked){
				ans="1";
				break;
			}
		}
	}
	if(ans=="0"){
		alert("Please select user to "+document.getElementById('action').value);
		return false;
	}else{
		var answer = confirm('Are you sure you want to '+document.getElementById('action').value+' User(s)');
		if(!answer)
			return false;
	}
	return true;
}	


function CheckAll(chk)
{
//alert(document.getElementById('UserCheck').checked);
//alert(document.getElementsByTagName('checkbox').length);
	var fmobj=document.getElementById('UserDeleteForm');
	for (var i=0;i<fmobj.elements.length;i++) 
	{
		var e = fmobj.elements[i];
		if(e.type=='checkbox')
			fmobj.elements[i].checked=document.getElementById('UserCheck').checked;
	}
	
}

</script>

<style type="text/css">
ul.Main {
  list-style-type: none;
  margin-left:0px;
  margin-top:-1px;
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
<!-- END BROWSERIE -->
<!-- BEGIN BROWSERMOZ -->
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

<div>
        <article>
		<header>
			<h2><?php echo __('user_manager') ?></h2>
					
			<div style="float:right;">	
				<a href="javascript:" onClick="return formsubmit('Publish');" class="button"><?php echo __('publish') ?></a>
				<a href="javascript:" onClick="return formsubmit('Unpublish');" class="button"><?php echo __('unpublish') ?></a>
				<a href="javascript:" onClick="return formsubmit('Delete');" class="button"><?php echo __('delete') ?></a>
				<?php echo  $this->Html->link(__('new'), array('controller'=>'users', 'action' => 'add'), array('escape' => false,'class'=>'button'));?>
			</div>
				
                </header>
        </article>
                <?php echo $this->element('admin/message');?>
                
		<?php echo $this->Form->create('User', array('name'=>'user','action' => 'delete','id'=>'UserDeleteForm','onSubmit'=>'return validate(this)','class'=>'table-form'));?>
		<?php echo $this->Form->hidden('action',array('id'=>'action','value'=>'')); ?>
								
<table width="100%">
	<tr>
		<th width="5%"><?php echo $this->Form->checkbox('check',array('value'=>1,'onchange'=>"CheckAll(this.value)",'class'=>'check-all')); ?></th>
		<th width="1%">&nbsp;</th>
		<th width="5%">SNo.</th>
		<th width="27%"><?php echo __('name') ?></th>	
		<th width="27%"><?php echo __('email') ?></th>
		<th width="5%"><?php echo __('publish') ?></th>
		<th width="15%"><?php echo __('action') ?></th>
		<th width="15%"><?php echo __('permission') ?></th>
	</tr>
	
	<tr>
		<td colspan="8">
		<?php //echo $javascript->link('prototype.js'); ?>
		<?php //echo $javascript->link('scriptaculous.js'); ?>	
		<ul id="mylist" class="Main" style="margin-left: 0;">	
		<?php $i = $this->Paginator->counter('{:start}'); ?>
		<?php 
		//$i = $paginator->counter(array('format' => __('%start%', true)));
		foreach ($users as $user){ ?>	
		<!--<li id="item_<?=$user['User']['id']?>"  style="cursor:move" >-->	
	
<table width="100%">
<tr>
	<td width="5%"><?php echo $this->Form->checkbox($user['User']['id'],array('value'=>$user['User']['id'])); ?></td>
	<td width="1%">
        <script type="text/javascript">
	$(document).ready(function() {
		$("#various<?php echo $user['User']['id'];?>").fancybox({
		});
	});
	</script>
	</td>
	<td width="5%"><?php echo $i++; ?></td>
	<td width="27%"><?php echo $user['User']['firstName'].' '.$user['User']['lastName']; ?></td>
	<td width="27%"><?php echo $user['User']['emailId']; ?></td>
	<td width="5%">
	      <?php if($user['User']['status']=='1')
			  echo  $this->Html->image('admin/icons/icon_success.png',array());  
		    else
			  echo  $this->Html->image('admin/icons/icon_error.png',array()); ?>
	</td>
	<td width="15%">
	<ul class="actions">
	<li><?php echo  $this->Html->link('edit', array('controller'=>'users', 'action' => 'edit',$user['User']['id']), array('escape' => false,'class'=>'edit','title'=>'Edit User','rel'=>'tooltip'));?></li>
	<li><a href="#view<?php echo $user['User']['id'];?>" id="various<?php echo $user['User']['id'];?>"  class="view" title="View User" rel="tooltip">view</a></li>
	</ul >
                                             
                <div style="display: none;">
		<div id='view<?php echo $user['User']['id'];?>' style="background:#f6f6f6; padding:8PX; max-height:550px; overflow-y:auto;">
                                            	<div style="padding:10px 0;">
							<div style="float:left; width:110px;"><b>First Name</b></div>
							<div align="justify;" style="float:left; width:400px;"><?php echo $user['User']['firstName'];?></div>
							<div style="clear:both;"></div>
                                                </div>
						
						<div style="padding:10px 0;">
							<div style="float:left; width:110px;"><b>Last Name</b></div>
							<div align="justify;" style="float:left; width:400px;"><?php echo $user['User']['lastName'];?></div>
							<div style="clear:both;"></div>
                                                </div>
						
                                                <div style="padding:10px 0;">
							<div style="float:left; width:110px;"><b>Email</b></div>
							<div align="justify" style="float:left; width:400px;"><?php echo $user['User']['emailId'];?></div>
							<div style="clear:both;"></div>
                                                </div>
						
                                                <div style="padding:10px 0;">     
                                                      <div style="float:left; width:110px;"><b>Username</b></div>
                                                      <div align="justify" style="float:left; width:400px;"><?php echo $user['User']['username'];?></div>
                                                      <div style="clear:both;"></div>
                                                </div>
						
						<div style="padding:10px 0;">     
                                                      <div style="float:left; width:110px;"><b>Contact Number</b></div>
                                                      <div align="justify" style="float:left; width:400px;"><?php echo $user['User']['phone'];?></div>
                                                      <div style="clear:both;"></div>
                                                </div>
                                                      
                                                <div style="padding:10px 0;">
                                                      <div style="float:left; width:110px;"><b>Address</b></div>
                                                      <div align="justify" style="float:left; width:400px;"><?php echo $user['User']['address'];?></div>
                                                      <div style="clear:both;"></div>
                                                </div>
						
						<div style="padding:10px 0;">
                                                      <div style="float:left; width:110px;"><b>City</b></div>
                                                      <div align="justify" style="float:left; width:400px;"><?php echo $user['User']['city'];?></div>
                                                      <div style="clear:both;"></div>
                                                </div>
						
						<div style="padding:10px 0;">
                                                      <div style="float:left; width:110px;"><b>State</b></div>
                                                      <div align="justify" style="float:left; width:400px;"><?php echo $user['User']['state'];?></div>
                                                      <div style="clear:both;"></div>
                                                </div>
						<div style="padding:10px 0;">
                                                      <div style="float:left; width:110px;"><b>Zip</b></div>
                                                      <div align="justify" style="float:left; width:400px;"><?php echo $user['User']['zip'];?></div>
                                                      <div style="clear:both;"></div>
                                                </div>
						<div style="padding:10px 0;">
                                                      <div style="float:left; width:110px;"><b>Country</b></div>
                                                      <div align="justify" style="float:left; width:400px;"><?php echo $user['User']['country'];?></div>
                                                      <div style="clear:both;"></div>
                                                </div>
						
                </div>
                </div>
		</td>
	<td width="15%"><?php echo  $this->Html->link('Permission', array('controller'=>'users', 'action' => 'permission',$user['User']['id']), array('escape' => false,'class'=>'permission','title'=>'User Permission','rel'=>'tooltip'));?>
	</td>
	</tr>
</table>
               
	<!--</li>-->		
	<?php } ?>
	</ul>
	
	<script language="javascript">
			/*Sortable.create('mylist', {constraint:'vertical', onUpdate : updateRows});
			function updateRows(){
			  var options = {
			  method : 'post',
			  parameters : Sortable.serialize('mylist')
							};
							
			  new Ajax.Request("<?=Configure::read('HTTP_PATH');?>/admin/user/change_order", options);

			}*/
	</script>
		</td>
	</tr>
									
             
    									
			</table>
		</form>
							
	</div>
