////////BUTON VIZUALIZARE PAROLA///////

function togglePasswordVisibility() {
    var passwordInput = document.getElementById('passwordInput');
    var showPasswordBtn = document.getElementById('showPasswordBtn');
 
    if (passwordInput.type === 'password') {
       passwordInput.type = 'text';
       showPasswordBtn.textContent = 'Hide Password';
    } else {
       passwordInput.type = 'password';
       showPasswordBtn.textContent = 'Show Password ☼ ';
    }
 }
 