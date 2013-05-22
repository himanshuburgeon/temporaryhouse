<script language="javascript">
  function validatefields(val)
  {
         if(document.getElementById('PageName').value==''){
                alert("Please Enter The Title");
                document.getElementById('PageName').focus();
                return false;
         }
         if(document.getElementById('PagePageTitle').value==''){
                alert("Please Enter The Page Title");
                document.getElementById('PagePageTitle').focus();
                return false;
         }

  }
  function saveform()
  {
         document.getElementById('PagePublish').value=1;
         document.getElementById('PageCms').submit();
  }
</script>
<?=$this->element('admin/breadcrumbs');?>
<div>
  <article>
    <header>
      <h2>
        <?php 
           if(isset($this->request->data['Page']['id'])):
               echo __('update').''.__('content');
         else:
               echo __('add').' '.__('content');
         endif;
        ?>
      </h2>
    </header>
  </article>
  
  <?php
    if(!empty($this->request->data) && $this->request->data['Page']['id'])$act='edit';
    else $act='add';
  ?>
  <?=$this->element('admin/message')?>
  <?=$this->Form->create('Page',array('name'=>'pages','id'=>'PageCms','action'=>$act.'/'.$parent_id,'onsubmit'=>'//return validatefields();'))?>
  <?=$this->Form->input('id');?>
  <?=$this->Form->hidden('status',array('value'=>'1')); ?>
  <!-- Inputs -->
  <!-- Use class .small, .medium or .large for predefined size -->
  <fieldset>
    <dl>
      <dt><label><?php echo __('language') ?><span style="color:red;">*</span></label></dt>
      <dd><?=$this->Form->input('language_code',array('options'=>$LANGUAGES,'div'=>false,'label'=>false,'lagend'=>false,'class'=>'small','value'=>$language)); ?></dd>
      
      <dt><label><?=__('title')?><span style="color:red;">*</span></label></dt>
      <dd><?=$this->Form->text('name',array('class'=> 'small','size'=>'45'))?></dd>
      
      <dt><label><?=__('page')?> <?=__('title')?><span style="color:red;">*</span></label></dt>
      <dd><?=$this->Form->text('pageTitle',array('class'=> 'small','size'=>'45')); ?></dd>
      
      <dt><label>Meta <?=__('keywords')?></label></dt>
      <dd><?=$this->Form->textarea('metaKeyword',array('class'=>'small','style'=>'height:100px;width:300px'));?></dd>
      <dt><label><?=__('Show in top menu')?></label></dt>
      <dd><?=$this->Form->input('top_menu',array('options'=>array('1'=>'Yes','0'=>'No'),'div'=>false,'label'=>false,'lagend'=>false,'class'=>'small','empty'=>'Select')); ?></dd>
      
      <dt><label>Meta <?=__('description')?></label></dt>
      <dd><?=$this->Form->textarea('metaDescription',array('class'=>'small','style'=>'height:100px;width:300px'));?></dd>
      
      <dt><label><?=__('Url Key') ?><span style="color:red;">*</span></label></dt>
      <dd><?=$this->Form->text('url_key',array('class'=> 'small','size'=>'45')); ?><p>Relative to Website Base URL</p></dd>
      
      <dt><label><?=__('long') ?> <?=__('description') ?></label></dt>
      <dd><?=$this->Form->textarea('content', array('cols'=>'60','rows'=>'3'));?><?=$this->Fck->load('Page.content');?></dd>
    </dl>
  </fieldset>
  
  <button type="submit">
      <?php
      if(isset($this->data['Page']['id'])):
        echo __('update');
      else:
        echo __('add');
      endif;
      ?>
  </button>
    <?=__('or')?>
    <?=$this->Html->link(__('cancel'), array('controller'=>'pages', 'action' => 'index'));?>
    <?=$this->Form->end();?>
</div>