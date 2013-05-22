function validatefields()
{
	if(document.getElementById('UserOldpassword').value=='')
	{
		alert('Please enter your current password');
		document.getElementById('UserOldpassword').focus();
		return false;
	}
	if(document.getElementById('UserPassword').value=='')
	{
		alert('Please enter your new password');
		document.getElementById('UserPassword').focus();
		return false;
	}
	if(document.getElementById('UserPassword2').value=='')
	{
		alert('Please confirm your password');
		document.getElementById('UserPassword2').focus();
		return false;
	}
	var password = document.getElementById('UserPassword').value;
	var password2 = document.getElementById('UserPassword2').value;
	if(password != password2)
	{
		alert('Password do not match please retry with correct password');
		document.getElementById('UserPassword2').value='';
		document.getElementById('UserPassword2').focus();
		return false;
	}
}