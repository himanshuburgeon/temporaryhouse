<script language="javascript">
function validatefields(val)
{
	if(document.getElementById('ProductTitle').value==''){
		alert("Please enter the product title");
		document.getElementById('ProductTitle').focus();
		return false;
	}
	if(document.getElementById('ProductPrice').value==''){
		alert("Please enter the Product Price");
		document.getElementById('ProductPrice').focus();
		return false;
	}
	
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
					if (isset($this->request->data['Product']['id'])):
						echo ('Update Product');
					else:
						echo ('Add Product');
					endif;
				?>
			</h2>
		</header>
	</article>
	<?php echo $this->element('admin/message');?>
	<?php
		if(!empty($this->data) && $this->data['Product']['id'])$act='edit';
		else $act='add';
	?>
	<?php echo $this->Form->create('Product',array('name'=>'product','id'=>'MessageCms','action'=>$act,'onsubmit'=>'return validatefields();','enctype'=>'multipart/form-data'))?>
	<?php echo $this->Form->hidden('id');?>
	
	<fieldset>
		<dl>
			<dt>
				<label>Product Title <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->text('title',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
				<label>Product Price <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->text('price',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			<dt>
			
				<label>Product image <span style="color:red;">*</span></label>
			</dt>
			<dd>
				<?php echo $this->Form->file('image',array('class'=> 'fileupload customfile-input')); ?>
			<br><label>(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB )</label><br />
			<?php if(isset($this->request->data['Product']['image'])){
			echo $this->Html->image("products/".$this->request->data['Product']['image'],array('width'=>'80','height'=>'40','border'=>'0'));}?>
			</dd>
			<dt>
				<label>Product Discription<span style="color:red;">*</span></label>
			</dt>
			
			<dd>
				<?php echo $this->Form->textarea('discription',array('class'=> 'small','size'=>'45')); ?>
			</dd>
			
		</dl>
	</fieldset>
	
	<button type="submit">
		<?php
			if (isset($this->request->data['Product']['id'])):
				echo ('Update');
			else:
				echo ('Add');
			endif;
		?>
	</button> or
	<?php echo $this->Html->link('Cancel', array('controller'=>'products', 'action' => 'index'));?>
	<?php echo $this->Form->end();?>
</div>
