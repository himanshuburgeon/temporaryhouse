<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

function validate(frm){
	if(document.getElementById('SiteAdminname').value==''){
		alert("Sorry! we cannot complete your request, please enter Site Admin Name");
		document.getElementById('SiteAdminname').focus();
		return false;
	}
	if(document.getElementById('SiteAdminemail').value==''){
		alert("Sorry! we cannot complete your request, please enter Admin Email");
		document.getElementById('SiteAdminemail').focus();
		return false;
	}
	if(!checkemail(document.getElementById('SiteAdminemail').value)){
		alert("Sorry! we cannot complete your request, please enter a Valid Admin Email");
		document.getElementById('SiteAdminemail').focus();
		return false;
	}
	
	if(document.getElementById('SiteContactemail').value==''){
		alert("Sorry! we cannot complete your request, please enter Contact Email");
		document.getElementById('SiteContactemail').focus();
		return false;
	}
	if(!checkemail(document.getElementById('SiteContactemail').value)){
		alert("Sorry! we cannot complete your request, please enter a Valid Email for Contact");
		document.getElementById('SiteContactemail').focus();
		return false;
	}
	if(document.getElementById('SiteSitetitle').value=='')
	{
		alert("Sorry! we cannot complete your request, please enter a Site title");
		document.getElementById('SiteSitetitle').focus();
		return false;
	}
}

function checkemail(str){
	var filter=/^.+@.+\..{2,3}$/;
	testresults=false;
	if (filter.test(str))
		testresults=true;
	return testresults;
} 

function IsNumeric(strString){
var strValidChars = "0123456789";
var strChar;
var blnResult = true;
if (strString.length == 0) return false;
	for (i = 0; i < strString.length && blnResult == true; i++){
		strChar = strString.charAt(i);
			if (strValidChars.indexOf(strChar) == -1){
				blnResult = false;
			}
	}
	return blnResult;
}
</script>

