<ul id="breadcrumbs">
	<?php foreach($breadcrumbs as $breadcrumb){ ?>
	<li>
		<?php if($breadcrumb['link']!='') { ?>
		<a title="<?=$breadcrumb['title']?>" href="<?=$breadcrumb['link']?>"><?=$breadcrumb['name']?></a>
		<?php } else {  ?>
		<?=$breadcrumb['name']?>
		<?php  } ?>
	</li>

	<?php } ?>
		
</ul>
