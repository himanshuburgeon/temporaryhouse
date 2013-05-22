<?php echo $this->Html->script('creditcard.js'); ?>
<script type="text/javascript">
function validate(){
	var form = document.paydue;

	//if(form.cardtype.value=='' || form.cardtype.value==undefined){
		if((form.cardtype[0].checked==false) && (form.cardtype[1].checked==false) && (form.cardtype[2].checked==false)){
		alert('please choose card type');
		form.cardtype[0].focus();
		return false;
	}
	
	if(form.cardname.value==''){
		alert('please ener card name');
		form.cardname.focus();
		return false;
	}
	if(form.cardnum.value==''){
		alert('please enter card number');
		form.cardnum.focus();
		return false;
	}
	if(form.securitycode.value==''){
		alert('please enter card security code');
		form.securitycode.focus();
		return false;
	}
	if(form.exp.value==''){
		alert('please enter card exp. date');
		form.exp.focus();
		return false;
	}
	myCardNo = form.value('cardnum').value;
	myCardType= form.value('cardtype').value;
	if (checkCreditCard (myCardNo,myCardType)) {
    alert ("Credit card has a valid format")
	} 
	else {alert (ccErrors[ccErrorNo])};

	return true;
}
</script>

<div class="content-left">
	<h1>Pay Dues</h1>
	<?php echo $this->element('front_message'); ?>
	<div class="pay-dues-box">
		<form id="" name="paydue" class="pay-dues-form" method="post" onsubmit="return validate();">
			<input type="hidden" name="total_value" value="<?php echo $total_fee; ?>" />
			<h3>Membership Dues</h3>
			<div class="clear"></div>
			<?php if(!$contractor['Contractor']['paid_sign_up_fee']){ ?>
				<div class="pay-text-box_2">
					<label for="pay-label" class="pay-label_1" style="color:#1A4F91">Sign up Fee : </label>
					<div class="pay_01">$<?php echo $contractor['Contractor']['sign_up_fee'];  ?></div>
				</div>
			<?php } ?>
			
			<div class="pay-text-box_2">
				<label for="pay-label" class="pay-label_1" style="color:#1A4F91">Quarterly Dues : </label>
				<div class="pay_01">$<?php echo $contractor['Contractor']['quarterly_fee'];  ?></div>
			</div>
			
			<div class="pay-text-box_2">
				<label for="pay-label" class="pay-label_1" style="color:#1A4F91">Total : </label>
				<div class="pay_01">$<?php printf('%2.2f',$total_fee);  ?></div>
			</div>
			
			<div class="clear"></div>
			
			<h3>Method of Payment</h3>
			<!--
            <div class="pay-check-box">
               <label for="pay-label" class="pay-label">Pay monthly</label>
               <input type="checkbox" id="" class="check-box" />
            </div>
            <div class="pay-check-box">
               <label for="pay-label" class="pay-label">Pay quarterly</label>
               <input type="checkbox" id="" class="check-box" />
            </div>
            <div class="pay-check-box">
               <label for="pay-label" class="pay-label">Pay yearly</label>
               <input type="checkbox" id="" class="check-box" />
            </div>
            <div class="pay-text-box">
            	<label for="pay-label" class="pay-label" style="float:left; width:100%;">Charge Type</label>
            </div> -->
			<div class="pay-check-box_1">
				<label for="pay-label" class="pay-label_1"> AmEx</label>
				<input type="radio" id="" value="AmEx" name="cardtype" class="check-box" />
			</div>
			
			<div class="pay-check-box_1">
				<label for="pay-label" class="pay-label_1">Visa MC</label>
				<input type="radio" id="" value="Visa" name="cardtype" class="check-box" />
			</div>
			
			<div class="pay-check-box_1 dis-none">
				<label for="pay-label" class="pay-label_1">Discover</label>
				<input type="radio" id="" value="Discover" name="cardtype" class="check-box" />
			</div>
			<div class="clear"></div>
			<div class="pay-text-box_2">
				<label for="pay-label" class="pay-label_2">Card Name</label>
				<input type="text" id="cardname" name="cardname" class="input-text_2" />
			</div>
			<div class="pay-text-box_2">
				<label for="pay-label" class="pay-label_2">Card Number</label>
				<input type="text" id="cardnum" name="cardnum" class="input-text_2" />
			</div>
			
			<div class="pay-text-box_2">
				<label for="pay-label" class="pay-label_2">Security Code</label>
				<input type="text" id="securitycode" name="securitycode" class="input-text_2" />
			</div>
			
			<div class="pay-text-box_3">
				<label for="pay-label" class="pay-label_2 _w50">Exp.</label>
				<input type="text" id="exp" name="exp" class="input-text_2" />
			</div>
			<!--
			<div class="pay-text-box_4">
				<label for="pay-label" class="pay-label_2 _w150">Billing Address</label>
				<input type="text" id="" name="bill" class="input-text_2" />
			</div>
			
			<div class="pay-text-box_4">
				<label for="pay-label" class="pay-label_2 _w150">Billing City , State Zip</label>
				<input type="text" id="" class="input-text_2" />
			</div>
			
			<div class="pay-text-box_4">
				<label for="pay-label" class="pay-label_2 _w150">Signature</label>
				<textarea id="" class="input-text_2" cols="5" rows="10"></textarea>
			</div>
			-->
			<div class="pay-text-box_4">
				<input type="submit" value="Pay now" id="" class="submit">
			</div>
		</form>
	</div>
</div>
<?php echo $this->element('rightmenu'); ?>