<div>
	
        <article>
		<header>
		    <h2>
		    <?php echo __('site_configuration') ?>
		    </h2>
		</header>
        </article>
                <?php echo $this->element('admin/message');?>
                <?php echo $this->Form->create('Site',array('name'=>'siteconfig','action'=>'siteconfig','type' => 'file','onsubmit'=>'return validate();' ))?>
                <?php echo $this->Form->input('id');?>
 	<fieldset>
  
                <dl>
                    	<dt><label>Admin <?php echo __('name') ?></label></dt>
			<dd><?php echo __($this->Form->text('adminname',array('class'=> 'small','size'=>'45'))); ?></dd>
                </dl>
                <dl>
                    	<dt><label>Admin Email ID</label></dt>
			<dd><?php echo __($this->Form->text('adminemail',array('class'=> 'small','size'=>'45'))); ?></dd>
                </dl>
                <dl>
                    	<dt><label><?php echo __('contact') ?> Email</label></dt>
			<dd><?php echo __($this->Form->text('contactemail',array('class'=> 'small','size'=>'45'))); ?></dd>
                </dl>
                <dl>
                    	<dt><label><?php echo __('site').' '.__('title') ?></label></dt>
			<dd><?php echo __($this->Form->text('sitetitle',array('class'=> 'small','size'=>'45'))); ?></dd>
                </dl>
                <dl>
                    	<dt><label><?php echo __('site') ?> URL</label></dt>
			<dd><?php echo __($this->Form->text('siteurl',array('class'=> 'small','size'=>'45'))); ?></dd>
                </dl>
                <dl>
                    	<dt><label><?php echo __('host') ?></label></dt>
			<dd><?php $options = array('http://' => '&nbsp;http&nbsp;&nbsp;', 'https://' => '&nbsp;https');
				$attributes = array('legend' => false,'between'=>'&nbsp');
				echo $this->Form->radio('host', $options, $attributes);?></dd>
                </dl>
                <dl>
                    	<dt><label><?php echo __('site') ?> Logo</label></dt>
			<dd><?php echo __($this->Form->file('siteimage_file', array('class'=> 'fileupload customfile-input'))); ?>
                             <p style="padding-bottom:15px;">(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
                             <?php if($this->data['Site']['siteimage']): ?>&nbsp;&nbsp;
			     <?php echo $this->Html->image("site_config/".$this->data['Site']['siteimage'],array('border'=>'0'));?>
                            <?php endif ?>
                        </dd>
                </dl>
		
		
		<dl>
			<dt><label><?php echo __('apartment').' '.__('listing').' '.__('limit') ?> </label></dt>
			<dd><?php echo __($this->Form->text('front_pagination',array('class'=>'small','size'=>'45')))?></dd>
		</dl>
		<dl>
			<dt><label><?php echo __('default').' '.__('language') ?></label></dt>
			<dd><?php echo $this->Form->input('language',array('options'=>$LANGUAGES,'div'=>false,'label'=>false,'lagend'=>false)); ?>
			
			
			</dd>
		</dl>
                <dl>
                    	<dt><label>Facebook <?php echo __('link') ?></label></dt>
			<dd><?php echo __($this->Form->text('facebook',array('class'=> 'small','size'=>'45'))); ?></dd>
                </dl>
                <dl>
                    	<dt><label>Facebook <?php echo __('logo') ?></label></dt>
			<dd>
				<?php // echo "<pre>"; print_r($this->data); die;?>
				<?php echo __($this->Form->file('fbimage_file', array('class'=> 'fileupload customfile-input'))); ?>
				<p style="padding-bottom:15px;">(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
				<?php if($this->data['Site']['fbimage']): ?>&nbsp;&nbsp;
				<?php echo $this->Html->image("site_config/".$this->data['Site']['fbimage'],array('border'=>'0'));?>
				<?php endif ?>
			</dd>
                </dl>
		<dl>
			<dt><label>Twitter <?php echo __('link') ?></label></dt>
			<dd><?php echo __($this->Form->text('twitter',array('class'=> 'small','size'=>'45'))); ?></dd>
		</dl>
		<dl>
			<dt><label>Twitter <?php echo __('logo') ?></label></dt>
			<dd>
				<?php echo __($this->Form->file('twimage_file', array('class'=> 'fileupload customfile-input'))); ?>
				<p style="padding-bottom:15px;">(Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
				<?php if($this->data['Site']['twimage']): ?>&nbsp;&nbsp;
				<?php echo $this->Html->image("site_config/".$this->data['Site']['twimage'],array('border'=>'0'));?>
				<?php endif ?>
			</dd>
		</dl>
		<!--
		<dl>
			<dt><label>Linkin Link</label></dt>
			<dd><?php echo __($this->Form->text('youtube',array('class'=> 'small','size'=>'45'))); ?></dd>
		</dl>
		<dl>
			<dt><label>Linkin Logo</label></dt>
			<dd>
				<?php echo __($this->Form->file('limage_file', array('class'=> 'fileupload customfile-input'))); ?>
				<p style="padding-bottom:15px;"> (Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
				<?php if($this->data['Site']['limage']): ?>&nbsp;&nbsp;
				<?php echo $this->Html->image("site_config/".$this->data['Site']['limage'],array('border'=>'0'));?>
				<?php endif ?>
			</dd>
		</dl>
		-->
		<dl>
			<dt><label>Youtube <?php echo __('link') ?></label></dt>
			<dd><?php echo __($this->Form->text('youtube',array('class'=> 'small','size'=>'45'))); ?></dd>
		</dl>
		<dl>
			<dt><label>Youtube <?php echo __('logo') ?></label></dt>
			<dd>
				<?php echo __($this->Form->file('youtubeimage_file', array('class'=> 'fileupload customfile-input'))); ?>
				<p style="padding-bottom:15px;"> (Only png, gif, jpg, jpeg types are allowed. Max Image Size is 150KB.)</p>
				<?php if($this->data['Site']['limage']): ?>&nbsp;&nbsp;
				<?php echo $this->Html->image("site_config/".$this->data['Site']['youtubeimage'],array('border'=>'0'));?>
				<?php endif ?>
			</dd>
		</dl>
		<dl>
			<dt><label>Meta <?php echo __('kewords') ?></label></dt>
			<dd><?php echo __($this->Form->textarea('metakeyword',array('class'=>'small','style'=>'height:100px;width:300px')));?></dd>
		</dl>
		<dl>
			<dt><label>Meta <?php echo __('description') ?></label></dt>
			<dd><?php echo __($this->Form->textarea('metaDescription',array('class'=>'small','style'=>'height:100px;width:300px')));?></dd>
		</dl>
		<dl>
			<dt><label>Google Analytic <?php echo __('code') ?> </label></dt>
			<dd><?php echo __($this->Form->textarea('googlecode',array('class'=>'small','style'=>'height:100px;width:300px')));?></dd>
		</dl>
	</fieldset>
	<button type="submit">
		<?php echo __('Save');	?>
	</button>
        <?php $this->Form->end();?>
</div>
