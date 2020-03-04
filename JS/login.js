var usererr=document.getElementById("usererr");
var passerr=document.getElementById("passerr");
var username=document.getElementById("username");
var password=document.getElementById("password");

function validate(){
if(username.value==""){
usererr.innerHTML="Please provide username";
alert("username not correct");
return 0;
}
if(password.innerHTML=="")
passerr.value="Please provide password";
//window.location.href = "http://www.w3schools.com";
}

function usernameOnFocus(){
usererr.innerHTML="";
if(username.value=="username"){
username.value="";
}
}


function usernameOnFocusOut(){
console.log("run");
if(username.value==""){
console.log("run");
usererr.innerHTML="Please provide username";

}

}
