const mailInput = document.getElementById("EmailInput");
const passwordInput = document.getElementById("PasswordInput");
const btnlogin = document.getElementById("btnlogin");
const loginForm = document.getElementById("loginForm");



btnlogin.addEventListener("click", checkCredentials);

function checkCredentials() {
    let dataForm = new FormData(loginForm);

    let myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    let raw = JSON.stringify({
        email: dataForm.get("email"),         // ⚠️ Debe coincidir con `username_path: email`
        password: dataForm.get("password")
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
                throw new Error("Erreur lors de connexion");
            }
        })
        .then(result => {
            alert("Bravo vous êtes maintenant connecté.");

            setCookie("accesstoken", result.token, 7); // ⚠️ Aquí asegúrate que el backend responde con "token"
            setCookie("role", "admin", 7);

            console.log("Token guardado:", getCookie("accesstoken"));
            document.location.href = "/login";
        })
        .catch(error => {
            console.error("Erreur attrapée :", error);
            alert(error.message);
        });
}
