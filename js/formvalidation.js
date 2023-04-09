function validation() {
   var username = document.loginForm.username;
   var password = document.loginForm.password;

    username.addEventListener('input',hideWarning);
    
    password.addEventListener('input',hideWarning);


   function hideWarning(){
    if(username.value.length > 0)
    {
        document.getElementById("warningUser").style.display = 'none';
        document.getElementById("usernameLabel").style.borderColor = '#838282';
    }
    if(password.value.length > 0)
    {
        document.getElementById("warningPass").style.display = 'none';
        document.getElementById("passwordLabel").style.borderColor = '#838282';
    }
   }

   if (username.value == null || username.value == "") {
       document.getElementById("warningUser").style.display = 'flex';
       document.getElementById("usernameLabel").style.borderColor = 'red';
       document.loginForm.username.focus();
       return false;
   }

   if (password.value == null || password.value == "") {
       document.getElementById("warningPass").style.display = 'flex';
       document.getElementById("passwordLabel").style.borderColor = 'red';
       document.loginForm.password.focus();
       return false;
   }

   return true;
}
