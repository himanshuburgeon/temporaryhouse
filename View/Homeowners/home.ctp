      <div class="content-left">
      	<h1>Homeowner</h1>
        <div style="overflow:hidden; margin-bottom:25px;">
            <div class="homeowner">
				<?php echo $this->Html->link($this->Html->image("education.png",array('escape'=>false)),'/pages/view/49',array('escape'=>false));?>
                <div class="homeowner-name"><?php echo $this->Html->link('Educate',array('controller'=>'homeowners','action'=>'view',49));?></div>
            </div>
            <div class="homeowner">
				<?php echo $this->Html->link($this->Html->image("investigate.png",array('escape'=>false)),'/pages/view/55',array('escape'=>false));?>
                <div class="homeowner-name"><?php echo $this->Html->link('Investigate',array('controller'=>'homeowners','action'=>'view',55));?></div>
            </div>
            <div class="homeowner">
				<?php echo $this->Html->link($this->Html->image("toolkit.png",array('escape'=>false)),'/pages/view/60',array('escape'=>false));?>
                <div class="homeowner-name"><?php echo $this->Html->link('Tool Kit',array('controller'=>'homeowners','action'=>'view',60));?></div>
            </div>
        </div>
        
        <p>A fire, flood, or any other type of loss can change your life in many ways. Knowing what to do after it happens and who can help is vital information.</p>
        
        <p>National Insurance Bureau has provided useful information, tips and links that will assist you in tackling through your loss. The All Point show below:</p>
        
        <p>National Insurance Bureau does not endorse or recommend any companies or service providers. Its only goal is to provide information and empower the consumer to make educated decisions.</p>
        
       
          
		

      </div><!-------------------------------content-left-end-------------------->
      <?php echo $this->element('rightmenu'); ?>
