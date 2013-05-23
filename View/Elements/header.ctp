<?php $menus = $this->requestAction(array('controller' => 'pages', 'action' => 'request_topmenu')); ?>


<div class="header">
     <div class="wrapper">
            <div class="float_left header_left"><?php echo $this->Html->link($this->Html->image('logo.png'),'/',array('escape'=>false));?></div>
        
            <div class="header_right float_right"> 
              <div id="menu">
            <ul class="menu">
              <?php foreach($menus as $menu){ ?>
              <?php if($menu['url_key']=='prenotazioni'){ ?>
                <li><?=$this->Html->link('<span>'.$menu['title'].'</span>',array('controller'=>'properties','action'=>'search'),array('escape'=>false,'class'=>($menu['parent'])?'parent':''))?>
             <?php }else{?>
              <li><?=$this->Html->link('<span>'.$menu['title'].'</span>',array('controller'=>'pages','action'=>'view',$menu['url_key']),array('escape'=>false,'class'=>($menu['parent'])?'parent':''))?>
               <?php } ?>
              
                <?php if(!empty($menu['submenu'])){?>
                <div><ul>
                    <?php foreach($menu['submenu'] as $submenu){ ?>
                    <li><?=$this->Html->link('<span>'.$submenu['title'].'</span>',array('controller'=>'pages','action'=>'view',$submenu['url_key']),array('escape'=>false,'class'=>($submenu['parent'])?'parent':''))?></li>
                    
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