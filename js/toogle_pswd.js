function toogleData(){
    var x = document.getElementById("account-confidential").type;
    if(x=="password"){
        document.getElementById("account-confidential").type = "text";
    }else{
        document.getElementById("account-confidential").type="password";
    }
}