<script language="javascript">
  function validatefields(val) {
    if (document.getElementById('PropertyName').value == '') {
      alert("Please Enter The Title");
      document.getElementById('PropertyName').focus();
      return false;
    }
    if (document.getElementById('PropertyPropertyTitle').value == '') {
      alert("Please Enter The Property Title");
      document.getElementById('PropertyPropertyTitle').focus();
      return false;
    }
  }
  function saveform() {
    document.getElementById('PropertyPublish').value = 1;
    document.getElementById('PropertyCms').submit();
  }
</script>


<style type="text/css">
  label {
    color: #666666;
    font-family: 'PT Sans',Arial,sans-serif;
    font-size: 13px;
  }
  #tabs > ul > li >a {
    color: #666666;
    font-family: 'PT Sans',Arial,sans-serif;
    font-size: 13px;
  }
  #tabs table  th{
    color: #666666;
    font-family: 'PT Sans',Arial,sans-serif;
    font-size: 13px;
    font-weight:bold;

  }
  .checkbox{
    float:left;
    position:static;
  }
  .error-message{
    font-family: 'PT Sans',Arial,sans-serif;
    font-size: 13px;
    font-weight: normal;
  }
</style>

<?= $this->element('admin/breadcrumbs'); ?>
<div>
  <article>
    <header>
      <h2>
        <?php
        if (!isset($this->request->data) && $this->request->data['Property']['id']):
          echo __('update') . '' . __('property');
        else:
          echo __('add') . ' ' . __('property');
        endif;
        ?>
      </h2>
    </header>
  </article>

  <?php
  if (!empty($this->request->data) && (isset($this->request->data['Property']['id']) && $this->request->data['Property']['id']))
    $act = 'edit';
  else
    $act = 'add';
  ?>

  <?= $this->element('admin/message'); ?>
  <?php echo $this->Form->create('Property', array('name' => 'Properties', 'id' => 'LanguageCms', 'action' => $act, 'onsubmit' => 'return validatefields();','enctype'=>'multipart/form-data')); ?>
