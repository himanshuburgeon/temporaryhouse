<?php $menus = $this->requestAction(array('controller' => 'pages', 'action' => 'request_topmenu')); ?>


<div class="header">
     <div class="wrapper">
            <div class="float_left header_left"><?php echo $this->Html->link($this->Html->image('logo.png'),'/',array('escape'=>false));?></div>
        
            <div class="header_right float_right"> 
              <div id="menu">
            <ul class="menu">
              <?php foreach($menus as $menu){ ?>
            
              <li><?=$this->Html->link('<span>'.$menu['title'].'</span>',$menu['link'],array('escape'=>false,'class'=>($menu['parent'])?'parent':''))?>
                <?php if(!empty($menu['submenu'])){?>
                <div><ul>
                    <?php foreach($menu['submenu'] as $submenu){ ?>
                    <li><?=$this->Html->link('<span>'.$submenu['title'].'</span>',$submenu['link'],array('escape'=>false))?></li>
                    
                <?php } ?>
                </ul></div>
                <?php } ?>
              </li>
                
              <?php } ?>
                
                
            </ul>
        </div>
           </div>                  
     </div>                 
</div>