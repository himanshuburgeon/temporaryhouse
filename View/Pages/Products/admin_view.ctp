<div style="background:#f6f6f6; padding:8PX; max-height:550px; overflow-y:auto;" id="view2">
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Product Title</b></div>
		<div align="justify;" style="float:left; width:400px;"><?=$product['Product']['title']?></div>
		<div style="clear:both;"></div>
	</div>
	
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Product Discription</b></div>
		
		<div align="justify" style="float:left; width:400px;"> <?=$product['Product']['discription']?></div>
		<div style="clear:both;"></div>
	</div>
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Product Price</b></div>
		<div align="justify" style="float:left; width:400px;"><?=$product['Product']['price']?></div>
		<div style="clear:both;"></div>
	</div>
	<div style="padding:10px 0;">
		<div style="float:left; width:110px;"><b>Product image</b></div>
		<div align="justify" style="float:left; width:400px;"><?=$this->Html->image($product['Product']['thumb_name'],array('width'=>80,'height'=>80)); ?></div>
		<div style="clear:both;"></div>
	</div>
	

</div>
