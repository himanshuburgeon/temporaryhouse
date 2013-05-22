<script language="javascript">
function validatefields(val)
{
	if(document.getElementById('SlideName').value==''){
		alert("Please Enter The Title");
		document.getElementById('SlideName').focus();
		return false;
	}
	if(document.getElementById('SlideSlideTitle').value==''){
		alert("Please Enter The Slide Title");
		document.getElementById('SlideSlideTitle').focus();
		return false;
	}
	
}
function saveform()
{
	document.getElementById('SlidePublish').value=1;
	document.getElementById('SlideCms').submit();
}
</script>

<div>
     <article>
        <header>
          <h2>
            <?php if (isset($this->data['Slide']['id'])):
			echo ('Update Slide');
		else:
			echo ('Add Slide');	    
		endif;
	     ?>
           </h2>
         </header>
      </article>
	    <?php //echo $this->data['Slide']['id'];
              //if($this->data['Slide']['id'])$act='edit';
              //else $act='add';
              //$act=$act.'/'.$parentId;
	     ?>
	    <?php echo $this->Form->create('Slide',array('name'=>'slides','type'=>'file','id'=>'SlideCms','action'=>'$act','onsubmit'=>'return validatefields();'))?>
	    <?php //echo $this->Form->input('id');?>
	    
		<!-- Inputs -->
		<!-- Use class .small, .medium or .large for predefined size -->
	<fieldset>
		<dl>
			<dt>
				<label>Title<span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->text('name',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
				<label>Image File<span style="color:red;">*</span></label>
			</dt>
			<dd>
			<?php echo $this->Form->file('image_file',array('class'=> 'fileupload customfile-input')); ?>
			<br><label>(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB )( 824 X 284 px)</label>
			<?php if(isset($this->request->data['Slide']['image'])){
			echo $this->Html->image("slide/".$this->request->data['Slide']['image'],array('width'=>'80','height'=>'40','border'=>'0'));}?>
			</dd>
			<dt>
				<label>Link</label>
			</dt>			
			<dd>
				<?php echo $this->Form->text('link',array('class'=> 'small','size'=>'45')); ?>
			</dd>
		</dl>
        </fieldset>
                <?php echo $this->Form->hidden('status',array('value'=>'1')); ?>
		<?php //e($form->hidden('publish',array('value'=>'0'))); ?>
		<button type="submit">
			<?php 
				if(isset($this->data['Slide']['id'])):
					echo ('Update');
				else:
					echo ('Add');
				endif;
		       ?>
		</button> or 
                   <?php echo $this->Html->link('Cancel', array('controller'=>'slides', 'action' => 'index'));?>
                    <?php $this->Form->end();?>
</div>
 