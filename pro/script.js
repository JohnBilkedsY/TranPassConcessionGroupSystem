function clear()
{   
   document.getElementById("Form").reset();
}

function validateLoginForm() {
   var email = document.getElementById("loginEmail").value;
   var password = document.getElementById("loginPassword").value;

   if (email.trim() == "") {
       alert("Please enter your email.");
       return false;
   }

   if (password.trim() == "") {
       alert("Please enter your password.");
       return false;
   }

   return true;
}
function validateLoginForm2() {
    var email = document.getElementById("loginUsername").value;
    var password = document.getElementById("loginPassword").value;
 
    if (email.trim() == "") {
        alert("Please enter your email.");
        return false;
    }
 
    if (password.trim() == "") {
        alert("Please enter your password.");
        return false;
    }
 
    return true;
 }

function validateRegistrationForm() {
   var email = document.getElementById("registerEmail").value;
   var password = document.getElementById("registerPassword").value;
   var confirmPassword = document.getElementById("confirmPassword").value;
   var stud_deptno = document.getElementById("stud_deptno").value;
   var location = document.getElementById("location").value;
   var dob = document.getElementById("dob").value;
   
   if (stud_deptno.trim() == "") {
    alert("Please enter your Department Number.");
    return false;
    }
    if (location.trim() == "") {
        alert("Please enter your Location.");
        return false;
    }
    if (dob.trim() == "") {
        alert("Please enter your Date of Birth.");
        return false;
    }

   if (email.trim() == "") {
       alert("Please enter your email.");
       return false;
   }

   if (password.trim() == "") {
       alert("Please enter a password.");
       return false;
   }

   if (confirmPassword.trim() == "") {
       alert("Please confirm your password.");
       return false;
   }
   
    if (passwordStrength < 2) {
        alert('Password must contain at least one uppercase letter, one lowercase letter, and one number.');
        return false;
    }
   if (password !== confirmPassword) {
       alert("Passwords do not match.");
       return false;
   }

   return true;
}



function validateGroupCreationForm() {
   var groupName = document.getElementById("groupName").value;
   var sourceId = document.getElementById("sourceId").value;
   var destinationId = document.getElementById("destinationId").value;

   if (groupName.trim() == "") {
       alert("Please enter a group name.");
       return false;
   }

   if (sourceId.trim() == "") {
       alert("Please select a source station.");
       return false;
   }

   if (destinationId.trim() == "") {
       alert("Please select a destination station.");
       return false;
   }

   return true;
}