function validateLoginForm(){
    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;

    if(username.trim() === ''|| password.trim() === ''){
        alert('Please fill in all fields!');
        return false
    }

    console.log('Login:', {username, password});
    return false;


    window.location.href = 'home.html';
    return false;
}

function validateRegisterForm() {
    const username = document.getElementById('reUsername').value;
    const email = document.getElementById('reEmail').value;
    const password = document.getElementById('rePassword').value;
    const confirmPassword = document.getElementById('reConfirmPassword').value;

    if(username.trim() === '' || email.trim === '' || password.trim() === ''|| confirmPassword.trim() === ''){
        alert('Please fill in all fields!');
        return false
    }
    if(password !== confirmPassword){
        alert('Password do not match!');
        return false
    }

    console.log('Register:', { username, email, password});
    return false

    function logout() {
        window.location.href = 'login.html'
    }

}