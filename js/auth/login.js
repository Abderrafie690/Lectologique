const mailInput = document.getElementById("EmailInput");
const passwordInput = document.getElementById("PasswordInput");
const btnlogin = document.getElementById("btnlogin");
const loginForm = document.getElementById("loginForm");



btnlogin.addEventListener("click", checkCredentials);

function checkCredentials(){
    let dataForm = new FormData(loginForm);

    
    
    
    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    let raw = JSON.stringify({
        "username": dataForm.get("email"),
        "password": dataForm.get("password")
    });

    let requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: raw,
        redirect: 'follow'
    };

  fetch("https://127.0.0.1:8000/api/login", requestOptions) 
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error("Erreur lors de connexion"); // ⛔ Detiene aquí
        }
    })
    .then(result => {
        alert("Bravo vous êtes maintenant connecté.");
        const fakeToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.FAKE_PAYLOAD.FAKE_SIGNATURE";
        setCookie("accesstoken", fakeToken, 7);
        setCookie("role", "user", 7); // Opcional si usas roles
        document.location.href = "/login";

        console.log("Token guardado:", getCookie("accesstoken"));
    })
    .catch(error => {
        console.error("Erreur attrapée :", error);
        alert(error.message); // Muestra mensaje de error
    });

    
    
}