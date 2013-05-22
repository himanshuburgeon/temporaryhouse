<script language="javascript">
function checkemail(str){
	var filter=/^.+@.+\..{2,3}$/;
	testresults=false;
	if (filter.test(str))
		testresults=true;
	return testresults;
}
function isAlphabet(str)
{
	var filter= /^[a-zA-Z]+[a-zA-Z]+[a-zA-Z ]{0,98}$/; 
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
function validate()
{
	if(document.getElementById('HomeownerName').value=='')
	{
		alert("Please Enter  name");
		document.getElementById('HomeownerName').focus();
		return false;
	}
	if(document.getElementById('HomeownerEmail').value=='')
	{
		alert("Please enter email id");
		document.getElementById('HomeownerEmail').focus();
		return false;
	}
	if(!checkemail(document.getElementById('HomeownerEmail').value))
	{
		alert("Please enter a valid email id");
		document.getElementById('HomeownerEmail').focus();
		return false;
	}
	
	if(!IsNumeric(document.getElementById('HomeownerPhone').value))
	{
		alert("Please enter  numbers only");
		document.getElementById('HomeownerPhone').focus();
		return false;
	}
		
}
</script>
<div class="content-left">
      	<h1>Homeowner form</h1>
      	<?php echo $this->element('front_message'); ?>
        <div id="contractor">
			<?php echo $this->Form->create('HomeOwnerUser', array('url'=>array('controller'=>'homeowners','action'=>'userform'),'action'=>'userform','onSubmit'=>"//return validate()"));?>
        	<?php echo $this->Form->input('id'); ?>
			
        	<div class="contractor">Name :</div><span style="color:red;">*</span>
           <?php echo $this->Form->text('name',array('class'=> 'float-left','size'=>'45')); ?>
            
			<div class="contractor">Email Address :</div><span style="color:red;">*</span>
            <?php echo $this->Form->text('email',array('class'=> 'float-left','size'=>'45')); ?>
			
            <div class="contractor">Address :</div>
            <?php echo $this->Form->text('address',array('class'=> 'float-left','size'=>'45')); ?>
            
            <div class="contractor">Address2 :</div>
            <?php echo $this->Form->text('address2',array('class'=> 'float-left','size'=>'45')); ?>
            
            <div class="contractor">Phone no. :</div>
            <?php echo $this->Form->text('phone',array('class'=> 'float-left','size'=>'45')); ?>
            
            <div class="contractor">City :</div>
            <?php echo $this->Form->text('city',array('class'=> 'float-left','size'=>'45')); ?>
            
            <div class="contractor">State :</div>
            <?php echo $this->Form->input('state',array('options'=>Configure::read('STATE'),'class'=>'float-left','div'=>false, 'legend'=>false, 'label'=>false)); ?>
            
            <div class="contractor">Zip :</div>
            <?php echo $this->Form->text('zip',array('class'=> 'float-left','size'=>'45')); ?>
                        
           
			<div class="contractor">&nbsp;</div>
            <?php echo $this->Form->submit('submit',array('class'=> 'float-left')); ?>
                    
        <?php echo $this->Form->end(); ?>
</div>
</div>
<?php echo $this->element('rightmenu'); ?>
<?php //if(!empty($this->request->data) || $this->Session->check('Message.flash')){ ?>
<script type="text/javascript">
//	$(document).ready(function(){
	
	//  window.location.hash = "#contractor";
	//})
	//;
</script>
<?php //} ?>
    
