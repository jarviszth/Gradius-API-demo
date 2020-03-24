/* 
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";

    // Finally submit the form. 
    form.submit();
}
function formhashConf(form, password, conf) {

	 if ( password.value != '' || conf.value != '') {
		 
		 if(password.value == '' || conf.value == ''){
			 alert('Password And Confirm Cannot Be empty');
		     return false;
		 }else{
			 
			 // Check password and confirmation are the same
			    if (password.value != conf.value) {
			        alert('Your password and confirmation do not match. Please try again');
			        form.password.focus();
			        return false;
			    }else{
				
				    // Create a new element input, this will be our hashed password field. 
				    var p = document.createElement("input");
				
				    // Add the new element to our form. 
				    form.appendChild(p);
				    p.name = "p";
				    p.type = "hidden";
				    p.value = hex_sha512(password.value);
				
				    // Make sure the plaintext password doesn't get sent. 
				    password.value = "";
				    conf.value = "";
				
				    // Finally submit the form. 
				    form.submit();
			    }
			 
			 
		 }
	        
	}else{
		// Finally submit the form. 
	    form.submit();
	}
	
}


function regformhash(form, uid, email, password, conf) {
    // Check each field has a value
    if (uid.value == '' || email.value == '' || password.value == '' || conf.value == '') {
        alert('You must provide all the requested details. Please try again');
        return false;
    }
    
    // Check the username
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Username must contain only letters, numbers and underscores. Please try again"); 
        form.username.focus();
        return false; 
    }
    
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
    
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
    //var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;//Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again
    //var re = /(?=.*[a-zA-Z\d]).{5,}/;//Passwords must contain at least one number, one lowercase or one uppercase letter.  Please try again
    var re = /(?=.*\d)(?=.*[a-zA-Z]).{6,}/;//Passwords must contain at least one number, one lowercase or one uppercase letter.  Please try again
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
    
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
        
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";

    // Finally submit the form. 
    form.submit();
    return true;
}
function regformChangePassHash(form, password, conf) {
    // Check each field has a value
    if (password.value == '' || conf.value == '') {
        alert('Password And Confirm Cannot Be empty');
        return false;
    }

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter
    // At least six characters
    //var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    // var re = /(?=.*\d)(?=.*[a-zA-Z]).{6,}/;
    // var re = /(?=.*\d)(?=.*[a-zA-Z]).{6,}/;
    // if (!re.test(password.value)) {
    //     alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
    //     return false;
    // }


    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);



    //only for radius project
    //send original password pain text to radcheck
    var pwd_radius = document.createElement("input");
    form.appendChild(pwd_radius);
    pwd_radius.name = "pr";
    pwd_radius.type = "hidden";
    pwd_radius.value = password.value;





    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    conf.value = "";

    // Finally submit the form.
    form.submit();
    return true;
}

//for radius user


function radiusRegformhash(form, user_name, password, conf) {
    // Check each field has a value
    if (user_name.value == '' || password.value == '' || conf.value == '') {
        alert('You must provide all the requested details. Please try again');
        return false;
    }

    // Check the username
    re = /^\w+$/;
    if(!re.test(user_name.value)) {
        alert("Username must contain only letters, numbers and underscores. Please try again");
        form.user_name.focus();
        return false;
    }

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 5) {
        alert('Passwords must be at least 5 characters long.  Please try again');
        form.password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter
    // At least five characters
    //var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;//Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again
    //var re = /(?=.*\d)(?=.*[a-zA-Z]).{6,}/;//Passwords must contain at least one number, one lowercase or one uppercase letter.  Please try again
    var re = /(?=.*[a-zA-Z\d]).{5,}/;//Passwords must contain at least one number, one lowercase or one uppercase letter.  Please try again
    if (!re.test(password.value)) {
        alert('Passwords must contain at number or lowercase or uppercase letter.  Please try again');
        return false;
    }

    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);


    //send original password pain text to radcheck
    var pwd_radius = document.createElement("input");
    form.appendChild(pwd_radius);
    pwd_radius.name = "pr";
    pwd_radius.type = "hidden";
    pwd_radius.value = password.value;

    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    conf.value = "";

    // Finally submit the form.
    form.submit();
    return true;
}
function radiusRegformChangePassHash(form, password, conf) {
    // Check each field has a value
    if (password.value == '' || conf.value == '') {
        alert('Password And Confirm Cannot Be empty');
        return false;
    }

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 5) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter
    // At least six characters
    //var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    var re = /(?=.*[a-zA-Z\d]).{5,}/;//Passwords must contain at least one number, one lowercase or one uppercase letter.  Please try again
    if (!re.test(password.value)) {
        alert('Passwords must contain at number or lowercase or uppercase letter.  Please try again');
        return false;
    }

    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    //send original password pain text to radcheck
    var pwd_radius = document.createElement("input");
    form.appendChild(pwd_radius);
    pwd_radius.name = "pr";
    pwd_radius.type = "hidden";
    pwd_radius.value = password.value;

    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    conf.value = "";

    // Finally submit the form.
    form.submit();
    return true;
}
function radiusFormhash(form, password) {
    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
    //send original password pain text to radcheck
    var pwd_radius = document.createElement("input");
    form.appendChild(pwd_radius);
    pwd_radius.name = "pr";
    pwd_radius.type = "hidden";
    pwd_radius.value = password.value;

    // Make sure the plaintext password doesn't get sent.
    password.value = "";

    // Finally submit the form.
    form.submit();
}