<?php echo $this->Form->hidden('id'); ?>
  <!-- Inputs -->
  <!-- Use class .small, .medium or .large for predefined size -->

  <script>
    $(function() {
      $("#tabs").tabs();
    });
  </script>

  <div id="tabs">
    <ul>
      <li><a href="#tabs-1">Basic</a></li>
      <li><a href="#tabs-2">Services</a></li>
      <li><a href="#tabs-3">Availability</a></li>
      <li><a href="#tabs-4">Prices</a></li>
      <li><a href="#tabs-5">Special prices</a></li>
    </ul>
    <div id="tabs-1">
      <dl>
        <dt>
        <label><?php echo __('owner') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('owner_id')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->input('owner_id', array('options' => $owners, 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false)); ?>

          <?php if ($this->Form->isFieldError('owner_id')): ?>
            <span class="error-message"><?php echo __($this->Form->error('owner_id', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>
        
        <dt>
        <label><?php echo __('Category') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('category_id')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->input('category_id', array('options' => $categories, 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false)); ?>

          <?php if ($this->Form->isFieldError('category_id')): ?>
            <span class="error-message"><?php echo __($this->Form->error('category_id', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>
        



        <dt>
        <label><?php echo __('nation') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('nation')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->text('nation', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
          <?php if ($this->Form->isFieldError('nation')): ?>
            <span class="error-message"><?php echo __($this->Form->error('nation', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('city') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('city')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->text('city', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
          <?php if ($this->Form->isFieldError('city')): ?>
            <span class="error-message"><?php echo __($this->Form->error('city', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('typology') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('typology')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->input('typology', array('options' => array(1, 2, 3, 4, 5), 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false)); ?>

          <?php if ($this->Form->isFieldError('typology')): ?>
            <span class="error-message"><?php echo __($this->Form->error('typology', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('sleeps') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('sleeps')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->input('sleeps', array('options' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10), 'div' => false, 'label' => false, 'lagend' => false,
              'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false));
          ?>

          <?php if ($this->Form->isFieldError('sleeps')): ?>
            <span class="error-message"><?php echo __($this->Form->error('sleeps', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('Bed') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('bed')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->input('bed', array('options' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10), 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false)); ?>
          <?php if ($this->Form->isFieldError('bed')): ?>
            <span class="error-message"><?php echo __($this->Form->error('bed', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('description') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('description')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->textarea('description', array('class' => 'small ' . $error_class, 'size' => '45')); ?>

          <?php if ($this->Form->isFieldError('description')): ?>
            <span class="error-message"><?php echo __($this->Form->error('description', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>


        <dt>
        <label><?php echo __('rooms') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('rooms')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->input('rooms', array('options' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10), 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false)); ?>
          <?php if ($this->Form->isFieldError('rooms')): ?>
            <span class="error-message"><?php echo __($this->Form->error('rooms', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>


        <dt>
        <label><?php echo __('bath') ?>  <span style="color:red;">*</span></label>
        </dt>

        <dd>
          <?php $error_class = ($this->Form->isFieldError('bath')) ? 'invalid' : ''; ?>
          <?php echo $this->Form->input('bath', array('options' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10), 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false)); ?>
          <?php if ($this->Form->isFieldError('bath')): ?>
            <span class="error-message"><?php echo __($this->Form->error('bath', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('title') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('title')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->text('title', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
          <?php if ($this->Form->isFieldError('title')): ?>
            <span class="error-message"><?php echo __($this->Form->error('title', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('description') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('description')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->textarea('description', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
          <?php if ($this->Form->isFieldError('description')): ?>
            <span class="error-message"><?php echo __($this->Form->error('description', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>
        
        <dt>
        <label><?php echo __('photo') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('photo')) ? 'invalid' : ''; ?>
        <dd>
          <?php echo $this->Form->file('photo', array('class' => 'fileupload customfile-input ' . $error_class, 'size' => '45')); ?>
          <?php if ($this->Form->isFieldError('Photo')): ?>
            <span class="error-message"><?php echo __($this->Form->error('photo', null, array('wrap' => false))); ?></span>
<?php endif; ?>
           <?php if($this->request->data['Property']['image']){?>
           <p> <?=$this->Html->image($this->request->data['Property']['image']);?></p>
           <?php } ?>
           
        </dd>
        
        
        
        
      </dl>
    
    
    
    </div>
    <div id="tabs-2">
      <dl>
        <dt>
        <label><?php echo __('service') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('service')) ? 'invalid' : ''; ?>
        <dd>
          <?php
          echo $this->Form->select('service', array(
              'smoking_is_permitted' => ' ' . __('Smoking_is_permitted'),
              'air_conditioning' => ' ' . __('air_conditioning'),
              'tv ' => ' ' . __('tv'),
              'internet_key ' => ' internet key',
              'internet_wifi ' => ' internet wifi',
              'building_with_elevator ' => ' ' . __('building_with_elevator'),
              'access_for_disabled ' => ' ' . __('Access_for_disabled'),
              'pool ' => ' ' . __('pool'),
              'parking_included' => ' ' . __('parking_included'),
              'porter' => ' ' . __('porter'),
              'sauna ' => ' ' . __('sauna'),
              'whirlpool ' => ' ' . __('whirlpool'),
              'fire_place' => ' ' . __('fireplace'),
              'washing_machine ' => ' ' . __('washing_machine'),
              'dryer' => ' ' . __('dryer'),
              'dishwasher' => ' ' . __('dishwasher'),
              'linens' => ' ' . __('linens')
                  ), array('multiple' => 'checkbox', 'hiddenField' => 'N', 'error' => false));
          ?>
          <br clear="all" />
<?php if ($this->Form->isFieldError('service')): ?>
            <div class="error-message"><?php echo __($this->Form->error('service', null, array('wrap' => false))); ?></div>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('address') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('address')) ? 'invalid' : ''; ?>
        <dd>
<?php echo $this->Form->textarea('address', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
<?php if ($this->Form->isFieldError('address')): ?>
            <span class="error-message"><?php echo __($this->Form->error('address', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('minimum_stay') ?>  <span style="color:red;">*</span></label>
        </dt>


        <dd>
          <?php $error_class = ($this->Form->isFieldError('min_stay')) ? 'invalid' : ''; ?>
<?php echo $this->Form->input('min_stay', array('options' => Configure::read('STAY') , 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false)); ?>
<?php if ($this->Form->isFieldError('min_stay')): ?>
            <span class="error-message"><?php echo __($this->Form->error('min_stay', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('maximum_stay') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('max_stay')) ? 'invalid' : ''; ?>
        <dd>
          <?php
          echo $this->Form->input('max_stay', array('options' => Configure::read('STAY'), 'div' => false, 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false));
          ?>
<?php if ($this->Form->isFieldError('max_stay')): ?>
            <span class="error-message"><?php echo __($this->Form->error('max_stay', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>
      </dl>
    </div>
    <div id="tabs-3">
      <dl>
        <dt>
        <label><?php echo __('availability') . ' ' . __('furniture') . ' ' . __('fair') ?>  <span style="color:red;">*</span></label>
        </dt>

          <?php $error_class = ($this->Form->isFieldError('avail_furniture_fair')) ? 'invalid' : ''; ?>
        <dd>
<?php echo $this->Form->input('avail_furniture_fair', array('options' => array('1' => 'yes','0' => 'no'), 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ' . $error_class, 'error' => false));
?>
<?php if ($this->Form->isFieldError('avail_furniture_fair')): ?>
            <span class="error-message"><?php echo __($this->Form->error('avail_furniture_fair', null, array('wrap' => false))); ?></span>
        <?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('availability') . ' ' . __('fashion') . ' ' . __('weeks') ?>  <span style="color:red;">*</span></label>
        </dt>

<?php //$error_class= ($this->Form->isFieldError('avail_fashion_week'))?'invalid':'';  ?>
        <dd>
<?php echo $this->Form->input('avail_fashion_week', array('options' => array(1 => 'yes',0 => 'no'), 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small '));
?>
        <?php //if($this->Form->isFieldError('avail_fashion_week')): ?>
               <!--<span class="error-message"><?php //echo __($this->Form->error('avail_fashion_week',null,array('wrap'=>false)));  ?></span>-->
          <?php //endif; ?>
        </dd>

        <dt>
        <label><?php echo __('availability') . ' ' . 'Burgo' ?>  <span style="color:red;">*</span></label>
        </dt>
<?php //$error_class= ($this->Form->isFieldError('avail_burgo'))?'invalid':'';  ?>
        <dd>
<?php echo $this->Form->input('avail_burgo', array('options' => array('1' => 'yes', '0' => 'no'), 'label' => false, 'lagend' => false, 'empty' => __('select'), 'class' => 'small ')); ?>
<?php //if($this->Form->isFieldError('avail_burgo')):  ?>
               <!--<span class="error-message"><?php //echo __($this->Form->error('avail_burgo',null,array('wrap'=>false)));  ?></span>-->
<?php //endif;  ?>
        </dd>
      </dl>
    </div>

    <div id="tabs-4">
      <dl>
        <dt>
        <label><?php echo __('deposit'); ?>  <span style="color:red;">*</span></label>
        </dt>

<?php $error_class = ($this->Form->isFieldError('deposit')) ? 'invalid' : ''; ?>
        <dd>
<?php echo $this->Form->text('deposit', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
        <?php if ($this->Form->isFieldError('deposit')): ?>
            <span class="error-message"><?php echo __($this->Form->error('deposit', null, array('wrap' => false))); ?></span>
          <?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('price') . ' ' . __('for') . ' ' . __('night'); ?>  <span style="color:red;">*</span></label>
        </dt>

<?php $error_class = ($this->Form->isFieldError('price_one_night')) ? 'invalid' : ''; ?>
        <dd>
<?php echo $this->Form->text('price_one_night', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
<?php if ($this->Form->isFieldError('price_one_night')): ?>
            <span class="error-message"><?php echo __($this->Form->error('price_one_night', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('price') . ' ' . __('on') . ' ' . __('range') ?>  </label>
        </dt>

        <dd>
          <table>
            <tr>
              <th>
                <?php echo __('from') . ' ' . __('number of') . ' ' . __('night') ?>  <span style="color:red;">*</span>
                <?php if ($this->Form->isFieldError('PropertyPrice.min_night')): ?> <br clear="all" />
                  <span class="error-message"><?php echo __($this->Form->error('PropertyPrice.min_night', null, array('wrap' => false))); ?></span>
<?php endif; ?>
              </th>
              <th>
                <?php echo __('to') . ' ' . __('number') . ' ' . __('of') . ' ' . __('night') ?>  <span style="color:red;">*</span>
                <?php if ($this->Form->isFieldError('PropertyPrice.max_night')): ?> <br clear="all" />
                  <span class="error-message"><?php echo __($this->Form->error('PropertyPrice.max_night', null, array('wrap' => false))); ?></span>
<?php endif; ?>

              </th>
              <th><?php echo __('Price') . ' ' . __('for') . ' ' . __('night') ?>  <span style="color:red;">*</span>
              <?php if ($this->Form->isFieldError('PropertyPrice.price')): ?> <br clear="all" />
                  <span class="error-message"><?php echo __($this->Form->error('PropertyPrice.price', null, array('wrap' => false))); ?></span>
              <?php endif; ?>

              </th>
            </tr>
            <tbody id ="parah">
<?php $i = 0; ?>
                  <?php if (!empty($this->request->data['ProductPrice'])) { ?>
                    <?php foreach ($this->request->data['ProductPrice'] as $prices) { ?>
  <?php } ?>
                  <?php } else { ?>
                <tr>
                  <td>
  <?php echo $this->Form->text('PropertyPrice.' . $i . '.min_night', array('class' => 'small', 'size' => '10')); ?>
                  </td>
                  <td>
  <?php echo $this->Form->text('PropertyPrice.' . $i . '.max_night', array('class' => 'small', 'size' => '10')); ?>
                  </td>
                  <td>
  <?php echo $this->Form->text('PropertyPrice.' . $i . '.price', array('class' => 'small', 'size' => '15')); ?>
                  </td>

                </tr>
<?php } ?>

            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th></th>
                <th>
                  <input type="button" name="add" onclick="javascript:addInput()" value="+" class="add" />
                  <input type="button" name="subtract" onclick="javascript:deleteInput()" value="-" class="remove" />
                </th>
              </tr>
            </tfoot>
          </table>

        </dd>

        <dt>
        <label><?php echo __('cleaning_costs') ?>  <span style="color:red;">*</span></label>
        </dt>

<?php $error_class = ($this->Form->isFieldError('cleaning_cost')) ? 'invalid' : ''; ?>
        <dd>
<?php echo $this->Form->text('cleaning_cost', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
        <?php if ($this->Form->isFieldError('cleaning_cost')): ?>
            <span class="error-message"><?php echo __($this->Form->error('cleaning_cost', null, array('wrap' => false))); ?></span>
          <?php endif; ?>
        </dd>

        <dt>
        <label><?php echo __('guest') . ' ' . __('price') . '/' . __('night') . ' ' . __('cost') ?>  <span style="color:red;">*</span></label>
        </dt>

<?php $error_class = ($this->Form->isFieldError('guest_cost')) ? 'invalid' : ''; ?>
        <dd>
<?php echo $this->Form->text('guest_cost', array('class' => 'small ' . $error_class, 'size' => '45')); ?>
<?php if ($this->Form->isFieldError('guest_cost')): ?>
            <span class="error-message"><?php echo __($this->Form->error('guest_cost', null, array('wrap' => false))); ?></span>
<?php endif; ?>
        </dd>
      </dl>
    </div>


    <div id="tabs-5">
      <dl>
        <dt>
        <label><?php echo __('SPECIAL PRICES') ?>  <span style="color:red;">*</span></label>
        </dt>
        <dd>
        </dd>
        <dd>
          <table>
            <tr>
              <th>
                <label><?php echo __('event') . ' ' . __('name') ?>  <span style="color:red;">*</span></label>
              </th>
<?php $error_class = ($this->Form->isFieldError('PropertySpecialPrice.0.event_name')) ? 'invalid' : ''; ?>
              <th>
                <label><?php echo __('Price') . ' ' . __('for') . ' ' . __('night') ?><span style="color:red;">*</span></label>
              </th>
              <th>
                <label><?php echo __('from') ?>&nbsp date  <span style="color:red;">*</span></label>

              </th>
              <th>
                <label><?php echo __('to') ?>&nbsp date  <span style="color:red;">*</span></label>

              </th>
            </tr>
            <tbody id ="parah">
                  <?php for ($i = 0; $i < 3; $i++) { ?>
                <tr>
                  <td>
  <?php echo $this->Form->text('PropertySpecialPrice.' . $i . '.event_name', array('class' => 'small' . $error_class, 'size' => '20')); ?>
                    <?php if ($this->Form->isFieldError('PropertySpecialPriceevent_name')): ?>
                      <span class="error-message"><?php echo __($this->Form->error('PropertySpecialPrice.event_name', null, array('wrap' => false))); ?></span>
  <?php endif; ?>
                  </td>
                  <td>
  <?php echo $this->Form->text('PropertySpecialPrice.' . $i . '.price', array('class' => 'small', 'size' => '15')); ?>

                  </td>
                  <td>
  <?php echo $this->Form->text('PropertySpecialPrice.' . $i . '.start_date', array('class' => 'small', 'size' => '10', 'id' => 'from_' . $i)); ?>
                  </td>
                  <td>
  <?php echo $this->Form->text('PropertySpecialPrice.' . $i . '.end_date', array('id' => 'to_' . $i, 'class' => 'small', 'size' => '10')); ?>
                  </td>

                </tr>
              <script>
  $(function() {
  $("#from_<?= $i ?>").datepicker({
  defaultDate: "+1d",
  changeMonth: true,
  dateFormat: "yy-mm-dd",
  numberOfMonths: 1,
  onClose: function(selectedDate) {
  $("#to_<?= $i ?>").datepicker("option", "minDate", selectedDate);
  }
  });
  $("#to_<?= $i ?>").datepicker({
  defaultDate: "+1w",
  changeMonth: true,
  dateFormat: "yy-mm-dd",
  numberOfMonths: 1,
  onClose: function(selectedDate) {
  $("#from_<?= $i ?>").datepicker("option", "maxDate", selectedDate);
  }
  });
  });
              </script>
<?php } ?>

            </tbody>


          </table>
        </dd>
      </dl>
    </div>

  </div>



  <button type="submit">
  <?php
  if (!isset($this->request->data) && $this->request->data['Property']['id']):
    echo __('update');
  else:
    echo __('add');
  endif;
  ?>
  </button> <?php echo __('or') ?> 
<?php echo $this->Html->link(__('cancel'), array('controller' => 'Properties', 'action' => 'index')); ?>

<?php echo $this->Form->end(); ?>
</div>

<script>
  var arrInput = new Array(0);
  var arrInputValue = new Array(0);
  var arrInput_q = new Array(0);
  var arrInputValue_q = new Array(0);
  var arrInput_r = new Array(0);
  var arrInputValue_r = new Array(0);

<?php for ($a = 0; $a <= $i; $a++) { ?>
    arrInput.push(<?= $a ?>);
    arrInputValue.push('<?= $this->request->data['PropertyPrice'][$a]['max_night'] ?>');
    arrInput_q.push(<?= $a ?>);
    arrInputValue_q.push('<?= $this->request->data['PropertyPrice'][$a]['min_night'] ?>');
    arrInput_r.push(<?= $a ?>);
    arrInputValue_r.push('<?= $this->request->data['PropertyPrice'][$a]['price'] ?>');
<?php } ?>

//display();
  function addInput() {


    arrInput.push(arrInput.length);
    arrInputValue.push("");
    arrInput_q.push(arrInput_q.length);
    arrInputValue_q.push("");
    arrInput_r.push(arrInput_r.length);
    arrInputValue_r.push("");

    display();
  }

  function display() {
    document.getElementById('parah').innerHTML = "";
    for (intI = 0; intI < arrInput.length; intI++) {
      document.getElementById('parah').innerHTML += createInput(arrInput[intI], arrInputValue[intI], arrInput_q[intI], arrInputValue_q[intI], arrInput_r[intI], arrInputValue_r[intI]);
    }
  }

  function saveValue(intId, strValue) {
    arrInputValue[intId] = strValue;
  }

  function saveValue_q(intId, strValue) {
    arrInputValue_q[intId] = strValue;
  }

  function saveValue_r(intId, strValue) {
    arrInputValue_r[intId] = strValue;
  }

  function createInput(id, value, id2, value2, id3, value3) {
    var str = "<tr><td><input type='text' class='small' name='data[PropertyPrice][" + id + "][min_night]' id='fixture_type_" + id + "'  onChange='javascript:saveValue(" + id + ",this.value)' value='" + value + "' size='10' class='float-left'/></td><td><input type='text' class='small' name='data[PropertyPrice][" + id + "][max_night]' size='10' id='quntity_" + id + "'  onChange='javascript:saveValue_q(" + id2 + ",this.value)' value='" + value2 + "' class='float-left' /></td> <td> <input type='text' class='small' size='10' name='data[PropertyPrice][" + id + "][price]' id='quntity_" + id + "'  onChange='javascript:saveValue_q(" + id3 + ",this.value)' value='" + value3 + "' class='float-left'/></td></tr>";

    return str;
  }

  function deleteInput() {
//alert(arrInput.length);
    if (arrInput.length > 1) {
      arrInput.pop();
      arrInputValue.pop();

      arrInput_q.pop();
      arrInputValue_q.pop();
      arrInput_r.pop();
      arrInputValue_r.pop();
    }
    display();
  }
</script>
