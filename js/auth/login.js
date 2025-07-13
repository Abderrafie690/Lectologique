const mailInput = document.getElementById("EmailInput");
const passwordInput = document.getElementById("PasswordInput");
const btnlogin = document.getElementById("btnlogin");



btnlogin.addEventListener("click", checkCredentials);

function checkCredentials(){
    if(mailInput.value == "test@mail.com" && passwordInput.value == "123"){
        

        const token = "lkjsdngfljsqdnglkjsdbglkjqskjgkfjgbqslkfdgbskldfgdfgsdgf";
        setToken(token);

       // setCookie(RoleCookieName, "admin", 7); // ✅ GUARDAR ANTES DE REDIRIGIR

        window.location.replace("/"); // ✅ REDIRECCIÓN AL FINAL
    } else {
        mailInput.classList.add("is-invalid");
        passwordInput.classList.add("is-invalid");
    }
}
