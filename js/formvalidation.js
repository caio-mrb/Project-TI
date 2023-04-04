function validation(){
    if( document.loginForm.username.value == "" ) {
        document.loginForm.emptyUser.style.display = 'block';
        document.loginForm.username.focus() ;
        return false;
     }
     if( document.loginForm.password.value == "" ) {
        document.getElementsById("emptyPass").style.display = 'block';
        document.loginForm.password.focus() ;
        return false;
     }
     return false;
}
