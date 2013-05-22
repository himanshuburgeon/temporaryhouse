<?=$this->element('admin/breadcrumbs');?>
<div>
	<article>
		<header>
			<h2>
				<?php 
					if (!empty($this->request->data) && $this->request->data['Product']['id']){
						echo ('Update Product');
					}
					else{
						echo ('Add Product');
					}
				?>
			</h2>
		</header>
	</article>
	
	<?php echo $this->element('admin/message');?>
	<?php echo $this->Form->create('Product', array('type' => 'file','onSubmit'=>"return validate()",'enctype'=>'multipart/form-data'));?>
	<?php echo $this->Form->input('id'); ?>
	
	<fieldset>
		<legend>Product Detail</legend>
		<dl>
			<dt>
				<label>Title</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('title',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>Discription <span style="color:red;">*</span></label>
		
			</dt>
			<dd>
				<?php echo $this->Form->text('discription',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			<dt>
				<label>Price</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('price',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
				<label>Shipping Cost</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->text('shipping_cost',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
			
			<dt>
				<label>Photo.</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->file('image', array('class'=> 'fileupload customfile-input')); ?>
				<p style="padding-bottom:15px;">(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
				
			</dd>
			
			<dt>
				<label>Status</label><span style="color:red;">*</span>
			</dt>
			<dd>
				<?php echo $this->Form->input('status',array('options'=>array('0'=>'Not Approved','1'=>'Approved','2'=>'Deactive'),'class'=>'small','div'=>false, 'legend'=>false, 'label'=>false)); ?>
			</dd>
			
		</dl>
		
		
	</fieldset>
	
	
	<button type="submit">
		<?php
			if (!empty($this->request->data) && $this->request->data['Product']['id']):
				echo ('Update');
				else:
				echo ('Add');
			endif;
		?>
	</button>
<?php echo $this->Form->end();?>
</div>


