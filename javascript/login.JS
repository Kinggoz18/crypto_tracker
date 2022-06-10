'use strict'
//Handles switching between signup and register
function loginPage()
{
    const signupBtn = document.querySelector('.swicth-signup');
    const loginBtn = document.querySelector('.swicth-login');
    const loginSection= document.querySelector('.login-section');
    const signupSection= document.querySelector('.signup-section');
    const createAcc = document.querySelector("#createAcc");
    signupBtn.addEventListener("click",(event)=>{
        event.preventDefault();
        loginSection.classList.add('hidden');
        signupSection.classList.remove('hidden');

    }); //IF THE SIGNUP BUTTON WAS CLICKED SWITCH TO SIGN UP
    loginBtn.addEventListener("click",(event)=>{
        event.preventDefault();
        signupSection.classList.add('hidden');
        loginSection.classList.remove('hidden');

    }); //ELSE IF IF THE LOGIN SWITCH BUTTON WAS CLICKED SWITCH TO SIGN UP
    createAcc.addEventListener("click", (event)=>{
        const su_username = document.querySelector("#signup-username").value;
        const su_password = document.querySelector("#signup-password").value;
        const error = document.querySelector("#signup-error");
        if(su_username.length == 0 || su_password.length == 0 || !error.classList.contains("hidden"))
        {
            event.preventDefault();
        }
    });
}

$(document).ready(()=>{
    //Login page
    loginPage();
});