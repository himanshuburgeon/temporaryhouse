 <script>
$(function() {
$( "#arrival_date" ).datepicker({
minDate: "+1d",
numberOfMonths: 2,
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#departure_date" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#departure_date" ).datepicker({
minDate: "+1d",
numberOfMonths: 2,
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#arrival_date" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
</script>
<style type="text/css">
    .ui-datepicker{
        z-index: 999!important;
    }
</style>

<div class="inner_main_calender clear">
    <?=$this->Form->create('Property', array('name' => 'Properties', 'id' => 'LanguageCms', 'action' => 'search'));?>
     <?php //$this->Form->input('location', array('class'=>'txt_field float_left','label'=>false,'div'=>false));?>
    <?=$this->Form->input('location', array('options' => $categories,'value'=>$location, 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('Select Location'), 'class' => 'txt_field_1 float_left')); ?>
     
     
    <?=$this->Form->input('arrival_date', array('class'=>'datepicker datepicker_1 float_left','id'=>'arrival_date','value'=>$arrival_date,'label'=>false,'div'=>false));?>
    <?=$this->Form->input('departure_date', array('class'=>'datepicker datepicker_1 float_left','id'=>'departure_date','value'=>$departure_date,'label'=>false,'div'=>false));?>

    <a href="Javascript:void();" onclick="$('#LanguageCms').submit();">
  <div class="float_left"><?=$this->Html->image('search_left.png');?></div>
  <div class="calender_btn float_left">Search</div>
  <div class="float_left"><?=$this->Html->image('search_right.png');?></div>
    </a>

  <div class="calender_content clear">
   
      <div class="radio_btn float_left">
      <input name="data[Property][availability]" type="radio" class="float_left" title="Availability furniture fair" value="avail_furniture_fair" <?=($availability=='avail_furniture_fair')?'checked="checked"':''?> >											<label class="radio">Availability furniture fair</label>
    </div>

    <div class="radio_btn float_left">
      <input name="data[Property][availability]" type="radio" class="float_left" title="Availability fashion week" value="avail_fashion_week" <?=($availability=='avail_fashion_week')?'checked="checked"':''?> >								<label class="radio">Availability fashion week</label>
    </div>

    <div class="radio_btn float_left">
      <input name="data[Property][availability]" type="radio" class="float_left" title="Availability Burgo" value="avail_burgo" <?=($availability=='avail_burgo')?'checked="checked"':''?> >								<label class="radio">Availability Burgo</label>
    </div> 
     
    
  </div>
<?=$this->Form->end();?>
</div>
<div class="float_left"><?=$this->Html->image('inner_pg_bottom_bg.png');?>
</div>
</div>

</div>

<!-----------------------middle content------------------------->
<div class="wrapper">
  <div class="inner">
    <div class="float_left inner_pg_top_bg"><?=$this->Html->image('inner_pg_top_bg.png');?></div>
    <div class="inner_main clear">
      <!-----------------------section------------------------->
      <?php foreach($properties as $property){ ?>
      <div class="section">
        <div class=" float_left img_bg"><?=$this->Html->image($property['Property']['image'])?></div>
        <div class="section_right float_right">
          <div class="section_right_top">
            <h3 class="float_left"><?=$property['Property']['title']?></h3><div class="price float_right">&euro; <?=$property['Property']['price_one_night']?>/<?=__('night')?></div>
            <p class="float_left clear section_para"><?=$property['Property']['description']?></p>
          </div>
          <div class="section_right_bottom">
            <div class="float_left clear"><strong>Minimum :  <?=$property['Property']['min_stay']?></strong><strong class="min_max">Maximum :  <?=$property['Property']['max_stay']?></strong></div>
          </div>      
          <div class="clear"></div>       
          <div class="float_left section_right_left">

            <a href="#"><?=$this->Html->image('twitter.png');?></a>
          </div>
          <div class="float_left section_right_left">
            <a href="#"><?=$this->Html->image('facebook.png');?></a>
          </div>
          <div class="float_left section_right_left">
            <a href="#"><?=$this->Html->image('mail.png');?></a>
          </div>
          <div class="float_left section_right_left">
            <a href="#"><?=$this->Html->image('share.png');?></a>
          </div>


          <div class="float_right">
            <a href="#">
                <span class="float_left"><?=$this->Html->image('bookbtn_left.png');?></span>
                <div class="bookbtn_mid float_left"><?=__('Book Now'); ?></div>
                <span class="float_left"><?=$this->Html->image('bookbtn_right.png');?></span>
            </a>
          </div>

        </div>
      </div>
      <?php  } ?>
      
      <?php if(empty($properties)){ ?>
     

              <h2 align="center">Sorry! No result Found</h2>


         
      <?php } ?>
      

      <!-----------------------section------------------------->  
</div>
<!-----------------------middle content------end------------------->