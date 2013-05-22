function CheckAll(chk,chk_class){
	$('.'+chk_class).attr({'checked':chk.checked});
}

function is_email(str) 
{

	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
	   
	   return false;
	}
	
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	  // alert("Invalid E-mail ID")
	   return false;
	}
	
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
	  //  alert("Invalid E-mail ID")
		return false;
	}
	
	if (str.indexOf(at,(lat+1))!=-1){
	//  alert("Invalid E-mail ID")
	return false;
	}
	
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
	// alert("Invalid E-mail ID")
	return false;
	}
	
	if (str.indexOf(dot,(lat+2))==-1){
	//alert("Invalid E-mail ID")
	return false;
	}
			
	if (str.indexOf(" ")!=-1){
	// alert("Invalid E-mail ID")
	return false;
	}
	else
	 return true;					
}
function IsNumeric(sText)

{

   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
   		 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
      {
		 
         IsNumber = false;
      }
   }
   return IsNumber;
   
}









