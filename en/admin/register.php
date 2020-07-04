<?php
include_once "header.php";
?>

	<h4 style="margin-top:15px;">Create an administrator account</h4>
	<h5>Please enter the following information</h5>

       <script>
    function formCheck(){
        if ($('#fname').val()=='') { alert("Please enter name"); return false; e.preventDefault(); }
        if ($('#fname').val().length < 3) { alert("Name can't be less than 3 characters"); return false; e.preventDefault();}
        if ($('#lname').val()=='') { alert("Please enter Last Name"); return false; e.preventDefault();}
        if ($('#lname').val().length < 2) { alert("Last name can't be less than 2 characters"); return false; e.preventDefault();}
        if ($('#username').val()=='') { alert("Please enter username"); return false; e.preventDefault();}
        if ($('#username').val().length < 5) { alert("Username can't be less than 5 chrarcters"); return false; e.preventDefault();}
        if ($('#password').val()=='') { alert("Please enter password"); return false; e.preventDefault();}
        if ($('#password').val().length < 6) { alert("Password can't be less than 6 characters"); return false; e.preventDefault();}
        if ($('#password').val()!=$('#password2').val()) { alert("Passwords do not match"); return false; e.preventDefault();}
        var emailPattern =/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(document.getElementById("email").value)) { alert("Wrong type of email"); return false; e.preventDefault();}
		var chkTerms = document.getElementById("terms");
        if (!chkTerms.checked) {
            alert("Please agree that you have acknowledged and understood the terms of creating an administrator account.");
			return false; 
			e.prevendDefault();
        }
		document.getElementById('myForm').submit();
    }    
    </script>

	<form id="myForm" method="post" action="registerdb.php" >
	<table>
	    <tr>
		<td><label >First Name : </label></td>
			<td><input style="margin-left: 27px; width: 250px;" name="fname" type='text' id='fname'></td>
		</tr>
		
		<tr height="10px;"></tr>

		<tr>
		<td><label >Last Name : </label></td>
			<td><input style="margin-left: 27px; width: 250px;" name="lname" type='text' id='lname'></td>
		</tr>
		
		<tr height="10px;"></tr>
		<tr>
		<td><label >Username : </label></td>
			<td><input style="margin-left: 27px; width: 250px;" name="username" type='text' id='username'></td>
		</tr>
		
		<tr height="10px;"></tr>
		<tr>
		<td><label >Password : </label></td>
			<td><input style="margin-left: 27px; width: 250px;" name="password" type='password' id='password'></td>
		</tr>
		<tr height="10px;"></tr>
		
                <tr>
		<td><label >Repeat Password : </label></td>
			<td><input style="margin-left: 27px; width: 250px;" name="password2" type='password' id='password2'></td>
		</tr>
		<tr height="10px;"></tr>
		
		<tr>
		<td><label >Email : </label></td> 
			<td><input style="margin-left: 27px; width: 250px;" name="email" type='text' id='email'></td>
		</tr>
		<tr height="10px;"></tr>
	</table>
    <h6>*Terms*: By creating an administrator account I acknowledge that full access rights will be granted.</h6>
	<input type="checkbox" id="terms" name="terms" value="Terms">
	<label for="terms"> Agree</label><br>
	
	<a href="#!" style="margin-top: 10px;" class="button icon approve" onclick="formCheck();" type="button" value='Submit' id='addButton2'>Submit </a>
	
	</form>	


<?php
include_once "footer.php";
?>