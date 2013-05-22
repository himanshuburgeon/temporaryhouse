<?php $menus = $this->requestAction(array('controller' => 'pages', 'action' => 'request_footermenu')); ?>

<div class="wrapper">
<div class="footer_inner">
	<div class="footer_inner_menu">
    	<ul>
            <?php foreach($menus as $menu){ ?>
            <li><a href="<?=$menu['link']?>"><?=$menu['title']?></a></li> 
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