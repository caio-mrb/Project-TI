function validation() {
   var username = document.loginForm.username.value;
   var password = document.loginForm.password.value;


   if (username == null || username == "") {
       document.getElementById("warningUser").style.display = 'flex';
       document.getElementById("usernameLabel").style.borderColor = 'red';
       document.loginForm.username.focus();
       return false;
   }

   if (password == null || password == "") {
       document.getElementById("warningPass").style.display = 'flex';
       document.getElementById("passwordLabel").style.borderColor = 'red';
       document.loginForm.password.focus();
       return false;
   }

   return true;
}
