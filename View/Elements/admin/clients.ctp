<script language="javascript">
function validatefields(val)
{
	if(document.getElementById('NewsName').value==''){
		alert("Please Enter The Title");
		document.getElementById('NewsName').focus();
		return false;
	}
	if(document.getElementById('NewsNewsTitle').value==''){
		alert("Please Enter The News Title");
		document.getElementById('NewsNewsTitle').focus();
		return false;
	}
	
}
function saveform()
{
	document.getElementById('NewsPublish').value=1;
	document.getElementById('NewsCms').submit();
}
</script>

<div>
        		<article>
                    <header>
                        <h2>
                        <?php if (isset($this->request->data['News']['id'])):
							echo ('Update News');
							else:
							echo ('Add News');
							endif;
						?>
                        </h2>
                    </header>
                </article>
								<?php 
                                    if(!empty($this->data) && $this->data['News']['id'])$act='edit';
                                    else $act='add';
                                    
								?>
								<?php echo $this->Form->create('News',array('name'=>'news','id'=>'NewsCms','action'=>$act,'onsubmit'=>'return validatefields();'))?>
								<?php echo $this->Form->hidden('id');?>
								<?php //e($form->hidden('parentId', array('value'=>$parentId))); ?>
								<!-- Inputs -->
								<!-- Use class .small, .medium or .large for predefined size -->
								<fieldset>
								
											
									<dl>
										<dt>
											<label>News Title <span style="color:red;">*</span></label></dt>
										<dd>
                                        	<?php echo $this->Form->text('name',array('class'=> 'small','size'=>'45')); ?>
										</dd>
										<dt>
											<label>Short Description<span style="color:red;">*</span></label>
										</dt>
										<dd>
											<?php echo $this->Form->textarea('short_description',array('class'=> 'small','size'=>'45')); ?>
											
										</dd>
																				<dt>
											<label>	Description </label>
										</dt>
										<dd>
											 <?php echo $this->Form->textarea('description',array('class'=> 'small','size'=>'45')); ?>
										</dd>
										
										
                                        
                                        
                                        
                                        <dt>
											<label>Date <span style="color:red;">*</span></label></dt>
										<dd>
                                      
                                        <?php echo $this->Form->text('date',array('class'=> 'datepicker small','label'=>'','size'=>'45')); ?>
                                        	<?php //echo $datePicker->picker('date',array('label'=>'','class'=> 'datepicker small hasDatepick')); ?>
			                                    <?php echo $this->Html->image("admin/mandetory.png",array('width'=>'12','height'=>'14','border'=>'0'));?>
										</dd>
                                        
                                           <dt>
											<label>Show on Home Page <span style="color:red;">*</span></label></dt>
										<dd>
                                        	<?php echo $this->Form->checkbox('home',array('value'=>'1')); ?>
										</dd>
                                        
										
									</dl>
                                   
								</fieldset>
                                
								
                                <?php echo $this->Form->hidden('status',array('value'=>'1')); ?>
								<?php //echo $this->Form->hidden('publish',array('value'=>'0')); ?>
										
                                
								<button type="submit">
                                <?php 
								
									if (isset($this->request->data['News']['id'])):
										echo ('Update');
										else:
										echo ('Add');
									endif;
								
								?>
                                </button> or 
                                <?php echo $this->Html->link('Cancel', array('controller'=>'news', 'action' => 'index'));?>
                                
							<?php $this->Form->end();?>
						</div>
 
