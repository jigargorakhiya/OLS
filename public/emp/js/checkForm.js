function checkForm(form)
{
	var email=document.getElementById('email');
	var phno =document.getElementById('phno');
		
    if(form.firstname.value == "") {
      alert("Error: firstname cannot be blank!");
      form.firstname.focus();
      return false;
    }
    re = /^[a-zA-Z]+$/;
    if(!re.test(form.firstname.value)) {
      alert("Error: firstname must contain only letters");
      form.firstname.focus();
      return false;
    }
    if(form.lastname.value == "") {
      alert("Error: lastname cannot be blank!");
      form.lastname.focus();
      return false;
    }
   re = /^[a-zA-Z]+$/;
    if(!re.test(form.lastname.value)) {
      alert("Error: lastname must contain only letters");
      form.lastname.focus();
      return false;
    }
	 if((document.addContact.male.checked==false) && (document.addContact.female.checked==false)){
           alert("Please Select Your Gender");return false;}
	
		re= /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(!email.value.match(re))
		{
		alert("Please enter a valid E-mail Address");
			email.focus();
			return false;
		}
		
		if(form.phno.value=="")
		{
			alert("Phone Number can not be blank");
			return false;
		}
		 re = /^[0-9]+$/;
		if(!re.test(form.phno.value))
		{
			alert("Numebers Only");
			return false;
		}
		if((form.phno.value.charAt("0")==9) || (form.phno.value.charAt("0")==8))
		{
			return true;
		}
		else
		{
			alert("Number must be start with 9 or 8");
			return false;
		}
		
}