<?php $menus = $this->requestAction(array('controller' => 'pages', 'action' => 'request_footermenu')); ?>

<div class="wrapper">
<div class="footer_inner">
	<div class="footer_inner_menu">
    	<ul>
            <?php foreach($menus as $menu){ ?>
            <li><?=$this->Html->link('<span>'.$menu['title'].'</span>',array('controller'=>'pages','action'=>'view',$menu['url_key']),array('escape'=>false,'class'=>($menu['parent'])?'parent':''))?></li> 
            <?php } ?>
        </ul>
    </div>
  
</div>
</div>

<div class="clear"></div> 
    
    <div class="copyright_inner">
    	<div class="wrapper">
    	© Copyright 2013 Temporary House s.a.s. di Guagnano Gianfranco & C. P.IVA 08101820960 | Powererd by WebGin
        </div>
    </div>